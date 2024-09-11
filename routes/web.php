<?php
namespace App\Http\Controllers;



use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TvSeriesListController;


Route::get('/', [HomeController::class, 'index'])->name('home');




//for authentication purposes
Auth::routes();

Route::get('/register', [AuthController::class, 'index'])->name('regiser_page');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//for search
Route::post('/search', [SearchController::class, 'index'])->name('search.multi');
Route::get('/search', [SearchController::class, 'index'])->name('search.multi');



// for watchlist

// Movie Routes

Route::get('/movies', [MovieListController::class, 'moviesList'])->name('movies.list');
Route::get('/movies/wpml', [MovieListController::class, 'wpmoviesList'])->name('wpmovies.list');
Route::get('/movies/trml', [MovieListController::class, 'trmoviesList'])->name('trmovies.list');
Route::get('/movies/tpml', [MovieListController::class, 'tpmoviesList'])->name('tpmovies.list');
//for the single page movies view
Route::get('/movies/{movie}', [SinglePageController::class, 'singleMovie'])->name('single.movie');
//for the single page tv series view
Route::get('/tv_series/{series}', [SinglePageController::class, 'singleTvSeries'])->name('single.tvseries');




// TV Series Routes
Route::get('/tv_series/', [TvSeriesListController::class, 'tvSeriesList'])->name('tv.series.list');


//for the anime
Route::get('/anime', [AnimeListController::class, 'animesList'])->name('anime.list');
Route::get('/anime/popular_anime', [AnimeListController::class, 'popular_anime'])->name('popular.anime.list');
Route::get('/anime/upcoming_anime', [AnimeListController::class, 'upcoming_anime'])->name('upcoming.anime.list');

//for watchlist

Route::get('/watchlist', [WatchlistController::class, 'index'])->name('watchlist');