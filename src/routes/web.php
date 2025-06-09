<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;


Route::get('/', [ContactController::class, 'index']);
Route::post('/contacts/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts', [ContactController::class, 'store']);
Route::get('/contacts/edit', [ContactController::class, 'edit']);

Route::get('/register', [RegisterController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);