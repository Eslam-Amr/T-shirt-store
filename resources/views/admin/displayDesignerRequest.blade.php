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
            <th>portfolio</th>
            <th>email</th>
            <th>phone</th>
            <th>delete</th>
            <th>confirme</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user )
        {{-- @dd($user->id) --}}
        <tr>
            <th>{{ $user['id'] }}</th>
            <th>{{ $user['name'] }}</th>
            <th>{{ $user['portfolio'] }}</th>
            <th>{{ $user['email'] }}</th>
            <th>{{ $user['phone'] }}</th>
            <th>
               <a class="text-white btn btn-danger " href="{{ route('admin.deleteUser',$user['id']) }}">Delete</a>

            </th>
            <th>
                <a class="text-white btn btn-warning " href="{{ route('admin.designerConfirmed',$user['id']) }}"> confirme</a>
            </th>
        </tr>

        @endforeach
    </tbody>
</table>
{{-- {{ $users->links() }} --}}
@endsection
