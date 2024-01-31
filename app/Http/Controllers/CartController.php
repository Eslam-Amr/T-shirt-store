<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cart_products;
use App\Models\Product;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //
    public function addToCart(Request $request, $id)
    {
        if (Helper::checkIfAuth() == false)
            return redirect()->to('/login')->with('message', 'you should login firstly ');
        $cart = DB::table('carts')
            ->join('cart_products', 'carts.id', '=', 'cart_products.cart_id')
            ->select('carts.*', 'cart_products.product_id')
            ->where('cart_products.product_id', '=', $id)
            ->where('carts.user_id', '=', auth()->user()->id)
            ->get();
        $productData = Product::select('designer_id', 'stock', 'price_after_discount')->where('id', $id)->first();
        $allCartItem = Cart::where('product_id', $id)->get();
        $totalItem = 0;
        for ($i = 0; $i < count($allCartItem); $i++)
            $totalItem += $allCartItem[$i]['quantity'];
        if ($productData['stock'] >= $request->all()['quantity'] + $totalItem) {
            if (count($cart) == 0) {
                Helper::setCartItems($request, $productData, $id);
                return redirect()->back()->with('message', 'added sucess ');
            } else {
                $carts_id = Cart_products::where('product_id', $id)->get();
                if ($carts_id) {
                    foreach ($carts_id as $cart_id) {
                        $cartItem = Cart::where('id', $cart_id['cart_id'])->where('user_id', auth()->user()['id'])->first();
                        if ($cartItem) {
                            $cartItem->update(['quantity' => $cartItem['quantity'] + $request->all()['quantity'], 'total' => $productData['price_after_discount'] * ($cartItem['quantity'] + $request->all()['quantity'])]);
                            break;
                        }
                    }
                    return redirect()->back()->with('message', 'added sucess ');
                }
                return redirect()->back()->with('message', 'added sucess ');
            }
        } else {
            return redirect()->back()->with('message', 'no stock found ');
        }
    }
    public function cart()
    {
        if (auth()->user() != null) {
            $cart = DB::table('carts')
                ->join('cart_products', 'carts.id', '=', 'cart_products.cart_id')
                ->join('products', 'cart_products.product_id', '=', 'products.id')
                ->select('carts.*', 'cart_products.product_id', 'products.*')
                ->where('carts.user_id', '=', auth()->user()->id)
                ->get();
            $totalPrice = Helper::getTotalOfOrder($cart);
        } else {
            $cart = [];
            $totalPrice = 0;
        }
        return view('home.cart', ['carts' => $cart, 'total' => $totalPrice]);
    }

}
