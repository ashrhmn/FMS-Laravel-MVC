@extends('layout.userLayout')
@section('content')
@if(Session::has('msg'))
    <p class="alert alert-info">{{ Session::get('msg') }}</p>
@endif
<table class="table table-striped">
    <tr>
        <th>Ticket Id</th>
        <th>From</th>
        <th>Destination</th>
        <th>Action</th>
    </tr>
    @foreach ($tickets as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->fromstopage->name }},{{$p->fromstopage->city->name}}</td>
            <td>{{ $p->tostopage->name }},{{$p->tostopage->city->name}}</td>
            <td><a class="btn btn-danger" href="{{ route('user.cancelTicket',['id'=>encrypt($p->id)]) }}">Cancel Ticket</a></td>
            
        </tr>
    @endforeach
</table>
@endsection