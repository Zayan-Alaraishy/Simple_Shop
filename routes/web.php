<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\EmailVerificationController;
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
    return view('products.index');
})->name('home');

Route::get('/home', function () {
    return view('welcome');
});

Route::prefix('/auth')->group(function () {
    Route::get('/signup', [AuthController::class, 'index'])->name('signup');
    Route::post('/signup', [AuthController::class, 'store']);

    Route::get('/login', [AuthController::class, 'LoginForm'])->name('login');
    Route::post('/login',  [AuthController::class, 'login'])->name('login');


    Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth')
    ->withoutMiddleware('guest');

});

// Email verification
Route::prefix('/email')->group(function () {

    Route::get('/verify', [EmailVerificationController::class, 'show'])
        ->name('verification.notice');

    Route::get('/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware('signed')->name('verification.verify');

    Route::post('/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
})->middleware(['auth']);


Route::get('/products/{product}', function(){
    return view('products.product-detail');
})->name('product');

Route::get('/about', function(){
    return view('about');
})->name('about');

Route::get('/contact', function(){
    return view('contact');
})->name('contact');

Route::get('/cart', function(){
    return view('cart');
})->name('cart');

