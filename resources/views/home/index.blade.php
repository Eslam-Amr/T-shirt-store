@include('layout.header')
@include('layout.navbar')
{{-- @if (session()->has('message'))
    <div class="alert alert-success col-2" style="z-index: 5" id="alert">

        {{ session()->get('message') }}
    </div>
    <script type="text/javascript">
        document.ready(setTimeout(function() {
            document.getElementById('alert').remove()
        }, 3000))
    </script>
@endif --}}
<section class="banner_part">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">

                <div class="banner_slider owl-carousel">
                    <div class="single_banner_slider">
                        <div class="row">
                            <div class="col-lg-5 col-md-8">
                                <div class="banner_text">
                                    <div class="banner_text_iner">
                                        <h1>cotton </h1>
                                        <p>
                                            {{-- @if (session()->has('message'))
                                                <span class="alert alert-success col-2" style="z-index: 5"
                                                    id="alert">

                                                    {{ session()->get('message') }}
                                                </span>
                                                <script type="text/javascript">
                                                    document.ready(setTimeout(function() {
                                                        document.getElementById('alert').remove()
                                                    }, 3000))
                                                </script>
                                            @endif --}}
                                            good and hight quality material
                                        </p>
                                        <a href="#" class="btn_2">buy now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="banner_img d-none d-lg-block">
                                <img src="img/images.jpeg" height="500px" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider-counter"></div>
            </div>
        </div>
    </div>
</section>

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
<section class="product_list section_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section_tittle text-center">
                    <h2>awesome <span>shop</span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="product_list_slider owl-carousel">
                    <div class="single_product_list_slider">
                        <div class="row align-items-center justify-content-between">
                            @for ($i = 0; $i < $numberOfProduct && $i < 8; $i++)
                                <div class="col-lg-3 col-sm-6">
                                    <div class="single_product_item">
                                        <a href="{{ route('home.productDetails', $products[$i]->id) }}">
                                            <img class="product__img w-100 h-100 object-fit-cover"
                                                src="{{ $products[$i]->image[0] == 'h' ? $products[$i]->image : asset('uplode') . '/RequestDesign/' . $products[$i]->image }}"
                                                data-id="white">
                                        </a>
                                        <div class="single_product_text">
                                            <h4>{{ $products[$i]['name'] }}</h4>
                                            <h3 style="text-decoration: line-through;">{{ $products[$i]['price'] }}
                                                EGP</h3>
                                            <h3>{{ $products[$i]['price_after_discount'] }} EGP</h3>
                                            <a href="{{ route('home.addToCart', $products[$i]['id']) }}"
                                                class="add_cart">+ add to cart
                                            </a>
                                            @php
                                                $wishlist = Helper::checkIfInWhislist($products[$i]['id']);

                                            @endphp
                                            @if ($wishlist)
                                                <a href="{{ route('wishlist.remove', $products[$i]['id']) }}"
                                                    class="like_us"> <i style="color: red"
                                                        class="fa-solid  fa-heart"></i> </a>
                                            @else
                                                <a href="{{ route('wishlist.add', $products[$i]['id']) }}"
                                                    class="like_us"> <i class="ti-heart"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                    @if ($numberOfProduct > 8)

                        <div class="single_product_list_slider">
                            <div class="row align-items-center justify-content-between">
                                @for ($i = 8; $i < $numberOfProduct - 8 && $i < 16; $i++)
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="single_product_item">
                                            <a href="{{ route('home.productDetails', $products[$i]->id) }}">
                                                <img class="product__img w-100 h-100 object-fit-cover"
                                                    src="{{ $products[$i]->image[0] == 'h' ? $products[$i]->image : asset('uplode') . '/RequestDesign/' . $products[$i]->image }}"
                                                    data-id="white">
                                            </a>
                                            <div class="single_product_text">
                                                <h4>{{ $products[$i]['name'] }}</h4>
                                                <h3 style="text-decoration: line-through;">{{ $products[$i]['price'] }}
                                                    EGP</h3>
                                                <h3>{{ $products[$i]['price_after_discount'] }} EGP</h3>
                                                <a href="{{ route('home.addToCart', $products[$i]['id']) }}"
                                                    class="add_cart">+ add to cart
                                                </a>
                                                @php
                                                    $wishlist = Helper::checkIfInWhislist($products[$i]['id']);

                                                @endphp
                                                @if ($wishlist)
                                                    <a href="{{ route('wishlist.remove', $products[$i]['id']) }}"
                                                        class="like_us"> <i style="color: red"
                                                            class="fa-solid  fa-heart"></i> </a>
                                                @else
                                                    <a href="{{ route('wishlist.add', $products[$i]['id']) }}"
                                                        class="like_us"> <i class="ti-heart"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<section class="product_list best_seller section_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section_tittle text-center">
                    <h2>Best Sellers <span>shop</span></h2>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-12">
                <div class="best_product_slider owl-carousel">
                    @foreach ($products as $product)
                        <div class="single_product_item">
                            <a href="{{ route('home.productDetails', $product->id) }}">
                                <img class="product__img w-100 h-100 object-fit-cover"
                                    src="{{ $product->image[0] == 'h' ? $product->image : asset('uplode') . '/RequestDesign/' . $product->image }}"
                                    data-id="white">
                            </a>
                            <div class="single_product_text">
                                <h4>{{ $product['name'] }}</h4>
                                <h3 style="text-decoration: line-through;">{{ $product['price'] }} EGP</h3>
                                <h3>{{ $product['price_after_discount'] }} EGP</h3>
                                <a href="{{ route('home.addToCart', $product['id']) }}" class="add_cart">+ add to cart
                                </a>
                                @php
                                    $wishlist = Helper::checkIfInWhislist($product['id']);

                                @endphp
                                @if ($wishlist)
                                    <a href="{{ route('wishlist.remove', $product['id']) }}" class="like_us"> <i
                                            style="color: red" class="fa-solid  fa-heart"></i> </a>
                                @else
                                    <a href="{{ route('wishlist.add', $product['id']) }}" class="like_us"> <i
                                            class="ti-heart"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<section class="client_logo padding_top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="single_client_logo">
                    <img src="img/client_logo/client_logo_1.png" alt="">
                </div>
                <div class="single_client_logo">
                    <img src="img/client_logo/client_logo_2.png" alt="">
                </div>
                <div class="single_client_logo">
                    <img src="img/client_logo/client_logo_3.png" alt="">
                </div>
                <div class="single_client_logo">
                    <img src="img/client_logo/client_logo_4.png" alt="">
                </div>
                <div class="single_client_logo">
                    <img src="img/client_logo/client_logo_5.png" alt="">
                </div>
                <div class="single_client_logo">
                    <img src="img/client_logo/client_logo_3.png" alt="">
                </div>
                <div class="single_client_logo">
                    <img src="img/client_logo/client_logo_1.png" alt="">
                </div>
                <div class="single_client_logo">
                    <img src="img/client_logo/client_logo_2.png" alt="">
                </div>
                <div class="single_client_logo">
                    <img src="img/client_logo/client_logo_3.png" alt="">
                </div>
                <div class="single_client_logo">
                    <img src="img/client_logo/client_logo_4.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
@include('layout.footer')
