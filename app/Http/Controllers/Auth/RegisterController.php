<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function store(Request $request)
    {

        $data = $request->validate([
            'email' => 'required|string|email|max:255|unique:users', //TODO: проверить рекомендации по валидации email
            'name' => 'required|string|max:255|min:3|unique:users',
            'password' => 'required|min:4|confirmed',
        ]);



        $data['password'] = Hash::make($data['password']);
        $data['role_id'] = 3;


        $user = User::query()->create($data);
        Auth::login($user);
        return redirect('profile',301,['message'=>'Регистрация прошла успешно']);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('auth.register');
    }


}
