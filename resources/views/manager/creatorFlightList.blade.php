@extends('layout.managerApp')

@section('content')

<h5>Created By: <b>{{$user->name}}</b></h5>

<table class="table table-formed">
    <tr>
        <th>Flight Name</th>
        <th>Maximum Seat</th>
    </tr>
    @foreach($user->transports as $t)
    <tr>
        <th><a href="{{route('manager.flightdetails',['id'=>encrypt($t->id)])}}" class="btn btn-success">{{$t->name}} </br> ID: {{$t->id}}</a></th>
        <th>{{$t->maximum_seat}}</th>
    </tr>
    @endforeach
</table>

@endsection