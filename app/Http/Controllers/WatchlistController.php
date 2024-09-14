<?php

namespace App\Http\Controllers;

use App\Models\Watchlist;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WatchlistController extends Controller
{
    //


    private $client;

    private $apiKey = 'f7f87d2556969f9f5d96533dd7a425d1';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function index(Request $request)
    {
        $userId = $request->user()->id;

        // Determine if we need to add or remove an item
        $action = $request->input('action');
        if ($request->has('movie_id')) {
            $mediaId = $request->input('movie_id');
        } elseif ($request->has('tv_series_id')) {
            $mediaId = $request->input('tv_series_id');
        } else {
            $mediaId = $request->input('anime_id');
        }

        if ($action === 'add') {
            // Insert movie, TV series, or anime based on the input
            Watchlist::create([
                'user_id' => $userId,
                'movie_id' => $request->has('movie_id') ? $request->movie_id : null,
                'tv_series_id' => $request->has('tv_series_id') ? $request->tv_series_id : null,
                'anime_id' => $request->has('anime_id') ? $request->anime_id : null,
            ]);
        } elseif ($action === 'remove') {
            // Remove the item from the wishlist
            Watchlist::where('user_id', $userId)
                ->where(function ($query) use ($mediaId) {
                    $query->where('movie_id', $mediaId)
                        ->orWhere('tv_series_id', $mediaId)
                        ->orWhere('anime_id', $mediaId);
                })
                ->delete();
        }

        // Redirect back to the previous page instead of the homepage
        return redirect()->back()->with('success', $action === 'add' ? 'Added to Wishlist successfully!' : 'Removed from Wishlist successfully!');
    }

    public function show_watchlist()
    {


        $userId = auth()->user()->id;

        // Fetch the watchlist for authenticated users for both movies and anime
        $watchlist_items = Watchlist::where('user_id', $userId)
            ->pluck('movie_id') // pluck movie ids first
            ->merge(Watchlist::where('user_id', $userId)->pluck('tv_series_id')); // merge anime ids into the collection

        // Fetch the watchlist items for the authenticated user

        $watchlistItems = Watchlist::where('user_id', $userId)->get();

        // Store movie and TV series details fetched from the TMDB API
        $mediaDetails = [];

        // Loop through the watchlist items
        foreach ($watchlistItems as $item) {
            // Check if it is a movie and fetch its details
            if ($item->movie_id) {
                $response = $this->client->request('GET', 'https://api.themoviedb.org/3/movie/' . $item->movie_id . '?' . $this->apiKey, [
                    'headers' => [
                        'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmN2Y4N2QyNTU2OTY5ZjlmNWQ5NjUzM2RkN2E0MjVkMSIsIm5iZiI6MTcyNDM5NDA2Mi42NTIxMDEsInN1YiI6IjY0MzNiMGUwOWE2NDM1MDY4OTQ4ZjEyMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.kv9n-HyuVbEVVoIf9G0X8TMoc8QBIPFKPxqC1wDIID0',
                        'accept' => 'application/json',
                    ],
                ]);

                $movieData = json_decode($response->getBody()->getContents(), true);

                // Add movie data to the mediaDetails array
                $mediaDetails[] = [
                    'type' => 'movie',
                    'details' => $movieData
                ];
            }

            // Check if it is a TV series and fetch its details
            if ($item->tv_series_id) {
                $response = $this->client->request('GET', 'https://api.themoviedb.org/3/tv/' . $item->tv_series_id . '?' . $this->apiKey, [
                    'headers' => [
                        'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmN2Y4N2QyNTU2OTY5ZjlmNWQ5NjUzM2RkN2E0MjVkMSIsIm5iZiI6MTcyNDM5NDA2Mi42NTIxMDEsInN1YiI6IjY0MzNiMGUwOWE2NDM1MDY4OTQ4ZjEyMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.kv9n-HyuVbEVVoIf9G0X8TMoc8QBIPFKPxqC1wDIID0',
                        'accept' => 'application/json',
                    ],
                ]);

                $tvSeriesData = json_decode($response->getBody()->getContents(), true);

                // Add TV series data to the mediaDetails array
                $mediaDetails[] = [
                    'type' => 'tv_series',
                    'details' => $tvSeriesData
                ];
            }
        }

        // Pass the media details to the view
        return view('watchlist', [
            'mediaDetails' => $mediaDetails,
            'watchlist_items' => $watchlist_items

        ]);
    }






}
