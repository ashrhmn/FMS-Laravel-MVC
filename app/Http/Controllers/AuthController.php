<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signin()
    {
        return view('auth.signin');
    }
    public function signup()
    {
        return view('auth.signup');
    }
}
