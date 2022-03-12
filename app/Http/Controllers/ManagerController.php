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

    public function profile(){
        $user = userinfo::where('username','fahim')
        ->first();
        
        return view('manager.profile')->with('user',$user);
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

        session()->flash('msg','Profile Updated Successfully');
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

            session()->flash('msg','Password Changed Successfully');
            return redirect()->route('manager.profile');

        }
        else{
            $user = userinfo::where('username',($req->uname))
            ->select('id','password')
            ->first();

            session()->flash('msg','Wrong Old Password');
            return  redirect()->route('manager.changepass',['id'=>encrypt($user->id)]);
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
            //$purchaseduser = PurchasedTicket::distinct()->get(['purchased_by']);
            //$users = User::with('purchasedtickets')->get();
            //$users = $purchaseduser->user;
            $tickets = PurchasedTicket::all();
            $users = array();
            foreach ($tickets as $ticket) {
                if (!in_array($ticket->user, $users)) {
                    array_push($users, $ticket->user);
                }
            }
            $stopage = Stopage::all();
            return view('manager.userlist')->with('users', $users)->with('stopage', $stopage);
        } elseif ($req->booked == '1' && $req->fromstopage != '0' && $req->tostopage == '0') {
            $tickets = PurchasedTicket::where('from_stopage_id', '=', $req->fromstopage)->get();
            $users = array();

            foreach($tickets as $ticket) {
                if(!in_array($ticket->user,$users)){
                    array_push($users,$ticket->user);
                }
            }
            $stopage = Stopage::all();
            return view('manager.userlist')->with('users', $users)->with('stopage', $stopage);
        } elseif ($req->booked == '1' && $req->fromstopage == '0' && $req->tostopage != '0') {
            $tickets = PurchasedTicket::where('to_stopage_id', '=', $req->tostopage)->get();
            $users = array();

            foreach($tickets as $ticket) {
                if(!in_array($ticket->user,$users)){
                    array_push($users,$ticket->user);
                }
            }
            $stopage = Stopage::all();
            return view('manager.userlist')->with('users', $users)->with('stopage', $stopage);
        } elseif ($req->booked == '1' && $req->fromstopage != '0' && $req->tostopage != '0') {
            $tickets = PurchasedTicket::where('from_stopage_id', '=', $req->fromstopage)
                ->where('to_stopage_id', '=', $req->tostopage)->get();
            $users = array();

            foreach($tickets as $ticket) {
                if(!in_array($ticket->user,$users)){
                    array_push($users,$ticket->user);
                }
            }
            $stopage = Stopage::all();
            return view('manager.userlist')->with('users', $users)->with('stopage', $stopage);
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
        //return $flight->maximum_seat; 
        //return count($booked);
        $available_seat = (($flight->maximum_seat) - (count($booked)));
        //return $available_seat;
        return view('manager.flightdetails')->with('flight', $flight)->with('available_seat', $available_seat);
    }

    public function cancelticket(Request $req){
        
        $ticketcount = PurchasedTicket::where('purchased_by','=',decrypt($req->uid))->count();
        
        if($ticketcount <= 1){
            $user = userinfo::where('id','=',decrypt($req->uid))->first();

            session()->flash('msg','Ticket cannot be canceled');
            return view('manager.userdetails')->with('user',$user);
        }
        else{
            $deleteticket = PurchasedTicket::where('id','=',decrypt($req->id))->delete();
            $user = userinfo::where('id','=',decrypt($req->uid))->first();

            session()->flash('msg','Ticket cancelled Successfully');
            return view('manager.userdetails')->with('user',$user);

        }

    }
    public function searchuserlist(){
        $users = userinfo::where('role','User')->get();
        return view('manager.searchuserlist')->with('users',$users);
    }
    public function searchuserlistsubmit(Request $req){

        if($req->email == "" && $req->uname == ""){
            $users = userinfo::where('role','User')->get();
            return view('manager.searchuserlist')->with('users',$users);

        }
        elseif($req->email != "" && $req->uname == ""){
            $users = userinfo::where('role','User')
            ->where('email','like','%'.$req->email.'%')
            ->get();
            return view('manager.searchuserlist')->with('users',$users);
        }
        elseif($req->email == "" && $req->uname != ""){
            $users = userinfo::where('role','User')
            ->where('username','like','%'.$req->uname.'%')
            ->get();
            return view('manager.searchuserlist')->with('users',$users);
        }
        elseif($req->email != "" && $req->uname != ""){
            $users = userinfo::where('role','User')
            ->where('username','like','%'.$req->uname.'%')
            ->where('email','like','%'.$req->email.'%')
            ->get();
            return view('manager.searchuserlist')->with('users',$users);
        }


    }
}
