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
<div>
    <a href="{{ route('admin.displayDesignsRequest') }}" class="btn btn-warning">back</a>
</div>
<h2 class="text-center py-1">Design</h2>
<div class=" alert-danger text-center my-2">

    @error('designName')
    {{ $message }}
    @enderror
    @error('designCategory')
    {{ $message }}
    @enderror
    @error('design')
    {{ $message }}
    @enderror
</div>
<div class="container w-25  m-auto ">
    {{-- <form action="{{ route('designer.sendDesignRequest') }}" method="POST" class="form-group" enctype="multipart/form-data" > --}}
       {{-- { !!  csrf_field()  !!} --}}
{{-- @csrf --}}
       {{-- <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">design name</label>
            <input type="text" name="designName"  class="form-control" id="exampleFormControlInput1" placeholder="Enter design name">

        </div>
       <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">design category</label>
            <input type="text" name="designCategory"  class="form-control" id="exampleFormControlInput1" placeholder="Enter design category">

        </div>


        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">insert design</label>
            <input type="file" name="design" class="form-control" id="exampleFormControlTextarea1"
            >

        </div>


        <div class="mb-3">
            <input type="submit" class="btn btn-primary" value="send">
        </div>
    </form> --}}

    <img  style="border: 50px white solid; width: 500px; transform: translate(-25%)" src="{{asset('uplode')}}/RequestDesign/{{ $design['design'] }}" alt="">
    <p> description : {{ $description }}</p>
    <div >
        <form action="{{route('admin.addSpecificDesign',$design->id)}}">
<input type="number" name="stock" id="stock" placeholder="stock">
<input type="submit" value="Add" class="btn btn-success">
        </form>
        {{-- <a href="{{route('admin.addSpecificDesign',$design->id)}}"><button>Add</button></a> --}}
        <a href="{{ route('admin.rejectSpecificDesign',$design->id) }}" class="btn btn-danger">reject</a>
    </div>
    {{-- @dd($design['design']) --}}
</div>
@endsection
