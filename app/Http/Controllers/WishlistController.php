<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Helper;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    //
    public function index()
    {
        if (Helper::checkIfAuth()) {

            // $wishlist = Wishlist::where('user_id', '=', auth()->user()->id)->get();
            $wishlist =  Wishlist::select('wishlists.id as wishlist_id', 'wishlists.user_id as wishlist_user_id', 'products.*', 'products.id as products_id')
                ->join('products', 'wishlists.product_id', '=', 'products.id')
                ->where('wishlists.user_id', auth()->user()->id)
                ->get();
            // dd($wishlist);
        } else {
            $wishlist = [];
        }
        return view('wishlist.index', ['wishlists' => $wishlist]);
    }
    public function add($id)
    {
        if (!Helper::checkIfAuth())
            return redirect()->route('login.index');
        Helper::addToWishlist($id);
        // dd('klsdm');
        return redirect()->back()->with('message', 'added to wishlist successfuly');
        // return view('wishlist.add');
    }
    public function remove($id)
    {
        if (!Helper::checkIfAuth())
            return redirect()->route('login.index');
        // dd('klsdm');
        Helper::removeFromWishlist($id);
        return redirect()->back()->with('message', 'deleted from wishlist successfuly');
        // return view('wishlist.add');
    }
}
