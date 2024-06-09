<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(\App\Http\Controllers\PostController::class)->group(static function () {
    Route::get('project', 'projectIndex')->name('project.index');
    Route::get('project/{post:slug}', 'projectDetail')->name('project.detail');
    Route::get('post', 'postIndex')->name('post.index');
    Route::get('post/{post:slug}', 'postDetail')->name('post.detail');
});
