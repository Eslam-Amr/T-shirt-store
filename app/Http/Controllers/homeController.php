<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cart_products;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class homeController extends Controller
{
    //
    public function index()
    {
        $products = Product::get();
        // dd($products);
        return view('home.index', ['products' => $products]);
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
    public function addToCart(Request $request,$id)
    {
        // dd($productData=Product::select('designer_id','stock','price_after_discount')->where('id', $id)->first());
        // dd($request->all()['quantity']);
//         dd( Product::count());
//         dd(auth()->user()['id']);
// dd( Product::select('designer_id')->where('id', $id)->first()['designer_id']);
//  dd($id);
        // dd(Product::select('designer_id')->where('id',$id)->first()['designer_id']);
        if (auth()->user() == null)
            return redirect()->to('/login')->with('message', 'you should login firstly ');
            else {

                $productData=Product::select('designer_id','stock','price_after_discount')->where('id', $id)->first();
                if($productData['stock']>=$request->all()['quantity']){

                    Cart::create([
                        'total'=>$request->all()['quantity']*$productData['price_after_discount'],
                        'status'=>'pending',
                        'quantity'=>$request->all()['quantity'],
                        'product_id'=>$id,
                        'user_id'=>auth()->user()['id'],
                        'designer_id'=>$productData['designer_id'],

                        ]);
                        Cart_products::create([
                            'quantity'=>$request->all()['quantity'],
                            // 'status'=>'pending',
                            'price'=>$request->all()['quantity']*$productData['price_after_discount'],
                            'product_id'=>$id,
    'cart_id'=>Cart::count(),
    // 'user_id'=>auth()->user()['id'],
    // 'designer_id'=>$productData['designer_id'],

    ]);
}
return redirect()->back()->with('message', 'added sucess ');




        }
    }
}
