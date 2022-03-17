@extends('layout.managerApp')

@section('content')

<h1>Flight Schedules</h1>

@if(Session::has('msg'))
    <p class="alert alert-info">{{ Session::get('msg') }}</p>
@endif


@if(count($schedules) > 0)
    <table class="table table-formed">
        <tr>
            <th>Flight Name:</th>
            <th>From Stopage</th>
            <th>To Stopage</th>
            <th>Start Time</th>
            <th>Day</th>
            <th>Available Seat</th>
            <th>Operation</th>
            
        </tr>
        @foreach($schedules as $s)
        <tr>
            <td>{{$flight->name}} </br> ID: {{$flight->id}}</td>
            
            <td>{{$s->fromstopage->name}}, {{$s->fromstopage->city->name}}, {{$s->fromstopage->city->country}} </td>
            <td>{{$s->tostopage->name}}, {{$s->tostopage->city->name}}, {{$s->tostopage->city->country}} </td>
            <td>{{$s->start_time}}</td>
            <td>{{$s->day}}</td>
            <td>{{$available_seat}}</td>
            <!-- <td>@if(($available_seat)>0)
                    {{$available_seat}} </td><td> <a href="" class="btn btn-danger">Book Seat for user</a>
                @else
                    No Available Seat
                @endif
            </td> -->
            <td><a href="{{route('manager.deleteSchedule',['id'=>encrypt($s->id),'fid'=>encrypt($flight->id)])}}" class="btn btn-danger">Delete</a></td>
        </tr>
        @endforeach

    </table>

@else
    <h6>No Available Schedules For This Flight</h6>
@endif

@endsection