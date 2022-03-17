@extends('layout.userLayout')
@section('content')
<form action="{{route('user.bookTicketSubmit')}}" method="post" class="form-horizontal">
    {{ @csrf_field() }}
    <div class="form-group">
        
        <div class="col-md-10">
            <input type="hidden" name="uid" value="{{$pt->uid}}"  class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-10">
            <input type="hidden" name="fid" value="{{$pt->fid}}" class="form-control" />
        </div>
    </div>
        

        <div class="form-group">
            <label class="col-md-2 control-label">From</label>
            <div class="col-md-10">
                <input type="text" name="fromname" value="{{$pt->fromname}}" class="form-control" readonly />
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">To</label>
            <div class="col-md-10">
                <input type="text" name="toname" value="{{$pt->toname}}" class="form-control" readonly/>
            </div>
        </div>

        <div class="form-group">

            <div class="col-md-10">
                <input type="hidden" name="fromid" value="{{$pt->fromid}}" class="form-control" />
            </div>
        </div>

        <div class="form-group">

            <div class="col-md-10">
                <input type="hidden" name="toid" value="{{$pt->toid}}" class="form-control" />
            </div>
        </div>
        

        <div class="form-group">
            <label class="col-md-2 control-label">Fare</label>
            <div class="col-md-10">
                <input type="text" name="fair" value="{{$pt->fair}}" class="form-control" readonly />
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input type="submit" class="btn btn-success" value="Confirm" />
            </div>
        </div>

</form>
@endsection