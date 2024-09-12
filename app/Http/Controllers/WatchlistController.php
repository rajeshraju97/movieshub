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




}
