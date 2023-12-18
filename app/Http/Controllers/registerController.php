<?php

namespace App\Http\Controllers;

use App\Http\Requests\registerRequest;
use App\Mail\registerMail;
use App\Models\User;
use App\Notifications\registerNotification;
use Illuminate\Http\Request;
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
    function verified()
    {
        return view('register.verified');
    }
    function auth(registerRequest $request)
    {
        $validated = $request->validated();
        $user = User::create($validated);
        // dd($validated);
        $user->sendEmailVerificationNotification();
        return redirect()->to('/register')->with('message','login successfully check for verification message');
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
