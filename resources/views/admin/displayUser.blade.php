@extends('adminlte::page')
@section('content')
@if(session()->has('message'))
<div class="alert alert-success" id="alert">

    {{ session()->get('message') }}
</div>
    <script type="text/javascript">
    document.ready(setTimeout(function(){
        document.getElementById('alert').remove()
    },3000))
    </script>
@endif
<table class="table border-dark">
    <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>role</th>
            <th>email</th>
            <th>phone</th>
            <th>delete</th>
            <th>update</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user )
        <tr>
            <th>{{ $user->id }}</th>
            <th>{{ $user->name }}</th>
            <th>{{ $user->role }}</th>
            <th>{{ $user->email }}</th>
            <th>{{ $user->phone }}</th>
            <th>
               <button class="btn btn-danger "><a class="text-white" href="{{ route('admin.deleteUser',$user->id) }}">Delete</a></button>

            </th>
            <th>
                <button class="btn btn-warning "><a class="text-white" href="{{ route('admin.updateUserForm',$user->id) }}"> Update</a></button>
            </th>
        </tr>

        @endforeach
    </tbody>
</table>
{{ $users->links() }}
@endsection
