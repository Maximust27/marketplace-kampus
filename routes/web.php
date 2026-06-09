<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Product\MyProduct;
use App\Livewire\Product\AddProduct;
use App\Livewire\Product\ProductDetail;
use App\Livewire\Product\AllProduct;
use App\Livewire\Cart\Cart;
use App\Livewire\Order\MyOrder;
use App\Livewire\Message\Inbox;

// Landing Page tetap pakai Volt (jika belum dipisah)
Volt::route('/', 'landing')->name('landing');
Route::get('/login', Login::class)->name('login')->middleware('guest');
Route::get('/register', Register::class)->name('register')->middleware('guest');

Route::get('/my-products', MyProduct::class)->name('my-products')->middleware('auth');
Route::get('/add-product/{slug?}', AddProduct::class)->name('add-product')->middleware('auth');
Route::get('/products/{slug}', ProductDetail::class)->name('detail-product'); 
Route::get('/products', AllProduct::class)->name('products');
Route::get('/cart', Cart::class)->name('cart')->middleware('auth');
Route::get('/my-orders', MyOrder::class)->name('my-orders')->middleware('auth');
Route::get('/messages', Inbox::class)->name('messages')->middleware('auth');

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/'); // Kembali ke halaman utama setelah logout
})->name('logout')->middleware('auth');