<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


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


Route::get('/about', [PostController::class, 'about'])->name('about');

Route::get('/', [PostController::class, 'index'])->name('post.index');
Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::get('post/{id}', [PostController::class, 'show'])->name('post.show');
Route::post('/post', [PostController::class, 'store'])->name('post.store');
Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::patch('/post/{id}', [PostController::class, 'update'])->name('post.update');
Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('post.destroy');

Route::post('/comment', [\App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');

//Route::get('user/{id}', function ($id) {
//    return view('test', compact('id'));
//});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
