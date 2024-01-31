<?php

namespace App\Http\Controllers;

use App\Http\Requests\commentRequest;
use App\Http\Requests\OrderConfermationRequest;
use App\Http\Requests\reviewRequest;
use App\Models\BillingDetail;
use App\Models\Cart;
use App\Models\Cart_products;
use App\Models\Comment;
use App\Models\Last_orders;
use App\Models\Order;
use App\Models\Order_products;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function index()
    {
        $products = Product::get();
        $numberOfProduct = $products->count();
        return view('home.index', ['products' => $products, 'numberOfProduct' => $numberOfProduct]);
    }

    
}
