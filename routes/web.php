<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FrontendController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontController;
use App\Http\Controllers\Frontend\RatingController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\WishlistController;
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

//productSearch
Route::get('product_list', [FrontController::class, 'productlistAjax'])->name('product_list');
Route::get('searchProduct', [FrontController::class, 'searchProduct'])->name('searchProduct');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Nav Cart Part
Route::post('addToCart', [CartController::class, 'addToCart'])->name('addToCart');
Route::delete('delete-cart-item', [CartController::class, 'deleteProduct'])->name('delete-cart-item');
Route::put('updateQtyCalc', [CartController::class, 'updateQtyCalc'])->name('updateQtyCalc');

//Wishlist add & delete
Route::post('addToWishlist', [WishlistController::class, 'addToWishlist'])->name('addToWishlist');
Route::delete('wishlistDelete', [WishlistController::class, 'wishlistDelete'])->name('wishlistDelete');

//Cart & Wishlist Count
Route::get('cart-count', [CartController::class, 'cartCount']);
Route::get('wishlist-count', [WishlistController::class, 'wishlistCount']);

Route::middleware(['auth'])->group(function () {
    Route::get('cart', [CartController::class, 'viewCart'])->name('cart');
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('place-order', [CheckoutController::class, 'placeOrder'])->name('place-order');

    Route::get('my-orders', [UserController::class, 'index'])->name('my-orders');
    Route::get('view-order/{id}', [UserController::class, 'viewOrder'])->name('Userview-order');

    //Wishlist Part
    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist');

    //Payment gateways
    Route::post('proceed-to-pay', [CheckoutController::class, 'razorPayCheck']);

    //Product Rating
    Route::post('add-rating', [RatingController::class, 'add'])->name('add-rating');

    //Review Giving
    Route::get('add-review/{slug}', [ReviewController::class, 'index'])->name('add-review');
    Route::post('post-review', [ReviewController::class, 'postReview'])->name('post-review');
    Route::get('edit-review/{slug}', [ReviewController::class, 'editReview'])->name('edit-review');
    Route::put('update-review', [ReviewController::class, 'updateReview'])->name('update-review');
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

    //Order Part
    Route::get('orders', [OrderController::class, 'index'])->name('orders');
    Route::get('orders/view-order/{id}', [OrderController::class, 'viewOrder'])->name('view-order');
    Route::put('orders/update-order/{id}', [OrderController::class, 'updateOrderStatus'])->name('update-order-status');
    Route::get('orders/order-histroy', [OrderController::class, 'orderHistroy'])->name('order-histroy');

    Route::get('users', [DashboardController::class, 'users'])->name('users');
    Route::get('users/view-user/{id}', [DashboardController::class, 'viewUser'])->name('view-user');
});
