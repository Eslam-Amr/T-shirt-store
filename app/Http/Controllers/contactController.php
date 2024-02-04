<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class contactController extends Controller
{
    //
    public function index(){
        return view('contact.index');
    }
    public function send(ContactRequest $request){
        Contact::create($request->all());
        return redirect()->back()->with('message', 'added successfully');
        // dd($request);
    }
}
