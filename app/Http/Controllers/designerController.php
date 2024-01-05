<?php

namespace App\Http\Controllers;

use App\Models\admin_design_request;
use App\Models\Designer;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class designerController extends Controller
{
    //
    function index()
    {
        return view('designer.index');
    }
    function addDesign()
    {
        return view('designer.addDesign');
    }

    function imageProcessing($data, $folderName)
    {
        $image = $data->file('design');
        $ext = $image->getClientOriginalExtension();
        $img = time() . rand(10000, 20000) . rand(10000, 20000) . '.' . $ext;
        $image->move(public_path("uplode/$folderName"), $img);
        return $img;
    }
    function sendDesignRequest(Request $request)
    {
        // dd("eslam");
        // $x=auth()->user('designer');
        // dd($x['id']);
        //         $designers = Designer::where('role', 'designer')->get();
        // $designerIds = $designers->pluck('id');
        // dd($designerIds);

        $x = auth()->user();
        // dd($x);
// dd( implode('-',$x->id));

        // $x = auth()->user();
        // dd($x->email);
        // dd(Designer::where('email',$x->email)->first()['id']);
// $designerUsers = auth()->user('designer');

// foreach ($designerUsers as $designerUser) {
    // dd($designerUsers);
    // }
    // foreach($x as $val =>$key){
    //     dump($key,$val);
    // }
    // die;
// dd($x['id']);

    $request->validate([
        'designName' => 'required|min:3|max:30',
        'designCategory' => 'required|min:3|max:30',
        'design' => 'required|image|mimes:png,jpg,jpeg,gif|mimetypes:image/jpeg,image/png,image/gif',
        'price'=>'required',
        'discount'=>'required',
        'description'=>'required'
        ]);
        // dd("eslam");
        $imageName = $this->imageProcessing($request, 'RequestDesign');
        admin_design_request::create([
            // 'user_id' => Designer::where('email',$x->email)->first()['id'],
            'user_id' =>'16dff78c-f4cb-3818-9de2-3cccf6492265',
            'design_name' => $request->designName,
            'design_category' => $request->designCategory,
            'price' => $request->price,
            'discount' => $request->discount,
            'description' => $request->description,
            'design' => $imageName
        ]);
        // return redirect()->route('admin.addBanner')->with('message', 'added successfly');
        return redirect()->back()->with('message', 'send successfly');
    }
    function message(){
        // dd('slkdfnk');
        $messages=Message::where('user_id',auth()->user()['id'])->get()->all();
    // dd(auth()->user()['id']);
        return view('designer.message',['messages'=>$messages]);
    }

}
