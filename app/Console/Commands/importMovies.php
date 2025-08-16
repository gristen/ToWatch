<?php

namespace App\Console\Commands;

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

    protected int $totalPages = 2; //108065 всего фильмов


    public function handle():void
    {

        $this->info("Импорт начался...");

        $last_imported_page = DB::table('import')->orderByDesc('last_movie_page')->value('last_movie_page');
        $last_imported_id = DB::table('import')->orderByDesc('last_movie_id')->value('last_movie_id');

        $this->info("Последняя импортированная страница: " . $last_imported_page);
        $this->info("Последний импортированный ID: " . $last_imported_id);

        for ($i = $last_imported_page + 1; $i <= $this->totalPages;  $i++)
        {
        $response = Http::withHeaders([ 'X-API-KEY' => env('APP_IMPORT_KEY')])
            ->get("https://api.kinopoisk.dev/v1.4/movie?page=" . $i);

            if ($response->successful())
            {
                $data = $response->json();
                $this->info('Страница ' . $response->json(['page']));
                $this->info('Фильм ' . $data['docs'][0]['name'] );

                foreach ($data['docs'] as $movie)
                {
                    $this->info("Тестовый перебор данных: " . ($movie['name'] ?: $movie['alternativeName']));


                }
            }else
            {
                $this->error("Ошибка для ID {$i}: {$response->status()} . Остановка цикла" );
                break;
            }
            sleep(1);

        }

        $this->info("Импорт закончился...");
    }
}

