<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;


class MainController extends Controller
{


    public function index()
    {

        $array = [
            "id"=>1,
            "name"=>"тайна хиопса",
            "genres" => [
                ["name" => "триллер"],
                ["name" => "ужасы"]
            ]
        ];





       // dump(data_get($array,"genres"));
        /*foreach ($array['genres'] as $value) {
            dump($value['name']);
        }*/






        $movies = Movie::with('countries')->paginate(15);
        return view('tasks');
    }
}
