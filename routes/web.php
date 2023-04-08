<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostsController::class, 'index']) -> name('posts.index')->middleware('auth');
Route::post('/posts', [PostsController::class, 'store']) -> name('posts.store')->middleware('auth');
Route::get('/posts/create', [PostsController::class, 'create']) -> name('posts.create')->middleware('auth');
Route::get('/posts/{post}', [PostsController::class, 'show']) -> name('posts.show')->middleware('auth');
Route::get('/posts/{post}/edit', [PostsController::class, 'edit']) -> name('posts.edit')->middleware('auth');
Route::put('/posts/{post}', [PostsController::class, 'update']) -> name('posts.update')->middleware('auth');
Route::delete('/posts/{post}', [PostsController::class, 'destroy']) -> name('posts.destroy')->middleware('auth');

Route::post('/posts/comments', [CommentsController::class, 'store']) -> name('comments.store');
Route::delete('/posts/comments/{comment}', [CommentsController::class, 'destroy']) -> name('comments.destroy');
Route::get('/posts/comments/{comment}/edit', [CommentsController::class, 'edit']) -> name('comments.edit');
Route::put('/posts/comments/{comment}', [CommentsController::class, 'update']) -> name('comments.update');

Auth::routes();

Route::get('/home', [PostsController::class, 'index'])->name('home');
