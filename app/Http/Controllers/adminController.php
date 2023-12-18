<?php

namespace App\Http\Controllers;

use App\Http\Requests\userDataUpdateRequest;
use App\Models\designer;
use App\Models\User;
use Illuminate\Http\Request;

class adminController extends Controller
{
    //
    function index(){
        return view('admin.index');
    }
    function displayUser(){
        // $users=User::paginate(5);
        $users = User::where('role', 'user')->paginate(
            $perPage = 5, $columns = ['*'], $pageName = 'users'
        );
        return view('admin.displayUser',['users'=>$users]);
    }
    function displayDesigner(){
        $designers=designer::paginate(5);
        // $designers = designer::where('role', 'user')->paginate(
        //     $perPage = 5, $columns = ['*'], $pageName = 'designers'
        // );
        return view('admin.displayDesigner',['designers'=>$designers]);
    }
    function deleteUser($id)
    {
        User::find($id)->delete();
        return redirect()->to('/admin/user')->with('message', 'deleted successfly');
    }
    function updateUserForm($id)
    {
        // dd($id);
        $user = User::find($id);
        return view('admin.userUpdateForm', ['user' => $user]);
    }
    function updateUser($id, Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|min:3|max:15',
            'phone' => 'required|numeric|min_digits:11|max_digits:11',
            ]);
        $request->only('name', 'email', 'phone');
        User::find($id)->update($request->except('token', 'image', 'password'));
        return redirect()->to('/admin/user')->with('message', 'updated successfly');
    }
}
