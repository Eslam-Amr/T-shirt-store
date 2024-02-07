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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function index()
    {
        if(auth('admin')->user()!=null)
        return redirect()->route('admin.index');
        if(auth('designer')->user()!=null)
        return redirect()->route('designer.index');

        $products = Product::get();
        $numberOfProduct = $products->count();
        return view('home.index', ['products' => $products, 'numberOfProduct' => $numberOfProduct]);
    }
public function profile(){
    return view('home.profile');
}
public function updateProfile(Request $request)
{
    $validated = Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'phone' => ['required', 'string', 'max:255'],
        // 'address' => ['required', 'string', 'max:255'],
    ]);

    # check if user profile image is null, then validate
    // if (auth()->user()->profile_image == null) {
    //      $validate_image = Validator::make($request->all(), [
    //         'profile_image' => ['required', 'image', 'max:1000']
    //     ]);
    //      # check if their is any error in image validation
    //     if ($validate_image->fails()) {
    //         return response()->json(['code' => 400, 'msg' => $validate_image->errors()->first()]);
    //     }
    // }

    # check if their is any error
    if ($validated->fails()) {
        return redirect()->back()->with( 'msg' , 'profile updated successfully.');

        // return response()->json(['code' => 400, 'msg' => $validated->errors()->first()]);
    }
// dd($request->hasFile('profile_image'));
    # check if the request has profile image
    if ($request->hasFile('profile_image')) {
        // $imagePath = 'public/uplode/Registered/'.auth()->user()->profile_image;
        $imagePath = asset('uplode').'/Registered/'.auth()->user()->profile_image;
        # check whether the image exists in the directory
        // dd(File::exists('storage/uplode/Registered/0lGsYb4WgSV3P9LRTLsqfSMvhtFMU3fFG33G5vyG.png'));
        // dd(Storage::disk('public'));
        // dd(dd(Storage::disk('public')->exists('upload/Registered/17071564911051811384.png')));
        // dd($imagePath);
        if (File::exists($imagePath)) {
            # delete image
            File::delete($imagePath);
        }
        // $profile_image = $request->profile_image->store('uplode/Registered');
        // dd(asset('uplode').'/Registered/'.auth()->user()->profile_image);
        // dd(File::exists('uplode'.'/Registered/'.auth()->user()->profile_image));
        // dd($imagePath);
        $profile_image = $this->imageProcessing($request, 'Registered');
    }else
    $profile_image=auth()->user()->profile_image;
    // $imageName = $this->imageProcessing($request, 'Registered');

    # update the user info
    $user=auth()->user();
    $user->update([
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email,
        // 'address' => $request->address,
        'profile_image' => $profile_image
    ]);
    return redirect()->back()->with( 'msg' , 'profile updated successfully.');
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

