<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class TvSeriesListController extends Controller
{

    private $client;
    private $apiKey = 'f7f87d2556969f9f5d96533dd7a425d1';

    public function __construct()
    {
        $this->client = new Client();
    }



    public function tvSeriesList(Request $request)
    {
        // Define the number of TV series per page
        $seriesPerPage = 8;

        // Get the current page, sort order, and language from the query parameters
        $page = $request->query('page', 1);
        $sort = $request->query('sort', 'popularity.desc'); // Default sorting
        $selectedLanguage = $request->query('language', 'en'); // Default language is English

        // Check if the language counts are already cached
        $languageCounts = Cache::remember('SerieslanguageCounts', now()->addHours(24), function () {
            $languageCounts = [];
            $response = $this->client->request('GET', 'https://api.themoviedb.org/3/configuration/languages', [
                'query' => [
                    'api_key' => $this->apiKey,
                ],
            ]);
            $languages = json_decode($response->getBody(), true);

            foreach ($languages as $language) {
                $response = $this->client->request('GET', 'https://api.themoviedb.org/3/discover/tv', [
                    'query' => [
                        'api_key' => $this->apiKey,
                        'with_original_language' => $language['iso_639_1'],
                    ],
                ]);

                $data = json_decode($response->getBody(), true);
                $totalSeries = $data['total_results'];

                if ($totalSeries > 0) {
                    $languageCounts[] = [
                        'iso_639_1' => $language['iso_639_1'],
                        'language' => $language['english_name'],
                        'totalSeries' => $totalSeries,
                    ];
                }
            }

            // Sort languages by the total number of series in descending order
            usort($languageCounts, function ($a, $b) {
                return $b['totalSeries'] <=> $a['totalSeries'];
            });

            return $languageCounts;
        });

        // Fetch data for the current page
        $response = $this->client->request('GET', 'https://api.themoviedb.org/3/discover/tv', [
            'query' => [
                'api_key' => $this->apiKey,
                'sort_by' => $sort,
                'page' => $page,
                'with_original_language' => $selectedLanguage,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        // Get the TV series data for the current page
        $series = $data['results'];

        // Calculate total pages based on TV series per page
        $totalSeries = $data['total_results'];
        $totalPages = ceil($totalSeries / $seriesPerPage);

        // Pass the TV series and pagination info to the view
        return view('lists/tv_series_list', [
            'series' => $series,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'seriesPerPage' => $seriesPerPage,
            'sort' => $sort,
            'selectedLanguage' => $selectedLanguage,
            'languageCounts' => $languageCounts,
        ]);
    }



}
