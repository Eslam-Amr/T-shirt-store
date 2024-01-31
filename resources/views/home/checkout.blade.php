@include('layout.header')
@include('layout.navbar')
@include('layout.breadcrumb', ['name' => 'Product Checkout'])
<section class="checkout_area padding_top">
    <div class="container">
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
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Billing Details</h3>
                    <form class="row contact_form" action="{{ route('home.setOreder') }}" method="post"
                        novalidate="novalidate">
                        @csrf
                        <div class="col-md-6 form-group">
                            <input type="text" class="form-control" id="first" name="firstName"
                                placeholder="First name" value="{{ old('firstName') }}" />
                        </div>
                        <div class="col-md-6 form-group">
                            <input value="{{ old('lastName') }}" type="text" class="form-control"
                                placeholder="Last name" id="last" name="lastName" />
                        </div>
                        <div class="col-md-6 form-group">
                            <input value="{{ old('phoneNumber') }}" type="text" class="form-control"
                                placeholder="Phone number" id="number" name="phone" />
                        </div>
                        <div class="col-md-6 form-group ">
                            <input type="email" class="form-control" id="email" name="email" placeholder="email"
                                value="{{ old('email') }}" />
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" placeholder="Address" id="add1"
                                name="address" />
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" placeholder="governorate" id="add1"
                                name="governorate" />
                        </div>
                        <div class="col-md-12 form-group">
                            <textarea class="form-control" name="note" id="note" rows="1" placeholder="Order Notes"></textarea>
                        </div>
                </div>
                <div class="col-lg-4">
                    <div class="order_box">
                        <h2>Your Order</h2>
                        <ul class="list">
                            <li>
                                <a href="#">Product
                                    <span>Total</span>
                                </a>
                            </li>
                            @foreach ($carts as $cart)
                                <li>
                                    <a>{{ $cart['name'] }}
                                        <span class="middle">x {{ $cart['quantity'] }}</span>
                                        <span class="last">{{ $cart['total'] }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <ul class="list list_2">
                            <li>
                                <a>Subtotal
                                    <span>{{ $total }}</span>
                                </a>
                            </li>
                            <li>
                                <a>Shipping
                                    <span>100</span>
                                </a>
                            </li>
                            <li>
                                <a>Total
                                    <span>{{ $total + 100 }}</span>
                                </a>
                            </li>
                        </ul>
                        <input class="btn_3" type="submit" value="Proceed to checkout">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layout.footer')
