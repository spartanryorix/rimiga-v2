<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\FavouritesController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\SearchController;


Route::post('/search', [SearchController::class, 'search']);
Route::get('/genre', [GenreController::class, 'show']);
Route::get('/favourites', [FavouritesController::class, 'index'])->middleware('auth');
Route::get('/game/{id}', [GameController::class, 'show']);
Route::post('/favorite', [FavouriteController::class, 'toggle'])->middleware('auth');
Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);
