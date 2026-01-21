<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class MainController extends Controller
{


    public function index(string $type = 'movie')
    {

        return view('index',compact('type'));
    }
}
