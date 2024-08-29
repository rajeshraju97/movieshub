<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MovieListController extends Controller
{
    private $client;
    private $apiKey = 'f7f87d2556969f9f5d96533dd7a425d1';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function moviesList(Request $request)
    {
        // Define the number of movies per page
        $moviesPerPage = 8;

        // Default sorting and language, can be overridden by user selection
        $sort = $request->query('sort', 'popularity.desc');
        $selectedLanguage = $request->query('language', 'en'); // Default language is English

        // Get the current page from the query parameters; default to 1 if not set
        $page = $request->query('page', 1);

        // Fetch movies based on the selected language and sort
        $response = $this->client->request('GET', 'https://api.themoviedb.org/3/discover/movie', [
            'query' => [
                'api_key' => $this->apiKey,
                'sort_by' => $sort,
                'page' => $page,
                'with_original_language' => $selectedLanguage,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        $movies = $data['results'];
        $totalMovies = $data['total_results'];
        $totalPages = ceil($totalMovies / $moviesPerPage);

        // Fetch all languages available on TMDB
        $response = $this->client->request('GET', 'https://api.themoviedb.org/3/configuration/languages', [
            'query' => [
                'api_key' => $this->apiKey,
            ],
        ]);

        $languages = json_decode($response->getBody(), true);

        // Pass the movies, languages, and selected language to the view
        return view('lists.movies_list', [
            'movies' => $movies,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'moviesPerPage' => $moviesPerPage,
            'sort' => $sort,
            'selectedLanguage' => $selectedLanguage,
            'languages' => $languages,
        ]);
    }


    public function wpmoviesList(Request $request)
    {
        // Define the number of movies per page
        $moviesPerPage = 8;

        // Get the current page from the query parameters; default to 1 if not set
        $page = $request->query('page', 1);

        // Fetch data for the current page
        $response = $this->client->request('GET', 'https://api.themoviedb.org/3/movie/popular', [
            'query' => [
                'api_key' => $this->apiKey,
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

        return view('lists/world_popular_movies_list', [
            'movies' => $movies,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'moviesPerPage' => $moviesPerPage,
        ]);
    }

    public function trmoviesList(Request $request)
    {
        // Define the number of movies per page
        $moviesPerPage = 8;

        // Get the current page from the query parameters; default to 1 if not set
        $page = $request->query('page', 1);

        // Fetch data for the current page
        $response = $this->client->request('GET', 'https://api.themoviedb.org/3/movie/top_rated', [
            'query' => [
                'api_key' => $this->apiKey,
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
        return view('lists/top_rated_ml', [
            'movies' => $movies,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'moviesPerPage' => $moviesPerPage,
        ]);
    }

    public function tpmoviesList(Request $request)
    {
        // Define the number of movies per page
        $moviesPerPage = 8;

        // Get the current page from the query parameters; default to 1 if not set
        $page = $request->query('page', 1);

        // Fetch data for the current page
        $response = $this->client->request('GET', 'https://api.themoviedb.org/3/discover/movie', [
            'query' => [
                'api_key' => $this->apiKey,
                'sort_by' => 'popularity.desc',
                'page' => $page,
                'language' => 'en-US',
                'region' => 'IN',
                'with_original_language' => 'te'


            ],
        ]);

        $data = json_decode($response->getBody(), true);

        // Get the movie data for the current page
        $movies = $data['results'];

        // Calculate total pages based on movies per page
        $totalMovies = $data['total_results'];
        $totalPages = ceil($totalMovies / $moviesPerPage);
        return view('lists/telugu_pml', [
            'movies' => $movies,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'moviesPerPage' => $moviesPerPage,
        ]);
    }





}
