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
//for the single page anime series view
Route::get('/anime/{anime}', [SinglePageController::class, 'singleAnime'])->name('single.anime');





// TV Series Routes
Route::get('/tv_series', [TvSeriesListController::class, 'tvSeriesList'])->name('tv.series.list');
Route::get('/tv/top_rated_tv_series', [TvSeriesListController::class, 'top_rated_tv_series'])->name('top.rated.list');
Route::get('/tv/airing_today', [TvSeriesListController::class, 'airing_today'])->name('airing.today.list');
Route::get('/tv/popular', [TvSeriesListController::class, 'popular'])->name('popular.series.list');


//for the anime
Route::get('/anime', [AnimeListController::class, 'animesList'])->name('anime.list');
Route::get('/anime/top', [AnimeListController::class, 'top_anime'])->name('top.anime.list');
Route::get('/anime/popular_anime', [AnimeListController::class, 'popular_anime'])->name('popular.anime.list');
Route::get('/anime/upcoming_anime', [AnimeListController::class, 'upcoming_anime'])->name('upcoming.anime.list');


//for watchlist

Route::get('/watchlist', [WatchlistController::class, 'index'])->name('watchlist');
Route::post('/watchlist', [WatchlistController::class, 'index'])->name('watchlist');
Route::get('/list', [WatchlistController::class, 'show_watchlist'])->name('list');



