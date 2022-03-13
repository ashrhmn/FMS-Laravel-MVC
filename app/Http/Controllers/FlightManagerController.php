<?php

namespace App\Http\Controllers;

use App\Models\Stopage;
use App\Models\Token;
use App\Models\Transport;
use App\Models\TransportSchedule;
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
    public function deleteScheduleById($id)
    {
        TransportSchedule::where('id', $id)->delete();
        return redirect()->action([FlightManagerController::class, 'dashboard']);
    }
    public function addScheduleByTransportId($tid)
    {
        $transport = Transport::where('id', $tid)->first();
        $airports = Stopage::all();
        return view('flightmanager.addSchedule')->with('transport', $transport)->with('airports', $airports);
    }
    public function addScheduleByTransportIdPost(Request $req)
    {
        $schedule = new TransportSchedule();
        $schedule->transport_id = $req->tid;
        $schedule->from_stopage_id = $req->from_stopage_id;
        $schedule->to_stopage_id = $req->to_stopage_id;
        $schedule->day = $req->day;
        $schedule->time = $req->timeh . $req->timem;
        // $schedule->start_time = $req->start_time;
        $schedule->save();
        return redirect()->action([FlightManagerController::class, 'dashboard']);
    }

    public function addAircraft(Request $req){
        $token = $req->session()->get('token');
        $tokenUser = Token::where('value', $token)->first();
        if (!$tokenUser) {
            return redirect()->route('auth.signin');
        }
        $transport = new Transport();
        $transport->name = $req->name;
        $transport->maximum_seat = $req->maximum_seat;
        $transport->created_by = $tokenUser->user_id;
        $transport->save();
        return redirect()->action([FlightManagerController::class,'dashboard']);
    }
}
