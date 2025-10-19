<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'index'])->name('main.index');

// Контактная форма
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
