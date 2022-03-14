@extends('layout.managerApp')

@section('content')

<h1>Flight Schedules</h1>

@if(count($schedules) > 0)
    <table class="table table-formed">
        <tr>
            <th>Flight Name:</th>
            <th>From Stopage</th>
            <th>To Stopage</th>
            <th>Start Time</th>
            <th>Available Seat</th>
            <th>Operation</th>
            
        </tr>
        @foreach($schedules as $s)
        <tr>
            <td>{{$flight->name}} </br> ID: {{$flight->id}}</td>
            
            <td>{{$s->fromstopage->name}}, {{$s->fromstopage->city->name}}, {{$s->fromstopage->city->country}} </td>
            <td>{{$s->tostopage->name}}, {{$s->tostopage->city->name}}, {{$s->tostopage->city->country}} </td>
            <td>{{$flight->id}}</td>
        </tr>
        @endforeach
        
        <tr>
            <th>Available Seats:</th>
            <td>@if(($available_seat)>0)
                                {{$available_seat}} </td><td> <a href="" class="btn btn-danger">Book Seat for user</a>
                            @else
                                No Available Seat
                            @endif
            </td>
        </tr>
    </table>

@else
    <h6>No Available Schedules For This Flight</h6>
@endif

@endsection