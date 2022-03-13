<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\Transport;
use Illuminate\Http\Request;

class FlightManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.flightManager');
    }
    public function dashboard(Request $req)
    {
        $token = $req->session()->get('token');
        $tokenUser = Token::where('value', $token)->first();
        if (!$tokenUser) {
            return redirect()->route('auth.signin');
        }
        $transports = Transport::where('created_by', $tokenUser->user_id)->get();
        return view('flightmanager.dashboard')->with('transports', $transports);
    }
}
