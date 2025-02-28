<?php

use App\Http\Controllers\Api\LaporanController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PemesananController;

use function Pest\Laravel\post;

Route::get('/', function () {
    return view('landing_page');
});

Route::get('/menu', function () {
    return view('menu_page');
});

Route::get('/about', function () {
    return view('about_page');
});

Route::get('/contact-us', function () {
    return view('contact_us_page');
});

Route::get('/menu/{slug}', function ($slug) {
    
    $product = Product::find($slug);
    return view('list_produk_page', ['product' => $product]);
});

Route::get('/cart/pengiriman/{pemesanan_id}', function () {
    return view('checkout_page')->with('pemesanan_id', request('pemesanan_id'));
});

Route::get('/cart/pembayaran/{pemesanan_id}', function () {
    return view('payment_page')->with('pemesanan_id', request('pemesanan_id'));
});





Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile_page');
    });
    
    Route::group(['prefix' => 'admin/product'], function () {

        Route::get('/', function () {
            return view('admin.product');
        })->name('admin.product');
    });
    Route::group(['prefix' => 'admin/pemesanan'], function () {
        Route::get('/', function () {
            return view('admin.pemesanan.index');
        })->name('admin.pemesanan');
        Route::get('{id}', [PemesananController::class, 'detail'])->name('admin.pemesanan.detail');
       
    });
    Route::group(['prefix' => 'admin/promo'], function () {

        Route::get('/', function () {
            return view('admin.promo');
        })->name('admin.promo');
        
    });
    Route::group(['prefix' => 'admin/pelanggan'], function () {

        Route::get('/', function () {
            return view('admin.pelanggan');
        })->name('admin.pelanggan');
    
    });

    Route::group(['prefix' => 'admin/laporan'], function () {

        Route::get('/', function () {
            return view('admin.laporan');
        })->name('admin.laporan');

        Route::get('/unduh', [LaporanController::class, 'downloadPdf'])->name('admin.laporan.unduh');
    
    });

    Route::group(['prefix' => 'admin/feedback'], function () {

        Route::get('/', function () {
            return view('admin.feedback');
        })->name('admin.feedback');
    
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('detail-order/{pemesanan_id}', function () {
            return view('order_detail_page')->with('pemesanan_id', request('pemesanan_id'));
        });    
        Route::get('history', function () {
            return view('order_history_page');
        });
    });

    Route::get('/cart', function () {
        return view('cart_page');
    });

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
