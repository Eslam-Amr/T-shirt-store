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
            {{-- <th>id</th> --}}
            <th>name</th>
            <th>portfolio</th>
            <th>email</th>
            <th>phone</th>
            {{-- <th>status</th> --}}
            <th>delete</th>
            <th>update</th>
        </tr>
    </thead>
    <tbody>
        {{-- @dd($designers[0]['id']) --}}
        @foreach ($designers as $designer )
        <tr>
            {{-- <th>{{ $designer->id }}</th> --}}
            <th>{{ $designer->name }}</th>
            <th>{{ $designer->portfolio }}</th>
            <th>{{ $designer->email }}</th>
            <th>{{ $designer->phone }}</th>
            {{-- <th>{{ $designer->status }}</th> --}}
            <th>
               <button class="btn btn-danger "><a class="text-white" href="{{ route('admin.deleteDesigner',$designer->name) }}">Delete</a></button>

            </th>
            <th>
                {{-- <button class="btn btn-warning "><a class="text-white" href="{{ route('admin.updatedesignerForm',$designer->id) }}"> Update</a></button> --}}
            </th>
        </tr>

        @endforeach
    </tbody>
</table>
{{ $designers->links() }}
@endsection
