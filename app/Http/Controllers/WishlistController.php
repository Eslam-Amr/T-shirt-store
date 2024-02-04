<?php

namespace App\Http\Controllers;

use Helper;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    //
    public function index(){
        return view('wishlist.index');
    }
    public function add($id){
        if(!Helper::checkIfAuth())
        return redirect()->route('login.index');
        Helper::addToWishlist($id);
        // dd('klsdm');
return redirect()->back()->with('message','added to wishlist successfuly');
        // return view('wishlist.add');
    }
    public function remove($id){
        if(!Helper::checkIfAuth())
        return redirect()->route('login.index');
            // dd('klsdm');
            Helper::removeFromWishlist($id);
return redirect()->back()->with('message','deleted from wishlist successfuly');
        // return view('wishlist.add');
    }
}

