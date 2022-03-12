<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signin()
    {
        return view('auth.signin');
    }
    public function signup()
    {
        $cities = City::all();
        return view('auth.signup')->with('cities', $cities);
    }
    public function signupPost(Request $req)
    {
        $req->validate([
            'username' => 'required|min:5',
            'name' => 'required|min:5',
        ]);
        return view('auth.signup');
    }
}
