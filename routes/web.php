<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\Profile\ProfileController;

// use App\Http\Controllers\Profile\ProfileController;

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

    // Forgot Password
    Route::prefix('/')->group(function () {
        Route::get('/forgot-password', [AuthController::class, 'forgotPasswordForm'])->name('forgot-password');
    
        Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->middleware('guest')->name('password.email');
    
        Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->middleware('guest')->name('password.reset');
    
        Route::post('/reset-password', [AuthController::class, 'resetPassword'])->middleware('guest')->name('password.update');
    });
    

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

Route::prefix('/profile')->middleware('auth')->group(function () {
    Route::get('/', [ProfileController::class, 'profilePage'])->name('profile');
    Route::put('/update-email', [ProfileController::class, 'updateEmail'])->name('updateEmail');
    Route::put('/update-username', [ProfileController::class, 'updateUsername'])->name('updateUsername');
});

