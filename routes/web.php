<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Website\WebsiteController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Auth\SigninConatroller;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Dashboard\DashboardConatroller;
use App\Http\Controllers\Dashboard\IndexConatroller;
use App\Http\Controllers\Dashboard\Product\ProductController;
use App\Http\Controllers\Dashboard\User\UserController;
use App\Http\Controllers\Dashboard\Settings\webSiteSettingsController;

use App\Http\Controllers\Dashboard\Data\DataController;

Route::get('/', [WebsiteController::class, 'index'])->name('index');
Route::post('send', [WebsiteController::class, 'store'])->name('send');

// auth
Route::group(['middleware' => 'guest'], function () {
    Route::resource('signin', SigninConatroller::class);
    Route::resource('signup', SignupController::class);
    Route::resource('forgotPassword', ForgotPasswordController::class);
});

Route::middleware('authWeb')
    ->get('logout', [LogoutController::class, 'logout'])
    ->name('logout');

// language
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::middleware(['authWeb', 'admin'])
    ->prefix('dashboard')
    ->group(function () {
        //Product OK!!
        Route::get('/index', [DashboardConatroller::class, 'index'])->name('/index');
        Route::resource('Product', ProductController::class);
        Route::post('getImages', [ProductController::class, 'getImages'])->name('getImages');
        Route::post('/update', [ProductController::class, 'update'])->name('/update');
        Route::post('deleteImages', [ProductController::class, 'deleteImage'])->name('deleteImages');
        Route::post('filters', [ProductController::class, 'filters'])->name('filters');
        Route::get('exportPdf', [ProductController::class, 'exportPdf'])->name('exportPdf');
        Route::get('exportExcel', [ProductController::class, 'exportExcel'])->name('exportExcel');
        Route::get('printAllProducts', [ProductController::class, 'printAllProducts'])->name('printAllProducts');
        Route::get('printProduct/{id}', [ProductController::class, 'printProduct'])->name('printProduct');

        Route::resource('User', UserController::class);
        Route::post('getUserImages', [UserController::class, 'getImages'])->name('getUserImages');
        Route::post('deleteUserImage', [UserController::class, 'deleteImage'])->name('deleteUserImage');
        Route::post('/updateUser', [UserController::class, 'update'])->name('/updateUser');
        Route::post('/userVerify', [UserController::class, 'verify'])->name('/userVerify');
        //WebSite settings
        Route::resource('webSiteSettings', webSiteSettingsController::class);
        Route::post('/updateWebSite', [webSiteSettingsController::class, 'update'])->name('/updateWebSite');
        Route::post('/disableAlerts', [webSiteSettingsController::class, 'disableAlerts'])->name('/disableAlerts');
        //Category //Level //Brand //Unit //Status //User
        Route::get('{name}List', [DataController::class, 'index'])->name('show');
        Route::get('Create{name}', [DataController::class, 'create'])->name('create');
        Route::get('Edit{name}/{id}', [DataController::class, 'edit'])->name('edit');
        Route::post('store/{name}', [DataController::class, 'store'])->name('store');
        Route::get('getImage/{name}/{id}', [DataController::class, 'getImage'])->name('getImage');
        Route::post('update/{name}/{id}', [DataController::class, 'update'])->name('update');
        Route::get('deleteImage/{name}/{id}', [DataController::class, 'deleteImage'])->name('deleteImage');
        Route::delete('delete/{name}/{id}', [DataController::class, 'destroy'])->name('delete');
    });

Route::get('/test', function () {
    return view('auth.login');
});
