<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    //
    public function index(Request $request,$key,$from,$to)
    {

        // dd("jdnsjkcfn");
// dd($key);
//         dd($request->all());
    $numberOfProduct =$this->countProduct();
    // $product=Product::where('price_after_discount','>',-1)->where('price_after_discount','<',501)->paginate(12);
    if($key=='men'){

        $product=Product::where('price_after_discount','>',$from-1)->where('price_after_discount','<',$to+1)->where('category_id',1)->paginate(12);
        $totalNoOfProduct=Product::where('price_after_discount','>',$from-1)->where('price_after_discount','<',$to+1)->where('category_id',1)->count();
    }
    if($key=='all'){

        $product=Product::where('price_after_discount','>',$from-1)->where('price_after_discount','<',$to+1)->paginate(12);
        $totalNoOfProduct=Product::where('price_after_discount','>',$from-1)->where('price_after_discount','<',$to+1)->count();
    }
    if($key=='kids'){

        $product=Product::where('price_after_discount','>',$from-1)->where('price_after_discount','<',$to+1)->where('category_id',2)->paginate(12);
        $totalNoOfProduct=Product::where('price_after_discount','>',$from-1)->where('price_after_discount','<',$to+1)->where('category_id',2)->count();
    }
    if($key=='women'){

        $product=Product::where('price_after_discount','>',$from-1)->where('price_after_discount','<',$to+1)->where('category_id',3)->paginate(12);
        $totalNoOfProduct=Product::where('price_after_discount','>',$from-1)->where('price_after_discount','<',$to+1)->where('category_id',3)->count();
    }
    // dd($product);
    // $totalNoOfProduct=Product::where('price_after_discount','>',-1)->where('price_after_discount','<',501)->count();
    // if($key=='all'){
        // }
        // else if($key=='men'){
        //        $numberOfProduct =$this->countProduct();
        //        $product=Product::where('category_id','1')->paginate(12);

        //    }
        // else if($key=='women'){
        //        $numberOfProduct =$this->countProduct();
        //        $product=Product::where('category_id','2')->paginate(12);

        //    }
        // else if($key=='kids'){
        //        $numberOfProduct =$this->countProduct();
        //        $product=Product::where('category_id','3')->paginate(12);

        //    }
        // dd($numberOfProduct);
        return view('category.index', ['products' => $product,'numberOfProducts' => $numberOfProduct,'totalNoOfProduct'=>$totalNoOfProduct,'key'=>$key,'from'=>$from,'to'=>$to]);
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
    public function filter(Request $request,$key,$from,$to){
        // dd($key);

                $filterdData=$request->all();
if(isset( $request->all()['all'])){

    if($filterdData['all']=='all'){

        return redirect()->route('category.index',['key' => 'all', 'from' => $filterdData['from'], 'to' => $filterdData['to']]);
    }
                }
                if(isset( $request->all()['men'])){

                    if($filterdData['men']=='men'&&isset($request->all()['men']))
                    // return redirect()->route('category.index',['key' => 'men', 'from' => $filterdData['from'], 'to' => $filterdData['to']]);
                    return redirect()->to("product/men/ $filterdData[from]/ $filterdData[to]?page=1");
                }
                if(isset( $request->all()['women'])){

                    if($filterdData['women']=='women'&&isset($request->all()['women']))
                    return redirect()->to("product/women/ $filterdData[from]/ $filterdData[to]?page=1");
                }
                if(isset( $request->all()['kids'])){

                    if($filterdData['kids']=='kids'&&isset($request->all()['kids']))
                    return redirect()->to("product/kids/ $filterdData[from]/ $filterdData[to]?page=1");
                }

//         $filterdData=$request->all();
// if(isset($filterdData[''])||$_SESSION['filter']='all'){
//     $_SESSION['filter']='all';
// if($filterdData['all']=='all'||$_SESSION['filter']='all'){
//     $numberOfProduct =$this->countProduct();
//     $product=Product::where('price_after_discount','>',0)->where('price_after_discount','<',500)->paginate(12);
//     $totalNoOfProduct=Product::where('price_after_discount','>',-1)->where('price_after_discount','<',501)->count();
//     return view('category.index', ['products' => $product,'numberOfProducts' => $numberOfProduct,'totalNoOfProduct'=>$totalNoOfProduct]);
// }}
// if($filterdData['men']=='men'){
//     $numberOfProduct =$this->countProduct();
//     $product=Product::where('price_after_discount','>',-1)->where('price_after_discount','<',501)->where('category_id','1')->paginate(12);
//     $totalNoOfProduct=Product::where('price_after_discount','>',-1)->where('price_after_discount','<',501)->where('category_id','1')->count();
//     return view('category.index', ['products' => $product,'numberOfProducts' => $numberOfProduct,'totalNoOfProduct'=>$totalNoOfProduct]);
// }
        // dd($filterdData['all']);



    }
}
