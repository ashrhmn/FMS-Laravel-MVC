@extends('layout.flightManager')

@section('content')
    <form class="flex flex-col gap-3 items-center my-10 text-xl"
        action="{{ route('fmgr.add.schedule.post', ['tid' => $transport->id]) }}" method="POST">
        {{ csrf_field() }}
        <input hidden type="text" name="tid" value="{{ $transport->id }}" id="">
        <div class="flex justify-end gap-4">
            <label for="from_stopage_id">From Airport :</label>
            <select class="w-60 border-2" name="from_stopage_id">
                @foreach ($airports as $airport)
                    <option value="{{ $airport->id }}">{{ $airport->name }}, {{ $airport->city->name }},
                        {{ $airport->city->country }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex justify-end gap-4">
            <label for="to_stopage_id">To Airport :</label>
            <select class="w-60 border-2" name="to_stopage_id">
                @foreach ($airports as $airport)
                    <option value="{{ $airport->id }}">{{ $airport->name }}, {{ $airport->city->name }},
                        {{ $airport->city->country }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex justify-end gap-4">
            <label for="day">Day : </label>
            <select name="day" class="border-2 w-60">
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>
        </div>
        <div class="flex justify-end gap-4">
            <label for="time">Time : </label>
            <select name="timeh" class="w-16">
                @foreach (range(0, 23) as $hour)
                    <option value="{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}">
                        {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}</option>
                @endforeach
            </select>
            :
            <select name="timem" class="w-16">
                @foreach (range(0, 60) as $min)
                    <option value="{{ str_pad($min, 2, '0', STR_PAD_LEFT) }}">
                        {{ str_pad($min, 2, '0', STR_PAD_LEFT) }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex justify-end gap-4">
            {{-- <label for="start_time">Start Time : </label>
            <input type="datetime-local" name="start_time" class="w-60 border-2">
        </div> --}}
            <input type="submit" name="Add" class="bg-blue-600 text-white p-1 rounded">
    </form>
@endsection
