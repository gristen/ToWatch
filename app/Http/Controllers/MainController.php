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


       /* $movies = Movie::with(['countries', 'publisher'])->paginate(15);*/

        //return view('index', ['movies' => $movies, 'publisher']);
        return view('index');
    }
}
