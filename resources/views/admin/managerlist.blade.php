@extends('layout.app')

@section('content')
 
<h1>Manager Details </h1>

<table>
        <tr>
            <th>User Name</th>
            <th>Date Of Birth</th>
            <th>Address</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Operation</th>
      </tr>

    @foreach ($user as $u)
    <tr>

        <td>{{$u->username}}</td>
        <td>{{$u->date_of_birth}}</td>
        <td>{{$u->address}}</td>
        <td>{{$u->email}}</td>
        <td>{{$u->phone}}</td>
        <td><a href="edit/{{$u->id}}" >Edit</a>
        <a href="managerdelete/{{$u->id}}">Delete</a></td>
   
    </tr>
    @endforeach
</table>

@endsection