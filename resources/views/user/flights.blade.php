@extends('layout.userLayout')
@section('content')

<table style="width:70%">
    <tr>
    <th>Name</th>
    <th>From</th>
    <th>Destination</th>
    <th>Maximum Seats</th>
    <th>Available seats</th>
    <th>Action</th>
    </tr>
    @foreach($flight as $p)
    <tr>
        <td>{{$p->name}}</td>
        <td>{{$p->fromstopage->city->name}}</td>
        <td>{{$p->tostopage->city->name}}</td>
        <td>{{$p->maximum_seat}}</td>
        <td>{{$p->avilableSeats}}</td>
        <!-- <td><a href=""></a></td> -->
    </tr>
    @endforeach
</table>

@endsection