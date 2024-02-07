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
            {{-- <th>name</th> --}}
            {{-- <th>role</th> --}}
            <th>email</th>
            <th>message</th>
            <th>delete</th>

        </tr>
        {{-- @dd($orders) --}}
    </thead>
    <tbody>
        @foreach ($contactData as $contact )
        <tr>
            <th>{{ $contact->name }}</th>
            <th>{{ $contact->email }}</th>
            <th>{{ $contact->message }}</th>
            <th>
                < a class="text-white btn btn-warning " href="{{ route('admin.deleteContact',$contact->id) }}"> Update</a>
            </th>
        </tr>

        @endforeach
    </tbody>
</table>
{{ $contactData->links() }}
@endsection
