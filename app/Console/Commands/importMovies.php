<?php

namespace App\Console\Commands;

use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
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

    protected int $totalPages = 108065; //108065 всего фильмов


    public function logImport(int $movieId , int $page):void
    {
        DB::table('import')->insert([
            'last_movie_id'   => $movieId,
            'last_movie_page' => $page,
        ]);
        $this->info("В таблицу импорта добавлено last_movie_id: $movieId  , last_movie_page: $page ");
    }


    public function handle(): void
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
                ->get("https://api.kinopoisk.dev/v1.4/movie?page=" . $i);

            if ($response->successful()) {
                $data = $response->json();

                foreach ($data['docs'] as $movie) {

                    try {

                       $new_movie = Movie::query()->create([
                            'id_kinopoisk' => $movie['id'],
                            'name' => $movie['name'],
                            'eng_name' => $movie['alternativeName'],
                            'type' => $movie['type'],
                            'year' => $movie['year'],
                            'preview_url' => data_get($movie, 'poster.url'),
                            'description' => $movie['description'],
                            'movieLength' => $movie['movieLength'],
                            'age_rating' => $movie['ageRating'],
                            'shortDescription' => $movie['shortDescription'],
                            'user_published' => 1
                        ]);

                        $genreIds = Genre::query()->
                        whereIn('name',
                        collect($movie['genres'])
                        ->pluck('name'))
                        ->pluck('id');

                        $countryIds = Country::query()->
                        whereIn('name',
                            collect($movie['countries'])
                                ->pluck('name'))
                            ->pluck('id');


                        $new_movie->genres()->attach($genreIds);
                        $new_movie->countries()->attach($countryIds);


                        $last_page = $data['page'];
                        $last_movie = $movie['id'];

                    } catch (\Throwable $e) {
                        $this->error("Ошибка парсинга {$e->getMessage()} ");
                        $this->logImport($movie['id'], $data['page']);
                        break 2; // разрыв двух циклов
                    }
                }

                $this->logImport($last_movie, $data['page']);

                $this->info("last_movie_id: {$last_movie} , page: {$last_page}");


            } else {
                match ($response->status()){
                    403=> $this->error("Превышен дневной лимит. Статус {$response->status()}"),
                    default => $this->error("Ошибка для ID $i: {$response->status()} . Остановка цикла"),
                };

                break;
            }
            sleep(1);
        }

        $this->info("Импорт закончился...");
    }
}

