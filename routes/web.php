<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return 'About page';
});

Route::get('/products', [ProductController::class,'index'])->name('products.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/create', [ProductController::class, 'create'])->middleware('admin')->name('products.create');
Route::post('products', [ProductController::class, 'store'])->middleware('admin')->name('products.store');
Route::get('products/{product:id}/edit', [ProductController::class, 'edit'])->middleware('admin')->name('products.edit');
Route::put('products/{product:id}', [ProductController::class, 'update'])->middleware('admin')->name('products.update');
Route::delete('products/{product:id}', [ProductController::class, 'destroy'])->middleware('admin')->name('products.destroy');


require __DIR__ . '/auth.php';
