@php
if (!isset($data['from']))
$data['from']=0;
if (!isset($data['to']))
$data['to']=500;
if (!isset($data['all']))
$data['all']='all';
    // dd(auth());
    use App\Models\Cart;
    if (auth()->user() != null) {
        $numbrerOfCart = Cart::where('user_id', auth()->user()->id)->count();
        $carts = DB::table('carts')
            ->join('cart_products', 'carts.id', '=', 'cart_products.cart_id')
            ->join('products', 'cart_products.product_id', '=', 'products.id')
            ->select('carts.*', 'carts.id as cart_id', 'cart_products.product_id', 'products.*')
            ->where('carts.user_id', '=', auth()->user()->id)
            ->get();
    } else {
        $numbrerOfCart = 0;
        $carts = [];
    }

    // dd($numbrerOfCart);

@endphp
<style>
    #cart-icon {
        position: relative;
        display: inline-block;
    }

    /* #cart-count {
    position: absolute;
    top: -10px;
    right: -10px;
    /* width: 15px;
    height: 15px; */
    /* transform: translate(-50%, -50%) ; */
    /* text-align: center;
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 1px;
    font-size: 12px;
}  */
    #cart-count {
        position: absolute;
        top: -12px;
        right: -15px;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 4px;
        /* Increase padding to make it more circular */
        font-size: 12px;
        line-height: 1;
        /* Ensure the text is centered vertically */
    }

    #cart-icon .dropdown-toggle {
        text-decoration: none;
        /* Remove the underline from the link */
        /* display: ; */
        color: transparent
    }
