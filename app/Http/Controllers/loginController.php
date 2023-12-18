<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    //
    function index()
    {
        return view('login.index');
    }
    function designerLogin()
    {
        return view('designer.login');
    }

    function login(loginRequest $request)
    {
        // dd($request->all());
        // $validator = $this->validateLogin($request->all());
        $validator = $request->validated();
        $guards = array_keys(array_slice(config('auth.guards'), 0, -1));
        // dd($validator);
        // dd($guards[1]=='admin');
        // dd($guards);
        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->attempt($validator)) {
        //         if ($guard == 'admin')
        //         return redirect()->route('admin.index');
        //    else if ($guard == 'web')
        //     return redirect()->route('home.index');

        //     // dd($validator);

        //     }
        // dd(Auth::guard("designer"));
        // dd(Auth::guard("designer"));
        if (Auth::guard("admin")->attempt($validator)) {
            // dd("admin");
            return redirect()->route('admin.index');
        }
        if (Auth::guard("designer")->attempt($validator))
            return redirect()->route('designer.index');

            // dd("designer");
        
        if (Auth::guard("web")->attempt($validator)) {

            // dd("user");
            return redirect()->route('home.index');
        }
        // foreach ($guards as $guard) {
        //     if (Auth::guard("admin")->attempt($validator)) {
        //         if ($guard == 'admin')
        //         return redirect()->route('admin.index');
        //     if ($guard == 'web')
        //     return redirect()->route('home.index');

        //     // dd($validator);

        //     }
        // }
        return back()->with('message', 'invalid email or password');
    }












    function logout()
    {
        Auth::logout();
        return redirect()->route('home.index');
    }
}
