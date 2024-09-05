<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

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
}
