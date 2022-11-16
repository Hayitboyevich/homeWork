<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepositsController;
use App\Http\Controllers\WalletsController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UsersController;

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

Route::view('/', 'welcome')->name('login.form');

Auth::routes();

Route::post('register', [AuthController::class, 'register'])->name('registerForm');
Route::post('login', [AuthController::class, 'login'])->name('loginForm');
Route::get('/user', [UsersController::class, 'index'])->name('users.index');


Route::group([
    'middleware' => 'auth'
], function (){
    Route::get('/deposit', [DepositsController::class, 'index'])->name('deposit.index');
    Route::post('/deposit/store', [DepositsController::class, 'store'])->name('deposit.store');

    Route::get('/transaction', [TransactionsController::class, 'index'])->name('transaction.index');


    Route::get('/wallet', [WalletsController::class, 'index'])->name('wallet.index');
    Route::post('/wallet/store', [WalletsController::class, 'store'])->name('wallet.store');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


});











