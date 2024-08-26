<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
        $client = new \GuzzleHttp\Client();

        // Fetch Now Playing Movies
        $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/now_playing?api_key=f7f87d2556969f9f5d96533dd7a425d1&region=IN', [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmN2Y4N2QyNTU2OTY5ZjlmNWQ5NjUzM2RkN2E0MjVkMSIsIm5iZiI6MTcyNDM5NDA2Mi42NTIxMDEsInN1YiI6IjY0MzNiMGUwOWE2NDM1MDY4OTQ4ZjEyMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.kv9n-HyuVbEVVoIf9G0X8TMoc8QBIPFKPxqC1wDIID0',
                'accept' => 'application/json',
            ],
        ]);

        $now_playing_movies = json_decode($response->getBody(), true)['results'];

        // Fetch Genre List
        $genreResponse = $client->request('GET', 'https://api.themoviedb.org/3/genre/movie/list?api_key=f7f87d2556969f9f5d96533dd7a425d1', [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmN2Y4N2QyNTU2OTY5ZjlmNWQ5NjUzM2RkN2E0MjVkMSIsIm5iZiI6MTcyNDM5NDA2Mi42NTIxMDEsInN1YiI6IjY0MzNiMGUwOWE2NDM1MDY4OTQ4ZjEyMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.kv9n-HyuVbEVVoIf9G0X8TMoc8QBIPFKPxqC1wDIID0',
                'accept' => 'application/json',
            ],
        ]);

        $genres = json_decode($genreResponse->getBody(), true)['genres'];

        // Map Genre IDs to Names
        $genreMap = [];
        foreach ($genres as $genre) {
            $genreMap[$genre['id']] = $genre['name'];
        }

        // Add Genre Names to Movies
        foreach ($now_playing_movies as &$movie) {
            $movie['genre_names'] = array_map(function ($genreId) use ($genreMap) {
                return $genreMap[$genreId] ?? 'Unknown'; // 'Unknown' as fallback
            }, $movie['genre_ids']);
        }
        foreach ($now_playing_movies as &$movie) {
            $rating_out_of_five = round($movie['vote_average'] / 2);
        }
        // Pass movies with genres to the view
        return view('welcome', compact('now_playing_movies', 'rating_out_of_five'));
    }


    public function movies_list()
    {
        return view('movies_list');
    }
}
