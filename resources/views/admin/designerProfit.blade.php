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

            <th>name</th>
            <th>total profit</th>


        </tr>
    </thead>
    <tbody>
        @foreach ($profits as $profit )
        <tr>
            <th>{{ $profit->name }}</th>
            <th>{{ $profit->total_sum }}</th>

            {{-- <th>
               <button class="btn btn-danger "><a class="text-white" href="{{ route('admin.deleteUser',$user->id) }}">Delete</a></button>

            </th>
            <th>
                <button class="btn btn-warning "><a class="text-white" href="{{ route('admin.updateUserForm',$user->id) }}"> Update</a></button>
            </th> --}}
        </tr>

        @endforeach
    </tbody>
</table>
{{ $profits->links() }}
@endsection
