<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Stopage;
use App\Models\PurchasedTicket;
use App\Models\Transport;
use App\Models\TransportSchedule;
use App\Models\SeatInfo;
use App\Models\Token;
use App\Models\City;

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.manager');
    }
    public function home()
    {
        return view('manager.home');
    }

    public function profile(Request $req){

        $token = $req->session()->get('token');
        $tokenUser = Token::where('value', $token)->first();
        if (!$tokenUser) {
            return redirect()->route('auth.signin');
        }

        $user = User::where('id',$tokenUser->user_id)
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

        session()->flash('msg', 'Profile Updated Successfully');
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

            session()->flash('msg', 'Password Changed Successfully');
            return redirect()->route('manager.profile');
        }
        else{
            $user = User::where('username',($req->uname))
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

            foreach ($tickets as $ticket) {
                if (!in_array($ticket->user, $users)) {
                    array_push($users, $ticket->user);
                }
            }
            $stopage = Stopage::all();
            return view('manager.userlist')->with('users', $users)->with('stopage', $stopage);
        } elseif ($req->booked == '1' && $req->fromstopage == '0' && $req->tostopage != '0') {
            $tickets = PurchasedTicket::where('to_stopage_id', '=', $req->tostopage)->get();
            $users = array();

            foreach ($tickets as $ticket) {
                if (!in_array($ticket->user, $users)) {
                    array_push($users, $ticket->user);
                }
            }
            $stopage = Stopage::all();
            return view('manager.userlist')->with('users', $users)->with('stopage', $stopage);
        } elseif ($req->booked == '1' && $req->fromstopage != '0' && $req->tostopage != '0') {
            $tickets = PurchasedTicket::where('from_stopage_id', '=', $req->fromstopage)
                ->where('to_stopage_id', '=', $req->tostopage)->get();
            $users = array();

            foreach ($tickets as $ticket) {
                if (!in_array($ticket->user, $users)) {
                    array_push($users, $ticket->user);
                }
            }
            $stopage = Stopage::all();
            return view('manager.userlist')->with('users', $users)->with('stopage', $stopage);
        }
    }
    public function flightManagerList(){
        $users = User::where('role', 'FlightManager')->get();
        return view('manager.flightManagerList')->with('users', $users);
    }

    public function flightManagerSearch(Request $req){
        if($req->uname != ""){
            $users = User::where('role', 'FlightManager')
                    ->where('username','like','%'.$req->uname.'%')
                    ->get();
            return view('manager.flightManagerList')->with('users', $users);
        }
        else{
            $users = User::where('role', 'FlightManager')->get();
        return view('manager.flightManagerList')->with('users', $users);
        }
        
    }

    public function creatorFlightList(Request $req){

        $user = User::where('id', '=', decrypt($req->id))->first();

        return view('manager.creatorFlightList')->with('user',$user);
    }


    public function userdetails(Request $req)
    {
        $user = User::where('id', '=', decrypt($req->id))->first();

        return view('manager.userdetails')->with('user', $user);
    }

    public function flightdetails(Request $req)
    {
        $flight = Transport::where('id', '=', decrypt($req->id))->first();
        $schedules= TransportSchedule::where('transport_id','=',decrypt($req->id))->get();

        // $schedules =[];
        // foreach( $schedul as $s){
        //     $seatinfo = SeatInfo::where('transport_id','=',decrypt($req->id))
        //     ->where()
        // }

        $booked = SeatInfo::where('transport_id', '=', decrypt($req->id))
            ->where('status', 'Booked')
            ->get();
        //return $flight->maximum_seat; 
        //return count($booked);
        $available_seat = (($flight->maximum_seat) - (count($booked)));
        //return $flight;
        return view('manager.flightdetails')->with('flight', $flight)->with('schedules',$schedules)->with('available_seat', $available_seat);
    }

    public function deleteSchedule(Request $req){

        $flight = Transport::where('id', '=', decrypt($req->fid))->first();
        $schedules= TransportSchedule::where('transport_id','=',decrypt($req->fid))->get();

        $booked = SeatInfo::where('transport_id', '=', decrypt($req->fid))
            ->where('status', 'Booked')
            ->get();
        
        $available_seat = (($flight->maximum_seat) - (count($booked)));
        if($available_seat == $flight->maximum_seat){
            $deleteticket = TransportSchedule::where('id', '=', decrypt($req->id))->delete();
            session()->flash('msg', 'Flight Schedule cancelled Successfully');
            return view('manager.flightdetails')->with('flight', $flight)->with('schedules',$schedules)->with('available_seat', $available_seat);
        }
        else{
            session()->flash('msg', 'Flight Schedule cannot be cancelled');
            return view('manager.flightdetails')->with('flight', $flight)->with('schedules',$schedules)->with('available_seat', $available_seat);
        }
    }


    public function cancelticket(Request $req){
        
        $ticketcount = PurchasedTicket::where('purchased_by','=',decrypt($req->uid))->count();
        
        if ($ticketcount <= 1) {
            $user = User::where('id', '=', decrypt($req->uid))->first();

            session()->flash('msg', 'Ticket cannot be canceled');
            return view('manager.userdetails')->with('user', $user);
        } 
        else {
            $deleteticket = PurchasedTicket::where('id', '=', decrypt($req->id))->delete();
            $user = User::where('id', '=', decrypt($req->uid))->first();

            session()->flash('msg', 'Ticket cancelled Successfully');
            return view('manager.userdetails')->with('user', $user);
        }
    }
    public function searchuserlist(){
        $users = User::where('role','User')->get();
        return view('manager.searchuserlist')->with('users',$users);
    }
    public function searchuserlistsubmit(Request $req){

        if($req->email == "" && $req->uname == ""){
            $users = User::where('role','User')->get();
            return view('manager.searchuserlist')->with('users',$users);
            
        } 
        elseif ($req->email != "" && $req->uname == "") {
            $users = User::where('role', 'User')
                ->where('email', 'like', '%' . $req->email . '%')
                ->get();
            return view('manager.searchuserlist')->with('users', $users);
        } 
        elseif ($req->email == "" && $req->uname != "") {
            $users = User::where('role', 'User')
                ->where('username', 'like', '%' . $req->uname . '%')
                ->get();
            return view('manager.searchuserlist')->with('users', $users);
        } 
        elseif ($req->email != "" && $req->uname != "") {
            $users = User::where('role', 'User')
                ->where('username', 'like', '%' . $req->uname . '%')
                ->where('email', 'like', '%' . $req->email . '%')
                ->get();
            return view('manager.searchuserlist')->with('users', $users);
        }
        


    }
    public function flightList(){
        $flight = Transport::all();
        $stopage = Stopage::all();
        $schedules = TransportSchedule::all();

        foreach ($schedules as $s) {
            $occupiedSeats = SeatInfo::where('transport_id', '=', $s->transport_id)
                ->where('status', '=', 'Booked')
                ->count();
            $f = Transport::where('id', '=', $s->transport_id)->first();
            $avilableSeats = $f->maximum_seat - $occupiedSeats;
            $s->avilableSeats = $avilableSeats;

            $s->flightName = $f->name;
            $s->flightId = $f->id;
            $s->maximumSeat= $f->maximum_seat;
            $from = Stopage::where('id','=',$s->from_stopage_id)->first();
            $fromcity = City::where('id','=',$from->city_id)->first();
            $s->fromstopage = $from->name;
            $s->fromstopagecity = $fromcity->name;
            $s->fromstopagecountry = $fromcity->country;
            $to = Stopage::where('id','=',$s->to_stopage_id)->first();
            $tocity = City::where('id','=',$to->city_id)->first();
            $s->tostopage = $to->name;
            $s->tostopagecity = $tocity->name;
            $s->tostopagecountry = $tocity->country;

        }

        return view('manager.flightList')->with('schedules', $schedules)->with('stopage', $stopage);

    }

    public function flightSearch(Request $req){

        $stopage = Stopage::all();
        if($req->fsid != "0" && $req->tsid == "0"){
            $transShed = TransportSchedule::where('from_stopage_id', '=', $req->fsid)
                    ->get();
        }
        else if($req->fsid != "0" && $req->tsid != "0"){
            $transShed = TransportSchedule::where('from_stopage_id', '=', $req->fsid)
                    ->where('to_stopage_id', '=', $req->tsid)
                    ->get();
        }
        else if($req->fsid == "0" && $req->tsid != "0"){
            $transShed = TransportSchedule::where('to_stopage_id', '=', $req->tsid)
                    ->get();
        }
        else {
            $transShed = TransportSchedule::all();
        }
        
        foreach ($transShed as $sched) {
            if ($req->date == date('Y-m-d', strtotime('next ' . $sched->day)) || $req->date == date('Y-m-d', strtotime($sched->day)) || $req->date == date('Y-m-d', strtotime($sched->day . ' next week'))) {
                 $f = Transport::where('id', '=', $sched->transport_id)->first();
                $sched->flightName = $f->name;
                $sched->maximumSeat= $f->maximum_seat;

                 $occupiedSeats = SeatInfo::where('transport_id', '=', $sched->transport_id)
                     ->where('status', '=', 'Booked')
                     ->count();
                 $sched->avilableSeats = $f->maximum_seat - $occupiedSeats;

                 $from = Stopage::where('id','=',$sched->from_stopage_id)->first();
                 $fromcity = City::where('id','=',$from->city_id)->first();
                 $sched->fromstopage = $from->name;
                 $sched->fromstopagecity = $fromcity->name;
                 $sched->fromstopagecountry = $fromcity->country;
                 $to = Stopage::where('id','=',$sched->to_stopage_id)->first();
                 $tocity = City::where('id','=',$to->city_id)->first();
                 $sched->tostopage = $to->name;
                 $sched->tostopagecity = $tocity->name;
                 $sched->tostopagecountry = $tocity->country;
                 
            }
        }
        return view('manager.flightList')->with('schedules', $transShed)->with('stopage', $stopage);
        // if ($transShed) {
        //     foreach ($transShed as $ts) {
        //         $f = Transport::where('id', '=', $ts->transport_id)->first();

        //         $occupiedSeats = SeatInfo::where('transport_id', '=', $ts->id)
        //             ->where('status', '=', 'Booked')
        //             ->count();
        //         $f->avilableSeats = $f->maximum_seat - $occupiedSeats;
        //         // $flight = array(
        //         //     'id' => $f->id,
        //         //     'name' => $f->name,
        //         //     'availableSeats' => $avilableSeats,
        //         //     'maximum_seat' => $f->maximum_seat
        //         // );

        //         array_push($flights, $f);
        //     }
            
        //     return view('user.flights')->with('flights', (object)$flights)->with('stopage', $stopage);
        // } 
        // else {
        //     return "No flight found";
        // }

    }

    public function deleteFlightSchedule(Request $req){

        $flightt = Transport::where('id', '=', decrypt($req->fid))->first();
        //$schedules= TransportSchedule::where('transport_id','=',decrypt($req->fid))->get();

        $booked = SeatInfo::where('transport_id', '=', decrypt($req->fid))
            ->where('status', 'Booked')
            ->get();
        $available_seat = (($flightt->maximum_seat) - (count($booked)));


        $flight = Transport::all();
        $stopage = Stopage::all();
        $schedules = TransportSchedule::all();

        foreach ($schedules as $s) {
            $occupiedSeats = SeatInfo::where('transport_id', '=', $s->transport_id)
                ->where('status', '=', 'Booked')
                ->count();
            $f = Transport::where('id', '=', $s->transport_id)->first();
            $avilableSeats = $f->maximum_seat - $occupiedSeats;
            $s->avilableSeats = $avilableSeats;

            $s->flightName = $f->name;
            $s->flightId = $f->id;
            $s->maximumSeat= $f->maximum_seat;
            $from = Stopage::where('id','=',$s->from_stopage_id)->first();
            $fromcity = City::where('id','=',$from->city_id)->first();
            $s->fromstopage = $from->name;
            $s->fromstopagecity = $fromcity->name;
            $s->fromstopagecountry = $fromcity->country;
            $to = Stopage::where('id','=',$s->to_stopage_id)->first();
            $tocity = City::where('id','=',$to->city_id)->first();
            $s->tostopage = $to->name;
            $s->tostopagecity = $tocity->name;
            $s->tostopagecountry = $tocity->country;

        }
        
        if($available_seat == $flightt->maximum_seat){
            $deleteticket = TransportSchedule::where('id', '=', decrypt($req->id))->delete();
            session()->flash('msg', 'Flight Schedule cancelled Successfully');
            //return view('manager.flightdetails')->with('flight', $flight)->with('schedules',$schedules)->with('available_seat', $available_seat);
            return view('manager.flightList')->with('schedules', $schedules)->with('stopage', $stopage);
        }
        else{
            session()->flash('msg', 'Flight Schedule cannot be cancelled');
            //return view('manager.flightdetails')->with('flight', $flight)->with('schedules',$schedules)->with('available_seat', $available_seat);
            return view('manager.flightList')->with('schedules', $schedules)->with('stopage', $stopage);
        }
    }






    public function bookFlight(Request $req){
        $uid = decrypt($req->id);
        Session::put('uid',$uid);


        return view('manager.bookFlight');
    }




}
