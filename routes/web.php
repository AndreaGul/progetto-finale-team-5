<?php

use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProfessionalController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SponsorizationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Braintree\Gateway;


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

Route::middleware('auth', 'verified')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::resource('info', ProfessionalController::class);
        Route::resource('messages', MessageController::class);
        Route::resource('reviews', ReviewController::class);
        Route::get('sponsorization', [SponsorizationController::class, 'index'])->name('sponsorization');
        Route::get('/checkout', function () {
            $gateway = new Gateway([
                'environment' => env('BRAINTREE_ENV'),
                'merchantId' => env('BRAINTREE_MERCHANT_ID'),
                'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
                'privateKey' => env('BRAINTREE_PRIVATE_KEY')
            ]);

            $clientToken = $gateway->clientToken()->generate();

            return view('admin.payment.checkout', compact('clientToken'))->with('request', request());
        })->name('prova');
        Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
    });
require __DIR__ . '/auth.php';
