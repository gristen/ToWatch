<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function showByUsername(string $name)
    {
        $user = User::findByUsername($name);

        if (!$user) {
            abort(404);
        }

        return view('profile', ['user' => $user]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

        if (Auth::user()) {
            $user = User::withCount(['followers', 'following'])->find(Auth::user()->id);
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
