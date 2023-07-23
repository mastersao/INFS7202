<?php

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
// use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\LoginWithGoogleController;
use App\Http\Controllers\AvatarController;
// use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\DropzoneController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\TwoFactorAuthController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\GoogleOCRController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Auth::routes(['verify' => true]);
Auth::routes();

Route::get('/', [PostController::class, 'index'])->name('/');


Route::get('/posts/{post:title}', function(Post $post) {
    return view('post', ['post' => $post]);
});


Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);


Route::get('/categories/{category:slug}', function(Category $category) {
    return view('posts', ['posts' => $category->posts]);
});

Route::get('/thread', [ThreadController::class, 'newThread'])->name('thread');
Route::post('/thread/create', [ThreadController::class, 'create'])->name('thread.create');
Route::post('/thread/upload-file', [DropzoneController::class, 'store'])->name('dropzone.store');

Route::get('/authors/{author:name}', function(User $author) {
    return view('posts', ['posts' => $author->posts]);
});


Route::get('/search', [PostController::class, 'search'])->name('posts.search');
Route::get('/autocomplete', [PostController::class, 'autocomplete'])->name('posts.autocomplete');

Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
Route::get('/watermark', [DashboardController::class, 'imageUpload'])->name('image.upload');
Route::post('/add-watermark', [DashboardController::class, 'addWatermark'])->name('image.watermark');

Route::get('/google/redirect', [LoginWithGoogleController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [LoginWithGoogleController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/update-avatar', [AvatarController::class, 'showUpdateForm'])->name('update-avatar');
Route::post('/change-avatar', [AvatarController::class, 'updateAvatar'])->name('change-avatar');
Route::get('/update-details', [AvatarController::class, 'show'])->name('update-details');
Route::post('/change-details', [AvatarController::class, 'updateDetails'])->name('change-details');


// Route::get('/email_verification_required', [SendEmailController::class, 'emailVerificationRequired'])->name('email-verification-required');

Route::get('/stripe', [StripePaymentController::class, 'show'])->name('stripe');
Route::post('/checkout', [StripePaymentController::class, 'checkout'])->name('stripe.checkout');

Route::get('/dropzone', [DropzoneController::class, 'dropzone'])->name('dropzone');
Route::post('/dropzone/store', [DropzoneController::class, 'dropzoneStore'])->name('dropzone.store');
Route::post('/dropzone/refresh', [DropzoneController::class, 'refresh'])->name('dropzone.refresh');;



Route::get('google-ocr', [GoogleOCRController::class, 'index'])->name('google-ocr-index');
Route::post('google-ocr', [GoogleOCRController::class, 'submit'])->name('google-ocr-submit');



Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect()->route('dashboard')->with('success', 'Email has been verified!');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
// });

// Login and register part
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('regi');
Route::get('/complete-registration', [RegisterController::class, 'completeRegistration'])->name('complete.registration');

Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/two-factor', function () {
    return view('two-factor');
})->name('two-factor')->middleware(['auth', 'verified']);


// Route::middleware(['2fa'])->group(function () {
//     Route::get('/two-factor', function () {
//         return view('two-factor');
//     })->name('two-factor');
    
//     Route::post('/2fa', function () {
//         return redirect(route('two-factor'));
//     })->name('2fa');
// });
  
// Route::get('/complete-registration', [RegisterController::class, 'completeRegistration'])->name('complete.registration');
// Route::post('/2fa-confirm', [TwoFactorAuthController::class, 'confirm'])->name('two-factor.confirm');



Route::get('/password/reset', [ResetPasswordController::class, 'showLinkRequestForm'])
    ->middleware('guest')
    ->name('none.request');

Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->middleware('guest')
    ->name('none.email');

Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->middleware('guest')
    ->name('none.reset');

Route::post('/password/reset', [ResetPasswordController::class, 'reset'])
    ->middleware('guest')
    ->name('none.update');

