<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FrontendController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [FrontendController::class, 'index'])->name('dashboard');

    Route::get('categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('categories/add-category', [CategoryController::class, 'addCat'])->name('addCat');
    Route::post('categories', [CategoryController::class, 'storeCat'])->name('storeCat');
    Route::get('categories/edit/{categories:slug}', [CategoryController::class, 'editCart'])->name('editCart');
    Route::put('categories/{categories:slug}', [CategoryController::class, 'updateCart'])->name('updateCart');
    Route::get('categories/{categories:slug}', [CategoryController::class, 'deleteCart'])->name('deleteCart');
});
