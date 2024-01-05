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
<h2 class="text-center my-5">Add Design</h2>
<div class=" alert-danger text-center my-5">

    @error('designName')
        {{ $message }}<br>
    @enderror
    @error('designCategory')
    {{ $message }}<br>
    @enderror
    @error('design')
    {{ $message }}<br>
    @enderror
    @error('price')
    {{ $message }}<br>
    @enderror
    @error('discount')
    {{ $message }}<br>
    @enderror
    @error('description')
    {{ $message }}<br>
    @enderror
</div>
<div class="container w-25 border m-auto mt-2">
    <form action="{{ route('designer.sendDesignRequest') }}" method="POST" class="form-group" enctype="multipart/form-data" >
       {{-- { !!  csrf_field()  !!} --}}
@csrf
{{-- @dd(auth()->user()['id']) --}}
       <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">design name</label>
            <input type="text" name="designName"  class="form-control" id="exampleFormControlInput1" placeholder="Enter design name">

        </div>
       <div class="mb-3">
            <label for="exampleFormControlInput2" class="form-label">design category</label>
            <input type="text" name="designCategory"  class="form-control" id="exampleFormControlInput2" placeholder="Enter design category">

        </div>
       <div class="mb-3">
            <label for="exampleFormControlInput3" class="form-label">price</label>
            <input type="number" name="price"  class="form-control" id="exampleFormControlInput3" placeholder="Enter design price">

        </div>
       <div class="mb-3">
            <label for="exampleFormControlInput4" class="form-label">discount</label>
            <input type="number" name="discount"  class="form-control" id="exampleFormControlInput4" placeholder="Enter design discount (%)">

        </div>
       <div class="mb-3">
            <label for="exampleFormControlInput5" class="form-label">description</label>
           <textarea name="description" id="exampleFormControlInput5" cols="50" rows="5" placeholder="Enter design description"></textarea>

        </div>


        <div class="mb-3">
            <label for="exampleFormControlTextarea6" class="form-label">insert design</label>
            <input type="file" name="design" class="form-control" id="exampleFormControlTextarea6"
            >

        </div>


        <div class="mb-3">
            <input type="submit" class="btn btn-primary" value="send">
        </div>
    </form>
</div>
@endsection
