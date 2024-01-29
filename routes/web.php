<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\WebsiteController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Auth\SigninConatroller;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Dashboard\DashboardConatroller;
use App\Http\Controllers\Dashboard\IndexConatroller;
use App\Http\Controllers\Dashboard\MessagesConatroller;
use App\Http\Controllers\Dashboard\Product\Product_List\Product_ListConatroller;
use App\Http\Controllers\Dashboard\Product\Add_Product\Add_ProductConatroller;
use App\Http\Controllers\Dashboard\Product\Edit_Product\Edit_ProductConatroller;
use App\Http\Controllers\Dashboard\Category\Category_List\Category_ListConatroller;

Route::resource('/', WebsiteController::class);

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
            Route::get('productList', [Product_ListConatroller::class, 'productList'])->name('productList');
            Route::post('filters', [Product_ListConatroller::class, 'filters'])->name('filters');
            Route::get('exportPdf', [Product_ListConatroller::class, 'exportPdf'])->name('exportPdf');
            Route::get('exportExcel', [Product_ListConatroller::class, 'exportExcel'])->name('exportExcel');
            Route::get('printList', [Product_ListConatroller::class, 'printList'])->name('printList');
            Route::get('editProduct/{id}', [Edit_ProductConatroller::class, 'editProduct'])->name('editProduct');
            Route::get('productDetails/{id}', [Product_ListConatroller::class, 'productDetails'])->name('productDetails');
            Route::post('deleteProduct', [Product_ListConatroller::class, 'delete'])->name('deleteProduct');
            Route::get('printProduct', [Product_ListConatroller::class, 'printProduct'])->name('printProduct');
            Route::get('addProduct', [Add_ProductConatroller::class, 'addProduct'])->name('addProduct');
            Route::post('saveProduct', [Add_ProductConatroller::class, 'saveProduct'])->name('saveProduct');
        });

        Route::prefix('Category')->group(function () {
            Route::resource('category_list', Category_listConatroller::class);
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
