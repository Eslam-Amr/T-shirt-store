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
            <th>first name</th>
            {{-- <th>name</th> --}}
            {{-- <th>role</th> --}}
            <th>email</th>
            <th>phone</th>
            <th>total</th>
            <th>status</th>
            <th>update status</th>
        </tr>
        {{-- @dd($orders) --}}
    </thead>
    <tbody>
        @foreach ($orders as $order )
        <tr>
            <th>{{ $order->first_name }}</th>
            <th>{{ $order->email }}</th>
            <th>{{ $order->phone }}</th>
            <th>{{ $order->total }}</th>
            <th>{{ $order->status }}</th>
            <th>
               {{-- <button class="btn btn-danger "><a class="text-white" href="{{ route('admin.deleteUser',$user->id) }}">Delete</a></button> --}}

            </th>
            <th>
                {{-- <button class="btn btn-warning "><a class="text-white" href="{{ route('admin.updateUserForm',$user->id) }}"> Update</a></button> --}}
            </th>
        </tr>

        @endforeach
    </tbody>
</table>
{{ $orders->links() }}
@endsection
