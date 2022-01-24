<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CategoryController;


Route::get('/', [PagesController::class, 'index'])->name('index');
Route::get('/about', [PagesController::class, 'about'])->name('about');


Route::prefix('home')->group(function (){
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::post('/filter', [HomeController::class, 'filter'])->name('home.filter');
    Route::get('/create', [HomeController::class, 'create'])->name('home.create');
    Route::post('/store', [HomeController::class, 'store'])->name('home.store');
    Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('home.edit');
    Route::post('/update/{id}', [HomeController::class, 'update'])->name('home.update');
    Route::delete('/destroy/{id}', [HomeController::class, 'destroy'])->name('home.destroy');
});


Route::prefix('home/category')->group(function (){
    Route::get('/index', [CategoryController::class, 'index'])->name('home.category.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('home.category.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('home.category.store');
});


Auth::routes();
