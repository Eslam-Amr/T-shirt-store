<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Helper;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    //
    public function index(Request $request, $key, $from, $to)
    {
        $numberOfProduct = Helper::countProduct();
        $product=Helper::getAllProduct($key,$from,$to);
        $totalNoOfProduct=Helper::getNumberOfProduct($key,$from,$to);
        return view('category.index', ['products' => $product, 'numberOfProducts' => $numberOfProduct, 'totalNoOfProduct' => $totalNoOfProduct, 'key' => $key, 'from' => $from, 'to' => $to]);
    }

    public function filter(Request $request, $key, $from, $to)
    {
        // dd($key);

        $filterdData = $request->all();
        if (isset($request->all()['all'])) {

            if ($filterdData['all'] == 'all') {

                return redirect()->route('category.index', ['key' => 'all', 'from' => $filterdData['from'], 'to' => $filterdData['to']]);
            }
        }
        if (isset($request->all()['men'])) {

            if ($filterdData['men'] == 'men' && isset($request->all()['men']))
                // return redirect()->route('category.index',['key' => 'men', 'from' => $filterdData['from'], 'to' => $filterdData['to']]);
                return redirect()->to("product/men/ $filterdData[from]/ $filterdData[to]?page=1");
        }
        if (isset($request->all()['women'])) {

            if ($filterdData['women'] == 'women' && isset($request->all()['women']))
                return redirect()->to("product/women/ $filterdData[from]/ $filterdData[to]?page=1");
        }
        if (isset($request->all()['kids'])) {

            if ($filterdData['kids'] == 'kids' && isset($request->all()['kids']))
                return redirect()->to("product/kids/ $filterdData[from]/ $filterdData[to]?page=1");
        }
    }
}
