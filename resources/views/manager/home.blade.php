@extends('layout.managerApp')

@section('content')



<h1>Manager Home</h1>

<table class="table table-formed">
    <tr>
        <td><a href="{{route('manager.userlist')}}" class="btn btn-success" >Customer & Purchased Ticket Customer</a></td>
        <td><a href="{{route('manager.flightManagerList')}}" class="btn btn-danger" >Search Flight Manager</a></td>
    </tr>
    <tr>
        <td><a href="{{route('manager.searchuserlist')}}" class="btn btn-success" >Search Customer</a></td>
        <td><a href="{{route('manager.userlist')}}" class="btn btn-danger" >Search Flights</a></td>
    </tr>
</table>

@endsection