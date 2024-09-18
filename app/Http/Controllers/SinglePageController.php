<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Watchlist;

class SinglePageController extends Controller
{
    //

    private $client;

    private $apiKey = 'f7f87d2556969f9f5d96533dd7a425d1';

    public function __construct()
    {
        $this->client = new Client();
    }


    public function singleMovie($id)
    {

        $data = $this->client->request('GET', 'https://api.themoviedb.org/3/movie/' . $id . '?' . $this->apiKey, [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmN2Y4N2QyNTU2OTY5ZjlmNWQ5NjUzM2RkN2E0MjVkMSIsIm5iZiI6MTcyNDM5NDA2Mi42NTIxMDEsInN1YiI6IjY0MzNiMGUwOWE2NDM1MDY4OTQ4ZjEyMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.kv9n-HyuVbEVVoIf9G0X8TMoc8QBIPFKPxqC1wDIID0',
                'accept' => 'application/json',
            ],
        ]);

        $credits = $this->client->request('GET', 'https://api.themoviedb.org/3/movie/' . $id . '/credits' . '?' . $this->apiKey, [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmN2Y4N2QyNTU2OTY5ZjlmNWQ5NjUzM2RkN2E0MjVkMSIsIm5iZiI6MTcyNDM5NDA2Mi42NTIxMDEsInN1YiI6IjY0MzNiMGUwOWE2NDM1MDY4OTQ4ZjEyMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.kv9n-HyuVbEVVoIf9G0X8TMoc8QBIPFKPxqC1wDIID0',
                'accept' => 'application/json',
            ],
        ]);


        $videos = $this->client->request('GET', 'https://api.themoviedb.org/3/movie/' . $id . '/videos' . '?' . $this->apiKey, [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmN2Y4N2QyNTU2OTY5ZjlmNWQ5NjUzM2RkN2E0MjVkMSIsIm5iZiI6MTcyNDM5NDA2Mi42NTIxMDEsInN1YiI6IjY0MzNiMGUwOWE2NDM1MDY4OTQ4ZjEyMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.kv9n-HyuVbEVVoIf9G0X8TMoc8QBIPFKPxqC1wDIID0',
                'accept' => 'application/json',
            ],
        ]);






        $movie = json_decode($data->getBody(), true);
        $credits = json_decode($credits->getBody(), true);
        $videos = json_decode($videos->getBody(), true)['results'];


        $casts = $credits['cast'];
        $crews = $credits['crew'];

        // echo $movie;
        return view('single_pages.movie_single_page', compact('movie', 'casts', 'crews', 'videos'));
    }


    public function singleTvSeries($id)
    {


        $data = $this->client->request('GET', 'https://api.themoviedb.org/3/tv/' . $id . '?' . $this->apiKey, [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmN2Y4N2QyNTU2OTY5ZjlmNWQ5NjUzM2RkN2E0MjVkMSIsIm5iZiI6MTcyNDM5NDA2Mi42NTIxMDEsInN1YiI6IjY0MzNiMGUwOWE2NDM1MDY4OTQ4ZjEyMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.kv9n-HyuVbEVVoIf9G0X8TMoc8QBIPFKPxqC1wDIID0',
                'accept' => 'application/json',
            ],
        ]);

        $credits = $this->client->request('GET', 'https://api.themoviedb.org/3/tv/' . $id . '/credits' . '?' . $this->apiKey, [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmN2Y4N2QyNTU2OTY5ZjlmNWQ5NjUzM2RkN2E0MjVkMSIsIm5iZiI6MTcyNDM5NDA2Mi42NTIxMDEsInN1YiI6IjY0MzNiMGUwOWE2NDM1MDY4OTQ4ZjEyMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.kv9n-HyuVbEVVoIf9G0X8TMoc8QBIPFKPxqC1wDIID0',
                'accept' => 'application/json',
            ],
        ]);

        $videos = $this->client->request('GET', 'https://api.themoviedb.org/3/tv/' . $id . '/videos' . '?' . $this->apiKey, [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmN2Y4N2QyNTU2OTY5ZjlmNWQ5NjUzM2RkN2E0MjVkMSIsIm5iZiI6MTcyNDM5NDA2Mi42NTIxMDEsInN1YiI6IjY0MzNiMGUwOWE2NDM1MDY4OTQ4ZjEyMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.kv9n-HyuVbEVVoIf9G0X8TMoc8QBIPFKPxqC1wDIID0',
                'accept' => 'application/json',
            ],
        ]);
        $tv_series = json_decode($data->getBody(), true);
        $credits = json_decode($credits->getBody(), true);
        $videos = json_decode($videos->getBody(), true)['results'];


        $casts = $credits['cast'];
        $crews = $credits['crew'];

        // echo $movie;
        return view('single_pages.tv_series_single_page', compact('tv_series', 'casts', 'crews', 'videos'));
    }

    public function singleAnime($mal_id, Request $request)
    {
        // Fetch anime details

        if ($request->user()) {
            $userId = $request->user()->id;

            // Fetch the watchlist for authenticated users for both movies and anime
            $watchlistItems = Watchlist::where('user_id', $userId)
                ->pluck('movie_id') // pluck movie ids first
                ->merge(Watchlist::where('user_id', $userId)->pluck('anime_id')); // merge anime ids into the collection
        } else {
            $watchlistItems = collect(); // Empty collection for unauthenticated users
        }

        $data = $this->client->request('GET', 'https://api.jikan.moe/v4/anime/' . $mal_id . '/full');

        // Fetch characters for the anime
        $characters = $this->client->request('GET', 'https://api.jikan.moe/v4/anime/' . $mal_id . '/characters');

        //fetch episodes for the anime
        $episodes = $this->client->request('GET', 'https://api.jikan.moe/v4/anime/' . $mal_id . '/episodes');



        // Fetch recommendations for the anime
        $recommendations = $this->client->request('GET', 'https://api.jikan.moe/v4/anime/' . $mal_id . '/recommendations');




        // Decode the responses
        $anime = json_decode($data->getBody(), true)['data'];

        // Since the characters array is not nested under a 'character' key
        $characters = json_decode($characters->getBody(), true)['data'];

        $recommendations = json_decode($recommendations->getBody(), true)['data'];



        return view('single_pages.anime_single_page', compact('anime', 'characters', 'recommendations', 'watchlistItems'));
    }

}
