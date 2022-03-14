<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transport;
use App\Models\SeatInfo;

use App\Models\TransportSchedule;
use App\Models\Stopage;



class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.user');
    }

    public function index(Request $req)
    {
        if ($req->search != null) {
            $flight = transport::wherehas('fromstopage', function ($q) {
                $q->where('city_id', 2);
            })->get();
            return view('user.index')
                ->with('flight', $flight);
        }
        $flight = transport::all();
        return view('user.index')
            ->with('flight', $flight);
    }
    public function viewProfile()
    {

        $user = userinfo::where('username', '=', 'afridi')->first();

        return view('user.viewProfile')
            ->with('user', $user);
    }
    public function editProfile()
    {

        $user = userinfo::where('username', '=', 'afridi')->first();

        return view('user.editProfile')
            ->with('user', $user);
    }
    public function editProfileSubmit(Request $req)
    {

        $req->validate(
            [
                'name'=>'required',
                'email'=>'required|email',
                'phone' =>'required|regex:/(01)[0-9]{9}/',
                
                'address'=>'required'
            ]
            
        );
        $user = userinfo::where('username', '=', 'afridi')->first();


        $user->name = $req->name;
        $user->name = $req->name;
        $user->date_of_birth = $req->dob;
        $user->address = $req->address;
        $user->email = $req->email;
        $user->phone = $req->phone;
        $user->save();
        return redirect()->route('user.viewProfile');
    }

    public function changepass(Request $req)
    {
        $user = userinfo::where('Id', '=', decrypt($req->id))
            ->select('username', 'password')
            ->first();

        return view('user.changepass')->with('user', $user);
    }
    public function changepassSubmit(Request $req)
    {
        $req->validate(
            [
                'oldpass' => 'min:4',
                'password' => 'min:4',
                'conpass' => 'min:4|same:password'
            ]

        );

        $users = userinfo::where('username', $req->uname)
            ->where('password', md5($req->oldpass))
            ->first();

        if ($users) {
            $user = userinfo::where('username', $req->uname)
                ->update(['password' => md5($req->password)]);

            $msg = "Password Changed Successfully";
            return redirect()->route('manager.profile');
        } else {
            $msg = "Wrong Old Password";

            $user = userinfo::where('username', ($req->uname))
                ->select('id', 'password')
                ->first();

            return  redirect()->route('manager.changepass', ['id' => encrypt($user->id)]);
        }
    }
    public function flights()
    {
        $flight = Transport::all();
        $stopage = Stopage::all();

        foreach ($flight as $f) {
            $occupiedSeats = SeatInfo::where('transport_id', '=', $f->id)
                ->where('status', '=', 'Booked')
                ->count();
            $avilableSeats = $f->maximum_seat - $occupiedSeats;
            $f->avilableSeats = $avilableSeats;
        }

        // return $flight;
        return view('user.flights')
            ->with('flights', $flight)->with('stopage', $stopage);
    }
    public function flightsSearch(Request $req)
    {
        $stopage = Stopage::all();
        $transShed = TransportSchedule::where('from_stopage_id', '=', $req->fsid)
            ->where('to_stopage_id', '=', $req->tsid)
            ->get();
        $flights = array();
        if ($transShed) {
            foreach ($transShed as $ts) {
                $f = Transport::where('id', '=', $ts->transport_id)->first();

                $occupiedSeats = SeatInfo::where('transport_id', '=', $ts->id)
                    ->where('status', '=', 'Booked')
                    ->count();
                $f->avilableSeats = $f->maximum_seat - $occupiedSeats;
                // $flight = array(
                //     'id' => $f->id,
                //     'name' => $f->name,
                //     'availableSeats' => $avilableSeats,
                //     'maximum_seat' => $f->maximum_seat
                // );

                array_push($flights, $f);
            }

            // return $flights;
            return view('user.flights')
                ->with('flights', (object)$flights)->with('stopage', $stopage);
        } else {
            return "No flight found";
        }
    }
    public function bookTicket()
    {
        

    }

}
