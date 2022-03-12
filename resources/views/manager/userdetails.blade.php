@extends('layout.managerApp')

@section('content')

<h1>User Details</h1>

<h5>Name:  {{$user->name}}  </h5>
<h5>Username: {{$user->username}} </h5>
<h5>Email: {{$user->email}} </h5>
<h5>Phone:  {{$user->phone}}  </h5>
<h5>Date of Birth: {{$user->date_of_birth}} </h5>
<h5>Address: {{$user->address}} </h5>
<h5>Purchased Tickets: </h5>

@if(count($user->purchasedtickets)>0)]
    <ol>
        @foreach($user->purchasedtickets as $p)
        
            <li><h6>Ticket Id: {{$p->id}}</h6>
                <ul>
                    <li>Start Time: {{$p->seatinfos[0]->start_time}}</li>
                    <li>From Stopage: {{$p->fromstopage->Name}}, {{$p->fromstopage->city->name}}, {{$p->fromstopage->city->country}}</li>
                    <li>Destination: {{$p->tostopage->Name}}, {{$p->tostopage->city->name}}, {{$p->tostopage->city->country}}</li>
                    <li>Seat Class: @foreach($p->seatinfos as $s)
                                        {{$s->seat_class}}
                                    @endforeach
                    </li>
                    <li><a href="{{route('manager.flightdetails',['id'=>encrypt($p->id)])}}" class="btn-success">Flight: {{$p->seatinfos[0]->transport->name}}, {{$p->seatinfos[0]->transport_id}}</a></li>
                    <li><a href="" class="btn btn-success">Cabcel Ticket</a></li>
                </ul>
            </li>
        
        @endforeach
    </ol>
@else
    <h6>No Purchased Tickets</h6>

@endif

@endsection