    @include('layout.header')
    @include('layout.navbar')
    @include('layout.breadcrumb', ['name' => 'Order history'])
    <section class="confirmation_part padding_top">
        <div class="container">
            <div class="row">
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
                                </tr>
                                <tr>
                                    <th colspan="3">shipping</th>
                                    <th><span>100</span></th>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col" colspan="3">Quantity</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layout.footer')
