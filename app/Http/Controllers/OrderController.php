<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderConfermationRequest;
use App\Models\BillingDetail;
use App\Models\Cart;
use App\Models\Cart_products;
use App\Models\Order;
use App\Models\Order_products;
use App\Models\Product;
use Helper;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout()
    {
        if (Helper::checkIfAuth() == false)
            return redirect()->to('/login')->with('message', 'you should login firstly ');
        $cart = Cart_products::join('carts', 'cart_products.cart_id', '=', 'carts.id')
            ->select('carts.*', 'cart_products.*')->where('user_id', auth()->user()['id'])
            ->join('products', 'cart_products.product_id', '=', 'products.id')
            ->select('carts.*', 'products.*', 'cart_products.*')
            ->get();
        $totalPrice = Helper::getTotalOfOrder($cart);
        return view('home.checkout', ['carts' => $cart, 'total' => $totalPrice]);
    }
    public function setOreder(OrderConfermationRequest $request)
    {
        Helper::setBillingDetail($request);
        return redirect()->to('/home/cart/checkout/confirmation');
    }

    public function confirmation()
    {
        $carts = Cart_products::join('carts', 'cart_products.cart_id', '=', 'carts.id')
            ->join('products', 'cart_products.product_id', '=', 'products.id')
            ->select('carts.*', 'products.*', 'cart_products.*')
            ->where('carts.user_id', '=', auth()->user()->id)
            ->get();
        $addressInfo = BillingDetail::where('user_id', auth()->user()->id)->first();
        $total = Helper::getTotalOfOrder($carts);
        return view('home.confirmation', ['orders' => $carts, 'addressInfo' => $addressInfo, 'total' => $total]);
    }
    public function confirmOrder()
    {
        $addressInfo = BillingDetail::where('user_id', auth()->user()->id)->first();
        $carts = Cart_products::join('carts', 'cart_products.cart_id', '=', 'carts.id')
            ->join('products', 'cart_products.product_id', '=', 'products.id')
            ->select('carts.*', 'products.*', 'cart_products.*')
            ->where('carts.user_id', '=', auth()->user()->id)
            ->get();
        foreach ($carts as $cart) {
            $product = Product::where('id', $cart->product_id)->first();
            if ($product->stock >= $cart->quantity) {
                Helper::setOrder($addressInfo, $cart);
                Helper::editProductQuantity($cart);
                Cart::where('id', $cart->cart_id)->delete();
            }
            for ($i = 0; $i < count($carts); $i++)
                Cart::where('id', $carts[$i]->cart_id)->delete();
        }
        BillingDetail::where('user_id', auth()->user()->id)->delete();

        return redirect()->route('home.thank')->with('message', 'order set successfully');
    }
    public function orderHistory()
    {
        $orders = Order_products::join('orders', 'order_products.order_id', '=', 'orders.id')
        ->join('products', 'order_products.product_id', '=', 'products.id')
        ->select('orders.*', 'products.*', 'order_products.order_id',  'order_products.product_id')
        ->where('orders.user_id', '=', auth()->user()->id)
        ->get();
        return view('home.allOrder', ['orders' => $orders]);
    }
    public function thank(){
        // dd('klsmv');
        return view('home.thank');
}
}
