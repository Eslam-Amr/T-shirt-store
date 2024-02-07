<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

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
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{

    public function index()
    {
        if (auth('admin')->user() != null)
            return redirect()->route('admin.index');
        if (auth('designer')->user() != null)
            return redirect()->route('designer.index');

        $products = Product::get();
        $numberOfProduct = $products->count();
        return view('home.index', ['products' => $products, 'numberOfProduct' => $numberOfProduct]);
    }
    public function profile()
    {
        return view('home.profile');
    }
    public function updateProfile(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
        ]);

        if ($validated->fails()) {
            return redirect()->back()->with('msg', 'profile updated successfully.');
        }
        if ($request->hasFile('profile_image')) {
            $imagePath = asset('uplode') . '/Registered/' . auth()->user()->profile_image;
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $profile_image = $this->imageProcessing($request, 'Registered');
        } else
            $profile_image = auth()->user()->profile_image;
        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'profile_image' => $profile_image
        ]);
        return redirect()->back()->with('msg', 'profile updated successfully.');
    }
    function imageProcessing($data, $folderName)
    {
        $image = $data->file('profile_image');
        $ext = $image->getClientOriginalExtension();
        $img = time() . rand(10000, 20000) . rand(10000, 20000) . '.' . $ext;
        $image->move(public_path("uplode/$folderName"), $img);
        return $img;
    }
}
