<?php
namespace App\Http\Controllers;



use Illuminate\Support\Facades\Route;




Route::get('/', [HomeController::class, 'index']);



Route::get('/movies', [MovieListController::class, 'moviesList'])->name('movies.list');
Route::get('/movies/wpml', [MovieListController::class, 'wpmoviesList'])->name('wpmovies.list');
Route::get('/movies/tpml', [MovieListController::class, 'tpmoviesList'])->name('tpmovies.list');
Route::get('/movies/trml', [MovieListController::class, 'trmoviesList'])->name('trmovies.list');




