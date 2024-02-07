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
            <th>date</th>
            {{-- <th>status</th>
            <th>update status</th> --}}
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
            <th>{{ $order->updated_at }}</th>
            {{-- <th> --}}
                {{-- Shipping --}}
               {{-- <button class="btn btn-danger "><a class="text-white" href="{{ route('admin.rejectOrder',$order->order_id) }}">rejected</a></button>
               <button class="btn btn-warning "><a class="text-white" href="{{ route('admin.ShippingOrder',$order->order_id) }}">Shipping</a></button>
               <button class="btn btn-success "><a class="text-white" href="{{ route('admin.completeOrder',$order->order_id) }} ">completed</a></button> --}}
               {{-- <button class="btn btn-danger "><a class="text-white" href="{{ route('admin.deleteUser',$user->id) }}">Delete</a></button> --}}

            {{-- </th> --}}
            <th>
                {{-- <button class="btn btn-warning "><a class="text-white" href="{{ route('admin.updateUserForm',$user->id) }}"> Update</a></button> --}}
            </th>
        </tr>

        @endforeach
    </tbody>
</table>
{{ $orders->links() }}
@endsection