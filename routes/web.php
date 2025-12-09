<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/




Route::get('/', function() {
    return redirect()->route('kasir.index');
});
// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
      ->name('dashboard');
      
// Produk (CRUD)
Route::resource('products', ProductController::class)->except(['show']);

// Kasir
Route::get('/kasir', [KasirController::class,'index'])->name('kasir.index');
Route::post('/kasir/add', [KasirController::class,'addToCart'])->name('kasir.add');
Route::post('/kasir/remove', [KasirController::class,'removeFromCart'])->name('kasir.remove');
Route::post('/kasir/checkout', [KasirController::class,'checkout'])->name('kasir.checkout');
Route::get('/kasir/histori', [KasirController::class, 'histori'])->name('kasir.histori');


// Transaksi detail / cetak
Route::get('/transaksi/histori', [KasirController::class, 'histori'])->name('transaksi.histori');
Route::get('/transaksi/{id}', [KasirController::class, 'showDetail'])->name('transaksi.show');
Route::get('/transaksi/{id}/cetak', [TransaksiController::class, 'cetakPdf'])->name('transaksi.cetak');
Route::get('/transaksi/{id}/print', [TransaksiController::class, 'printThermal'])->name('transaksi.print');




// Riwayat (admin)
Route::get('/riwayat', [TransaksiController::class,'index'])->name('riwayat.index');
Route::get('/riwayat/{id}', [TransaksiController::class,'show'])->name('riwayat.show');

// Laporan
Route::get('/laporan', [TransaksiController::class,'laporan'])->name('laporan.index');
Route::get('/laporan/cetak', [TransaksiController::class,'cetakLaporan'])->name('laporan.cetak');
