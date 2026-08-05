<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('categories', CategoryController::class);
Route::resource('tags', TagController::class);
Route::resource('tasks', TaskController::class);
