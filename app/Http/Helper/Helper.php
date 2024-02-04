<?php

use App\Models\BillingDetail;
use App\Models\Cart;
use App\Models\Cart_products;
use App\Models\Comment;
use App\Models\Message;
use App\Models\Order;
use App\Models\Order_products;
use App\Models\Product;
use App\Models\Review;
use App\Models\Wishlist;

use function PHPUnit\Framework\isEmpty;

class Helper
{

    public static function getStarsReview($id)
    {
        $starsReview = Review::where('product_id', $id)->select('stars')->get();
        $oneReview = 0;
        $twoReview = 0;
        $threeReview = 0;
        $fourReview = 0;
        $fiveReview = 0;
        foreach ($starsReview as $starReview) {
            if ($starReview['stars'] == 1)
                $oneReview++;
            else if ($starReview['stars'] == 2)
                $twoReview++;
            else if ($starReview['stars'] == 3)
                $threeReview++;
            else if ($starReview['stars'] == 4)
                $fourReview++;
            else if ($starReview['stars'] == 5)
                $fiveReview++;
        }
        $totalReview = ($oneReview + $twoReview + $threeReview + $fourReview + $fiveReview);
        try {
            $avgReview = ($oneReview + $twoReview * 2 + $threeReview * 3 + $fourReview * 4 + 5 * $fiveReview) / $totalReview;
        } catch (\Throwable $th) {
            $avgReview = 0;
        }
        return [
            'oneStar' => $oneReview,
            'twoStar' => $twoReview,
            'threeStar' => $threeReview,
            'fourStar' => $fourReview,
            'fiveStar' => $fiveReview,
            'avgStar' => $avgReview,
            'totalStar' => $totalReview
        ];
    }

