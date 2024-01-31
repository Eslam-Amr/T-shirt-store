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
use Illuminate\Auth\Notifications\VerifyEmail;

// use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class registerController extends Controller
{
    //
    function index()
    {
        return view('register.index');
    }
    function auth(registerRequest $request)
    {
        $validated = $request->validated();
        $user = User::create($validated);
        // $this->toMail('test');
        // event(new Registered($user));
// $user->notify(new registerNotification($user));
Auth::login($user);
        $user->sendEmailVerificationNotification($user);
        return redirect()->to('/register')->with('message', 'login successfully check for verification message');
    }
    // function auth(registerRequest $request)
    // {
    //     $validated = $request->validated();
    //     $user = User::create($validated);
    //     // $this->toMail('test');
    //     // event(new Registered($user));


    //     $user->sendEmailVerificationNotification();
    //     return redirect()->to('/register')->with('message', 'login successfully check for verification message');
    // }
    function designerRegisterView()
    {
        return view('register.designerRegister');
    }
    function designerRegister(designerRegisterRequest $request)
    {
        $user = User::select('email', 'phone', 'password', 'id')->where('email', $request['email'])->first();
        if ($user == null)
            return redirect()->back()->with('message', 'no user with this  email and password');
        if (Hash::check($request['password'], $user['password'])) {
            if (ToBeDesigner::select('id')->where('user_id', $user['id'])->first() != null)
                return redirect()->back()->with('message', 'this user already register with for admin confirmed ');
                ToBeDesigner::create(['user_id' => $user['id'], 'portfolio' => $request['portfolio']]);
                return redirect()->back()->with('message', 'your request send successfully waitig to admin confirmed');
            }
            return redirect()->back()->with('message', 'no user with this  email and password');
        }
        public function toMail($notifiable)
        {
            return (new VerifyEmail)->toMail($notifiable);
        }

}
