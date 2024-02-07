@extends('adminlte::page')
@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success" id="alert">

            {{ session()->get('message') }}
        </div>
        <script type="text/javascript">
            document.ready(setTimeout(function() {
                document.getElementById('alert').remove()
            }, 3000))
        </script>
    @endif
    <table class="table border-dark">
        <thead>
            <tr>
                <th>name</th>
                {{-- <th>name</th> --}}
                {{-- <th>role</th> --}}
                <th>designer name</th>
                <th>price </th>
                <th>discount </th>
                <th>final price </th>
                <th>stock </th>
                <th>number of sold item </th>
                <th>show design and control</th>
                {{-- <th>phone</th>
            <th>total</th>
            <th>date</th> --}}
                {{-- <th>status</th>
            <th>update status</th> --}}
            </tr>
            {{-- @dd($products) --}}
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <th>{{ $product->name }}</th>
                    <th>{{ $product->designer_name }}</th>
                    <th>{{ $product->price }}</th>
                    <th>{{ $product->discount }}</th>
                    <th>{{ $product->price_after_discount }}</th>
                    <th>{{ $product->stock }}

                        <a class="btn btn-warning" href="{{ route('admin.stockIncrement',$product->id) }}">+</a>
                    </th>
                    <th>{{ $product->numberOfSold }}</th>
                    {{-- <th>{{ $product->updated_at }}</th> --}}
                    <th>
                        <a class="btn btn-success" href="{{ route('admin.control',$product->id) }}">
                            control
                        </a>
                    </th>
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
    {{ $products->links() }}
@endsection