</style>
<header class="main_menu home_menu">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="{{ route('home.index') }}"> <img src="{{ asset('img') }}/logo.png"
                            alt="logo"> </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="menu_icon"><i class="fas fa-bars"></i></span>
                    </button>

                    <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home.index') }}">Home</a>
                            </li>
                            @auth

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home.orderHistory') }}">Order History</a>
                                </li>
                            @endauth
                            <li class="nav-item">
                                {{-- <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_1"
                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Shop
                                </a> --}}
                                {{-- <div class="dropdown-menu" aria-labelledby="navbarDropdown_1"> --}}
                                {{-- <a class="dropdown-item" href="{{ route('category.index',['all',0,500]) }}"> shop category</a> --}}
                                {{-- <a class="nav-link" href="{{ route('category.index',[$data['from'],$data['to'],$data['all']]) }}"> shop</a> --}}
                                <a class="nav-link" href="{{ route('category.index') }}"> shop</a>
                                {{-- <a class="dropdown-item" href="single-product.html">product details</a> --}}

                                {{-- </div> --}}
                            </li>
                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_3"
                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    pages
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown_2">
                                    @guest

                                    <a class="dropdown-item" href="{{ route('register.index') }}">register</a>
                                    <a class="dropdown-item" href="{{ route('login.index') }}">user login</a>
                                    @endguest
                                    <a class="dropdown-item" href="{{ route('register.designerRegisterView') }}">designer register</a> --}}
                            {{-- <a class="dropdown-item" href="tracking.html">tracking</a> --}}
                            {{-- <a class="dropdown-item" href="checkout.html">product checkout</a> --}}
                            {{-- <a class="dropdown-item" href="{{ route('home.cart') }}">shopping cart</a> --}}
                            {{-- <a class="dropdown-item" href="confirmation.html">confirmation</a> --}}
                            {{-- <a class="dropdown-item" href="elements.html">elements</a> --}}
                            {{-- </div>
                            </li> --}}
                            @guest

                                <li class="nav-item">

                                    <a class="nav-link" href="{{ route('register.index') }}">register</a>
                                </li>
                                <li class="nav-item">

                                    <a class="nav-link" href="{{ route('login.index') }}"> login</a>
                            </li> @endguest
                            <li class="nav-item">

                                <a class="nav-link" href="{{ route('register.designerRegisterView') }}">designer
                                    register</a>
                            </li> {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_2"
                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    blog
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown_2">
                                    <a class="dropdown-item" href="blog.html"> blog</a>
                                    <a class="dropdown-item" href="single-blog.html">Single blog</a>
                                </div>
                            </li> --}}

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contact.index') }}">Contact</a>
                            </li>
                            @auth

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home.logout') }}">logout</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home.profile') }}">profile</a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                    <div class="hearer_icon d-flex">
                        {{-- <a id="search_1" href="javascript:void(0)"><i class="ti-search"></i></a> --}}
                        <a href="{{ route('wishlist.index') }}"><i class="ti-heart"></i></a>
                        {{-- <i class="fa-solid fa-cart-plus"></i> --}}
                        <!-- HTML -->
                        {{-- <a href="{{ route('cart.index') }}"> --}}
                        {{-- <a class="dropdown-toggle" href="{{ route('cart.index') }}" id="navbarDropdown3" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="dropdown">
                                <div id="cart-icon">
                                    <i class="fa-solid fa-cart-plus"></i>
                                    <span id="cart-count">{{ $numbrerOfCart }}</span>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <div class="single_product">

                                    </div>
                                </div>
                            </div>
                        </a> --}}
                        {{-- @dd($carts) --}}
                        {{-- </a> --}}
                        <a href="{{ route('cart.index') }}">
                            <div class="dropdown">
                                <div id="cart-icon">
                                    <i class="fa-solid fa-cart-plus"></i>
                                    <span id="cart-count">{{ $numbrerOfCart }}</span>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    {{-- @foreach ($carts as $cart) --}}

                                    <div class="single_product">
                                        {{-- @dd($cart) --}}
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
                                                    {{-- @dd($cart) --}}
                                                    <tr>
                                                        {{-- <td>
                                                            <div class="media">
                                                                <div class="d-flex">

                                                                    <img class="product__img  object-fit-cover"
                                                                        src="{{ $cart->image[0] == 'h' ? $cart->image : asset('uplode') . '/RequestDesign/' . $cart->image }}"
                                                                        data-id="white" width="600px">
                                                                    {{-- <img src="{{ asset('img') }}/product/single-product/cart-1.jpg" alt="" /> --}}
                                                        {{-- </div>
                                                                <div class="media-body">
                                                                    <p>{{ $cart->name }}</p>
                                                                </div>
                                                            </div>

                                                        </td> --}}
                                                        <td>
                                                            <img
                                                                src="{{ $cart->image[0] == 'h' ? $cart->image : asset('uplode') . '/RequestDesign/' . $cart->image }}">
                                                        </td>
                                                        <td>
                                                            <h5>{{ $cart->price_after_discount }}</h5>
                                                        </td>
                                                        {{-- <td>
                                                            <a href="{{ route('cart.decrement', $cart->cart_id) }}" class="btn btn-danger ">-</a> {{ $cart->quantity }} <a href="{{ route('cart.cartIncrement',$cart->cart_id) }}" class="btn btn-warning">+</a>
                                                        </td> --}}
                                                        <td>
                                                            <h5>{{ $cart->quantity }}</h5>
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
                                                @unless (count($carts) == 0)
                                                    {{-- <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <h5>Subtotal</h5>
                                                    </td>
                                                    <td>
                                                        <h5>{{ $total }}+100 shipping = {{ $total + 100 }}</h5>
                                                    </td>
                                                </tr> --}}
                                                @endunless
                                                <tr class="shipping_area">
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- @endforeach --}}
                                </div>
                            </div>
                        </a>

                        {{-- <div class="dropdown cart">
                            <a class="dropdown-toggle" href="{{ route('cart.index') }}" id="navbarDropdown3"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <a href="{{ route('cart.index') }}"><i class="fas fa-cart-plus"></i></a>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <div class="single_product">

                                </div>
                            </div>

                        </div> --}}
                    </div>
                </nav>
            </div>
        </div>
    </div>
    {{-- <div class="search_input" id="search_input_box">
        <div class="container ">
            <form class="d-flex justify-content-between search-inner">
                <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                <button type="submit" class="btn"></button>
                <span class="ti-close" id="close_search" title="Close Search"></span>
            </form>
        </div>
    </div> --}}
</header>
