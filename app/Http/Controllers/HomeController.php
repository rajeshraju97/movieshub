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

        // Pass movies with genres to the view
        return view('welcome', compact('nowPlayingMovies', 'popularWorldMovies', 'popularTeluguMovies'));
    }

    private function fetchMovies($type, $region = null, $language = null)
    {
        $query = [
            'api_key' => $this->apiKey,
            'sort_by' => 'popularity.desc',
        ];

        if ($region) {
            $query['region'] = $region;
        }

        if ($language) {
            // Use the /discover/movie endpoint to filter by original language
            $response = $this->client->request('GET', 'https://api.themoviedb.org/3/discover/movie', [
                'query' => array_merge($query, ['with_original_language' => $language]),
                'headers' => [
                    'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmN2Y4N2QyNTU2OTY5ZjlmNWQ5NjUzM2RkN2E0MjVkMSIsIm5iZiI6MTcyNDM5NDA2Mi42NTIxMDEsInN1YiI6IjY0MzNiMGUwOWE2NDM1MDY4OTQ4ZjEyMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.kv9n-HyuVbEVVoIf9G0X8TMoc8QBIPFKPxqC1wDIID0',
                    'accept' => 'application/json',
                ],
            ]);
        } else {
            // For other cases, use the /movie endpoint
            $response = $this->client->request('GET', "https://api.themoviedb.org/3/movie/{$type}", [
                'query' => $query,
                'headers' => [
                    'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmN2Y4N2QyNTU2OTY5ZjlmNWQ5NjUzM2RkN2E0MjVkMSIsIm5iZiI6MTcyNDM5NDA2Mi42NTIxMDEsInN1YiI6IjY0MzNiMGUwOWE2NDM1MDY4OTQ4ZjEyMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.kv9n-HyuVbEVVoIf9G0X8TMoc8QBIPFKPxqC1wDIID0',
                    'accept' => 'application/json',
                ],
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
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmN2Y4N2QyNTU2OTY5ZjlmNWQ5NjUzM2RkN2E0MjVkMSIsIm5iZiI6MTcyNDM5NDA2Mi42NTIxMDEsInN1YiI6IjY0MzNiMGUwOWE2NDM1MDY4OTQ4ZjEyMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.kv9n-HyuVbEVVoIf9G0X8TMoc8QBIPFKPxqC1wDIID0',
                'accept' => 'application/json',
            ],
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
