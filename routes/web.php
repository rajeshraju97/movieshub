<?php
namespace App\Http\Controllers;



use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TvSeriesListController;


Route::get('/', [HomeController::class, 'index']);



Route::get('/movies', [MovieListController::class, 'moviesList'])->name('movies.list');
Route::get('/movies/wpml', [MovieListController::class, 'wpmoviesList'])->name('wpmovies.list');
Route::get('/movies/tpml', [MovieListController::class, 'tpmoviesList'])->name('tpmovies.list');
Route::get('/movies/trml', [MovieListController::class, 'trmoviesList'])->name('trmovies.list');



// TV Series Routes
Route::get('/tv_series', [TvSeriesListController::class, 'tvSeriesList'])->name('tv.series.list');

