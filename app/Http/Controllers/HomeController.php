<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    private $client;
    private $apiKey = 'f7f87d2556969f9f5d96533dd7a425d1';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function index()
    {
        // Fetch movies
        $nowPlayingMovies = $this->fetchMovies('now_playing', 'IN');
        $popularWorldMovies = $this->fetchMovies('popular');
        $popularTeluguMovies = $this->fetchMovies('popular', 'IN', 'te');
        $topRatedMovies = $this->fetchMovies('top_rated');
        $upcomingMovies = $this->fetchMovies('upcoming', 'IN', 'en-US');

        // Pass movies with genres to the view
        return view('welcome', compact('nowPlayingMovies', 'popularWorldMovies', 'popularTeluguMovies', 'topRatedMovies', 'upcomingMovies'));
    }

    private function fetchMovies($type, $region = null, $language = null)
    {
        $query = [
            'api_key' => $this->apiKey,
            'language' => 'en-US',
            'region' => $region,
        ];

        if ($language && $type === 'popular' && $region) {
            // Use the /discover/movie endpoint to filter by original language
            $response = $this->client->request('GET', 'https://api.themoviedb.org/3/discover/movie', [
                'query' => array_merge($query, ['with_original_language' => $language]),
            ]);
        } else {
            // For other cases, use the /movie endpoint
            $response = $this->client->request('GET', "https://api.themoviedb.org/3/movie/{$type}", [
                'query' => $query,
            ]);
        }

        $movies = json_decode($response->getBody(), true)['results'];

        // Fetch Genre List and Map Genre IDs to Names
        $genreMap = $this->fetchGenreMap();

        // Add Genre Names to Movies
        foreach ($movies as &$movie) {
            $movie['genre_names'] = array_map(function ($genreId) use ($genreMap) {
                return $genreMap[$genreId] ?? 'Unknown'; // 'Unknown' as fallback
            }, $movie['genre_ids']);
        }

        return $movies;
    }

    private function fetchGenreMap()
    {
        $response = $this->client->request('GET', 'https://api.themoviedb.org/3/genre/movie/list', [
            'query' => ['api_key' => $this->apiKey],
        ]);

        $genres = json_decode($response->getBody(), true)['genres'];

        // Map Genre IDs to Names
        $genreMap = [];
        foreach ($genres as $genre) {
            $genreMap[$genre['id']] = $genre['name'];
        }

        return $genreMap;
    }
}
