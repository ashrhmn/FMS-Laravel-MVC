<div>

    <a href="{{ route('admin.index') }}" class="btn btn-success">Home </a>
    <a href="{{ route('user.list') }}" class="btn btn-success">userlist </a>
    <a href="{{ route('manager.list') }}" class="btn btn-success">managerlist </a>
    <!-- <a href="" class="btn btn-primary">update Information </a> -->
    <a href="{{route('password.change')}}" class="btn btn-secondary">password change </a>

    <a class="btn btn-danger" href="{{ route('auth.logout') }}"> logout </a>


</div>