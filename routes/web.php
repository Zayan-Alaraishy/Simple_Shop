<?php

use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UsersRolesController;
use App\Http\Controllers\Dashboard\PermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\Profile\ProfileController;

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



Route::name('home')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/home', [ProductController::class, 'index']);
});


Route::prefix('products')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/create', [ProductController::class, 'create'])->middleware('permission:create products')->name('products.create');
    Route::post('/', [ProductController::class, 'store'])->middleware('permission:create products')->name('products.store');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->middleware('permission:edit products')->name('products.edit');
    Route::put('/{product}', [ProductController::class, 'update'])->middleware('permission:edit products')->name('products.update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->middleware('permission:delete products')->name('products.destroy');
});

Route::get('/products', [ProductController::class, 'index'])->name("products.index");
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::post('/products/{id}/ratings', [RatingController::class, 'store'])->name('products.ratings.store')->middleware(['auth', 'verified']);
Route::put('/products/{id}/ratings/{rating}', [RatingController::class, 'update'])->name('products.ratings.update')->middleware(['auth', 'verified']);
Route::delete('/products/{id}/ratings/{rating}', [RatingController::class, 'destroy'])->name('products.ratings.destroy')->middleware(['auth', 'verified']);


Route::prefix('/auth')->group(function () {
    Route::get('/signup', [AuthController::class, 'index'])->name('signup');
    Route::post('/signup', [AuthController::class, 'store']);

    Route::get('/login', [AuthController::class, 'LoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');


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
        ->middleware('auth')->name('verification.verify');

    Route::post('/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
})->middleware(['auth']);

Route::prefix('/profile')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/{id}', [ProfileController::class, 'profilePage'])->name('profile');
    Route::put('/update-profile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/toggle-account-privacy', [ProfileController::class, 'toggleAccountPrivacy'])->name('toggleAccountPrivacy');
});


Route::get('/orders', [OrderController::class, 'index'])->Middleware(['auth', 'verified'])->name('orders');
Route::post('/orders', [OrderController::class, 'store'])->Middleware(['auth', 'verified'])->name('orders.store');
Route::match(['GET', 'POST'], '/filter-orders', [OrderController::class, 'filter'])
    ->middleware(['auth', 'verified'])
    ->name('orders.filter');

Route::get('/confirm-order/{id}', [OrderController::class, 'confirm_page'])->Middleware(['auth', 'verified'])->name('confirm_order');

Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::resource('/carts', CartController::class)->except(['create', 'show', 'edit'])->middleware(['auth', 'verified']);
Route::post('/carts/bulk', [CartController::class, 'bulkUpdate'])->middleware(['auth', 'verified'])->name('carts.bulkUpdate');


Route::get('/dashboard', [UsersRolesController::class, 'index'])->name('dashboard')->middleware(['auth', 'super-admin']);

Route::group(['middleware' => ['auth', 'super-admin'], 'prefix' => 'dashboard'], function () {
    Route::resource('/permissions', PermissionController::class);
});

Route::group(['middleware' => ['auth', 'super-admin'], 'prefix' => 'dashboard'], function () {
    Route::resource('/roles', RoleController::class);
});

Route::group(['middleware' => ['auth', 'super-admin'], 'prefix' => 'dashboard'], function () {
    Route::resource('/users', UsersRolesController::class);
});

Route::resource('audit_logs', AuditLogController::class)->only(['index'])->middleware(['auth', 'super-admin']);