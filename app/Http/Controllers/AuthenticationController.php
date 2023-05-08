<?php

namespace App\Http\Controllers;

class AuthenticationController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function logout()
    {
        \Auth::logout();

        return to_route('auth.login');
    }
}
