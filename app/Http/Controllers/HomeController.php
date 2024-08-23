<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/now_playing?api_key=f7f87d2556969f9f5d96533dd7a425d1', [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmN2Y4N2QyNTU2OTY5ZjlmNWQ5NjUzM2RkN2E0MjVkMSIsIm5iZiI6MTcyNDM5NDA2Mi42NTIxMDEsInN1YiI6IjY0MzNiMGUwOWE2NDM1MDY4OTQ4ZjEyMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.kv9n-HyuVbEVVoIf9G0X8TMoc8QBIPFKPxqC1wDIID0',
                'accept' => 'application/json',
            ],
        ]);
        // echo $response->getBody(), true;

        $data = json_decode($response->getBody(), true);

        $movies = $data['results'];

        return view('welcome', compact('movies'));
    }

    public function movies_list()
    {
        return view('movies_list');
    }
}
