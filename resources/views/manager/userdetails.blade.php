@extends('layout.managerApp')

@section('content')

<h1>User Details</h1>


<table class="table table-formed">
    <tr>
        <th>Customer Name:</th>
        <td>{{$user->name}}</td>
    </tr>
    <tr>
        <th>Username:</th>
        <td>{{$user->username}}</td>
    </tr>
    <tr>
        <th>Email:</th>
        <td>{{$user->email}}</td>
    </tr>
    <tr>
        <th>Phone:</th>
        <td>{{$user->phone}}</td>
    </tr>
    <tr>
        <th>Date of Birth:</th>
        <td>{{$user->date_of_birth}}</td>
    </tr>
    <tr>
        <th>Address:</th>
        <td>{{$user->address}}</td>
    </tr>

    <tr>
        <th>Purchased Tickets:</th>
        <td>     
        </td>
    </tr>
    <tr>
        @if(count($user->purchasedtickets)>0)]
        <th> </th>
        <td> 
        
            <ol>
                @foreach($user->purchasedtickets as $p)
                
                    <li><h6>Ticket Id: {{$p->id}}</h6>
                        <ul>
                            <li>Start Time: {{$p->seatinfos[0]->start_time}}</li>
                            <li>From Stopage: {{$p->fromstopage->name}}, {{$p->fromstopage->city->name}}, {{$p->fromstopage->city->country}}</li>
                            <li>Destination: {{$p->tostopage->name}}, {{$p->tostopage->city->name}}, {{$p->tostopage->city->country}}</li>
                            <li>Age Class: @foreach($p->seatinfos as $s)
                                                {{$s->age_class}}
                                            @endforeach
                            <li>Seat Class: @foreach($p->seatinfos as $s)
                                                {{$s->seat_class}}
                                            @endforeach
                            </li>
                            <li>Flight: {{$p->seatinfos[0]->transport->name}}, {{$p->seatinfos[0]->transport_id}} <a href="{{route('manager.flightdetails',['id'=>encrypt($p->seatinfos[0]->transport_id)])}}" class="btn btn-success">Show Flight Details</a></li>
                            <a href="{{route('manager.cancelticket',['id'=>encrypt($p->id)])}}" class="btn btn-danger">Cabcel Ticket</a></li>
                        </ul>
                    </li>
                
                @endforeach
            </ol>
        </td>
        @else
            <th></th>
            <td>
            <h6>No Purchased Tickets</h6>
            </td>

        @endif
    </tr>
</table>

@endsection