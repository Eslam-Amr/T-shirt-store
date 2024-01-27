<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cart_products;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Order_products;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    //
    public function index()
    {
        $products = Product::get();
        // dd($products);
        $numberOfProduct = $products->count();
        // dd($numberOfProduct);
        return view('home.index', ['products' => $products, 'numberOfProduct' => $numberOfProduct]);
    }
    public function productDetails($id)
    {
        // dd(auth()->user());
        // dd($id);


        // $totalReview = Review::where('product_id', $id)->count();
        // $zeroReview = Review::where('product_id', $id)->where('stars', '0')->count();
        // $oneReview = Review::where('product_id', $id)->where('stars', '1')->count();
        // $twoReview = Review::where('product_id', $id)->where('stars', '2')->count();
        // $threeReview = Review::where('product_id', $id)->where('stars', '3')->count();
        // $fourReview = Review::where('product_id', $id)->where('stars', '4')->count();
        // $fiveReview = Review::where('product_id', $id)->where('stars', '5')->count();
        // $avgReview = ($oneReview + $twoReview * 2 + $threeReview * 3 + $fourReview * 4 + 5 * $fiveReview) / $totalReview;
        // dd($avgReview);

        $starReviews = $this->getStarsReview($id);
        // dd($reviews);



        $product = Product::where('id', $id)->first();
        $reviews = Review::where('product_id', $id)->get();
        $comments = Comment::where('product_id', $id)->get();
        // dd($comments,$reviews);
        return view('home.productDetails', ['product' => $product, 'starReviews' => $starReviews, 'reviews' => $reviews, 'comments' => $comments]);
    }
    public function getStarsReview($id)
    {
        // $totalReview = Review::where('product_id', $id)->count();
        // $zeroReview = Review::where('product_id', $id)->where('stars', '0')->count();
        $oneReview = Review::where('product_id', $id)->where('stars', '1')->count();
        $twoReview = Review::where('product_id', $id)->where('stars', '2')->count();
        $threeReview = Review::where('product_id', $id)->where('stars', '3')->count();
        $fourReview = Review::where('product_id', $id)->where('stars', '4')->count();
        $fiveReview = Review::where('product_id', $id)->where('stars', '5')->count();
        $totalReview = ($oneReview + $twoReview + $threeReview + $fourReview + $fiveReview);
        try {
            //code...
            $avgReview = ($oneReview + $twoReview * 2 + $threeReview * 3 + $fourReview * 4 + 5 * $fiveReview) / $totalReview;
        } catch (\Throwable $th) {
            //throw $th;
            $avgReview = 0;
        }
        return [
            //    'zeroStar'=> $zeroReview,
            'oneStar' => $oneReview,
            'twoStar' => $twoReview,
            'threeStar' => $threeReview,
            'fourStar' => $fourReview,
            'fiveStar' => $fiveReview,
            'avgStar' => $avgReview,
            'totalStar' => $totalReview
        ];
    }
    public function addComment(Request $request, $id)
    {

        // dd(Product::select('designer_id')->where('id',$id)->first()['designer_id']);
        $request->validate([
            'name' => 'required|min:3|max:15',
            'email' => 'required|email',
            'number' => 'required|numeric',
            'message' => 'required|min:5|max:500',
        ]);

        Comment::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->number,
            'message' => $request->message,
            'product_id' => $id,
            'user_id' => Product::select('designer_id')->where('id', $id)->first()['designer_id'],
        ]);
        return redirect()->back()->with('message', 'comment added ');
    }
    public function addReview(Request $request, $id)
    {

        // dd(Product::select('designer_id')->where('id',$id)->first()['designer_id']);
        $request->validate([
            'stars' => 'required',
            'name' => 'required|min:3|max:15',
            'email' => 'required|email',
            'number' => 'required|numeric',
            'message' => 'required|min:5|max:500',
        ]);
        // dd($request->all());

        Review::create([
            'stars' => $request->stars,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->number,
            'review' => $request->message,
            'product_id' => $id,
            'user_id' => Product::select('designer_id')->where('id', $id)->first()['designer_id'],
        ]);
        return redirect()->back()->with('message', 'review added ');
    }
    public function addToCart(Request $request, $id)
    {
        // dd($productData=Product::select('designer_id','stock','price_after_discount')->where('id', $id)->first());
        // dd($request->all()['quantity']);
        //         dd( Product::count());
        //         dd(auth()->user()['id']);
        // dd( Product::select('designer_id')->where('id', $id)->first()['designer_id']);
        //  dd($id);
        // dd(Product::select('designer_id')->where('id',$id)->first()['designer_id']);
        // if (auth()->user() == null)
        //     return redirect()->to('/login')->with('message', 'you should login firstly ');
        // dd($this->checkIfAuth());
        // dd(auth()->user());
        if ($this->checkIfAuth() == false)
            return redirect()->to('/login')->with('message', 'you should login firstly ');
        // dd('fds;');

        // return redirect()->to('/login')->with('message', 'you should login firstly ');

        // $this->checkIfAuth('/login','you should login firstly');
        // dd('ioe');
        // else {
        // $cart = Cart_products::where('product_id', $id)->join('carts','carts.id' , '=','cart_products.cart_id' )
        //     ->select('carts.*', 'cart_products')
        //     ->get();
        // dd(Cart_products::where('product_id', $id)->join('carts','carts.id' , '=','cart_products.cart_id' )
        //     ->select('carts.*', 'cart_products.cart_id')
        //     ->toSql());
        // dd(auth()->user());
        //     dd( DB::table('carts')
        //     ->join('cart_products', 'carts.id', '=', 'cart_products.cart_id')
        //     ->select('carts.*', 'cart_products.product_id')
        //     ->where('cart_products.product_id', '=', $id)
        //     ->where('carts.user_id', '=', auth()->user()->id)
        //     ->get(),
        //     $cart=Cart::where('product_id', $id)->where('user_id',auth()->user()->id)->first()
        // );
        // $cart=Cart::where('product_id', $id)->where('user_id',auth()->user()->id)->first();
        $cart = DB::table('carts')
            ->join('cart_products', 'carts.id', '=', 'cart_products.cart_id')
            ->select('carts.*', 'cart_products.product_id')
            ->where('cart_products.product_id', '=', $id)
            ->where('carts.user_id', '=', auth()->user()->id)
            ->get();
        // dd($cart);

        // dd($cart);
        // dd(count($cart));

        $productData = Product::select('designer_id', 'stock', 'price_after_discount')->where('id', $id)->first();
        // dd($productData);
        // $cart = Cart::where('product_id', $id)->where('user_id', auth()->user()['id'])->first();
        // $allCartItem = Cart_products::where('product_id', $id)->join('carts', 'cart_products.cart_id', '=', 'carts.id')
        //     ->select('carts.*', 'cart_products.product_id')
        //     ->get();
        $allCartItem = Cart::where('product_id', $id)->get();
        // dd(Cart::where('user_id',auth()->user()->id)->get());
        // $cart->update(['quantity' => $cart->quantity + $request->all()['quantity'], 'total' => $productData['price_after_discount'] * ($cart['quantity'] + $request->all()['quantity'])]);
        $totalItem = 0;
        for ($i = 0; $i < count($allCartItem); $i++)
            $totalItem += $allCartItem[$i]['quantity'];
        // dd($allCartItem);
        // dd(($request->all()['quantity'] + $totalItem));
        // dd($productData['stock']);
        // dd($productData['stock'] >= ($request->all()['quantity'] + $totalItem));
        if ($productData['stock'] >= $request->all()['quantity'] + $totalItem) {
            // $cart = Cart_products::where('product_id', $id)->join('carts', 'cart_products.cart_id', '=', 'carts.id')
            //     ->select('carts.*', 'cart_products.created_at')->where('user_id', auth()->user()['id'])
            //     ->first();
            // dd($cart);
            if (count($cart) == 0) {

                //                     dd($lastCartRecord = Cart::select('id')->latest('id')->first()['id']
                //                 );
                //                     dd(Cart::count());
                // dd("wf");
                Cart::create([
                    'total' => $request->all()['quantity'] * $productData['price_after_discount'],
                    'status' => 'pending',
                    'quantity' => $request->all()['quantity'],
                    'product_id' => $id,
                    'user_id' => auth()->user()['id'],
                    'designer_id' => $productData['designer_id'],

                ]);
                Cart_products::create([
                    'quantity' => $request->all()['quantity'],
                    // 'status'=>'pending',
                    'price' => $request->all()['quantity'] * $productData['price_after_discount'],
                    'product_id' => $id,
                    'cart_id' => Cart::select('id')->latest('id')->first()['id'],
                    // 'user_id'=>auth()->user()['id'],
                    // 'designer_id'=>$productData['designer_id'],

                ]);
                return redirect()->back()->with('message', 'added sucess ');
            } else {
                // Cart::where('product_id', $id)->where('user_id', auth()->user()['id'])->first()->update(['quantity'=>++$cart['quantity']]);
                $carts_id = Cart_products::where('product_id', $id)->get();
                // dd($carts_id);
                if ($carts_id) {
                    foreach ($carts_id as $cart_id) {
                        $cartItem = Cart::where('id', $cart_id['cart_id'])->where('user_id', auth()->user()['id'])->first();
                        if ($cartItem) {
                            // dd($request->all()['quantity']);
                            // dd($cartItem);
                            // dd($cartItem['quantity']);

                            $cartItem->update(['quantity' => $cartItem['quantity'] + $request->all()['quantity'], 'total' => $productData['price_after_discount'] * ($cartItem['quantity'] + $request->all()['quantity'])]);
                            break;
                        }
                    }
                    return redirect()->back()->with('message', 'added sucess ');
                }
                // quantity
                // $cart->update([
                //     'quantity' => $cart->quantity + $request->input('quantity'),
                //     'total' => $productData['price_after_discount'] * ($cart->quantity + $request->input('quantity'))
                // ]);
                return redirect()->back()->with('message', 'added sucess ');
            }
        } else {
            return redirect()->back()->with('message', 'no stock found ');
        }
        // return redirect()->back()->with('message', 'added sucess ');
        // }
    }
    public function cart()
    {
        // dd("wfd");
        // if($this->checkIfAuth()==false)
        //     return redirect()->to('/login')->with('message', 'you should login firstly ');
        // $cart=Cart::where('user_id',auth()->user()->id)->get();
        // $cart=Cart::where('user_id',auth()->user()->id)->
        // join('products', 'carts.product_id', '=', 'products.id')
        // ->select('carts.*', 'products.*')
        // ->get();
        // $cart=Cart_products::
        // join('carts', 'cart_products.cart_id', '=', 'carts.id')
        // ->select('carts.*', 'cart_products.product_id')->where('user_id', auth()->user()['id'])
        // ->get();
        // $cart = Cart_products::join('carts', 'cart_products.cart_id', '=', 'carts.id')
        //     ->select('carts.*', 'cart_products.product_id')->where('user_id', auth()->user()['id'])
        //     ->join('products', 'cart_products.product_id', '=', 'products.id')
        //     ->select('carts.*', 'products.*')
        //     ->get();
        // $cart= Cart::where('user_id',auth()->user()->id)->get();
        // $cart=DB::table('carts')
        // ->join('cart_products', 'carts.id', '=', 'cart_products.cart_id')
        // ->select('carts.*', 'cart_products.product_id')
        // // ->where('cart_products.product_id', '=', $id)
        // ->where('carts.user_id', '=', auth()->user()->id)
        // ->get();
        if (auth()->user() != null) {

            $cart = DB::table('carts')
                ->join('cart_products', 'carts.id', '=', 'cart_products.cart_id')
                ->join('products', 'cart_products.product_id', '=', 'products.id')
                ->select('carts.*', 'cart_products.product_id', 'products.*')

                ->where('carts.user_id', '=', auth()->user()->id)
                // ->where('cart_products.product_id', '=', 'product.id')
                ->get();
            $totalPrice = 0;
            for ($i = 0; $i < count($cart); $i++)
                $totalPrice += $cart[$i]->total;
        } else {
            $cart = [];
            $totalPrice = 0;
        }
        return view('home.cart', ['carts' => $cart, 'total' => $totalPrice]);
        // dd($cart,$results);
        // dd($cart);
        // dd($cart[0]->total);
        // $cart = Cart_products::
        // join('carts', 'cart_products.cart_id', '=', 'carts.id')
        // ->select('carts.*', 'cart_products.product_id')
        // ->where('user_id', auth()->user()['id'])
        // ->join('products', 'cart_products.product_id', '=', 'products.id')
        // ->select('carts.*', 'products.* as product_data') // Alias conflicting columns from 'products' table
        // ->get();

        // $cart=$cart->
        // join('products', 'carts.product_id', '=', 'products.id')
        // ->select('carts.*', 'products.*')
        // ->get();
        // $mergedCart = $cart->join('products', 'carts.product_id', '=', 'products.id')
        // ->select('carts.*', 'products.*')
        // ->get();
        // dd($cart);
        // dd($totalPrice);
    }
    public function checkout()
    {
        if ($this->checkIfAuth() == false)
            return redirect()->to('/login')->with('message', 'you should login firstly ');
        // dd(auth()->user());
        //         $c=Cart_products::join('carts', 'cart_products.cart_id', '=', 'carts.id')
        //         ->select('carts.*', 'cart_products.product_id')->get();
        // dd($c->where('user_id',auth()->user()->id));
        $cart = Cart_products::join('carts', 'cart_products.cart_id', '=', 'carts.id')
            ->select('carts.*', 'cart_products.*')->where('user_id', auth()->user()['id'])
            ->join('products', 'cart_products.product_id', '=', 'products.id')
            ->select('carts.*', 'products.*', 'cart_products.*')
            ->get();
        // dd($cart);
        $totalPrice = 0;
        for ($i = 0; $i < count($cart); $i++)
            $totalPrice += $cart[$i]['total'];
        return view('home.checkout', ['carts' => $cart, 'total' => $totalPrice]);
    }
    public function setOreder(Request $request)
    {
        // dd($request);
        // if($request['selector']!='on')
        // return  redirect()->back()->with('message','you should agree ');
        $request->validate([

            'firstName' => 'required|min:3|max:15',
            'lastName' => 'required|min:3|max:15',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|min:3|max:100',
            'governorate' => 'required|min:3|max:80',
            'note' => 'min:3|max:900',
            'phone' => 'required|numeric|min_digits:11|max_digits:11',
        ]);
        // $product
        // $carts = Cart_products::join('carts', 'cart_products.cart_id', '=', 'carts.id')
        // ->select('carts.*', 'cart_products.product_id')->where('user_id', auth()->user()['id'])
        // ->join('products', 'cart_products.product_id', '=', 'products.id')
        // ->select('carts.*', 'products.*', 'cart_products.product_id')
        // ->get();
        //     $carts = DB::table('carts')
        //     ->join('cart_products', 'carts.id', '=', 'cart_products.cart_id')
        //     ->join('products', 'cart_products.product_id', '=', 'products.id')
        //     ->select('carts.*', 'cart_products.product_id', 'products.*')

        //     ->where('carts.user_id', '=', auth()->user()->id)
        // // ->where('cart_products.product_id', '=', 'product.id')
        // ->get();
        $carts = Cart_products::join('carts', 'cart_products.cart_id', '=', 'carts.id')
            ->join('products', 'cart_products.product_id', '=', 'products.id')
            ->select('carts.*', 'products.*', 'cart_products.*')
            ->where('carts.user_id', '=', auth()->user()->id)
            ->get();
        // $carts=Cart::where('user_id', auth()->user()['id'])->get();
        $flag = false;
        // dd($carts);
        foreach ($carts as $cart) {
            $product = Product::where('id', $cart->product_id)->first();
            // if($product->stock < $cart['quantity'])
            //     $greaterThan=false;
            if ($product->stock >= $cart->quantity) {
                $flag = true;

                Order::create([
                    'first_name' => $request->firstName,
                    'last_name' => $request->lastName,
                    'email' => $request->email,
                    'total' => $cart->total,
                    'status' => 'pending',
                    'notes' => $request->note,
                    'governorate' => $request->governorate,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    "designer_id" => $product->designer_id,
                    "user_id" => auth()->user()->id
                ]);

                $order = Order::latest('id')->first();

                // $order = Order::create
                Order_products::create([
                    "quantity" => $cart->quantity,
                    'price' => $cart->total,
                    "order_id" => $order->id,
                    "product_id" => $cart->product_id,
                ]);
                $product->stock -= $cart->quantity;
                $product->save();
                // Cart_products::where('cart_id', $cart['id'])->where('product_id', $cart['product_id'])->delete();
                // $cart::delete();
                // Cart::where('product_id', $cart['product_id'])->where('user_id', auth()->user()->id)->delete();
                Cart::where('id', $cart->cart_id)->delete();
            }
            for ($i = 0; $i < count($carts); $i++)
                Cart::where('id', $carts[$i]->cart_id)->delete();
            // dd($`carts);
            // dd(Cart::get());
            //     else {
            //        $flag = false;
            //        break;
            //    }
        }

        // dump($product);


        // if ($flag) {
        return redirect()->to('/home/cart/checkout/confirmation');
        // }
        // if($greaterThan){

        // }
        // dd($carts);

        // dd($request);
    }
    public function confirmation()
    {
        $orders = Order_products::join('orders', 'order_products.order_id', '=', 'orders.id')
            ->join('products', 'order_products.product_id', '=', 'products.id')
            ->select('orders.*', 'products.*', 'order_products.order_id', 'order_products.quantity', 'order_products.product_id')
            ->where('orders.user_id', '=', auth()->user()->id)
            ->get();
        // $orders=DB::table('orders')
        // ->join('order_products', 'orders.id', '=', 'order_products.order_id')
        // ->select('orders.*', 'order_products.*')
        // // ->where('cart_products.product_id', '=', $id)
        // ->where('orders.user_id', '=', auth()->user()->id)
        // ->get();
        // dd($orders,$carts);
        $total = 0;
        foreach ($orders as $order) {
            $total += $order['total'];
        }
        // dd($total);
        return view('home.confirmation', ['orders' => $orders, 'total' => $total]);
    }
    public function checkIfAuth()
    {
        // dd('df');
        // dd(auth()->user() == null);
        return (auth()->user() == null ? false : true);
        // return false;
        // return redirect()->back();
        // if (auth()->user() == null){

        // return redirect()->to($path)->with('message', $message);
        // }
    }
}
