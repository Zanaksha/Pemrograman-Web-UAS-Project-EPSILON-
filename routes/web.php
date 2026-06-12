<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ModelsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WarrantyController;

Route::get('/warranties', [WarrantyController::class, 'index']);
Route::post('/warranties/check', [WarrantyController::class, 'check'])->name('warranty.check');

Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/cars', [AdminController::class, 'cars'])->name('admin.cars');
    Route::get('/cars/create', [AdminController::class, 'carCreate'])->name('admin.cars.create');
    Route::post('/cars', [AdminController::class, 'carStore'])->name('admin.cars.store');
    Route::get('/cars/{id}/edit', [AdminController::class, 'carEdit'])->name('admin.cars.edit');
    Route::put('/cars/{id}', [AdminController::class, 'carUpdate'])->name('admin.cars.update');
    Route::delete('/cars/{id}', [AdminController::class, 'carDestroy'])->name('admin.cars.destroy');

    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/create', [AdminController::class, 'productCreate'])->name('admin.products.create');
    Route::post('/products', [AdminController::class, 'productStore'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'productEdit'])->name('admin.products.edit');
    Route::put('/products/{id}', [AdminController::class, 'productUpdate'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminController::class, 'productDestroy'])->name('admin.products.destroy');

    Route::get('/messages', [AdminController::class, 'messages'])->name('admin.messages');
    Route::delete('/messages/{id}', [AdminController::class, 'messageDestroy'])->name('admin.messages.destroy');

    Route::get('/warranties', [AdminController::class, 'warranties'])->name('admin.warranties');
    Route::get('/warranties/create', [AdminController::class, 'warrantyCreate'])->name('admin.warranties.create');
    Route::post('/warranties', [AdminController::class, 'warrantyStore'])->name('admin.warranties.store');
    Route::get('/warranties/{id}/edit', [AdminController::class, 'warrantyEdit'])->name('admin.warranties.edit');
    Route::put('/warranties/{id}', [AdminController::class, 'warrantyUpdate'])->name('admin.warranties.update');
    Route::delete('/warranties/{id}', [AdminController::class, 'warrantyDestroy'])->name('admin.warranties.destroy');
    Route::post('/warranties/{id}/service', [AdminController::class, 'serviceStore'])->name('admin.service.store');
});
 
Route::get('/models', [CarController::class, 'index']);

Route::post('/contactinfo', [MessageController::class, 'store'])->name('message.store');

Route::get('/brochure/{slug}', [CarController::class, 'brochure'])->name('brochure');

Route::get('/', function () {   
    return view('home'); 
});

Route::get('/about', function () { 
    return view('about'); 
});

Route::get('/buycar', [CarController::class, 'buycar']);

// Route::get('/models', function () { 
//     return view('models'); 
// });

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

Route::get('/m3', function () { 
    return view('m3');
});

// Route::get('/choosebuy', function () { 
//     return view('choosebuy'); 
// });

Route::get('/choosebuy', [AdminController::class, 'shop']);

Route::get('/finddealer', function () { 
    return view('finddealer'); 
});

Route::get('/shop', function () { 
    return view('shop'); 
});

// Route::get('/buycar', function () { 
//     return view('buycar'); 
// });

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

Route::get('/warranty', function () { 
    return view('warranty'); 
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