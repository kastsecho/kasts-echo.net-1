<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('/posts', PostController::class);
Route::put('/posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore');

Route::resource('/categories', CategoryController::class);
Route::put('/categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
