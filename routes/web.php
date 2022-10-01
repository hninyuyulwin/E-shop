<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FrontendController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FrontController;
use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [FrontController::class, 'index'])->name('index');

Route::get('category', [FrontController::class, 'category'])->name('category');
Route::get('category/{category:slug}', [FrontController::class, 'fetch_by_cat'])->name('fetch_product_byCat');
Route::get('category/{category:slug}/{product:slug}', [FrontController::class, 'product_detail'])->name('product_detail');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Nav Cart Part
Route::post('addToCart', [CartController::class, 'addToCart'])->name('addToCart');
Route::delete('delete-cart-item', [CartController::class, 'deleteProduct'])->name('delete-cart-item');
Route::put('updateQtyCalc', [CartController::class, 'updateQtyCalc'])->name('updateQtyCalc');

Route::middleware(['auth'])->group(function () {
    Route::get('cart', [CartController::class, 'viewCart'])->name('cart');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [FrontendController::class, 'index'])->name('dashboard');

    Route::get('categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('categories/add-category', [CategoryController::class, 'addCat'])->name('addCat');
    Route::post('categories', [CategoryController::class, 'storeCat'])->name('storeCat');
    Route::get('categories/edit/{categories:slug}', [CategoryController::class, 'editCart'])->name('editCart');
    Route::put('categories/{categories:slug}', [CategoryController::class, 'updateCart'])->name('updateCart');
    Route::get('categories/{categories:slug}', [CategoryController::class, 'deleteCart'])->name('deleteCart');

    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::get('products/addProduct', [ProductController::class, 'addProduct'])->name('addProduct');
    Route::post('products/storeProduct', [ProductController::class, 'storeProduct'])->name('storeProduct');
    Route::get('products/editProduct/{products:slug}', [ProductController::class, 'editProduct'])->name('editProduct');
    Route::put('products/{products:slug}', [ProductController::class, 'updateProduct'])->name('updateProduct');
    Route::get('products/{products:slug}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
});
