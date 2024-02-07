@include('layout.header')
@include('layout.navbar')
@include('layout.breadcrumb', ['name' => 'wishlist'])
<section class="cart_area padding_top">
    <div class="container">
        {{-- @dd($wishlists) --}}
        <div class="cart_inner">
            @if (session()->has('message'))
                                <div class="alert alert-danger" id="alert">

                                    {{ session()->get('message') }}
                                </div>
                                <script type="text/javascript">
                                    document.ready(setTimeout(function() {
                                        document.getElementById('alert').remove()
                                    }, 3000))
                                </script>
                            @endif
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">name</th>
                            {{-- <th scope="col">description</th> --}}
                            <th scope="col">Price</th>
                            {{-- <th scope="col">Quantity</th> --}}
                            {{-- <th scope="col">remove from wishlist </th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($wishlists as $wishlist)
                            {{-- @dd($wishlist) --}}
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">

                                            <img class="product__img  object-fit-cover"
                                                src="{{ $wishlist->image[0] == 'h' ? $wishlist->image : asset('uplode') . '/RequestDesign/' . $wishlist->image }}"
                                                data-id="white" width="200px">
                                            {{-- <img src="{{ asset('img') }}/product/single-product/cart-1.jpg" alt="" /> --}}
                                        </div>
                                        {{-- <div class="media-body"> --}}
                                        {{-- <p>{{ $wishlist->name }}</p> --}}
                                        {{-- </div> --}}
                                    </div>
                                </td>
                                <td>
                                    <h5>{{ $wishlist->name }}</h5>
                                </td>
                                {{-- <td>
                                    <h5>{{ $wishlist->description }}</h5>
                                </td> --}}
                                {{-- <td>
                                    <h5>{{ $wishlist->price }}</h5>
                                </td> --}}
                                <td>
                                    <h5>{{ $wishlist->price_after_discount }}</h5>
                                </td>
                                <td>
                                    <a href="{{ route('wishlist.remove', $wishlist['products_id']) }}" class="like_us"> <i
                                            style="color: red" class="fa-solid  fa-heart"></i> </a>
                                </td>
                                <td>
                                    {{-- {{-- <a href="{{ route('cart.decrement', $cart->cart_id) }}" class="btn btn-danger ">-</a> {{ $cart->quantity }} <a href="{{ route('cart.cartIncrement',$cart->cart_id) }}" class="btn btn-warning">+</a>  --}}
                                </td>
                                <td>
                                    {{-- <h5>{{ $cart->total }}</h5> --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>
                                    <div>No Item in wishlist</div>
                                </td>
                            </tr>
                        @endforelse
                        {{-- @unless (count($carts) == 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <h5>Subtotal</h5>
                            </td>
                            <td>
                                <h5>{{ $total }}+100 shipping = {{ $total + 100 }}</h5>
                            </td>
                        </tr>
                    @endunless --}}
                        <tr class="shipping_area">
                        </tr>
                    </tbody>
                </table>
                <div class="checkout_btn_inner float-right">
                    <a class="btn_1" href="{{ route('home.index') }}">Continue Shopping</a>
                    {{-- @unless (count($carts) == 0)
                <a class="btn_1 checkout_btn_1" href="{{ route('home.checkout') }}">Proceed to checkout</a>
                @endunless --}}
                </div>
            </div>
        </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var errorMessages = document.getElementById('error-messages');

        // Check if the error messages div exists
        if (errorMessages) {
            // Check if there are error messages
            var hasErrors = errorMessages.innerText.trim() !== "";

            // Add the alert classes if there are errors
            if (hasErrors) {
                errorMessages.classList.add('alert', 'alert-danger', 'p-2', 'mb-3');

                // Hide the error messages after 3 seconds
                setTimeout(function() {
                    errorMessages.style.display = 'none';
                }, 3000); // 3000 milliseconds = 3 seconds
            }
        }
    });
</script>
@include('layout.footer')
