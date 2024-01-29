<?php

use App\Http\Controllers\Admin\CategoriesConatroller as AdminCategoriesConatroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\IndexController;
use App\Http\Controllers\Web\Auth\LogoutController;
use App\Http\Controllers\Web\Auth\SignupController;
use App\Http\Controllers\Web\Auth\SigninConatroller;
use App\Http\Controllers\Web\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\IndexConatroller;
use App\Http\Controllers\Admin\OrdersConatroller;
use App\Http\Controllers\Admin\UsersConatroller;
use App\Http\Controllers\Admin\CategoriesConatroller;
use App\Http\Controllers\Dashboard\DashboardConatroller;
use App\Http\Controllers\Dashboard\IndexConatroller as DashboardIndexConatroller;
use App\Http\Controllers\Dashboard\MessagesConatroller;
use App\Http\Controllers\Dashboard\Product\product_list\Product_listConatroller;
use App\Http\Controllers\Dashboard\Product\add_product\add_productConatroller;

Route::get('/demo', function () {
    return view('dashboard.Product.demo');
})->name('demo');

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

Route::middleware(['authWeb', 'admin'])
    ->prefix('dashboard')
    ->group(function () {
        Route::get('unreadMessages', [MessagesConatroller::class, 'unreadMessages'])->name('unreadMessages');
        Route::get('dashboard', [DashboardConatroller::class, 'index'])->name('dashboard');
        Route::prefix('Product')->group(function () {
            Route::get('productlist', [Product_listConatroller::class, 'index'])->name('productlist');
            Route::post('filters', [Product_listConatroller::class, 'filters'])->name('filters');
            Route::get('exportPdf', [Product_listConatroller::class, 'exportPdf'])->name('exportPdf');
            Route::get('exportExcel', [Product_listConatroller::class, 'exportExcel'])->name('exportExcel');
            Route::get('printList', [Product_listConatroller::class, 'printList'])->name('printList');
            Route::get('productDetails/{id}', [Product_listConatroller::class, 'productDetails'])->name('productDetails');
            Route::post('deleteProduct', [Product_listConatroller::class, 'delete'])->name('deleteProduct');
            Route::get('printProduct', [Product_listConatroller::class, 'printProduct'])->name('printProduct');
            Route::get('addproduct', [add_productConatroller::class, 'addproduct'])->name('addproduct');
            Route::post('newProduct', [add_productConatroller::class, 'newProduct'])->name('newProduct');
        });
    });

// CategoriesConatroller

// admin
// Route::middleware(['authWeb', 'admin'])->prefix('dashboard')->group(function () {
//     Route::get('index', [IndexConatroller::class, 'index'])->name('index');
//     Route::get('pendings', [OrdersConatroller::class, 'pendings'])->name('pendings');
//     Route::post('searchPendings', [OrdersConatroller::class, 'searchPendings'])->name('searchPendings');
//     Route::get('others', [OrdersConatroller::class, 'others'])->name('others');
//     Route::post('showOrder', [OrdersConatroller::class, 'show'])->name('showOrder');
//     Route::post('updateOrder', [OrdersConatroller::class, 'updateOrder'])->name('updateOrder');
//     Route::post('userProfile', [UsersConatroller::class, 'userProfile'])->name('userProfile');
//     Route::post('printOrderNumber', [OrdersConatroller::class, 'printOrderNumber'])->name('printOrderNumber');
//     Route::get('categories', [CategoriesConatroller::class, 'index'])->name('categories');
//     // Route::post('showCategory', [CategoriesConatroller::class, 'showCategory'])->name('showCategory');
//     // Route::post('deleteCategory', [CategoriesConatroller::class, 'deleteCategory'])->name('deleteCategory');
//     // Route::post('editCategory', [CategoriesConatroller::class, 'editCategory'])->name('editCategory');
//     // Route::post('updateCategory', [CategoriesConatroller::class, 'updateCategory'])->name('updateCategory');
//     Route::get('categories', [CategoriesConatroller::class, 'index'])->name('categories');
//     Route::get('getAllCategories', [CategoriesConatroller::class, 'getAllCategories'])->name('getAllCategories');
//     Route::post('createdCategory', [CategoriesConatroller::class, 'createdCategory'])->name('createdCategory');
//     Route::post('deleteCategory', [CategoriesConatroller::class, 'deleteCategory'])->name('deleteCategory');
//     //  MessagesConatroller
//     Route::get('unreadMessages', [MessagesConatroller::class, 'unreadMessages'])->name('unreadMessages');
// });

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
