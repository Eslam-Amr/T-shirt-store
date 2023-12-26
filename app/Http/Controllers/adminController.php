<?php

namespace App\Http\Controllers;

use App\Http\Requests\userDataUpdateRequest;
use App\Models\admin_design_request;
use App\Models\designer;
use App\Models\Portfolio;
use App\Models\ToBeDesigner;
use App\Models\User;
use Illuminate\Http\Request;

class adminController extends Controller
{
    //
    function index()
    {
        return view('admin.index');
    }
    function displayUser()
    {
        // $users=User::paginate(5);
        $users = User::where('role', 'user')->paginate(
            $perPage = 5,
            $columns = ['*'],
            $pageName = 'users'
        );
        return view('admin.displayUser', ['users' => $users]);
    }
    function displayDesigner()
    {
        $designers = designer::paginate(5);
        // $designers = designer::where('role', 'user')->paginate(
        //     $perPage = 5, $columns = ['*'], $pageName = 'designers'
        // );
        return view('admin.displayDesigner', ['designers' => $designers]);
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
    function displayDesignerRequest()
    {
        $usersId = ToBeDesigner::select('user_id', 'portfolio')->get()->all();
        // dd($usersId);
        // $users=[];
        // foreach($usersId as $userId){

        //     $user=User::where('id',$userId['user_id'])->first();
        //     $users.append($user);
        // }
        // $users = [];

        // foreach ($usersId as $userId) {
        //     $user = User::where('id', $userId['user_id'])->first();
        //     if ($user) {
        //         $users[] = [$user + $userId['portfolio']];
        //     }
        // }
        $users = [];

        foreach ($usersId as $userId) {
            $user = User::where('id', $userId['user_id'])->first();
            if ($user) {
                $userWithPortfolio = $user->toArray() + ['portfolio' => $userId['portfolio']];
                $users[] = $userWithPortfolio;
            }
        }
        // dd($userId['user_id']);
        // dd($users);

        // $users=User::where('id','3549ce7b-414a-345c-b7df-01fbf60d82c7')->get()->all();
        // $user = User::first();

        // dd($users);
        return view('admin.displayDesignerRequest', ['users' => $users]);
    }
    function designerConfirmed($id)
    {
        // dd($id);
        User::where('id', $id)->update(['role' => 'designer']);
        $Portfolio=ToBeDesigner::select('Portfolio')->where('user_id', $id)->first()['Portfolio'];
        // dd($Portfolio);
        Portfolio::create(['user_id'=> $id,'Portfolio'=>$Portfolio]);
        ToBeDesigner::where('user_id', $id)->delete();
        return redirect()->back()->with('message', 'confirmed successfly');

        // $usersId = ToBeDesigner::select('user_id')->get()->all();
        // dd($usersId);
        // $users=[];
        // foreach($usersId as $userId){

        //     $user=User::where('id',$userId['user_id'])->first();
        //     $users.append($user);
        // }
    }
    function displayDesignRequest(){
        // designRequest
        $designs = admin_design_request::paginate(5);
        return view('admin.designRequest',['designs'=>$designs]);
    }
    function showSpecificDesign($id){
        // dd($id);
        $design=admin_design_request::where('id',$id)->first();
// dd($design);
return view('admin.showSpecificDesign',['design'=>$design]);
    }
}
