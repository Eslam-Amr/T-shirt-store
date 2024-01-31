    @include('layout.header')
    @include('layout.navbar')
    @include('layout.breadcrumb',['name' => 'Cart Products'])
    <section class="cart_area padding_top">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($carts as $cart)
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">

                                                <img class="product__img  object-fit-cover"
                                                    src="{{ $cart->image[0] == 'h' ? $cart->image : asset('uplode') . '/RequestDesign/' . $cart->image }}"
                                                    data-id="white" width="300px">
                                                {{-- <img src="{{ asset('img') }}/product/single-product/cart-1.jpg" alt="" /> --}}
                                            </div>
                                            <div class="media-body">
                                                <p>{{ $cart->name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>{{ $cart->price_after_discount }}</h5>
                                    </td>
                                    <td>
                                        {{ $cart->quantity }}
                                    </td>
                                    <td>
                                        <h5>{{ $cart->total }}</h5>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        <div>No Item in cart</div>
                                    </td>
                                </tr>
                            @endforelse
                        @unless (count($carts)==0)
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
                        @endunless
                        <tr class="shipping_area">
                        </tr>
                    </tbody>
                </table>
                <div class="checkout_btn_inner float-right">
                    <a class="btn_1" href="{{ route('home.index') }}">Continue Shopping</a>
                    @unless (count($carts)==0)
                    <a class="btn_1 checkout_btn_1" href="{{ route('home.checkout') }}">Proceed to checkout</a>
                    @endunless
                </div>
            </div>
        </div>
</section>
@include('layout.footer')
