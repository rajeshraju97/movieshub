<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    //
    private $client;

    private $api_key = 'f7f87d2556969f9f5d96533dd7a425d1';

    public function __construct()
    {
        $this->client = new Client();
    }
    //
    public function index(Request $request)
    {
        // Get search query from POST or GET request
        $search_query = $request->input('search_query', $request->query('q', ''));
        // Get the current page number from GET request
        $page = $request->query('p', 1);

        // Perform the API request
        $response = $this->client->request('GET', 'https://api.themoviedb.org/3/search/multi', [
            'query' => [
                'query' => $search_query,
                'api_key' => $this->api_key,
                'page' => $page
            ],
        ]);

        // Decode the response
        $data = json_decode($response->getBody(), true);

        $results = $data['results'];
        $totalPages = $data['total_pages'];


        // Return the view with data
        return view('search', [
            'search_query' => $search_query,
            'results' => $results,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ]);
    }



}
