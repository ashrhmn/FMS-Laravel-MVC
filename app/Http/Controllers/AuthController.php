<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function signin(Request $req)
    {
        $token = $req->session()->get('token');
        $userToken = Token::where('value', $token)->first();
        if ($userToken) {
            switch ($userToken->user->role) {
                case 'User':
                    //return redirect()->route('index');
                    return "Redirect to user dashboard";
                    break;

                case 'Manager':
                    return redirect()->route('manager.home');
    
                    break;

                case 'FlightManager':
                    return redirect()->route('fmgr.dashboard');
                    break;

                case 'Admin':
                    return redirect()->route('index');
                    break;

                default:
                    return redirect()->route('auth.signin');
                    break;
            }
        }
        $req->session()->put('token', null);
        return view('auth.signin');
    }
    public function signup(Request $req)
    {
        $token = $req->session()->get('token');
        $userToken = Token::where('value', $token)->first();
        if ($userToken) {
            return redirect()->route('auth.signin');
        }
        $req->session()->put('token', null);
        $cities = City::all();
        return view('auth.signup')->with('cities', $cities);
    }

    public function signupPost(Request $req)
    {
        $req->validate([
            'username' => 'required|unique:users,username|min:3',
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


        $user = new User();

        $user->username = $req->username;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->address = $req->address;
        $user->phone = $req->phone;
        $user->date_of_birth = $req->dob;
        $user->password = md5($req->password);
        $user->save();

        // $tokenGen = bin2hex(random_bytes(37));

        // $token = new Token();
        // $token->value = $tokenGen;
        // $token->user_id = $user->id;
        // $token->save();
        // $req->session()->put('token', $tokenGen);
        return redirect()->route('auth.signin');
    }


    public function logoutPost(Request $req)
    {
        $token = $req->session()->get('token');
        Token::where('value', $token)->delete();
        $req->session()->put('user', null);
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
        } else {
            $req->session()->put('user', null);
            throw ValidationException::withMessages(['password' => 'Username or password is incorrect']);
        }
        return redirect()->route('auth.signin');
    }
}
