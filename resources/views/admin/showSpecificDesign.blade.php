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
    <button>back</button>
</div>
<h2 class="text-center py-5">Design</h2>
<div class=" alert-danger text-center my-5">

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
<div class="container w-25 border m-auto ">
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
    {{-- @dd(asset('uplode')) --}}
    <img  style="border: 50px white solid" src="{{asset('uplode')}}/RequestDesign/{{ $design['design'] }}" alt="">
    <div ><button>Add</button>
    <button>reject</button>
    </div>
    {{-- @dd($design['design']) --}}
</div>
@endsection
