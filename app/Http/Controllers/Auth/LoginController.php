<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\ActivityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    /**
     * Display the specified resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);


        if (Auth::attempt($data)) {
            app(ActivityService::class)->log('login', auth()->user());
            return redirect()->intended(route('profile'));

        }

        return back()->withErrors(['message' => 'Неверный email или пароль']);
    }
}
