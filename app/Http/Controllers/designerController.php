<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class designerController extends Controller
{
    //
    function index(){
        return view('designer.index');
    }
    function addDesign(){
        return view('designer.addDesign');

    }
}
