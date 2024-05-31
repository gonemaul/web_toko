<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

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
    return view('login');
})->name('login')->middleware('guest');

Route::POST('/login', [UserController::class,'authenticate'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/dashboard/load', [DashboardController::class, 'load'])->middleware('auth');

Route::get('/data-barang', [InventoryController::class, 'index'])->middleware('auth');
Route::get('/data-barang/load/{request}', [InventoryController::class,'loadFile'])->middleware('auth');
Route::get('/data-barang/create', [InventoryController::class,'create'])->middleware('auth');
Route::post('/data-barang', [InventoryController::class,'store'])->middleware('auth');
Route::get('/data-barang/{inventory:id_barang}/delete', [InventoryController::class,'destroy'])->middleware('auth');
Route::get('/data-barang/edit/{inventory:id_barang}', [InventoryController::class,'edit'])->middleware('auth');
Route::post('/data-barang/{inventory:id_barang}/update', [InventoryController::class,'update'])->middleware('auth');

Route::get('/data-penjualan', [SaleController::class,'index'])->middleware('auth');
Route::get('/data-penjualan/loadSummary ', [SaleController::class,'loadSummary'])->middleware('auth');
Route::GET('/data-penjualan/detail/{id} ', [SaleController::class,'loadDetail'])->middleware('auth');
Route::get('/data-penjualan/load ', [SaleController::class,'loadFile'])->middleware('auth');
Route::post('/data-penjualan/summary ', [SaleController::class,'save'])->middleware('auth');
Route::get('/data-penjualan/create ', [SaleController::class,'create'])->middleware('auth');
Route::POST('/data-penjualan ', [SaleController::class,'add'])->middleware('auth');

Route::get('/supply-barang', [BuyController::class, 'index'])->middleware('auth');
Route::get('/supply-barang/loadSummary', [BuyController::class, 'loadSummary'])->middleware('auth');
Route::GET('/supply-barang/detail/{id} ', [BuyController::class,'loadDetail'])->middleware('auth');
Route::get('/supply-barang/create', [BuyController::class, 'create'])->middleware('auth');
Route::get('/supply-barang/add/form', [BuyController::class, 'form'])->middleware('auth');
Route::get('/supply-barang/add/load', [BuyController::class, 'loadAdd'])->middleware('auth');
Route::POST('/supply-barang/add/store', [BuyController::class, 'store'])->middleware('auth');
Route::POST('/supply-barang/add/save', [BuyController::class, 'save'])->middleware('auth');
