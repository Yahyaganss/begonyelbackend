<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
Route::get('/users/add', [App\Http\Controllers\UserController::class, 'create'])->name('users-add');
Route::post('/users/store', [App\Http\Controllers\UserController::class, 'store'])->name('users-store');
Route::get('/users/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('users-edit');
Route::post('/users/update', [App\Http\Controllers\UserController::class, 'update'])->name('users-update');
Route::get('/users/delete/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('users-delete');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/add', [CategoryController::class, 'create'])->name('categories-add');
Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories-edit');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories-store');
Route::post('/categories/update', [CategoryController::class, 'update'])->name('categories-update');
Route::get('/categories/delete/{id}', [CategoryController::class, 'delete'])->name('categories-delete');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/add', [ProductController::class, 'create'])->name('products-add');
Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products-edit');
Route::post('/products/store', [ProductController::class, 'store'])->name('products-store');
Route::post('/products/update', [ProductController::class, 'update'])->name('products-update');
Route::get('/products/delete/{id}', [ProductController::class, 'delete'])->name('products-delete');

