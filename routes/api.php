<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\V1\Auth\CheckUserController;
use App\Http\Controllers\API\V1\Auth\SignInController;
use App\Http\Controllers\API\V1\Auth\SignUpController;
use App\Http\Controllers\API\V1\Auth\googleSignInController;
use App\Http\Controllers\API\V1\Auth\ResetPassController;
use App\Http\Controllers\API\V1\Auth\UpdatePassController;
use App\Http\Controllers\API\V1\Auth\ProfileController;
use App\Http\Controllers\API\V1\Product\ProductsController;
use App\Http\Controllers\API\V1\Product\GetProductDetailsController;
use App\Http\Controllers\API\V1\Home\HomeScreenController;

// My Middlewares
// auth:api
// UserBannedAuth
// UserBannedRequest
// ExpirationDateAuth
// ExpirationDateRequest

Route::prefix('v1')->group(function () {
    Route::get('/HomeScreen', [HomeScreenController::class, 'HomeScreen']);

    Route::prefix('auth')->group(function () {
        Route::post('/signIn', [SignInController::class, 'signIn']);
        Route::post('/signUp', [SignUpController::class, 'signUp']);
        Route::post('/googleSignIn', [googleSignInController::class, 'googleSignIn']);
        Route::post('/resetPass', [ResetPassController::class, 'resetPass']);
        Route::post('/updatePass', [UpdatePassController::class, 'updatePass']);
        Route::get('/checkUser', [CheckUserController::class, 'checkUser'])->middleware('auth:api');
        Route::get('/getProfile', [ProfileController::class, 'getProfile'])->middleware('auth:api');
        Route::post('/updateProfile', [ProfileController::class, 'updateProfile'])->middleware('auth:api');
        Route::post('/updatePassword', [ProfileController::class, 'updatePassword'])->middleware('auth:api');
        Route::get('/logout', [ProfileController::class, 'logout'])->middleware('auth:api');
        Route::get('/delete', [ProfileController::class, 'delete'])->middleware('auth:api');
    });

    Route::prefix('Category')->group(function () {
        Route::get('/getAllCategory', [HomeScreenController::class, 'getCategory']);
    });
    Route::prefix('product')->group(function () {
        Route::get('/getPrimiumProducts', [ProductsController::class, 'getPrimiumProducts']);
        Route::get('/getAllProducts', [ProductsController::class, 'getAllProducts']);
        Route::get('/getProductDetails/{id}', [GetProductDetailsController::class, 'getProductDetails']);
    });
});
