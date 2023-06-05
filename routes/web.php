<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestTestController;
use App\Http\Controllers\DiggingDeeperController;

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

Route::resource('rest', RestTestController::class)->names('restTest');

Route::group(['namespace' => 'App\Http\Controllers\Blog', 'prefix' => 'blog'], function () {
    Route::resource('posts', PostController::class)->names('blog.posts');
});

Route::group(['prefix' => 'digging_deeper'], function () {
    Route::get('collections', [DiggingDeeperController::class, 'collections'])->name('digging_deeper.collections');
    Route::get('process-video', [DiggingDeeperController::class, 'processVideo'])->name('digging_deeper.processVideo');
    Route::get('prepare-catalog', [DiggingDeeperController::class, 'prepareCatalog'])->name('digging_deeper.prepareCatalog');
});

// Адмінка
Route::group(['namespace' => 'App\Http\Controllers\Blog\Admin', 'prefix' => 'admin/blog'], function () {
    Route::resource('categories', CategoryController::class)->only(['index', 'edit', 'store', 'update', 'create'])->names('blog.admin.categories');
    Route::resource('posts', PostController::class)->except(['show'])->names('blog.admin.posts');
});
