<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userinfo;
use App\Models\Transport;
use App\Models\SeatInfo;
class UserController extends Controller
{
    public function index(Request $req){
        if($req->search != null)
        {
            $flight = transport::wherehas('fromstopage', function($q){
                $q->where('city_id', 2);})->get();
            return view ('user.index')
            ->with('flight',$flight);
        }
        $flight = transport::all();
        return view ('user.index')
        ->with('flight',$flight);
    }
    public function viewProfile(){
        $user = userinfo::where('username','=','Mortujaii')->first();
        return view ('user.viewProfile')
        ->with('user',$user);
    }
    public function editProfile(){
        $user = userinfo::where('username','=','Mortujaii')->first();
        return view ('user.editProfile')
        ->with('user',$user);
    }
    public function editProfileSubmit(Request $req){
        $user = userinfo::where('username','=','Mortujaii')->first();
        
        $user->name = $req->name;
        $user->username = $req->username;
        $user->name = $req->name;
        $user->date_of_birth = $req->dob;
        $user->address = $req->address;
        $user->email = $req->email;
        $user->phone = $req->phone;
        $user->save();
        return redirect()->route('user.viewProfile');
    }
    public function flights(){
        $flight = Transport::all();
        foreach($flight as $f)
        {
            $occupiedSeats = SeatInfo::where('transport_id','=',$f->id)
            ->where('status','=','Booked')
            ->count();
            $avilableSeats = $f->maximum_seat - $occupiedSeats;
            $f->avilableSeats = $avilableSeats;
        }
        
        return view ('user.flights')
        ->with('flight',$flight);
    }
    public function purchase(){
        

    }

}
