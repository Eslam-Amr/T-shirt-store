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
        <a class="btn btn-warning" href="{{ route('admin.displayProduct') }}">back</a>
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
        {{-- @dd($design) --}}
        {{-- @dd($description) --}}
        {{-- <img  style="border: 50px white solid; width: 500px; transform: translate(-25%)" src="{{asset('uplode')}}/RequestDesign/{{ $product['design'] }}" alt=""> --}}
        <img style="border: 10px white solid; width: 500px; transform: translate(-25%)"
            src="{{ $product->image[0] == 'h' ? $product->image : asset('uplode') . '/RequestDesign/' . $product->image }}"
            data-id="white">
        {{-- <p>{{ $description }}</p> --}}
        <div>
            <form action="{{ route('admin.edit', $product['id']) }}">
                {{-- <div class="row">
                    <div class="col-4">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" name="stock" value="{{ $product['stock'] }}"
                            id="stock" placeholder="Stock">
                    </div>
                    <div class="col-4">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" value="{{ $product['price'] }}"
                            id="price" placeholder="Price">
                    </div>
                    <div class="col-4">
                        <label for="discount">Discount</label>
                        <input type="number" class="form-control" name="discount" value="{{ $product['discount'] }}"
                            id="discount" placeholder="Discount">
                    </div>
                    <div class="col-12 mt-3">
                        <input type="submit" class="btn btn-success" value="edit">
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-4">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" name="stock" value="{{ $product['stock'] }}"
                            id="stock" placeholder="Stock">
                    </div>
                    <div class="col-4">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" value="{{ $product['price'] }}"
                            id="price" placeholder="Price">
                    </div>
                    <div class="col-4">
                        <label for="discount">Discount</label>
                        <input type="number" class="form-control" name="discount" value="{{ $product['discount'] }}"
                            id="discount" placeholder="Discount">
                    </div>
                    <div class="col-12 mt-3">
                        <label for="calculated_price">Calculated Price After Discount</label>
                        <input type="number" class="form-control" id="calculated_price" disabled>
                    </div>
                    <div class="col-12 mt-3">
                        <input type="submit" class="btn btn-success" value="edit">
                    </div>
                </div>

            </form>
            {{-- <a href="{{route('admin.addSpecificDesign',$design->id)}}"><button>Add</button></a> --}}
            {{-- <a href="{{ route('admin.rejectSpecificDesign',$design->id) }}"><button>reject</button></a> --}}
        </div>
        {{-- @dd($design['design']) --}}
    </div>

    <script>
        // Get references to the input fields
        const discountInput = document.getElementById('discount');
        const priceInput = document.getElementById('price');
        const calculatedPriceInput = document.getElementById('calculated_price');

        // Add event listener to the discount input field
        discountInput.addEventListener('input', function() {
            // Calculate the price after discount
            const discount = parseFloat(discountInput.value);
            const price = parseFloat(priceInput.value);
            const discountedPrice = price - (price * discount / 100);

            // Update the value of the calculated price input field
            calculatedPriceInput.value = discountedPrice.toFixed(2); // Format to two decimal places
        });
    </script>
@endsection
