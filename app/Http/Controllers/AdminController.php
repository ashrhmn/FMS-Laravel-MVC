<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Symfony\Component\HttpFoundation\SessiSession;

class AdminController extends Controller
{
    public function userlist()
    {


        $user = User::where('role', 'User')
            ->get();

        // return $users;

        return view('admin.userlist')->with('user', $user);
    }

    public function managerlist()
    {

        $user = User::where('role', 'Manager')
            ->get();

        return view('admin.managerlist')->with('user', $user);
    }


    public function editlist(Request  $req)
    {

        $id = $req->id;

        $data = User::where('id', $id)->first();

        return view('admin.editlist')->with('data', $data);
    }

    public function update(Request $req)
    {


        $var = User::where('id', $req->id)->first();
        $var->username = $req->username;
        $var->name = $req->name;
        $var->date_of_birth = $req->dob;
        $var->phone = $req->phone;
        $var->email = $req->email;
        $var->address = $req->address;
        $var->save();
        return redirect()->route('user.list');
    }

    public function deletelist($id)
    {


        $data = User::find($id)->delete();

        return redirect()->route('user.list')->with('data', $data);
    }
}
