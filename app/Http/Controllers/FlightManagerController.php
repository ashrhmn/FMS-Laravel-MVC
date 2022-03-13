<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use Illuminate\Http\Request;

class FlightManagerController extends Controller
{
    public function __construct(){
        $this->middleware('auth.flightmanager');
    }
    public function dashboard()
    {
        $transports = Transport::where('created_by', 8)->get();
        return view('flightmanager.dashboard')->with('transports', $transports);
    }
}
