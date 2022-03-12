<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userinfo;
use Session;
use Symfony\Component\HttpFoundation\SessiSession;

class AdminController extends Controller
{
    public function userlist(){


        $user = userinfo::where('role','User')
        ->get();

        // return $users;

         return view('admin.userlist')->with('user',$user);
    }

    public function managerlist(){

        $user = userinfo::where('role','Manager')
        ->get();

        return view('admin.managerlist')->with('user',$user);
    }


    public function editlist(Request  $req){

        $id= $req->id;

        $data=userinfo::where('id',$id)->first();
        
        return view ('admin.editlist')->with('data',$data);

        // $data = userinfo::find($id);

        // // return $data;
    
        // return view('admin.editlist',['data'=>$data]);


    }

    public function update(Request $req){

        // $resto = userinfo::find($req->input('id'));

        // $resto ->username=$req->input('username');
        // $resto ->name=$req->input('name');
        // $resto ->date_of_birth=$req->input('dob');
        // $resto ->phone=$req->input('phone');
        // $resto ->email=$req->input('email');
        // $resto ->address=$req->input('address');
        // $resto->save();
        // $req->session()->flash('status','user updated successfully');

        
        // return redirect()->route('user.list');

        // public function editSubmit(Request $request){

            $var=userinfo::where('id',$req->id)->first();
            $var->username=$req->username;
            $var->name=$req->name;
            $var->date_of_birth=$req->dob;
            $var->phone=$req->phone;
            $var->email=$req->email;
            $var->address=$req->address;
            $var->save(); 
            return redirect()-> route('user.list'); 
    }

    public function deletelist($id){


        $data = userinfo::find($id)->delete();

        return redirect()->route('user.list')->with('data',$data);
    }




    public function managereditlist(Request  $req){

        $id= $req->id;

        $data=userinfo::where('id',$id)->first();
        
        return view ('admin.managerlist')->with('data',$data);



    }

    public function managerupdate(Request $req){

    

            $var=userinfo::where('id',$req->id)->first();
            $var->username=$req->username;
            $var->name=$req->name;
            $var->date_of_birth=$req->dob;
            $var->phone=$req->phone;
            $var->email=$req->email;
            $var->address=$req->address;
            $var->save(); 
            return redirect()-> route('manager.list'); 
    }


    public function managerdelete($id){


        $data1=userinfo::find($id)->delete();

        return redirect()->route('manager.list')->with('data1',$data1);
    }






    public function searchsubmit(Request $req){
        
        //  return $req->uname;
        $user = userinfo::where('username','like','%'.$req->uname.'%')
        ->where('role','User')
        ->get();

        return view('admin.userlist')->with('user',$user);
    }


    
}
