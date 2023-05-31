<?php

use App\Http\Controllers\DashboardController;
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


route::resource('/dashboard', DashboardController::class)->middleware('auth');
Route::get('/',[\App\Http\Controllers\LandingController::class, 'index']);
Route::get('/search',[\App\Http\Controllers\LandingController::class, 'search'])->name('search');
Auth::routes();

// Menampilkan daftar role
Route::get('/roles', [\App\Http\Controllers\RoleController::class, 'index'])->middleware('auth','admin')->name('roles.index');
Route::get('/roles/create', [\App\Http\Controllers\RoleController::class, 'create'])->middleware('auth','admin')->name('roles.create');
Route::post('/roles/store', [\App\Http\Controllers\RoleController::class, 'store'])->middleware('auth','admin')->name('roles.store');
Route::get('/roles/{role}/edit', [\App\Http\Controllers\RoleController::class, 'edit'])->middleware('auth','admin')->name('roles.edit');
Route::put('/roles/{role}/update', [\App\Http\Controllers\RoleController::class, 'update'])->middleware('auth','admin')->name('roles.update');
Route::delete('/roles/{role}/destroy', [\App\Http\Controllers\RoleController::class, 'destroy'])->middleware('auth','admin')->name('roles.destroy');


// Menampilkan daftar kategori
Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])->middleware('auth','admin')->name('categories.index');
Route::get('/categories/create', [\App\Http\Controllers\CategoryController::class, 'create'])->middleware('auth','admin')->name('categories.create');
Route::post('/categories/store', [\App\Http\Controllers\CategoryController::class, 'store'])->middleware('auth','admin')->name('categories.store');
Route::get('/categories/{category}/edit', [\App\Http\Controllers\CategoryController::class, 'edit'])->middleware('auth','admin')->name('categories.edit');
Route::put('/categories/{category}/update', [\App\Http\Controllers\CategoryController::class, 'update'])->middleware('auth','admin')->name('categories.update');
Route::delete('/categories/{category}/destroy', [\App\Http\Controllers\CategoryController::class, 'destroy'])->middleware('auth','admin')->name('categories.destroy');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Menampilkan daftar pengguna
Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->middleware('auth','admin')->name('users.index');
Route::get('/users/create', [\App\Http\Controllers\UserController::class, 'create'])->middleware('auth','admin')->name('users.create');
Route::post('/users/store', [\App\Http\Controllers\UserController::class, 'store'])->middleware('auth','admin')->name('users.store');
Route::get('/users/{user}', [\App\Http\Controllers\UserController::class, 'show'])->middleware('auth','admin')->name('users.show');
Route::get('/users/{user}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->middleware('auth','admin')->name('users.edit');
Route::put('/users/{user}/update', [\App\Http\Controllers\UserController::class, 'update'])->middleware('auth','admin')->name('users.update');
Route::delete('/users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->middleware('auth','admin')->name('users.destroy');



Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);


// Menampilkan daftar produk
Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->middleware('auth')->name('products.index');

// Menampilkan formulir tambah produk
Route::get('/products/create', [\App\Http\Controllers\ProductController::class, 'create'])->middleware('auth')->name('products.create');
Route::post('/products/store', [\App\Http\Controllers\ProductController::class, 'store'])->middleware('auth')->name('products.store');
Route::get('/products/{product}', [\App\Http\Controllers\ProductController::class, 'show'])->middleware('auth','admin')->name('products.show');
Route::get('/products/{product}/edit', [\App\Http\Controllers\ProductController::class, 'edit'])->middleware('auth','admin')->name('products.edit');
Route::put('/products/{product}/update', [\App\Http\Controllers\ProductController::class, 'update'])->middleware('auth','admin')->name('products.update');
Route::delete('/products/{product}', [\App\Http\Controllers\ProductController::class, 'destroy'])->middleware('auth','admin')->name('products.destroy');



// Menampilkan daftar slider
Route::get('/sliders', [\App\Http\Controllers\SliderController::class, 'index'])->middleware('auth')->name('sliders.index');
Route::get('/sliders/create', [\App\Http\Controllers\SliderController::class, 'create'])->middleware('auth')->name('sliders.create');
Route::post('/sliders', [\App\Http\Controllers\SliderController::class, 'store'])->middleware('auth','admin')->name('sliders.store');
Route::get('/sliders/{slider}', [\App\Http\Controllers\SliderController::class, 'show'])->middleware('auth','admin')->name('sliders.show');
Route::get('/sliders/{slider}/edit', [\App\Http\Controllers\SliderController::class, 'edit'])->middleware('auth','admin')->name('sliders.edit');
Route::put('/sliders/{slider}', [\App\Http\Controllers\SliderController::class, 'update'])->middleware('auth','admin')->name('sliders.update');
Route::delete('/sliders/{slider}', [\App\Http\Controllers\SliderController::class, 'destroy'])->middleware('auth','admin')->name('sliders.destroy');



