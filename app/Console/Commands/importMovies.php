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
    protected $signature = 'import:movies';

    protected $description = 'Импорт фильмов из API кинопоиска и добавление в БД';

    protected int $totalPages = 11; //108065 всего фильмов todo: Захордкоженное количество страниц это конечно пиздец что могу сказать товарищи

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



    public function handle(ImportLoggerService $importService): void
    {

        $last_movie = null;
        $last_page = null;

        $this->info("Импорт начался...");

        $last_imported_page = DB::table('import')->orderByDesc('last_movie_page')->value('last_movie_page');
        $last_imported_id = DB::table('import')->orderByDesc('last_movie_id')->value('last_movie_id');

        $this->info("Последняя импортированная страница: " . $last_imported_page);
        $this->info("Последний импортированный ID: " . $last_imported_id);

        for ($i = $last_imported_page + 1; $i <= $this->totalPages; $i++) {
            $response = Http::withHeaders(['X-API-KEY' => env('APP_IMPORT_KEY')])
                ->timeout(300)
                ->get("https://api.kinopoisk.dev/v1.4/movie?page=$i&selectFields=id&selectFields=name&selectFields=alternativeName&selectFields=year&selectFields=type&selectFields=poster&selectFields=description&selectFields=movieLength&selectFields=ageRating&selectFields=shortDescription&selectFields=persons&selectFields=genres&selectFields=countries&limit=5");

            if ($response->successful()) {
                $data = $response->json();

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
                            'user_published' => 2
                        ]);

                        // актёры
                        $personIds = [];

                            foreach ($movie['persons'] as $person) {
                                $p = Person::query()->firstOrCreate(
                                    ['kinopoisk_id' => $person['id']],
                                    [
                                        'name' => $person['name'],
                                        'eng_name' => $person['enName'],
                                        'profession' => $person['profession'],
                                        'photo' => $person['photo'],
                                    ]
                                );
                                $personIds[] = $p->id;
                            }

                        $new_movie->persons()->sync($personIds);

                        // бывает что ключа 'genres' не приходит с апи, так что делаем проверку этого ключа
                        if (array_key_exists('genres', $movie)) {
                            $genreIds = Genre::query()->
                            whereIn('name',
                                collect($movie['genres'])
                                ->pluck('name'))
                                ->pluck('id');
                            $new_movie->genres()->attach($genreIds);
                        }

                        if (array_key_exists('countries', $movie)) {
                        $countryIds = Country::query()->
                            whereIn('name',
                                collect($movie['countries'])
                                    ->pluck('name'))
                                ->pluck('id');
                            $new_movie->countries()->attach($countryIds);
                        }



                        $last_page = $data['page'];
                        $last_movie = $movie['id'];

                        $importService->logImport($movie['id'],$data['page'],'last_movie_id','last_movie_page');
                       // $importService->logImport($movie['persons']['id'],$data['page'],'last_person_id','last_person_page');



                    } catch (\Throwable $e) {
                        $this->error("Ошибка парсинга {$e->getMessage()} ");
                        //$this->logImport($movie['id'], $data['page']);
                        break 2; // разрыв двух циклов
                    }
                }

                $this->logImport($last_movie, $data['page']);

                $this->info("last_movie_id: {$last_movie} , page: {$last_page}");


            } else {
                match ($response->status()) {
                    403 => $this->error("Превышен дневной лимит. Статус {$response->status()}"),
                    default => $this->error("Ошибка для ID $i: {$response->status()} . Остановка цикла"),
                };

                break;
            }
            sleep(1);
        }

        $this->info("Импорт закончился...");
    }
}







