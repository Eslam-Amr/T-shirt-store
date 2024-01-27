<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    //
    public function index($key)
    {
        // dd($key);
        if($key=='all'){
            $numberOfProduct =$this->countProduct();
            $product=Product::paginate(12);
        }
        else if($key=='men'){
               $numberOfProduct =$this->countProduct();
               $product=Product::where('category_id','1')->paginate(12);

           } 
        else if($key=='women'){
               $numberOfProduct =$this->countProduct();
               $product=Product::where('category_id','2')->paginate(12);

           } 
        else if($key=='kids'){
               $numberOfProduct =$this->countProduct();
               $product=Product::where('category_id','3')->paginate(12);

           } 
        // dd($numberOfProduct);
        return view('category.index', ['products' => $product,'numberOfProducts' => $numberOfProduct]);
    }
    public function countProduct()
    {
        $kidsProduct=Product::where('category_id', 2)->count();
        $menProduct=Product::where('category_id', 1)->count();
        $womenProduct=Product::where('category_id', 3)->count();
        return [
            'menProduct'=>$menProduct,
            'womenProduct'=>$womenProduct,
            'kidsProduct'=>$kidsProduct
        ];
    }
    public function search(Request $request){
        if($request->ajax()){
            $products = Product::where("product_name","like","%{$request->search}%")
            ->orWhere("final_price","like","%{$request->search}%")
            ->orderBy('id','asc')
            ->paginate(6);
            return view('category.index',compact('products'));
        }
    }
}
