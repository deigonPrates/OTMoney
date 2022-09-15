<?php

use App\Http\Controllers\ChargeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentMethodController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('home',      [HomeController::class, 'index'])->name('home');

    Route::resource('charge',         ChargeController::class);
    Route::resource('payment-method', PaymentMethodController::class);

    Route::group(['prefix' => 'list'], function () {
        Route::get('charge',          [ChargeController::class, 'list'])->name('charge.list');
        Route::get('payment-method',  [PaymentMethodController::class, 'list'])->name('payment-method.list');
    });

});
