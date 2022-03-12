<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Stopage;
use App\Models\PurchasedTicket;
use App\Models\Transport;
use App\Models\SeatInfo;

class ManagerController extends Controller
{
    //
    public function home()
    {
        return view('manager.home');
    }
    public function profile()
    {
        $user = User::where('username', 'Mortujaii')
            ->first();

        return view('manager.profile')->with('user', $user);
    }
    public function editProfile(Request $req)
    {
        $user = User::where('Id', '=', decrypt($req->id))
            ->first();

        return view('manager.editProfile')->with('user', $user);
    }
    public function editProfileSubmit(Request $req)
    {
        $req->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|regex:/(01)[0-9]{9}/',

                'address' => 'required'
            ]

        );

        $user = User::where('username', $req->uname)
            ->update([
                'name' => $req->name,
                'email' => $req->email,
                'phone' => $req->phone,
                'date_of_birth' => $req->date_of_birth,
                'address' => $req->address
            ]);

        return redirect()->route('manager.profile');
    }
    public function changepass(Request $req)
    {
        $user = User::where('Id', '=', decrypt($req->id))
            ->select('username', 'password')
            ->first();

        return view('manager.changepass')->with('user', $user);
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

        $users = User::where('username', $req->uname)
            ->where('password', md5($req->oldpass))
            ->first();

        if ($users) {
            $user = User::where('username', $req->uname)
                ->update(['password' => md5($req->password)]);

            $msg = "Password Changed Successfully";
            return redirect()->route('manager.profile');
        } else {
            $msg = "Wrong Old Password";

            $user = User::where('username', ($req->uname))
                ->select('id', 'password')
                ->first();

            return  redirect()->route('manager.changepass', ['id' => encrypt($user->id)]);
        }
    }
    public function userlist()
    {
        $users = User::where('role', 'User')->get();
        $stopage = Stopage::all();
        return view('manager.userlist')->with('users', $users)->with('stopage', $stopage);
    }
    public function userlistSearch(Request $req)
    {

        if ($req->booked != '1') {
            $users = User::where('role', 'User')->get();
            $stopage = Stopage::all();
            return view('manager.userlist')->with('users', $users)->with('stopage', $stopage);
        } elseif ($req->booked == '1' && $req->fromstopage == '0' && $req->tostopage == '0') {
            $tickets = PurchasedTicket::all();
            $users = array();
            foreach ($tickets as $ticket) {
                array_push($users, $ticket->user);
            }
            $stopage = Stopage::all();
            return view('manager.userlist')->with('users', $users)->with('stopage', $stopage);
        } elseif ($req->booked == '1' && $req->fromstopage != '0' && $req->tostopage == '0') {

            $stopage = Stopage::all();
        } elseif ($req->booked == '1' && $req->fromstopage == '0' && $req->tostopage != '0') {

            $stopage = Stopage::all();
        } elseif ($req->booked == '1' && $req->fromstopage != '0' && $req->tostopage != '0') {

            $stopage = Stopage::all();
        }
    }
    public function userdetails(Request $req)
    {
        $user = User::where('id', '=', decrypt($req->id))->first();

        return view('manager.userdetails')->with('user', $user);
    }
    public function flightdetails(Request $req)
    {
        $flight = Transport::where('id', '=', decrypt($req->id))->first();

        $booked = SeatInfo::where('transport_id', '=', decrypt($req->id))
            ->where('status', 'Booked')
            ->get();

        $available_seat = (($flight->maximum_seat) - (count($booked)));
        return view('manager.flightdetails')->with('flight', $flight)->with('available_seat', $available_seat);
    }
}
