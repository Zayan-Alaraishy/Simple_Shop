<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\EmailVerificationController;
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


// Route::post('/product/{id}/rate', [RatingController::class, 'store'])->name('product.rate.store');


Route::get('/products/edit', [ProductController::class, 'edit']);
Route::resource('/products', ProductController::class)->except(['index', 'show'])->middleware(['auth', 'verified', 'admin']);
Route::get('/products', [ProductController::class, 'index'])->name("products.index");
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
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
    Route::put('/update-email', [ProfileController::class, 'updateEmail'])->name('updateEmail');
    Route::put('/update-username', [ProfileController::class, 'updateUsername'])->name('updateUsername');
    Route::post('/toggle-account-privacy', [ProfileController::class, 'toggleAccountPrivacy'])->name('toggleAccountPrivacy');
});

Route::view('/about', 'about')->name('about');
Route::view('/cart', 'cart')->name('cart');
Route::view('/contact', 'contact')->name('contact');
Route::view('/products/{product}', 'products.product-detail')->name('product');