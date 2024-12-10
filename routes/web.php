<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/landing');
});

// Sisi Guest
    Route::get('/landing',[LandingController::class, 'index']);
//ini route untuk otorisasi
    Route::controller(LoginController::class)->group(function(){
        Route::get('/login','index')->name('login')->middleware('guest');
        Route::get('/register','registrationView')->name('register')->middleware('guest');
        Route::post('/login','authenticate');
        Route::post('/register','register');
        Route::post('/logout','logout');
    });
// Akses Dashboard (Penjual & Pembeli)
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
//ini route untuk sisi admin
    // Khusus Tabel
    Route::group([],function(){
        Route::resource('/table/profile', ProfileController::class)->middleware('admin');
        Route::resource('/table/barang', BarangController::class)->middleware('admin');
    });
    // Khusus Transaksi
    Route::group([],function(){
        // Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('admin');
        Route::resource('/transaction/order', OrderController::class)->middleware('admin');
        Route::resource('/transaction/checkout', PesananController::class)->middleware('admin');
    });

//ini route untuk sisi pembeli

// Route::get('/order',[OrderController::class,'OrderPembeli'])->middleware('auth');

Route::group([],function(){
    Route::get('/order',[CheckOutController::class,'index'])->middleware('auth');
    Route::get('/order/create',[CheckOutController::class,'create'])->middleware('admin');
    Route::post('/order',[KatalogController::class,'store'])->middleware('auth');
    Route::post('/order/store',[CheckOutController::class,'store'])->middleware('auth');
    Route::put('/order/update',[CheckOutController::class,'update'])->middleware('auth');
    Route::get('/order/destroy',[OrderController::class,'destroy'])->middleware('auth');
});
Route::group([],function(){
    Route::get('/wishlist',[WishlistController::class,'index']);
    Route::get('/wishlist/create',[WishlistController::class,'create']);
})->middleware('member');










