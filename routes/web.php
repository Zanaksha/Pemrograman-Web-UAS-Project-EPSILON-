<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {   
    return view('home'); 
});

Route::get('/about', function () { 
    return view('about'); 
});

Route::get('/models', function () { 
    return view('models'); 
});

Route::get('/ix', function () { 
    return view('ix'); 
});

Route::get('/ix1', function () { 
    return view('ix1'); 
});

Route::get('/i7', function () { 
    return view('i7'); 
});

Route::get('/i4', function () { 
    return view('i4');
});

Route::get('/xm', function () { 
    return view('xm'); 
});

Route::get('/x5', function () { 
    return view('x5'); 
});

Route::get('/x3', function () { 
    return view('x3'); 
});

Route::get('/7', function () { 
    return view('7'); 
});

Route::get('/i5', function () { 
    return view('i5');
});

Route::get('/choosebuy', function () { 
    return view('choosebuy'); 
});

Route::get('/finddealer', function () { 
    return view('finddealer'); 
});

Route::get('/shop', function () { 
    return view('shop'); 
});

Route::get('/buycar', function () { 
    return view('buycar'); 
});

Route::get('/customer', function () { 
    return view('customer'); 
});

Route::get('/contactinfo', function () { 
    return view('contactinfo'); 
});

Route::get('/shop2', function () { 
    return view('shop2'); 
});

Route::get('/shop3', function () { 
    return view('shop3'); 
});

Route::get('/shop4', function () { 
    return view('shop4'); 
});

Route::get('/shop5', function () { 
    return view('shop5'); 
});

Route::get('/shop6', function () { 
    return view('shop6'); 
});

Route::get('/shop7', function () { 
    return view('shop7'); 
});

Route::get('/shop8', function () { 
    return view('shop8'); 
});

Route::get('/shop9', function () { 
    return view('shop9'); 
});

Route::get('/assistant', function () { 
    return view('assistant'); 
});

Route::get('/warranties', function () { 
    return view('warranties'); 
});

Route::get('/sneakers', function () { 
    return view('sneakers'); 
});

Route::get('/hoodie', function () { 
    return view('hoodie'); 
});

Route::get('/watch', function () { 
    return view('watch'); 
});

Route::get('/tshirt', function () { 
    return view('tshirt'); 
});

Route::get('/jacket', function () { 
    return view('jacket'); 
});

Route::get('/running', function () { 
    return view('running'); 
});

Route::get('/running-shoes', function () { 
    return view('running-shoes'); 
});

Route::get('/beli', [ProdukController::class, 'buyer'])->name('buyer');

Route::get('/detail', [ProdukController::class, 'detail'])->name('detail');

Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';