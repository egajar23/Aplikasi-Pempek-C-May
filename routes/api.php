<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\LaporanController;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PemesananController;
use App\Http\Controllers\Api\PromoController;
use App\Http\Controllers\Api\ShippingMethodController;
use App\Http\Controllers\Api\TestingController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ReviewController;
use App\Models\Feedback;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('pelanggan')->group(function () {
    Route::put('change-image/{id}', [PelangganController::class, 'changeImage']);
    Route::get('/', [PelangganController::class, 'index']);
    Route::get('{id}', [PelangganController::class, 'show']);
    Route::put('{id}', [PelangganController::class, 'update']);
    Route::put('update-profile/{id}', [PelangganController::class, 'updateProfile']);
    Route::put('update-address/{id}', [PelangganController::class, 'updateAddress']);
    Route::post('delete/{id}', [PelangganController::class, 'destroy']);

});
Route::prefix('products')->group(function () {
    Route::get('get-by-slug/{slug}', [ProductController::class, 'imgDetailProduct']);
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [ProductController::class, 'store']);
    Route::get('{id}', [ProductController::class, 'show']);
    Route::put('{id}', [ProductController::class, 'update']);
    Route::post('delete/{id}', [ProductController::class, 'destroy']);
});

Route::prefix('pemesanans')->group(function () {
    Route::apiResource('/', PemesananController::class);
    Route::get('/show/{id}', [PemesananController::class, 'show']);
    Route::get('detail-pemesanan/{id}', [PemesananController::class, 'detailPemesanan']);
    Route::post('/update-status/{id}', [PemesananController::class, 'updateStatus']);
    Route::post('payment-upload', [PemesananController::class, 'paymentUpload']);
    Route::get('status-pemesanan', [PemesananController::class, 'statusPemesanan']);
    Route::post('{id}/konfirmasi', [PemesananController::class, 'konfirmasi']);
    Route::post('{id}/batal', [PemesananController::class, 'batal']);
    Route::post('/delete/{id}', [PemesananController::class, 'destroy']);
});

Route::apiResource('promos', PromoController::class);
Route::prefix('promos')->group(function () {
    Route::get('/', [PromoController::class, 'index']);
    Route::post('/', [PromoController::class, 'store']);
    Route::get('{id}', [PromoController::class, 'show']);
    Route::put('{id}', [PromoController::class, 'update']);
    Route::post('/delete/{id}', [PromoController::class, 'destroy']);
});

Route::get('/shipping-methods', [ShippingMethodController::class, 'index']);
Route::get('/shipping-rates', [ShippingMethodController::class, 'getRate']);

Route::prefix('cart')->group(function () {
    Route::post('add', [CartController::class, 'addItem']);
    Route::post('update-quantity', [CartController::class, 'updateQuantity']);
    Route::post('apply-promo', [CartController::class, 'applyPromo']);
    Route::post('remove/{id}', [CartController::class, 'removeItem']);
    Route::post('remove-multiple-item', [CartController::class, 'removeMultipleItem']);
    Route::get('/', [CartController::class, 'listCart']);
    Route::get('count', [CartController::class, 'getCartCount']);
    Route::post('checkout', [CartController::class, 'checkout']);

});

Route::get('/show-reviews', [ReviewController::class, 'index']);
Route::post('/add-reviews', [ReviewController::class, 'store']);

Route::get('/show-feedback', [FeedbackController::class, 'index']);
Route::post('/add-feedback', [FeedbackController::class, 'store']);

Route::get('/report-monthly', [LaporanController::class, 'index']);

Route::get('/testing', [TestingController::class, 'index']);