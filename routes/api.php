<?php

use App\Http\Controllers\CurrencyCombinationController;
use App\Http\Controllers\PaymentMethodController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('currency/origin',       [CurrencyCombinationController::class, 'origin'])->name('currency.search.origin');
Route::get('currency/destiny',      [CurrencyCombinationController::class, 'destiny'])->name('currency.search.destiny');
Route::get('payment-method/search', [PaymentMethodController::class, 'search'])->name('payment.method.search');
