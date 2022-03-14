@extends('layout.managerApp')

@section('content')

<h1>Flight Details</h1>

<table class="table table-formed">
    <tr>
        <th>Flight Name:</th>
        <td>{{$flight->name}}</td>
    </tr>
    <tr>
        <th>Flight ID:</th>
        <td>{{$flight->id}}</td>
    </tr>
    
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

@endsection