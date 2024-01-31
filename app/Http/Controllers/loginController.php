<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use Helper;
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
        $validator = $request->validated();
        $guards = array_keys(array_slice(config('auth.guards'), 0, -1));
        if (Auth::guard("admin")->attempt($validator)) {
            Helper::rememberMe($request);
            return redirect()->route('admin.index');
        }
        if (Auth::guard("designer")->attempt($validator)){
            Helper::rememberMe($request);
            return redirect()->route('designer.index');
        }
        if (Auth::guard("web")->attempt($validator)) {
            Helper::rememberMe($request);
            return redirect()->route('home.index');
        }
        return back()->with('message', 'invalid email or password');
    }
    function logout()
    {
        Auth::logout();
        return redirect()->route('home.index');
    }
}
