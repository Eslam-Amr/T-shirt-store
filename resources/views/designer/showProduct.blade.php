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
    <div>
        <a class="btn btn-warning" href="{{ route('designer.displayProduct') }}">back</a>
    </div>
    <h2 class="text-center py-3">Design</h2>
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
    <div class="container w-25  m-auto ">
        <img style="border: 10px white solid; width: 500px; transform: translate(-25%)"
            src="{{ $product->image[0] == 'h' ? $product->image : asset('uplode') . '/RequestDesign/' . $product->image }}"
            data-id="white">
        <div>
        </div>
    </div>

@endsection
