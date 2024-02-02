<?php

namespace App\Http\Controllers;

use App\Http\Requests\commentRequest;
use App\Http\Requests\reviewRequest;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Review;
use Helper;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function productDetails($id)
    {
        $starReviews = Helper::getStarsReview($id);
        $product = Product::where('id', $id)->first();
        $reviews = Review::where('product_id', $id)->get();
        $comments = Comment::where('product_id', $id)->get();
        return view('home.productDetails', ['product' => $product, 'starReviews' => $starReviews, 'reviews' => $reviews, 'comments' => $comments]);
    }

    public function addComment(commentRequest $request, $id)
    {
     Helper::setComment($request,$id);
        return redirect()->back()->with('message', 'comment added ');
    }
    public function addReview(reviewRequest $request, $id)
    {
   Helper::setReview($request,$id);
        return redirect()->back()->with('message', 'review added ');
    }
}