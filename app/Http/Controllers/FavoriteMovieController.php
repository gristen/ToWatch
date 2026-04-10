<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use App\Services\ActivityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteMovieController extends Controller
{
    public function __invoke(Request $request, int $id)
    {

        $authUser = Auth::user();

        $action = $request->input('action_type');


        $relation = match ($action) {
            'favorite' => 'favoritesMovies',
            'like' => 'likesMovies',
            'watchLater' => 'watchLater',
            'viewed' => 'viewedMovies',
        };

        $result = $authUser->{$relation}()->toggle($id);

        app(ActivityService::class)->log($action, Movie::query()->find($id), $authUser);

        $active = !empty($result['attached']); // добавлено - тру

        return response()->json(['status' => $active]);

    }


}
