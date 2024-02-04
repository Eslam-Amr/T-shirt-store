<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\desginerController;
use App\Http\Controllers\designerController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Auth;
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

    return redirect()->route('home.index');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->name('verification.notice');
// Route::post('/email/verify/{id}', function () {
//     return view('auth.verify-email');
// })->name('verification.verify');
// Auth::routes([
//     'verify'=>true
// ]);
// productDetailscheckout  orderHistory confirmOrder
// In routes/web.php
// Route::get('/verify-email/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');
// Route::get('/verify-email/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');

Route::get('/email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::get('/home', [homeController::class, 'index'])->name('home.index');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::get('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::get('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::get('/orderHistory', [OrderController::class, 'orderHistory'])->name('home.orderHistory');
Route::get('/product', [categoryController::class, 'index'])->name('category.index');
Route::get('/product/filter', [categoryController::class, 'filter'])->name('category.filter');
// Route::get('/product/{key}/{from}/{to}', [categoryController::class, 'index'])->name('category.index');
// Route::get('/product/{key}/{from}/{to}/filter', [categoryController::class, 'filter'])->name('category.filter');
Route::get('/product/search', [categoryController::class, 'search'])->name('product.search');
Route::get('/contact', [contactController::class, 'index'])->name('contact.index');
Route::post('/contact/send', [contactController::class, 'send'])->name('contact.send');
Route::get('/logout', [loginController::class, 'logout'])->name('home.logout');
Route::get('/home/cart', [CartController::class, 'cart'])->name('cart.index');
Route::get('/home/cart/decrement/{id}', [CartController::class, 'cartDecrement'])->name('cart.decrement');
Route::get('/home/cart/cartIncrement/{id}', [CartController::class, 'cartIncrement'])->name('cart.cartIncrement');
Route::get('/home/cart/checkout', [OrderController::class, 'checkout'])->name('home.checkout');
Route::post('/home/cart/checkout/setOreder', [OrderController::class, 'setOreder'])->name('home.setOreder');
Route::get('/home/cart/checkout/confirmation', [OrderController::class, 'confirmation'])->name('home.confirmation');
Route::get('/home/cart/checkout/confirmation/confirmOrder', [OrderController::class, 'confirmOrder'])->name('home.confirmOrder');
Route::get('/home/cart/checkout/thank', [OrderController::class, 'thank'])->name('home.thank');
Route::get('/home/{id}/productDetails', [ProductController::class, 'productDetails'])->name('home.productDetails');
Route::get('/home/{id}/productDetails/addToCart', [CartController::class, 'addToCart'])->name('home.addToCart');
Route::get('/home/{id}/productDetails/addComment', [ProductController::class, 'addComment'])->name('home.addComment');
Route::post('/home/{id}/productDetails/addReview', [ProductController::class, 'addReview'])->name('home.addReview');
// Route::get('/loginDesigner',[loginController::class,'designerLogin'])->name('designer.login');
Route::get('/login', [loginController::class, 'index'])->name('login.index');
Route::post('/login/logic', [loginController::class, 'login'])->name('login');
Route::get('/register', [registerController::class, 'index'])->name('register.index');
Route::get('/register/designer', [registerController::class, 'designerRegisterView'])->name('register.designerRegisterView');
Route::post('/register/designer/auth', [registerController::class, 'designerRegister'])->name('register.designerRegister');
Route::post('/register/auth', [registerController::class, 'auth'])->name('register.auth');
Route::get('/register/verified', [registerController::class, 'verified'])->name('register.verified');
// Route::post('/register/verified/verifiedNumber',[registerController::class,'verifiedNumber'])->name('register.verifiedNumber');
// designerConfirmed
// displayDesignerRequest
// designer_id
Route::controller(adminController::class)->prefix('admin')->middleware('auth:admin')->group(function () {
    // Route::get('/admin/logout',[adminController::class,'logout'])->name('admin.logout');
    Route::get('/', 'index')->name('admin.index');
    Route::get('/user', 'displayUser')->name('admin.displayUser');
    Route::get('/order', 'displayOrder')->name('admin.displayOrder');
    Route::get('/order/{id}/reject', 'rejectOrder')->name('admin.rejectOrder');
    Route::get('/order/{id}/Shipping', 'ShippingOrder')->name('admin.ShippingOrder');
    Route::get('/order/{id}/complete', 'completeOrder')->name('admin.completeOrder');
    Route::get('/profit', 'displayProfit')->name('admin.displayProfit');
    Route::get('/profit/designerProfit', 'designerProfit')->name('admin.designerProfit');
    Route::get('/profit/year', 'displayYearProfit')->name('admin.displayYearProfit');
    Route::get('/profit/month', 'displayMonthProfit')->name('admin.displayMonthProfit');
    Route::get('/profit/day', 'displayDayProfit')->name('admin.displayDayProfit');
    Route::get('/designRequest', 'displayDesignRequest')->name('admin.displayDesignsRequest');
    Route::get('/designRequest/{id}/show', 'showSpecificDesign')->name('admin.showSpecificDesign');
    Route::get('/designRequest/{id}/show/reject', 'rejectSpecificDesign')->name('admin.rejectSpecificDesign');
    Route::get('/designRequest/{id}/show/add', 'addSpecificDesign')->name('admin.addSpecificDesign');
    Route::get('/designer', 'displayDesigner')->name('admin.displayDesigner');
    Route::get('/designer/{id}/delete', 'deleteDesigner')->name('admin.deleteDesigner');
    Route::get('/designer/request', 'displayDesignerRequest')->name('admin.displayDesignerRequest');
    Route::get('/designer/request/confirmed/{id}', 'designerConfirmed')->name('admin.designerConfirmed');
    Route::get('/user/{id}/deleteUser', 'deleteUser')->name('admin.deleteUser');
    Route::get('/user/{id}/updateUserForm', 'updateUserForm')->name('admin.updateUserForm');
    Route::post('/user/{id}/updateUserForm/updateUser', 'updateUser')->name('admin.updateUser');
});
// Route::get('/admin/desginer',[designerController::class,'index'])->name('desginer.index');
// designer
Route::controller(designerController::class)->prefix('designer/admin')->middleware('auth:designer')->group(function () {
    Route::get('/','index')->name('designer.index');
    Route::get('/order', 'displayOrder')->name('designer.displayOrder');
    Route::get('/profit','displayProfit')->name('designer.displayProfit');
    Route::get('/profit/yaer','displayYearProfit')->name('designer.displayYearProfit');
    Route::get('/profit/month','displayMonthProfit')->name('designer.displayMonthProfit');
    Route::get('/profit/day','displayDayProfit')->name('designer.displayDayProfit');
    Route::get('/message','message')->name('designer.message');
    Route::get('/message/read/{id}','readMessage')->name('designer.readMessage');
    Route::get('/addDesign','addDesign')->name('designer.addDesign');
    Route::post('/addDesign/send','sendDesignRequest')->name('designer.sendDesignRequest');
});
