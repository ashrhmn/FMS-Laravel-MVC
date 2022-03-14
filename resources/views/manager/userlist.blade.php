@extends('layout.managerApp')

@section('content')

<h1>Customer List</h1>

<form action="{{route('manager.userlistSearch')}}" method="post">
    {{@csrf_field()}}
    <table>
        <tr>
            <td>
            <input type="checkbox" id="booked" name="booked" value="1"> <label class="form-check-label" for="booked">Purchased Ticket</label>
            </td>
        </tr>
        <tr>
            <th>From Stopage</th>
            <td>
                 <select name="fromstopage">
                    <option value="0">From Stopage</option>
                    @foreach($stopage as $s)
                        <option value="{{$s->id}}">{{$s->name}}, {{$s->city->name}}, {{$s->city->country}}</option>
                    @endforeach
                 </select>
            </td>
        </tr>
        <tr>
            <th>Destination</th>
            <td>
                 <select name="tostopage">
                    <option value="0">Destination</option>
                    @foreach($stopage as $s)
                        <option value="{{$s->id}}">{{$s->name}}, {{$s->city->name}}, {{$s->city->country}}</option>
                    @endforeach
                 </select>
            </td>
            <td><input type="submit" value="Search User" /></td>
        </tr>
    </table>
</form>

@if(count($users)>0)
    <table class="table table-formed">
        <tr>
            <th>Name</th>
            <th>Username</th>
        </tr>
        @foreach($users as $u)
            <tr>
                <td>{{$u->name}}</td>
                <td><a href="{{route('manager.userdetails',['id'=>encrypt($u->id)])}}" class="btn-success"> {{$u->username}}</td>
            </tr>
        @endforeach
    </table>
@else
    <h4>No User found</h4>
@endif


@endsection