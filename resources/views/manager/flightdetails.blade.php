@extends('layout.managerApp')

@section('content')

<h1>Flight Details</h1>

<h5>Flight Name:  {{$flight->name}}  </h5>
<h5>Flight ID: {{$flight->id}} </h5>
<h5>Start Time: {{$flight->seatinfos[0]->start_time}} </h5>
<h5>From Stopage:  {{$flight->fromstopage->Name}}, {{$flight->fromstopage->city->name}}, {{$flight->fromstopage->city->country}}  </h5>
<h5>Available Seats:    @if(($available_seat)>0)
                            {{$available_seat}} <a href="" class="btn btn-danger">Book Seat for user</a>
                        @else
                            No Available Seat
                        @endif

</h5>
<h5>Date of Birth: {{$flight->date_of_birth}} </h5>
<h5>Address: {{$flight->address}} </h5>
<h5>Purchased Tickets: </h5>

@endsection