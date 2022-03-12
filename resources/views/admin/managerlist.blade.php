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
      </tr>

    @foreach($user as $u)
    <tr>

        <td>{{$u->username}}</td>
        <td>{{$u->date_of_birth}}</td>
        <td>{{$u->address}}</td>
        <td>{{$u->email}}</td>
        <td>{{$u->phone}}</td>
   
    </tr>
    @endforeach
</table>

@endsection