    public static function setComment($request, $id)
    {
        Comment::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->number,
            'message' => $request->message,
            'product_id' => $id,
            'user_id' => Product::select('designer_id')->where('id', $id)->first()['designer_id'],
        ]);
    }
    public static function setReview($request, $id)
    {
        Review::create([
            'stars' => $request->stars,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->number,
            'review' => $request->message,
            'product_id' => $id,
            'user_id' => Product::select('designer_id')->where('id', $id)->first()['designer_id'],
        ]);
    }
    public static function checkIfAuth()
    {
        return (auth()->user() == null ? false : true);
    }
    public static function getTotalOfOrder($products)
    {

        $total = 0;
        foreach ($products as $product) {
            $total += $product->total;
        }
        return $total;
    }
    public static function setCartItems($quantity, $productData, $id)
    {
        Cart::create([
            'total' => $quantity * $productData['price_after_discount'],
            'status' => 'pending',
            'quantity' => $quantity,
            'product_id' => $id,
            'user_id' => auth()->user()['id'],
            'designer_id' => $productData['designer_id'],
        ]);
        Cart_products::create([
            'product_id' => $id,
            'cart_id' => Cart::select('id')->latest('id')->first()['id'],
        ]);
    }
    public static function setBillingDetail($data)
    {
        BillingDetail::create([
            'first_name' => $data->firstName,
            'last_name' => $data->lastName,
            'phone' => $data->phone,
            'email' => $data->email,
            'notes' => $data->note,
            'governorate' => $data->governorate,
            'address' => $data->address,
            'user_id' => auth()->user()->id
        ]);
    }
    public static function editProductQuantity($cart)
    {
        $product = Product::where('id', $cart->product_id)->first();
        $product->stock -= $cart->quantity;
        $product->save();
    }
    public static function setOrder($addressInfo, $cart)
    {
        $product = Product::where('id', $cart->product_id)->first();
        Order::create([
            'first_name' => $addressInfo->first_name,
            'last_name' => $addressInfo->last_name,
            'email' => $addressInfo->email,
            'total' => $cart->total,
            'status' => 'pending',
            'quantity' => $cart['quantity'],
            'year' => now()->format('Y'),
            'month' => now()->format('F'),
            'day' =>  date('j'),
            'notes' => $addressInfo->note == null ? ' ' : $addressInfo->notes,
            'governorate' => $addressInfo->governorate,
            'phone' => $addressInfo->phone,
            'address' => $addressInfo->address,
            "designer_id" => $product->designer_id,
            "user_id" => auth()->user()->id
        ]);
        $order = Order::latest('id')->first();
        Order_products::create([
            "order_id" => $order->id,
            "product_id" => $cart->product_id,
        ]);
    }
    public static function getCategoryId($data)
    {
        if (strtolower($data) == 'men')
            return 1;
        else if (strtolower($data) == 'women')
            return 2;
        else if (strtolower($data) == 'kids')
            return 3;
    }

    public static function setProduct($stock, $design, $category_id)
    {

        Product::create([
            'stock' => $stock,
            'discount' => $design['discount'],
            'price' => $design['price'],
            'price_after_discount' => $design['price'] * (1 - ($design['discount'] / 100)),
            'name' => $design['design_name'],
            'desinger' => $design['design_name'],
            'bestSeller' => 0,
            'image' => $design['design'],
            'category_id' => $category_id,
            'designer_id' => $design['user_id'],
            'status' => 'pending',
            'description' => $design['description'],
        ]);
        Message::create([
            'user_id' => $design['user_id'],
            'message' => 'congratulation 🎉 your design have been approved'
        ]);
    }
    public static function  calculateProfitForDay($day)
    {
        return Order::where('day', $day)->where('status', 'completed')->sum('total');
    }
    public static function editOrderStatus($id, $status)
    {
        $order = Order::where('id', $id)->first();
        $order->status = $status;
        $order->save();
    }
    public static function countProduct()
    {
        $allProductCategory = Product::select('category_id')->get();
        $kidsProduct = 0;
        $menProduct = 0;
        $womenProduct = 0;
        foreach ($allProductCategory as $productCategory) {
            if ($productCategory['category_id'] == 1)
                $menProduct++;
            else if ($productCategory['category_id'] == 2)
                $womenProduct++;
            else if ($productCategory['category_id'] == 3)
                $kidsProduct++;
        }
        return [
            'menProduct' => $menProduct,
            'womenProduct' => $womenProduct,
            'kidsProduct' => $kidsProduct
        ];
    }









    public static function rememberMe($data)
    {
        if (isset($data['remember']) && !empty($data['remember'])) {
            setcookie('email', $data['email'], time() + 3600);
            setcookie('password', $data['password'], time() + 3600);
        } else {
            setcookie('email', '');
            setcookie('password', '');
        }
    }

    public static function getNumberOfMessage()
    {
        return Message::where('user_id', auth()->user()->id)->count();
    }









    public static function addToWishlist($id)
    {
        Wishlist::create([
            'product_id' => $id,
            'user_id' => auth()->user()->id
        ]);
    }
    public static function checkIfInWhislist($id)
    {
        if (!Helper::checkIfAuth())
            return false;

        $product = Wishlist::where('product_id', $id)->where('user_id', auth()->user()->id)->first();
        if ($product)
            return true;
        else
            return false;
    }
    public static function removeFromWishlist($id)
    {
        $wishlist=Wishlist::where('user_id',auth()->user()->id)->where('product_id',$id)->first();
        $wishlist->delete();
    }










    public static function getAllProduct($data)
    {
        // dd($data);
        if (count($data) == 0);
        $product = Product::paginate(12);
        if (!isset($data['men']) && !isset($data['men']) && !isset($data['women']) && isset($data['from']) && isset($data['to']))
            $product = Product::where('price_after_discount', '>', $data['from'] - 1)->where('price_after_discount', '<', $data['to'] + 1)->paginate(12);
        if (isset($data['men']))
            $product = Product::where('price_after_discount', '>', $data['from'] - 1)->where('price_after_discount', '<', $data['to'] + 1)->where('category_id', 1)->paginate(12);
        if (isset($data['women']))
            $product = Product::where('price_after_discount', '>', $data['from'] - 1)->where('price_after_discount', '<', $data['to'] + 1)->where('category_id', 2)->paginate(12);
        if (isset($data['kids']))
            $product = Product::where('price_after_discount', '>', $data['from'] - 1)->where('price_after_discount', '<', $data['to'] + 1)->where('category_id', 3)->paginate(12);
        if (isset($data['men']) && isset($data['women']))
            $product = Product::where('price_after_discount', '>', $data['from'] - 1)->where('price_after_discount', '<', $data['to'] + 1)->where('category_id', 1)->orWhere('category_id', 2)->paginate(12);
        if (isset($data['kids']) && isset($data['women']))
            $product = Product::where('price_after_discount', '>', $data['from'] - 1)->where('price_after_discount', '<', $data['to'] + 2)->where('category_id', 3)->orWhere('category_id', 2)->paginate(12);
        if (isset($data['kids']) && isset($data['men']))
            $product = Product::where('price_after_discount', '>', $data['from'] - 1)->where('price_after_discount', '<', $data['to'] + 1)->where('category_id', 3)->orWhere('category_id', 1)->paginate(12);
        if (isset($data['kids']) && isset($data['men']) && isset($data['women']))
            $product = Product::where('price_after_discount', '>', $data['from'] - 1)->where('price_after_discount', '<', $data['to'] + 1)->where('category_id', 3)->orWhere('category_id', 1)->orWhere('category_id', 2)->paginate(12);
        if (isset($data['all']))
            $product = Product::where('price_after_discount', '>', $data['from'] - 1)->where('price_after_discount', '<', $data['to'] + 1)->paginate(12);

        return $product;
        // if ($key == 'men') {

        //     $product = Product::where('price_after_discount', '>', $from - 1)->where('price_after_discount', '<', $to + 1)->where('category_id', 1)->paginate(12);
        //     // $totalNoOfProduct = Product::where('price_after_discount', '>', $from - 1)->where('price_after_discount', '<', $to + 1)->where('category_id', 1)->count();
        // }
        // if ($key == 'all') {

        //     $product = Product::where('price_after_discount', '>', $from - 1)->where('price_after_discount', '<', $to + 1)->paginate(12);
        //     // $totalNoOfProduct = Product::where('price_after_discount', '>', $from - 1)->where('price_after_discount', '<', $to + 1)->count();
        // }
        // if ($key == 'kids') {

        //     $product = Product::where('price_after_discount', '>', $from - 1)->where('price_after_discount', '<', $to + 1)->where('category_id', 2)->paginate(12);
        //     // $totalNoOfProduct = Product::where('price_after_discount', '>', $from - 1)->where('price_after_discount', '<', $to + 1)->where('category_id', 2)->count();
        // }
        // if ($key == 'women') {

        //     $product = Product::where('price_after_discount', '>', $from - 1)->where('price_after_discount', '<', $to + 1)->where('category_id', 3)->paginate(12);
        //     // $totalNoOfProduct = Product::where('price_after_discount', '>', $from - 1)->where('price_after_discount', '<', $to + 1)->where('category_id', 3)->count();
        // }
    }
    public static function getNumberOfProduct($key, $from, $to)
    {
        if ($key == 'men') {

            // $product = Product::where('price_after_discount', '>', $from - 1)->where('price_after_discount', '<', $to + 1)->where('category_id', 1)->paginate(12);
            $totalNoOfProduct = Product::where('price_after_discount', '>', $from - 1)->where('price_after_discount', '<', $to + 1)->where('category_id', 1)->count();
        }
        if ($key == 'all') {

            // $product = Product::where('price_after_discount', '>', $from - 1)->where('price_after_discount', '<', $to + 1)->paginate(12);
            $totalNoOfProduct = Product::where('price_after_discount', '>', $from - 1)->where('price_after_discount', '<', $to + 1)->count();
        }
        if ($key == 'kids') {

            // $product = Product::where('price_after_discount', '>', $from - 1)->where('price_after_discount', '<', $to + 1)->where('category_id', 2)->paginate(12);
            $totalNoOfProduct = Product::where('price_after_discount', '>', $from - 1)->where('price_after_discount', '<', $to + 1)->where('category_id', 2)->count();
        }
        if ($key == 'women') {

            // $product = Product::where('price_after_discount', '>', $from - 1)->where('price_after_discount', '<', $to + 1)->where('category_id', 3)->paginate(12);
            $totalNoOfProduct = Product::where('price_after_discount', '>', $from - 1)->where('price_after_discount', '<', $to + 1)->where('category_id', 3)->count();
        }
        return $totalNoOfProduct;
    }









    public static function search($request)
    {
        if ($request->ajax()) {
            $products = Product::where("product_name", "like", "%{$request->search}%")
                ->orWhere("final_price", "like", "%{$request->search}%")
                ->orderBy('id', 'asc')
                ->paginate(6);
            return view('category.index', compact('products'));
        }
    }
}
