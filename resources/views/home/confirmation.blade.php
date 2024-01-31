@include('layout.header')
@include('layout.navbar')
@include('layout.breadcrumb', ['name' => 'Order Confirmation'])
<section class="confirmation_part padding_top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                {{-- <div class="confirmation_tittle">
                      <span>Thank you. Your order has been received.</span>
                    </div> --}}
            </div>
            <div class="col-lg-6 col-lx-4">
                <div class="single_confirmation_details">
                    <h4>order info</h4>
                    <ul>
                        <li>
                            <p>date</p><span>: {{ $orders[0]['created_at']->format('Y-m-d H:i:s') }}</span>
                        </li>
                        <li>
                            <p>total</p><span>: {{ $total }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-lx-4">
                <div class="single_confirmation_details">
                    <h4>shipping Address</h4>
                    <ul>
                        <li>
                            <p>governorate</p><span>: {{ $addressInfo['governorate'] }}</span>
                        </li>
                        <li>
                            <p>address</p><span>: {{ $addressInfo['address'] }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="order_details_iner">
                    <h3>Order Details</h3>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" colspan="2">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <th colspan="2"><span>{{ $order['name'] }}</span></th>
                                    <th>x{{ $order['quantity'] }}</th>
                                    <th> <span>{{ $order['total'] }}</span></th>
                                </tr>
                            @endforeach

                            <tr>
                                <th colspan="3">Subtotal</th>
                                <th> <span>{{ $total }}</span></th>
                            </tr>
                            <tr>
                                <th colspan="3">shipping</th>
                                <th><span>100</span></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col" colspan="3">Quantity</th>
                                <th scope="col">{{ $total + 100 }}</th>
                            </tr>
                        </tfoot>

                    </table>
                    <tr class="float-right">
                        <a href="{{ route('home.confirmOrder') }}" class="btn btn-success">
                            confirm
                        </a>
                    </tr>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layout.footer')
