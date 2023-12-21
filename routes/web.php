<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\desginerController;
use App\Http\Controllers\designerController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\registerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function (){
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });

Route::get('/home',[homeController::class,'index'])->name('home.index');
// Route::get('/loginDesigner',[loginController::class,'designerLogin'])->name('designer.login');
Route::get('/login',[loginController::class,'index'])->name('login.index');
Route::post('/login/logic',[loginController::class,'login'])->name('login');
Route::get('/register',[registerController::class,'index'])->name('register.index');
Route::get('/register/designer',[registerController::class,'designerRegisterView'])->name('register.designerRegisterView');
Route::post('/register/designer/auth',[registerController::class,'designerRegister'])->name('register.designerRegister');
Route::post('/register/auth',[registerController::class,'auth'])->name('register.auth');
// Route::get('/register/verified',[registerController::class,'verified'])->name('register.verified');
// Route::post('/register/verified/verifiedNumber',[registerController::class,'verifiedNumber'])->name('register.verifiedNumber');
// designerConfirmed
// displayDesignerRequest
Route::middleware('auth:admin')->group(function(){
    // Route::get('/admin/logout',[adminController::class,'logout'])->name('admin.logout');
    Route::get('/admin',[adminController::class,'index'])->name('admin.index');
    Route::get('/admin/user',[adminController::class,'displayUser'])->name('admin.displayUser');
    Route::get('/admin/designer',[adminController::class,'displayDesigner'])->name('admin.displayDesigner');
    Route::get('/admin/designer/request',[adminController::class,'displayDesignerRequest'])->name('admin.displayDesignerRequest');
    Route::get('/admin/designer/request/confirmed/{id}',[adminController::class,'designerConfirmed'])->name('admin.designerConfirmed');
    Route::get('/admin/user/{id}/deleteUser',[adminController::class,'deleteUser'])->name('admin.deleteUser');
    Route::get('/admin/user/{id}/updateUserForm',[adminController::class,'updateUserForm'])->name('admin.updateUserForm');
    Route::post('/admin/user/{id}/updateUserForm/updateUser',[adminController::class,'updateUser'])->name('admin.updateUser');
});
// Route::get('/admin/desginer',[designerController::class,'index'])->name('desginer.index');
// designer
Route::middleware('auth:designer')->group(function(){
    Route::get('/designer/admin',[designerController::class,'index'])->name('designer.index');

});
