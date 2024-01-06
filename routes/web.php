<?php

use App\Http\Controllers\Web\Auth\AuthenticationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Home\homeController;



Route::get('/', [homeController::class, 'index'])->name('home');

Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
Route::post('/registr', [AuthenticationController::class, 'registr'])->name('registr');


// Route::get('new',  function () {
//     return view('new');
// })->name('new');





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
