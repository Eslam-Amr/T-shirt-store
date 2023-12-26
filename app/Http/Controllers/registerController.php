<?php

namespace App\Http\Controllers;

use App\Http\Requests\designerRegisterRequest;
use App\Http\Requests\registerRequest;
use App\Mail\registerMail;
use App\Models\ToBeDesigner;
use App\Models\User;
use App\Notifications\registerNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Http\Request;
// use Illuminate\Notifications\Notification;

// use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification;

class registerController extends Controller
{
    //
    function index()
    {
        return view('register.index');
    }
    // function verified()
    // {
    //     return view('register.verified');
    // }
    function auth(registerRequest $request)
    {
        $validated = $request->validated();
        $user = User::create($validated);
        // dd($validated);
        $user->sendEmailVerificationNotification();
        return redirect()->to('/register')->with('message','login successfully check for verification message');
    }
    function designerRegisterView(){
        return view('register.designerRegister');
    }
    function designerRegister(Request $request){
        // $validated = $request->validated();
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3|max:10',
            'portfolio'=>'required|url'
        ]);
        $data=$request->all();
        // dd($data);
        $user=User::select('email','phone','password','id')->where('email',$data['email'])->first();
        if($user==null)
        return redirect()->back()->with('message','no user with this  email and password');
    if(Hash::check($data['password'],$user['password'])){
        if(ToBeDesigner::select('id')->where('user_id',$user['id'])->first()!=null)
        return redirect()->back()->with('message','this user already register with for admin confirmed ');
        // User::where('email',$user['email'])->update(['role'=>'designer']);
        ToBeDesigner::create(['user_id'=>$user['id'],'portfolio'=>$data['portfolio']]);
        return redirect()->back()->with('message','your request send successfully waitig to admin confirmed');
    }
    return redirect()->back()->with('message','no user with this  email and password');
    // dd('eslam');
    // User::where()
    // dd($user);
    // $user->update
    // $2y$12$5A1ok9pZVhpvshRGi6NUFuD2CXGWsSrPY7o8U4TyQg3ChV0c8VQLa
    // $2y$12$5A1ok9pZVhpvshRGi6NUFuD2CXGWsSrPY7o8U4TyQg3ChV0c8VQLa
    // dd($data['email']);
    // $users=User::select('email','phone','password')->first();
    // dd($users['password']);
    // $check=User::where('password',bcrypt($data['password']))->where('email',$data['email'])->first();
        // dd(Hash::make($data['password']));
        // dd(Hash::check($data['password'],$users['password']));
        // $check=User::where('password',Hash::make($data['password']))->first();
        // dd($check);
        // if($check==null)
        // dd($users);

    }

}





// function verifiedNumber(Request $request){
//     // session_start();

//     // dd($request->all());
//     // dd($_SESSION['validNumber']);
//     // dd($i);
//     if($request['n']==$request['verified'])
//     {
//     }
// }
