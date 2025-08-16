<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    private array $genres = [
        "драма",
        "комедия",
        "триллер",
        "боевик",
        "фантастика",
        "фэнтези",
        "ужасы",
        "мелодрама",
        "приключения",
        "детектив",
        "мистика",
        "исторический",
        "военный",
        "анимация",
        "семейный",
        "биография",
        "музыкальный",
        "вестерн",
        "спорт",
        "криминал",
        "документальный",
        "арт-хаус",
        "романтика",
        "катастрофа",
    ];


    public function run(): void
    {
        DB::table('genres')->insert(
            array_map(fn($name)=> ['name' => $name,'image_path' => 'image_path'], $this->genres),
        );
    }
}
