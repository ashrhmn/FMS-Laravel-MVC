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
        $user = userinfo::where('username','Mortujaii')
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

        return redirect()->route('manager.profile');
    }
    public function changepass(Request $req){
        $user = userinfo::where('Id','=',decrypt($req->id))
        ->select('username','password')
        ->first();

        return view('manager.changepass')->with('user',$user);
    }
    public function changepassSubmit(Request $req){
        $req->validate(
            [
                'oldpass'=>'min:4',
                'password'=>'min:4',
                'conpass' =>'min:4|same:password'
            ]
            
        );

        $users = userinfo::where('username',$req->uname)
        ->where ('password',md5($req->oldpass))
        ->first();

        if($users){
            $user = userinfo::where('username',$req->uname)
                ->update(['password' => md5($req->password)]);

            $msg = "Password Changed Successfully";
            return redirect()->route('manager.profile');
        }
        else{
            $msg = "Wrong Old Password";

            $user = userinfo::where('username',($req->uname))
            ->select('id','password')
            ->first();

            return  redirect()->route('manager.changepass',['id'=>encrypt($user->id)]);
        }
        
    }
    



}
