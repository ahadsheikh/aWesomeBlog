<?php

use App\Http\Controllers\PostsController;
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

// Users Routes
Route::get('/user/{user}', [\App\Http\Controllers\UsersController::class, 'index'])->name('users.index');
Route::get('/user/{user}/edit', [\App\Http\Controllers\UsersController::class, 'edit'])->name('users.edit');
Route::patch('/user/{user}', [\App\Http\Controllers\UsersController::class, 'update'])->name('users.update');

//// Posts Routes
//Route::get('/posts', [\App\Http\Controllers\PostsController::class, 'index'])->name('posts.index');
//    // create
//Route::get('/posts/create', [\App\Http\Controllers\PostsController::class, 'create'])->name('posts.create');
//Route::post('/posts', [\App\Http\Controllers\PostsController::class, 'store'])->name('posts.store');
//    // read
//Route::get('/posts/{post}', [\App\Http\Controllers\PostsController::class, 'show'])->name('posts.show');
//    // update
//Route::get('/posts/{post}/edit', [\App\Http\Controllers\PostsController::class, 'edit'])->name('posts.edit');
//Route::patch('/posts/{post}', [\App\Http\Controllers\PostsController::class, 'update'])->name('posts.update');
//    // delete
//Route::delete('/posts/{post}', [\App\Http\Controllers\PostsController::class, 'delete'])->name('posts.destroy');

Route::resources([
    'posts' => PostsController::class,
]);


