<?php

use App\Http\Controllers\BlogController;
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

Route::redirect('/', '/blog');

Route::get('/blog', [BlogController::class,'index'])->name('blog.index');
Route::get('/blog/{post}', [BlogController::class,'show'])->name('blog.show');

Route::prefix('admin')
    ->name('admin.')
    ->group(base_path('routes/admin.php'));
