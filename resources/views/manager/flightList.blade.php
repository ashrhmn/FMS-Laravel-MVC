@extends('layout.managerApp')

@section('content')


<form action="{{ route('manager.flightSearch')}}" method="post">
    {{ @csrf_field() }}
    <table>
        <tr>
            <th>From Stopage: </th>
            <td>
                <select name="fsid">
                    <option value="0">From Stopage</option>
                    @foreach ($stopage as $s)
                        <option value="{{ $s->id }}">{{ $s->name }}, {{ $s->city->name }}, {{ $s->city->country }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <th>Destination: </th>
            <td>
                <select name="tsid">
                    <option value="0">Destination</option>
                    @foreach ($stopage as $s)
                        <option value="{{ $s->id }}">{{ $s->name }}, {{ $s->city->name }}, {{ $s->city->country }}</option>
                    @endforeach
                </select>
            </td>
            
        </tr>
        <tr>
            <th>Date: </th>
            <td>
                <input type="date" name="date">
            </td>
        </tr>
        <tr>
            <th></th>
            <td><input type="submit" value="Search Flight" class="btn btn-Info" /></td>
        </tr>
        
    </table>
</form>

@if(Session::has('msg'))
    <p class="alert alert-info">{{ Session::get('msg') }}</p>
@endif

@if(count($schedules)> 0)
    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>From</th>
            <th>Destination</th>
            <th>Day</th>
            <th>Maximum Seats</th>
            <th>Available seats</th>
            <th>Action</th>
        </tr>
        @foreach ($schedules as $s)
            <tr>
                <td>{{$s->flightName}}</td>
                <td>{{$s->fromstopagee}}, {{$s->fromstopagecity}}, {{$s->fromstopagecountry}}</td>
                <td>{{$s->tostopagee}}, {{$s->tostopagecity}}, {{$s->tostopagecountry}}</td>
                <td>{{$s->day}}</td>
                <td>{{$s->maximumSeat}}</td>
                <td>{{$s->avilableSeats}}</td>
                <td><a href="{{route('manager.deleteFlightSchedule',['id'=>encrypt($s->id),'fid'=>encrypt($s->flightId)])}}" class="btn btn-danger">Delete</a></td>
            </tr>
        @endforeach
    </table>
    @else
        <h6>No Available Flights</h6>
    @endif
@endsection