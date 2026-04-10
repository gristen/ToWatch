<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use App\Services\ActivityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('index');
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {

        $actors = $movie->actors;
        $limit = 5;
        $hasMore = $actors->count() > $limit;
        $moreCount = $actors->count() - $limit;
        $limitSeconds = 15;
        if (Auth::check()){
            $actor = auth()->user();
            $lastActivity = $actor->activities()
                ->where('action','=','view')
                ->where('subject_id','=',$movie->id)
                ->latest()
                ->first();
            if (!$lastActivity || $lastActivity->created_at->diffInSeconds() > $limitSeconds) {
                app(ActivityService::class)->log('view', $movie, $actor);
            }
        }


        return view('one-movie', compact('movie', 'actors', 'hasMore', 'moreCount','limit'));
    }

    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
