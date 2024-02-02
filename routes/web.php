<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\WebsiteController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Auth\SigninConatroller;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Dashboard\DashboardConatroller;
use App\Http\Controllers\Dashboard\IndexConatroller;
use App\Http\Controllers\Dashboard\Product\ProductController;
use App\Http\Controllers\Dashboard\Category\CategoryController;
use App\Http\Controllers\Dashboard\Level\LevelController;
use App\Http\Controllers\Dashboard\Brand\BrandController;
use App\Http\Controllers\Dashboard\Unit\UnitController;
use App\Http\Controllers\Dashboard\Status\StatusController;

Route::resource('/', WebsiteController::class);

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
        Route::post('deleteImage', [ProductController::class, 'deleteImage'])->name('deleteImage');
        Route::post('filters', [ProductController::class, 'filters'])->name('filters');
        Route::get('exportPdf', [ProductController::class, 'exportPdf'])->name('exportPdf');
        Route::get('exportExcel', [ProductController::class, 'exportExcel'])->name('exportExcel');
        Route::get('printAllProducts', [ProductController::class, 'printAllProducts'])->name('printAllProducts');
        Route::get('printProduct/{id}', [ProductController::class, 'printProduct'])->name('printProduct');
        //Category
        Route::resource('Category', CategoryController::class);
        Route::post('getCategoryImages', [CategoryController::class, 'getImages'])->name('getCategoryImages');
        Route::post('deleteCategoryImage', [CategoryController::class, 'deleteImage'])->name('deleteCategoryImage');
        Route::post('/updateCategory', [CategoryController::class, 'update'])->name('/updateCategory');
        //Level
        Route::resource('Level', LevelController::class);
        Route::post('getLevelImages', [LevelController::class, 'getImages'])->name('getLevelImages');
        Route::post('deleteLevelImage', [LevelController::class, 'deleteImage'])->name('deleteLevelImage');
        Route::post('/updateLevel', [LevelController::class, 'update'])->name('/updateLevel');
        //Brand
        Route::resource('Brand', BrandController::class);
        Route::post('getBrandImages', [BrandController::class, 'getImages'])->name('getBrandImages');
        Route::post('deleteBrandImage', [BrandController::class, 'deleteImage'])->name('deleteBrandImage');
        Route::post('/updateBrand', [BrandController::class, 'update'])->name('/updateBrand');
        //Unit
        Route::resource('Unit', UnitController::class);
        Route::post('getUnitImages', [UnitController::class, 'getImages'])->name('getUnitImages');
        Route::post('deleteUnitImage', [UnitController::class, 'deleteImage'])->name('deleteUnitImage');
        Route::post('/updateUnit', [UnitController::class, 'update'])->name('/updateUnit');
        //Status
        Route::resource('Status', StatusController::class);
        Route::post('getStatusImages', [StatusController::class, 'getImages'])->name('getStatusImages');
        Route::post('deleteStatusImage', [StatusController::class, 'deleteImage'])->name('deleteStatusImage');
        Route::post('/updateStatus', [StatusController::class, 'update'])->name('/updateStatus');
    });
