<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Watchlist;
use GuzzleHttp\Client;


class HomeController extends Controller
{
    private $client;
    private $apiKey = 'f7f87d2556969f9f5d96533dd7a425d1';

    public function __construct()
    {
        $this->client = new Client();
    }
    public function index(Request $request)
    {
        // Check if the user is authenticated
        if ($request->user()) {
            $userId = $request->user()->id;

            // Fetch the watchlist for authenticated users for both movies and anime
            $watchlistItems = Watchlist::where('user_id', $userId)
                ->pluck('movie_id') // pluck movie ids first
                ->merge(Watchlist::where('user_id', $userId)->pluck('anime_id')); // merge anime ids into the collection
        } else {
            $watchlistItems = collect(); // Empty collection for unauthenticated users
        }

        // Fetch movies and pass to view
        $nowPlayingMovies = $this->fetchMovies('now_playing', 'IN');
        $popularWorldMovies = $this->fetchMovies('popular');
        $popularTeluguMovies = $this->fetchMovies('popular', 'IN', 'te');
        $topRatedMovies = $this->fetchMovies('top_rated');
        $upcomingMovies = $this->fetchMovies('upcoming', 'IN', 'en-US');
        $popularAnime = $this->fetchAnime('bypopularity');
        $upcomingAnime = $this->fetchAnime('upcoming');

        // Pass movies, anime, and watchlist status to the view
        return view('welcome', compact(
            'nowPlayingMovies',
            'popularWorldMovies',
            'popularTeluguMovies',
            'topRatedMovies',
            'upcomingMovies',
            'popularAnime',
            'upcomingAnime',
            'watchlistItems'
        ));
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

    private function fetchAnime($type)
    {
        $response = $this->client->request('GET', "https://api.jikan.moe/v4/top/anime?filter=$type");
        $anime = json_decode($response->getBody(), true)['data'];
        return $anime;
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
