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



    <table style="width:70%">
        <tr>
            <th>Name</th>
            <th>From</th>
            <th>Destination</th>
            <th>Maximum Seats</th>
            <th>Available seats</th>
            <th>Action</th>
        </tr>
        @foreach ($flights as $p)
            <tr>
                <td>{{ $p->name }}</td>
                <td>{{ count($p->transportschedules) == 0 ? '' : $p->transportschedules[0]->id }}</td>
                <td>{{ $p->maximum_seat }}</td>
                {{-- <td>{{ $p->avilableSeats }}</td> --}}
                <td><a href="{{ route('user.bookTicket') }}"></a></td>
            </tr>
        @endforeach
    </table>
@endsection