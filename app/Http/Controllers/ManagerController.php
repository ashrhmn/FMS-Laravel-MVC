<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userinfo;

class ManagerController extends Controller
{
    //
    public function home(){
        return view('manager.home');
    }
    public function profile(){
        $user = userinfo::where('username','Mortuja')
        ->first();
        
        return view('manager.profile')->with('user',$user);
    }
    public function editProfile(Request $req){
        $user = userinfo::where('Id','=',decrypt($req->id))
        ->first();
        
        return view('manager.editProfile')->with('user',$user);
    }
    public function editProfileSubmit(Request $req){
        $req->validate(
            [
                'name'=>'required',
                'email'=>'required|email',
                'phone' =>'required|regex:/(01)[0-9]{9}/',
                
                'address'=>'required'
            ]
            
        );

        $user = userinfo::where('username',$req->uname)
                ->update(['name' => $req->name,
                'email' => $req->email,
                'phone' => $req->phone,
                'date_of_birth' => $req->date_of_birth,
                'address' => $req->address
                ]);

        return redirect('/manager/profile');
    }
}
