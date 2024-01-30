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
            {{-- <th>user id</th> --}}
            <th>name</th>
            <th>category</th>
            <th>price</th>
            <th>discount</th>
            <th>price after discount</th>
            <th>description</th>
            <th>show</th>
            {{-- <th>email</th>
            <th>phone</th>
            <th>status</th> --}}
            {{-- <th>delete</th>
            <th>update</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($designs as $design )
        <tr>
            {{-- <th>{{ $design->user_id }}</th> --}}
            <th>{{ $design->design_name }}</th>
            <th>{{ $design->design_category }}</th>
            <th>{{ $design->price }}</th>
            <th>{{ $design->discount }}</th>
            <th>{{ $design->price*(1-($design->discount/100)) }}</th>
            <th>{{ $design->description }}</th>
            {{-- <th>{{ $design->design_name }}</th> --}}
            {{-- <th>{{ $design->phone }}</th>
            <th>{{ $design->status }}</th> --}}
            <th>
               {{-- <button class="btn btn-danger "><a class="text-white" href="{{ route('admin.deletedesigner',$designer->id) }}">Delete</a></button> --}}
               <button class="btn btn-success "><a class="text-white" href="{{ route('admin.showSpecificDesign',$design->id) }}">Show</a></button>
               {{-- {{ route('admin.showSpecificDesign',$design->id) }} --}}
            </th>
            <th>
                {{-- <button class="btn btn-warning "><a class="text-white" href="{{ route('admin.updatedesignerForm',$designer->id) }}"> Update</a></button> --}}
            </th>
        </tr>

        @endforeach
    </tbody>
</table>
{{ $designs->links() }}
@endsection
