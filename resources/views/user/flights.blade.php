@extends('layout.userLayout')
@section('content')
    <form action="{{ route('user.flightsSearch') }}" method="post">
        {{ @csrf_field() }}
        <table>
            <tr>
                <th>From Stopage</th>
                <td>
                    <select name="fsid">
                        <option value="0">From Stopage</option>
                        @foreach ($stopage as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}, {{ $s->city->name }},
                                {{ $s->city->country }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th>Destination</th>
                <td>
                    <select name="tsid">
                        <option value="0">Destination</option>
                        @foreach ($stopage as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}, {{ $s->city->name }},
                                {{ $s->city->country }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
                <tr>
                    <td>
                        <input type="date" name="date">
                    </td>
                </tr>
                <td><input type="submit" value="Search Flight" /></td>
            
        </table>
    </form>
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>From</th>
            <th>Destination</th>
            <th>Maximum Seats</th>
            <th>Available seats</th>
            <th>Go to</th>
        </tr>
        @foreach ($flights as $p)
            <tr>
                @if(count($p->transportschedules))
                <td>{{ $p->name }}</td>
                <td>{{ count($p->transportschedules) == 0 ? '' : $p->transportschedules[0]->fromstopage->name}},{{ count($p->transportschedules) == 0 ? '' : $p->transportschedules[0]->fromstopage->city->name}}</td>
                <td>{{ count($p->transportschedules) == 0 ? '' : $p->transportschedules[0]->tostopage->name }},{{ count($p->transportschedules) == 0 ? '' : $p->transportschedules[0]->tostopage->city->name }}</td>
                <td>{{ $p->maximum_seat }}</td>
                <td>{{ $p->availableSeats }}</td>
                <td><a class="btn btn-info" href="{{ route('user.bookTicket',['id'=>encrypt($p->id)]) }}">Book</a></td>
                @endif
            </tr>
        @endforeach
    </table>
@endsection
