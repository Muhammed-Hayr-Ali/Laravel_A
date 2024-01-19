<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\IndexController;
use App\Http\Controllers\Web\Auth\LogoutController;
use App\Http\Controllers\Web\Auth\SignupController;
use App\Http\Controllers\Web\Auth\SigninConatroller;
use App\Http\Controllers\Web\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\IndexConatroller;
use App\Http\Controllers\Admin\OrdersConatroller;
use App\Http\Controllers\Admin\UsersConatroller;

// web site
Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('home', [IndexController::class, 'index'])->name('home');
Route::post('sendMessage', [IndexController::class, 'sendMessage'])->name('sendMessage');

// auth
Route::group(['middleware' => 'guest'], function () {
    Route::resource('signin', SigninConatroller::class);
    Route::resource('signup', SignupController::class);
    Route::resource('forgotPassword', ForgotPasswordController::class);
});
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');

// language
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});





// admin
Route::middleware(['authWeb' , 'admin'])->prefix('Dashboard')->group(function () {
    Route::get('index', [IndexConatroller::class, 'index'])->name('index');
    Route::get('pendings', [OrdersConatroller::class, 'pendings'])->name('pendings');
    Route::get('others', [OrdersConatroller::class, 'others'])->name('others');
    Route::post('showOrder', [OrdersConatroller::class, 'show'])->name('showOrder');
    Route::post('updateOrder', [OrdersConatroller::class, 'updateOrder'])->name('updateOrder');
    Route::post('userProfile', [UsersConatroller::class, 'userProfile'])->name('userProfile');

});






































































































// Route::get('dashboard', [DashboardConatroller::class, 'index'])->name('dashboard')->middleware('authWeb');

// Route::get('logut',  function () {
//     Auth::logout();
//     return redirect('/');
// })->name('login');


// Route::resource('products', ProductsController::class)->middleware('authWeb');

// Route::prefix('auth')->group(function () {

// });





// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')
//     ->middleware('auth');;


// Route::get('/login',  function () {
//     return view("auth.login");
// })->name('login');



//  Route::get('/loginlogec', [DashboardController::class, 'loginlogec'])->name('login');



/*
Route::get('/index/{category?}/{item?}', function ($category = null, $item = null) {
*   /*if(isset($category)) {
*   /*    if(isset($item)) {
*   /*        return "<h1>{$item}</h1>";
*   /*    }
*   /*   return "<h1>{$category}</h1>";
*   /*}
*   /*return '<h1>Story</h1>';
*   });
*/
