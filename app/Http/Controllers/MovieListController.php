<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MovieListController extends Controller
{
    public function moviesList(Request $request)
    {
        $client = new Client();

        // Define the number of movies per page
        $moviesPerPage = 8;

        // Get the current page from the query parameters; default to 1 if not set
        $page = $request->query('page', 1);

        // Fetch data for the current page
        $response = $client->request('GET', 'https://api.themoviedb.org/3/discover/movie', [
            'query' => [
                'api_key' => 'f7f87d2556969f9f5d96533dd7a425d1',
                'sort_by' => 'popularity.desc',
                'page' => $page,


            ],
        ]);

        $data = json_decode($response->getBody(), true);

        // Get the movie data for the current page
        $movies = $data['results'];

        // Calculate total pages based on movies per page
        $totalMovies = $data['total_results'];
        $totalPages = ceil($totalMovies / $moviesPerPage);

        // Pass the movies and pagination info to the view
        return view('lists/movies_list', [
            'movies' => $movies,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'moviesPerPage' => $moviesPerPage,
        ]);
    }
}
