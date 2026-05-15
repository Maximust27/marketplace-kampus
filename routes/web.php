<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Product\MyProduct;
use App\Livewire\Product\AddProduct;

// Landing Page tetap pakai Volt (jika belum dipisah)
Volt::route('/', 'landing')->name('landing');
Route::get('/login', Login::class)->name('login')->middleware('guest');
Route::get('/register', Register::class)->name('register')->middleware('guest');

Route::get('/my-products', MyProduct::class)->name('my-products')->middleware('auth');
Route::get('/add-product', AddProduct::class)->name('add-product')->middleware('auth');

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/'); // Kembali ke halaman utama setelah logout
})->name('logout')->middleware('auth');