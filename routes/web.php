<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;




Route::get('/', [HomeController::class, 'index']);

Route::get('/movies_list', [HomeController::class, 'movies_list']);

