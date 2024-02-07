    @include('layout.header')
    @include('layout.navbar')
    @include('layout.breadcrumb', ['name' => 'Order history'])
    <section class="confirmation_part padding_top">
        <div class="container">
            <div class="row">

                @foreach ($allOrders as $orders)
                    <div class="col-lg-12">
                        <div class="order_details_iner">
                            <h3>Order Details</h3>
                            <h3>Order status : <span class="text-success">{{ $orders[0]->status }}</span></h3>
                            <h3>Order date : {{ $orders[0]->created_at }}</h3>
                            <div class="mt-5">

                                <table class="table table-borderless mt-4">
                                    <thead>
                                        <tr>
                                            <th scope="col" colspan="2">Product</th>
                                            <th scope="col">price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total</th>
                                            {{-- <th scope="col">date</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalPrice = 0;
                                        @endphp
                                        @foreach ($orders as $order)
                                            <tr>
                                                <th colspan="2"><span>{{ $order['name'] }}</span></th>
                                                <th>{{ $order['price_after_discount'] }}</th>
                                                <th>x{{ $order['quantity'] }}</th>
                                                <th> <span>{{ $order['total'] }}</span></th>
                                                {{-- <th> <span>{{ $order['created_at'] }}</span></th> --}}
                                                @php

                                                    $totalPrice += $order['total'];
                                                @endphp

                                            </tr>
                                        @endforeach

                                        <tr>
                                            <th colspan="3">shipping</th>
                                            <th><span>100</span></th>
                                            <th><span>total is {{ $totalPrice + 100 }}</span></th>

                                        </tr>
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>
                @endforeach
                @if (!$allOrders)
<h2>no order yet</h2>
                @endif
            </div>
        </div>
    </section>

    @include('layout.footer')
