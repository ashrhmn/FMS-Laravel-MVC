<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transport;
use App\Models\SeatInfo;
use App\Models\Token;
use App\Models\PurchasedTicket;
use App\Models\TransportSchedule;
use App\Models\Stopage;
use Illuminate\Console\Scheduling\Schedule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.user');
    }

    public function index(Request $req)
    {
        $token = $req->session()->get('token');
        $tokenUser = Token::where('value', $token)->first();
        $user = User::where('id', '=', $tokenUser->user_id)->first();
        return view('user.index')
        ->with('user', $user);
    }
    public function viewProfile(Request $req)
    {
        $token = $req->session()->get('token');
        $tokenUser = Token::where('value', $token)->first();
        $user = User::where('id', '=', $tokenUser->user_id)->first();

        return view('user.viewProfile')
            ->with('user', $user);
    }
    public function editProfile(Request $req)
    {
        
        $user = User::where('id', '=', decrypt($req->id))->first();
        //return $req->id;
        return view('user.editProfile')
            ->with('user', $user);
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
        $user = User::where('id', '=', $req->id)->first();


        $user->name = $req->name;
        $user->name = $req->name;
        $user->date_of_birth = $req->dob;
        $user->address = $req->address;
        $user->email = $req->email;
        $user->phone = $req->phone;
        $user->save();
        session()->flash('msg', 'Profile Updated Successfully');
        return redirect()->route('user.viewProfile');
    }

    public function changepass(Request $req)
    {
        $user = User::where('Id', '=', decrypt($req->id))
            ->select('username', 'password')
            ->first();

        return view('user.changepass')->with('user', $user);
    }
    public function changepassSubmit(Request $req)
    {
        $req->validate(
            [
                'oldpass' => 'min:6',
                'password' => 'min:6',
                'conpass' => 'min:6|same:password'
            ]

        );

        $users = User::where('username', $req->uname)
            ->where('password', md5($req->oldpass))
            ->first();

        if ($users) {
            $user = User::where('username', $req->uname)
                ->update(['password' => md5($req->password)]);

                session()->flash('msg', 'Password Changed Successfully');
            return redirect()->route('user.viewProfile');
        } else {
            $msg = "Wrong Old Password";

            $user = User::where('username', ($req->uname))
                ->select('id', 'password')
                ->first();

            return  redirect()->route('user.changepass', ['id' => encrypt($user->id)]);
        }
    }
    public function flights()
    {
        $flight = Transport::all();
        $stopage = Stopage::all();

        foreach ($flight as $f) {
            $occupiedSeats = SeatInfo::where('transport_id', '=', $f->id)
                ->count();
            $avilableSeats = $f->maximum_seat - $occupiedSeats;
            $f->availableSeats = $avilableSeats;
        }

        // return $flight;
        return view('user.flights')
            ->with('flights', $flight)->with('stopage', $stopage);
    }
    public function flightsSearch(Request $req)
    {
        // return $req;
        $stopage = Stopage::all();
        $transShed = TransportSchedule::where('from_stopage_id', '=', $req->fsid)
            ->where('to_stopage_id', '=', $req->tsid)
            ->get();
        $flights = array();
        foreach ($transShed as $sched) {
            if ($req->date == date('Y-m-d', strtotime('next ' . $sched->day)) || $req->date == date('Y-m-d', strtotime($sched->day)) || $req->date == date('Y-m-d', strtotime($sched->day . ' next week'))) {
                
                $occupiedSeats = SeatInfo::where('transport_id',$sched->transport_id)->get();

                $sched->transport->availableSeats = $sched->transport->maximum_seat - count($occupiedSeats);

                array_push($flights, $sched->transport);
            }
        }
        // return $flights;
        return view('user.flights')
            ->with('flights', (object)$flights)->with('stopage', $stopage);
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

        //     //return $flights;
        //     return view('user.flights')
        //         ->with('flights', (object)$flights)->with('stopage', $stopage);
        // } else {
        //     return "No flight found";
        // }
    }
    public function bookTicket(Request $req)
    {
        $token = $req->session()->get('token');
        $tokenUser = Token::where('value', $token)->first();
        $uid = $tokenUser->user_id;
        $schedule = TransportSchedule::where('transport_id','=', decrypt($req->id))->first();
        //return $transport;
        $fromrootfare = $schedule->fromstopage->fare_from_root;
        
        $torootfare = $schedule->tostopage->fare_from_root;
        $basefair = abs(($torootfare - $fromrootfare)*4);
        //return $basefair;
        $pt = array
        (
            "fromid"=> $schedule->fromstopage->id,
            "toid"=>$schedule->tostopage->id,
            "fromname"=>$schedule->fromstopage->name,
            "toname"=>$schedule->tostopage->name,
            "uid"=>$uid,
            "fid"=>decrypt($req->id),
            "fair"=>$basefair
        );
       $pt = (object)$pt;
       //return $pt;
       return view('user.bookticket')
       ->with('pt', $pt);
        
    }
    public function bookTicketSubmit(Request $req)
    {
        $purt = new PurchasedTicket();
        $purt->from_stopage_id = $req->fromid;
        $purt->to_stopage_id = $req->toid;
        $purt->purchased_by = $req->uid;
        $purt->save();
        $ticketid =  $purt->id;
        //$ticketid = TransportSchedule::where('purchased_by','=',$req->uid)->first();
        $si = new SeatInfo();
        //$si->start_time = "2022-03-15";
        $si->seat_no = 101;
        $si->ticket_id = $ticketid;
        $si->transport_id = $req->fid;
        $si->age_class = "adult";
        $si->seat_class = "Business";
        $si->status = "Booked";
        $si->save();

        session()->flash('msg', 'Ticket purchsed Successfully');
            return redirect()->route('user.showTickets');
    }
    public function showTickets(Request $req)
    {
        $token = $req->session()->get('token');
        $tokenUser = Token::where('value', $token)->first();
        $uid = $tokenUser->user_id;
        $tickets = PurchasedTicket::where('purchased_by','=',$uid)->get();

        return view('user.showTickets')
       ->with('tickets', $tickets);
    
    }

    
    public function bookTicket()

    {
        $deleteticket = PurchasedTicket::where('id', '=', decrypt($req->id))->delete();
        session()->flash('msg', 'Ticket Cancelled Successfully');
        return redirect()->route('user.showTickets');
    
    }
}
