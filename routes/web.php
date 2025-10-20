<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\PortfolioController;

Route::get('/', [MainController::class, 'index'])->name('main.index');

// Страница "Проекты"
Route::get('/projects', [ProjectsController::class, 'index'])->name('projects.index');

// Страницы портфолио
Route::get('/portfolio/gallery-of-taste', [PortfolioController::class, 'galleryOfTaste'])->name('portfolio.gallery-of-taste');

// Страница "О компании"
Route::get('/about', [AboutController::class, 'index'])->name('about.index');

// Контактная форма
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
