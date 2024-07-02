<?php

use App\Http\Controllers\EoqtableController;
use App\Http\Controllers\FoodCategoryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\FrakturBeliController;
use App\Http\Controllers\FrakturJualController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReturBeliController;
use App\Http\Controllers\ReturJualController;
use App\Http\Controllers\SupplierController;
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

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->middleware('guest')->name('login');
    Route::post('/login', 'authenticate')->middleware('guest');
    Route::post('/logout', 'logout');
});
Route::controller(RegisterController::class)->group(function () {
    Route::get('/regist', 'index')->middleware('guest');
    Route::post('/regist', 'store')->middleware('guest');
});

Route::controller(FoodController::class)->group(function () {
    Route::get('/foods', 'index')->middleware('auth');
    Route::get('/food/datain', 'create')->middleware('auth');
    Route::post('/food/datain', 'store')->middleware('auth');
    Route::get('/food/{food}/editdata', 'edit')->middleware('auth');
    Route::post('/food/printdel', 'printdelete')->middleware('auth');
    Route::patch('/food/{food}', 'update')->middleware('auth');
});

Route::controller(MemberController::class)->group(function () {
    Route::get('/members', 'index')->middleware('auth');
    Route::get('/member/datain', 'create')->middleware('auth');
    Route::post('/member/datain', 'store')->middleware('auth');
    Route::get('/member/{member}/editdata', 'edit')->middleware('auth');
    Route::post('/member/printdel', 'printdelete')->middleware('auth');
    Route::patch('/member/{member}', 'update')->middleware('auth');
});

Route::controller(InventoryController::class)->group(function () {
    Route::get('/inventories', 'index')->middleware('auth');
    Route::get('/inventory/datain', 'create')->middleware('auth');
    Route::post('/inventory/datain', 'store')->middleware('auth');
    Route::get('/inventory/{inventory}/editdata', 'edit')->middleware('auth');
    Route::post('/inventory/printdel', 'printdelete')->middleware('auth');
    Route::patch('/inventory/{inventory}', 'update')->middleware('auth');
});

Route::controller(SupplierController::class)->group(function () {
    Route::get('/suppliers', 'index')->middleware('auth');
    Route::get('/supplier/datain', 'create')->middleware('auth');
    Route::post('/supplier/datain', 'store')->middleware('auth');
    Route::get('/supplier/{supplier}/editdata', 'edit')->middleware('auth');
    Route::post('/supplier/printdel', 'printdelete')->middleware('auth');
    Route::patch('/supplier/{supplier}', 'update')->middleware('auth');
});

Route::controller(FrakturBeliController::class)->group(function () {
    Route::get('/buyFractures', 'index')->middleware('auth');
    Route::get('/buyFracture/datain', 'create')->middleware('auth');
    Route::post('/buyFracture/datain', 'store')->middleware('auth');
    Route::get('/buyFracture/{buyFracture}/editdata', 'edit')->middleware('auth');
    Route::get('/buyFracture/{buyFracture}/show', 'show')->middleware('auth');
    Route::get('/buyFracture/{buyFracture}/print', 'print')->middleware('auth');
    Route::post('/buyFracture/printdel', 'printdelete')->middleware('auth');
    Route::patch('/buyFracture/{buyFracture}', 'update')->middleware('auth');
});

Route::controller(FrakturJualController::class)->group(function () {
    Route::get('/sellFractures', 'index')->middleware('auth');
    Route::get('/sellFracture/datain', 'create')->middleware('auth');
    Route::post('/sellFracture/datain', 'store')->middleware('auth');
    Route::get('/sellFracture/{sellFracture}/editdata', 'edit')->middleware('auth');
    Route::get('/sellFracture/{sellFracture}/show', 'show')->middleware('auth');
    Route::get('/sellFracture/{sellFracture}/print', 'print')->middleware('auth');
    Route::post('/sellFracture/printdel', 'printdelete')->middleware('auth');
    Route::patch('/sellFracture/{sellFracture}', 'update')->middleware('auth');
});

Route::controller(ReturBeliController::class)->group(function () {
    Route::get('/buyReturns', 'index')->middleware('auth');
    Route::get('/buyReturn/datain', 'create')->middleware('auth');
    Route::post('/buyReturn/datain', 'store')->middleware('auth');
    Route::get('/buyReturn/{buyReturn}/editdata', 'edit')->middleware('auth');
    Route::post('/buyReturn/printdel', 'printdelete')->middleware('auth');
    Route::patch('/buyReturn/{buyReturn}', 'update')->middleware('auth');
});

Route::controller(ReturJualController::class)->group(function () {
    Route::get('/sellReturns', 'index')->middleware('auth');
    Route::get('/sellReturn/datain', 'create')->middleware('auth');
    Route::post('/sellReturn/datain', 'store')->middleware('auth');
    Route::get('/sellReturn/{sellReturn}/editdata', 'edit')->middleware('auth');
    Route::post('/sellReturn/printdel', 'printdelete')->middleware('auth');
    Route::patch('/sellReturn/{sellReturn}', 'update')->middleware('auth');
});

Route::controller(FoodCategoryController::class)->group(function () {
    Route::get('/foodCategories', 'index')->middleware('auth');
    Route::get('/foodCategory/datain', 'create')->middleware('auth');
    Route::post('/foodCategory/datain', 'store')->middleware('auth');
    Route::get('/foodCategory/{foodCategory}/editdata', 'edit')->middleware('auth');
    Route::post('/foodCategory/printdel', 'printdelete')->middleware('auth');
    Route::patch('/foodCategory/{foodCategory}', 'update')->middleware('auth');
});
Route::controller(EoqtableController::class)->group(function () {
    Route::get('/', 'dashboard')->middleware('auth');
    Route::get('/eoq', 'index')->middleware('auth');
    Route::post('/eoq', 'updateEoq')->middleware('auth');
    Route::get('/printqr/{catch}', 'printQR')->middleware('auth');
    Route::post('/eoq/print', 'print')->middleware('auth');
});