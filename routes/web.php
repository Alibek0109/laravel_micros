<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [PagesController::class, 'index'])->name('index');
Route::get('/about', [PagesController::class, 'about'])->name('about');


Route::group(['prefix' => 'home', 'middleware' => 'auth'], function (){
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/create', [HomeController::class, 'create'])->name('home.create');
    Route::get('/search', [HomeController::class, 'search'])->name('home.search');
    Route::post('/stat', [HomeController::class, 'stat'])->name('home.stat');

    Route::post('/', [HomeController::class, 'store'])->name('home.store');
    Route::get('/{id}/edit', [HomeController::class, 'edit'])->name('home.edit');
    Route::patch('/{id}', [HomeController::class, 'update'])->name('home.update');
    Route::delete('/{id}', [HomeController::class, 'destroy'])->name('home.destroy');

    Route::group(['prefix' => 'category'], function (){
        Route::get('/', [CategoryController::class, 'index'])->name('home.category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('home.category.create');
        Route::post('/', [CategoryController::class, 'store'])->name('home.category.store');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('home.category.edit');
        Route::patch('/{id}', [CategoryController::class, 'update'])->name('home.category.update');
        Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('home.category.destroy');
    });
});





Auth::routes();
