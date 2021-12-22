<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
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


Route::get('/posts/create', [PostController::class, 'createForm']);

Route::get('/posts/{postId}', [PostController::class, 'editForm']);

Route::get('/categories/create', [CategoryController::class, 'createForm']);

Route::post('action/create/post', [PostController::class, 'create'])->name('post.create');

Route::post('action/edit/post', [PostController::class, 'edit'])->name('post.edit');

Route::post('action/create/category', [CategoryController::class, 'create'])->name('category.create');