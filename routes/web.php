<?php

declare(strict_types=1);

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Post routes
// Show single post by slug
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('post.show')->middleware('auth');

// Like/unlike post
Route::post('/posts/{post}/like', [PostController::class, 'toggleLike'])->name('post.like')->middleware('auth');
