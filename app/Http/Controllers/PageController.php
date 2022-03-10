<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use App\Models\userinfo;
use Illuminate\Validation\Validator;
use Illuminate\Contracts\Session;
class PageController extends Controller
{
    public function index(){

        return view('home.index');
    }
    public function login()
    {

        return view('home.login');
    }

    public function registation()
    {

        return view('home.registation');
    }

    public function loginsubmit(Request $req)
    {

         $req->validate([

            'username'=>'required',
            // 'email'=>'required|email',
            'password'=>"required"
         ]);
         
    $users = userinfo::where('username',$req->username)
      ->where ('password',md5($req->password))
      ->first();
    //   if ($userinfo==null) return 'sum';
    //    return $userinfo;
     
    $msg="";
    if($users ){ $msg= "users exists";

    }
    else{
        $msg = "student doestnot exist";
    }
    return  redirect()->route('index',['msg'=> $msg]);

    //  if($userinfo){
    //   $req->session()->flash('msg','users Exists');

    //  }
    //  else{
    //     $req->session()->flash('msg','users does not Exists');
    //  }

    // return  redirect()->route('index');
    

}

   

    public function registersubmit(Request $req){

        $req->validate([
            'username'=>'required',
            'name' =>'required',
            'email' =>'required|email',
            'phone' =>'required|min:11|numeric',
            'dob' =>'required',
            'address' =>'required',
            'password'=>'required|min:6',  
            'confirm_password' =>'required|same:password'  
               
        ]);
  
        $info = new userinfo();

        $info->username = $req->name;
        $info->name = $req->name;
        $info->email=$req->email;
        $info->address=$req->address;
        $info->phone=$req->phone;
        $info->date_of_birth=$req->dob;
        $info->password =md5($req->password) ;
        $info->save();
        
        return "<h1>Registation Successfully <h1>";
    }

    public function logout(){
         session()->flush();
         return redirect()->route('login');
    }

}
