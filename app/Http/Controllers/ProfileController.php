<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function showByUsername($value)
    {

        return view('profile',compact('value'));
    }



    /**
     * Display the specified resource.
     */
    public function show()
    {

        if (Auth::user()) {

            $user = User::query()
                ->withCount(['followers', 'following','likesMovies','favoritesMovies','viewedMovies'])
                ->find(Auth::user()->id);

            return view('profile', compact('user'));
        }

        return redirect('login');
    }


    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
