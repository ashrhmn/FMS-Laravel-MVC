<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Session;

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
            'username' => 'required|min:3',
            'name' => 'required|min:5',
            'password' => 'required|min:6',
            'password2' => 'required|same:password',
            'email' => 'required|email',
            'dob' => 'required'
        ], [
            'password2.required' => '',
            'password2.same' => 'Both passwords must match',
        ]);

        $existingUser = User::where('username', $req->username)->first();
        if ($existingUser) {
            throw ValidationException::withMessages(['username' => 'User already exist with the username']);
        }


        $info = new User();

        $info->username = $req->username;
        $info->name = $req->name;
        $info->email = $req->email;
        $info->address = $req->address;
        $info->phone = $req->phone;
        $info->date_of_birth = $req->dob;
        $info->password = md5($req->password);
        $info->save();

        // $tokenGen = bin2hex(random_bytes(37));

        // $token = new Token();

        // $token->value = $tokenGen;
        // $token->user_id = $info->id;
        // $token->save();

        // $req->session()->put('token', $tokenGen);


        // return array($token, $info);

        return redirect()->route('auth.signin');
    }

    public function signinPost(Request $req)
    {
        $user = User::where('username', $req->username)->where('password', md5($req->password))->first();
        if ($user) {
            $tokenGen = bin2hex(random_bytes(37));

            $token = new Token();

            $token->value = $tokenGen;
            $token->user_id = $user->id;
            $token->save();

            $req->session()->put('token', $tokenGen);
            switch ($user->role) {
                case 'User':
                    # code...
                    break;

                case 'Manager':
                    # code...
                    break;

                case 'FlightManager':
                    # code...
                    break;

                case 'Admin':
                    # code...
                    break;

                default:
                    return redirect()->route('auth.signin');
                    break;
            }
            return redirect()->route('fmgr.dashboard');
        } else {
            $req->session()->put('user', null);
            return redirect()->route('auth.signin');
        }
    }
}
