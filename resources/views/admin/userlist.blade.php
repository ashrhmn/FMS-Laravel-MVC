@extends('layout.app')

@section('content')
 
<h1>User Details </h1>

<form action="{{route('search.submit')}}" method="post">
    {{csrf_field()}}
 <b>Search:<b> <input type="search" name="uname">
 <input type="submit">
</form>

<table>
        <tr>
            <th>User Name</th>
            <th> Name</th>
            <th>Date Of Birth</th>
            <th>Address</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>

      </tr>

    @foreach($user as $u)
    <tr>

        <td>{{$u->username}}</td>
        <td>{{$u->name}}</td>
        <td>{{$u->date_of_birth}}</td>
        <td>{{$u->address}}</td>
        <td>{{$u->email}}</td>
        <td>{{$u->phone}}</td>
        <td><a href="edit/{{$u->id}}" >Edit</a>
        <a href="delete/{{$u->id}}">Delete</a></td>
   
    </tr>
    @endforeach
</table>

@endsection