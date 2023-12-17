<?php

use App\Http\Controllers\EoqtableController;
use App\Http\Controllers\FoodCategoryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\FrakturBeliController;
use App\Http\Controllers\FrakturJualController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MemberController;
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

Route::controller(FoodController::class)->group(function () {
    Route::get('/foods', 'index');
    Route::get('/food/datain', 'create');
    Route::post('/food/datain', 'store');
    Route::get('/food/{food}/editdata', 'edit');
    Route::post('/food/printdel', 'printdelete');
    Route::patch('/food/{food}', 'update');
});

Route::controller(MemberController::class)->group(function () {
    Route::get('/members', 'index');
    Route::get('/member/datain', 'create');
    Route::post('/member/datain', 'store');
    Route::get('/member/{member}/editdata', 'edit');
    Route::post('/member/printdel', 'printdelete');
    Route::patch('/member/{member}', 'update');
});

Route::controller(InventoryController::class)->group(function () {
    Route::get('/inventories', 'index');
    Route::get('/inventory/datain', 'create');
    Route::post('/inventory/datain', 'store');
    Route::get('/inventory/{inventory}/editdata', 'edit');
    Route::post('/inventory/printdel', 'printdelete');
    Route::patch('/inventory/{inventory}', 'update');
});

Route::controller(SupplierController::class)->group(function () {
    Route::get('/suppliers', 'index');
    Route::get('/supplier/datain', 'create');
    Route::post('/supplier/datain', 'store');
    Route::get('/supplier/{supplier}/editdata', 'edit');
    Route::post('/supplier/printdel', 'printdelete');
    Route::patch('/supplier/{supplier}', 'update');
});

Route::controller(FrakturBeliController::class)->group(function () {
    Route::get('/buyFractures', 'index');
    Route::get('/buyFracture/datain', 'create');
    Route::post('/buyFracture/datain', 'store');
    Route::get('/buyFracture/{buyFracture}/editdata', 'edit');
    Route::post('/buyFracture/printdel', 'printdelete');
    Route::patch('/buyFracture/{buyFracture}', 'update');
});

Route::controller(FrakturJualController::class)->group(function () {
    Route::get('/sellFractures', 'index');
    Route::get('/sellFracture/datain', 'create');
    Route::post('/sellFracture/datain', 'store');
    Route::get('/sellFracture/{sellFracture}/editdata', 'edit');
    Route::post('/sellFracture/printdel', 'printdelete');
    Route::patch('/sellFracture/{sellFracture}', 'update');
});

Route::controller(ReturBeliController::class)->group(function () {
    Route::get('/buyReturns', 'index');
    Route::get('/buyReturn/datain', 'create');
    Route::post('/buyReturn/datain', 'store');
    Route::get('/buyReturn/{buyReturn}/editdata', 'edit');
    Route::post('/buyReturn/printdel', 'printdelete');
    Route::patch('/buyReturn/{buyReturn}', 'update');
});

Route::controller(ReturJualController::class)->group(function () {
    Route::get('/sellReturns', 'index');
    Route::get('/sellReturn/datain', 'create');
    Route::post('/sellReturn/datain', 'store');
    Route::get('/sellReturn/{sellReturn}/editdata', 'edit');
    Route::post('/sellReturn/printdel', 'printdelete');
    Route::patch('/sellReturn/{sellReturn}', 'update');
});

Route::controller(FoodCategoryController::class)->group(function () {
    Route::get('/foodCategories', 'index');
    Route::get('/foodCategory/datain', 'create');
    Route::post('/foodCategory/datain', 'store');
    Route::get('/foodCategory/{foodCategory}/editdata', 'edit');
    Route::post('/foodCategory/printdel', 'printdelete');
    Route::patch('/foodCategory/{foodCategory}', 'update');
});
Route::get('/', function () {
    return view('dashboard',["title"=>"Dashboard"]);
});
Route::controller(EoqtableController::class)->group(function () {
    Route::get('/', 'dashboard');
    Route::get('/eoq', 'index');
    Route::post('/eoq', 'store');
    Route::post('/eoq/updates', 'print');
    Route::post('/eoq/print', 'print');
});