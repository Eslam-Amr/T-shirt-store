<?php

namespace App\Http\Controllers;
// require 'ssp.class.php';

use App\Models\Product;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class categoryController extends Controller
{
    // use withPagination;
    //
    // public $from=0;
    // public $to=500;
    public function index(Request $request)
    {
        $numberOfProduct = Helper::countProduct();
        $product = Helper::getAllProduct($request->all());
        $data = $request->all();
        $totalNoOfProduct = Helper::getNumberOfProduct($request->all());
        return view('category.index', ['numberOfProducts' => $numberOfProduct, 'totalNoOfProduct' => $totalNoOfProduct, 'products' => $product, 'data' => $data]);
    }

    public function filter(Request $request, $from, $to, $category)
    {
        dd($request->all());

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
