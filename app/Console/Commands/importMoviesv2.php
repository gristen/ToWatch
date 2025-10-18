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

class importMoviesv2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:movies2 {year?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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


    /**
     * Execute the console command.
     */
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


                $start = microtime(true);
                if ($year){
                    dd("year {{$year}}");
                }
                $response = Http::withHeaders(['X-API-KEY' => env('APP_IMPORT_KEY_UN')])
                    ->timeout(5000)
                    ->connectTimeout(20) // максимум 10 секунд на установку соединения
                    ->retry(3, 5000)
                    ->get("https://kinopoiskapiunofficial.tech/api/v2.2/films",[

                        'page' => $i,
                        'limit' => 2,
                        'selectFields' => [
                            'id', 'name', 'alternativeName', 'year', 'type',
                            'poster', 'description', 'movieLength', 'ageRating',
                            'shortDescription', 'persons', 'genres', 'countries',
                        ],
                        'year' => $year ?? null,


                    ]);



            if ($response->successful()) {

                $data = $response->json();
                dd($data);
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
                            'user_published' => 2
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

                                $new_movie->persons()->attach($person->id);
                            }
                        }

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

                        //$importService->logImport($movie['id'],$data['page'],'last_movie_id','last_movie_page');
                        // $importService->logImport($movie['persons']['id'],$data['page'],'last_person_id','last_person_page');



                    } catch (\Throwable $e) {
                        $this->error("Ошибка парсинга {$e->getMessage()} ");
                        //$this->logImport($movie['id'], $data['page']);
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
