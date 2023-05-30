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
Route::resource('/roles', \App\Http\Controllers\RoleController::class)->middleware('auth');
Route::resource('/categories', \App\Http\Controllers\CategoryController::class)->middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/users', \App\Http\Controllers\UserController::class)
    ->middleware('auth');
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
Route::resource('/products', \App\Http\Controllers\ProductController::class)->middleware('auth');
Route::resource('/sliders', \App\Http\Controllers\SliderController::class)->middleware('auth');


