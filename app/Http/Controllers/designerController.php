<?php

namespace App\Http\Controllers;

use App\Models\admin_design_request;
use App\Models\User;
use Illuminate\Http\Request;

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
        $x = auth()->user();
        // dd(User::where('id',$x->id)->first()['id']);
// dd($x->id);
// $designerUsers = auth()->user('designer');

// foreach ($designerUsers as $designerUser) {
    // dd($designerUsers);
// }


        $request->validate([
            'designName' => 'required|min:3|max:30',
            'designCategory' => 'required|min:3|max:30',
            'design' => 'required|image|mimes:png,jpg,jpeg,gif|mimetypes:image/jpeg,image/png,image/gif'
        ]);
        $imageName = $this->imageProcessing($request, 'RequestDesign');
        admin_design_request::create([
            'user_id' => User::where('id',$x->id)->first()['id'],
            'design_name' => $request->designName,
            'design_category' => $request->designCategory,
            'design' => $imageName
        ]);
        // return redirect()->route('admin.addBanner')->with('message', 'added successfly');
        return redirect()->back()->with('message', 'send successfly');
    }

}
