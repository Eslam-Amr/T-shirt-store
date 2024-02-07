<?php

namespace App\Http\Controllers;

use App\Mail\restPassword;
use App\Models\User;
// use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Facade;

class authController extends Controller
{



    public function forgotPassword(){
        return view('forgetpassword.forgetPassword');
    }
    public function submitForgotPassword(request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
//--------------------------------------------------------
        $token=str::random(64);
        \DB::table('password_reset_tokens')->insert([
            'email'=> $request->email,
            'token'=> $token,
            'created_at'=> now()
        ]);
//--------------------------------------------------------
        $user=User::where('email',$request->email)->first();
        $formData =[
            'email' => $user,
            'subject'=>'please click here to reset your password',
            // 'token'=>$token
        ];
        // dd($formData['email']->id);
        Mail::to($request->email)->send(new restPassword($formData));
        session()->flash('message','please check your account');
        return back();
    }
    public function resetPassword($id){
        $user=User::find($id);
        dd($user);
        // return view('auth.rest-Password',['user'=>$user,'id'=>$id]);
// return $user;
    }
    public function restPasswordLogic($id){
        $user=User::find($id);
        // dd($user);reset-password
        return view('auth.reset-password',['user'=>$user,'id'=>$id]);
    }
    public function SubmitResetPassword(request $request,$id){
        $data=$request->all();
        $user=User::find($id);
        $request->validate([
            'password' => "required|max:255|min:8|confirmed",
        ]);
        user::where('id',$id)->update(['password'=>bcrypt($data['password'])]);
        //delete the token from table
        \DB::table('password_reset_tokens')
          ->where('email','=',$user->email)
          ->delete();
          return redirect()->route('login.index')->with('success','password is reset successfully');
    }

    //
}