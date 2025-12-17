<?php

namespace App\Console\Commands;

use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Person;
use App\Services\ImportLoggerService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class importMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:movies {year?}';

    protected $description = 'Импорт фильмов из API кинопоиска и добавление в БД';

    protected int $totalPages = 541695; // todo: Захордкоженное количество страниц это конечно пиздец что могу сказать товарищи

    //$movie - пришел с апи а нев муви который только что создал
    private function attachRelations($movie, $new_movie)
    {
        $relations = [
            'genres' => Genre::class,
            'countries' => Country::class,
            'persons' => Person::class,
        ];

        foreach ($relations as $key => $model) {
            if (empty($movie[$key])) continue;

            $ids = $model::whereIn('name', collect($movie[$key])->pluck('name'))->pluck('id');
            $new_movie->{$key}()->attach($ids);
        }
    }


    public function logImport(int $movieId , int $page):void
    {
        DB::table('import')->insert([
            'last_movie_id'   => $movieId,
            'last_movie_page' => $page,
        ]);
        $this->info("В таблицу импорта добавлено last_movie_id: $movieId  , last_movie_page: $page ");
    }



    public function handle(ImportLoggerService $importService): void
    {
        $year = $this->argument('year');
        $last_movie = null;
        $last_page = null;

        $this->info("Импорт начался...");

        $last_imported_page = DB::table('import')->orderByDesc('last_movie_page')->value('last_movie_page');
        $last_imported_id = DB::table('import')->orderByDesc('last_movie_id')->value('last_movie_id');

        $this->info("Последняя импортированная страница: " . $last_imported_page);
        $this->info("Последний импортированный ID: " . $last_imported_id);



        for ($i = $last_imported_page + 1; $i <= $this->totalPages; $i++) {

            try {
            $start = microtime(true);


                $response = Http::withHeaders(['X-API-KEY' => env('APP_IMPORT_KEY')])
                    ->timeout(5000)
                    ->connectTimeout(20) // максимум 10 секунд на установку соединения
                    ->retry(3, 5000)
                    ->get("https://api.kinopoisk.dev/v1.4/movie?selectFields&selectFields=id&selectFields=externalId&selectFields=name&selectFields=enName&selectFields=alternativeName&selectFields=description&selectFields=shortDescription&selectFields=slogan&selectFields=type&selectFields=status&selectFields=year&selectFields=releaseYears&selectFields=rating&selectFields=ageRating&selectFields=votes&selectFields=movieLength&selectFields=genres&selectFields=countries&selectFields=poster&selectFields=videos&selectFields=persons&selectFields=facts&selectFields=fees&selectFields=watchability&page=$i&limit=2&notNullFields=poster.url");

            }catch (\Illuminate\Http\Client\RequestException $e){
                $status = $e->response->status();
                $body = $e->response->body();
                match ($status) {
                    403 => $this->error("Превышен дневной лимит"),
                    default => $this->error("Неизвестная ошибка, код: $status , тело : $body" ),
                };

                break;
            }
            if ($response->successful()) {

                $data = $response->json();


                $duration = round(microtime(true) - $start, 2); // время выполнения
                $size = round(strlen($response->body()) / 1024, 2); // размер в КБ

                $countMovies = count($data['docs']);
                $this->info("✅ Страница {$i}: {$countMovies} фильмов, размер {$size} КБ, время {$duration} сек . ");
                foreach ($data['docs'] as $movie) {

                    try {

                        $new_movie = Movie::query()->create([
                            'kinopoisk_id' => $movie['id'],
                            'name' => $movie['name'],
                            'eng_name' => $movie['alternativeName'],
                            'type' => $movie['type'],
                            'year' => $movie['year'],
                            'preview_url' => data_get($movie, 'poster.url'),
                            'description' => $movie['description'],
                            'movieLength' => $movie['movieLength'],
                            'age_rating' => $movie['ageRating'],
                            'shortDescription' => $movie['shortDescription'],
                            'user_published' => 2,
                            'kp_id' => $movie['externalId']['kpHD'] ?? null,
                            'tmdb_id' => $movie['externalId']['tmdb'] ?? null,
                            'imdb_id' => $movie['externalId']['imdb'] ?? null,
                        ]);

                        if (!empty($movie['persons'])) {
                            foreach ($movie['persons'] as $personData) {
                                // ищем по имени или создаём
                                $person = Person::query()->firstOrCreate(
                                    ['name' => $personData['name']],
                                    [
                                        'photo' => $personData['photo'] ?? null,
                                        'profession' => $personData['profession'] ?? null,
                                        'enProfession' => $personData['enProfession'] ?? null,
                                        'enName' => $personData['enName'] ?? null,
                                        'description' => $personData['description'] ?? null,
                                    ]
                                );

                                $new_movie->persons()->sync($person->id);
                            }
                        }
                        //todo: status , rating - table , votes - table ,

                        // бывает что ключа 'genres' не приходит с апи, так что делаем проверку этого ключа
                        if (array_key_exists('genres', $movie)) {
                            $genreIds = Genre::query()->
                            whereIn('name',
                                collect($movie['genres'])
                                ->pluck('name'))
                                ->pluck('id');
                            $new_movie->genres()->sync($genreIds);
                        }


                        if (array_key_exists('countries', $movie)) {
                        $countryIds = Country::query()->
                            whereIn('name',
                                collect($movie['countries'])
                                    ->pluck('name'))
                                ->pluck('id');
                            $new_movie->countries()->sync($countryIds);
                        }

                        // ИСПОЛЬЗУЙТЕ:
                        if (isset($movie['watchability']) && !empty($movie['watchability']['items'])) {
                            $this->info("✅ Найдено источников для просмотра: " . count($movie['watchability']['items']));

                            foreach ($movie['watchability']['items'] as $item) {
                                $new_movie->watchability()->create([
                                    'name' => $item['name'] ?? null,
                                    'logo_url' => $item['logo']['url'] ?? null,
                                    'url'  => $item['url'] ?? null,
                                ]);
                            }
                        }


                        if (!empty($movie['videos']['trailers'])) {
                            $this->info("трейлер пойман ");
                            foreach ($movie['videos']['trailers'] as $item) {
                                $new_movie->videos()->create([
                                    'name' => $item['name'] ?? null,
                                    'url'=> $item['url'] ?? null,
                                    'site' => $item['site'] ?? null,
                                    'type' => $item['type'] ?? null,
                                ]);
                            }
                        }

                        if (!empty($movie['fees'])){
                           foreach ($movie['fees'] as $key=>$item) {


                               $new_movie->fees()->create([
                                   'name' => $key ?? null,
                                   'value' => $item['value'] ?? null,
                               ]);
                           }
                        }

                        $last_page = $data['page'];
                        $last_movie = $movie['id'];





                    } catch (\Throwable $e) {
                        $this->error("Ошибка парсинга {$e->getMessage()} ");
                        break 2; // разрыв двух циклов
                    }
                }

                $this->logImport($last_movie, $data['page']);

                $this->info("last_movie_id: {$last_movie} , page: {$last_page}");


            }
            sleep(1);
        }

        $this->info("Импорт закончился...");
    }
}







