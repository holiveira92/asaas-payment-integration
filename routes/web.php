<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\CustomersController;

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
    return redirect()->route('payments');
});

Route::prefix('/payments')->group(function () {
    Route::get('/', [PaymentsController::class, 'index'])->name('payments');
    Route::get('/show/{paymentMethodName}', [PaymentsController::class, 'showByMethod'])->name('payments.show.showByMethod');
    Route::get('/create', [PaymentsController::class, 'create'])->name('payments.create');
    Route::get('/createBy/{paymentMethodName}', [PaymentsController::class, 'createByType'])->name('payments.createBy');
    Route::get('/thankYou/{payment}', [PaymentsController::class, 'thankYou'])->name('payments.thankYou');
});

Route::prefix('/customers')->group(function () {
    Route::get('/', [CustomersController::class, 'index'])->name('customers');
});
