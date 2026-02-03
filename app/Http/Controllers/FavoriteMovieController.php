<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteMovieController extends Controller
{
    public function __invoke(Request $request, int $id)
    {
        $action = $request->input('action_type');
        $authUser = Auth::user();

        $result = match ($action) {
            'favorite' => $authUser->favoritesMovies()->toggle($id),
            'like'=>$authUser->likesMovies()->toggle($id),
        };

        $active = !empty($result['attached']);

        return response()->json(['status' => $active]);

    }


}
