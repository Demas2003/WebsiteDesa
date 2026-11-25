<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita', [HomeController::class, 'news'])->name('news');
Route::get('/berita/{slug}', [HomeController::class, 'newsDetail'])->name('news.detail');
Route::get('/galeri', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/potensi/{id}', [HomeController::class, 'potentialDetail'])->name('potential.detail');
Route::get('/potensi-desa', [HomeController::class, 'allPotentials'])->name('potential.all');
