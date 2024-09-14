<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Watchlist;
class AnimeListController extends Controller
{
    //private

    private $client;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    public function animesList(Request $request)
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
        // Define the number of anime per page
        $animePerPage = 8;

        // Get the current page from the query parameters; default to 1 if not set
        $page = $request->query('page', 1);

        // Fetch anime data from Jikan API
        $response = $this->client->request('GET', 'https://api.jikan.moe/v4/top/anime', [
            'query' => [
                'page' => $page,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        // Get the anime data for the current page
        $anime = $data['data']; // 'data' holds the list of anime
        $totalAnime = $data['pagination']['items']['total']; // Total number of anime
        $totalPages = $data['pagination']['last_visible_page']; // Total number of pages

        // Pass the anime and pagination info to the view
        return view('lists.animes_list', [
            'animes' => $anime,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'total_anime' => $totalAnime,
            'animePerPage' => $animePerPage,
            'watchlistItems' => $watchlistItems,
        ]);
    }
    public function popular_anime(Request $request)
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
        // Define the number of anime per page
        $animePerPage = 8;

        // Get the current page from the query parameters; default to 1 if not set
        $page = $request->query('page', 1);

        // Fetch anime data from Jikan API
        $response = $this->client->request('GET', 'https://api.jikan.moe/v4/top/anime', [
            'query' => [
                'filter' => 'bypopularity',
                'page' => $page,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        // Get the anime data for the current page
        $anime = $data['data']; // 'data' holds the list of anime
        $totalAnime = $data['pagination']['items']['total']; // Total number of anime
        $totalPages = $data['pagination']['last_visible_page']; // Total number of pages

        // Pass the anime and pagination info to the view
        return view('lists.popluar_anime_list', [
            'animes' => $anime,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'total_anime' => $totalAnime,
            'animePerPage' => $animePerPage,
            'watchlistItems' => $watchlistItems,
        ]);

    }

    public function upcoming_anime(Request $request)
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
        // Define the number of anime per page
        $animePerPage = 8;

        // Get the current page from the query parameters; default to 1 if not set
        $page = $request->query('page', 1);

        // Fetch anime data from Jikan API
        $response = $this->client->request('GET', 'https://api.jikan.moe/v4/top/anime', [
            'query' => [
                'filter' => 'upcoming',
                'page' => $page,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        // Get the anime data for the current page
        $anime = $data['data']; // 'data' holds the list of anime
        $totalAnime = $data['pagination']['items']['total']; // Total number of anime
        $totalPages = $data['pagination']['last_visible_page']; // Total number of pages

        // Pass the anime and pagination info to the view
        return view('lists.upcoming_anime_list', [
            'animes' => $anime,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'animePerPage' => $animePerPage,
            'total_anime' => $totalAnime,
            'watchlistItems' => $watchlistItems,
        ]);


    }
}
