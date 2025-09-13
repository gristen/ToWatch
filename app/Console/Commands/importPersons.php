<?php

namespace App\Console\Commands;

use App\Models\Movie;
use App\Models\Person;
use App\Services\ImportLoggerService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class importPersons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:persons';


    protected int $totalPages = 2; //593456 всего актеров

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';



    /**
     * Execute the console command.
     */
    public function handle(ImportLoggerService $importLoggerService)
    {
        $last_movie = null;
        $last_page = null;

        $this->info("Импорт начался...");

        $last_imported_page = DB::table('import')->orderByDesc('last_person_page')->value('last_person_page');
        $last_imported_id = DB::table('import')->orderByDesc('last_person_id')->value('last_person_id');

        $this->info("Последняя импортированная страница: " . $last_imported_page);
        $this->info("Последний импортированный ID: " . $last_imported_id);

        for ($i = $last_imported_page + 1; $i <= $this->totalPages; $i++) {
            $response = Http::withHeaders(['X-API-KEY' => env('APP_IMPORT_KEY')])
                ->get("https://api.kinopoisk.dev/v1.4/movie?page=$i&selectFields=persons" );

            dd($response->json());

            if ($response->successful()) {
                $data = $response->json();

                foreach ($data['docs'] as $person) {

                    try {

                        $newPerson = Person::query()->create([
                            'name' => $person['name'],
                            'eng_name' => $person['enName'],
                            'photo_url' => $person['photo'],
                        ]);
                        $lastPage = $data['page'];
                        $lastPerson = $person['id'];
                        $this->info("Персонал успешно добавлен {$newPerson['name']}. ");


                    } catch (\Throwable $e) {

                        $this->error("Ошибка парсинга {$e->getMessage()} ");
                        break 2;

                    }

                    $importLoggerService->logImport($lastPerson,$lastPage,'last_person_id', 'last_page');

                    $this->info("last_movie_id: {$last_movie} , page: {$last_page}");
                    }

            }
        }

    }
}
