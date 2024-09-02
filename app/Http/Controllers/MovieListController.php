<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class MovieListController extends Controller
{
    private $client;
    private $apiKey = 'f7f87d2556969f9f5d96533dd7a425d1';

    public function __construct()
    {
        $this->client = new Client();
    }

    private function fetchMoviesWithPagination($endpoint, $page, $additionalParams = [])
    {
        $maxPage = 500;

        // Adjust the page number for the API's 500-page limit
        $adjustedPage = $page % $maxPage;
        if ($adjustedPage === 0) {
            $adjustedPage = $maxPage;
        }

        // Build the query parameters
        $queryParams = array_merge([
            'api_key' => $this->apiKey,
            'page' => $adjustedPage,
        ], $additionalParams);

        // Make the request to the TMDB API
        $response = $this->client->request('GET', $endpoint, [
            'query' => $queryParams,
        ]);

        return json_decode($response->getBody(), true);
    }
    //total movies lists for all languages
    public function moviesList(Request $request)
    {
        $moviesPerPage = 20;
        $sort = $request->query('s', 'popularity.desc');
        $selectedLanguage = $request->query('l', 'en');
        $selectedGenre = $request->query('g', []);
        $page = $request->query('p', 1);

        // Ensure selectedGenre is an array
        if (is_string($selectedGenre)) {
            $selectedGenre = explode(',', $selectedGenre);
        }

        // Fetch languages
        $languageCounts = Cache::remember('movieslanguageCounts', now()->addHours(24), function () {
            $client = $this->client;
            $apiKey = $this->apiKey;

            $languageCounts = [];
            $response = $client->request('GET', 'https://api.themoviedb.org/3/configuration/languages', [
                'query' => [
                    'api_key' => $apiKey,
                ],
            ]);

            $languages = json_decode($response->getBody(), true);

            foreach ($languages as $language) {
                $response = $client->request('GET', 'https://api.themoviedb.org/3/discover/movie', [
                    'query' => [
                        'api_key' => $apiKey,
                        'with_original_language' => $language['iso_639_1'],
                    ],
                ]);

                $data = json_decode($response->getBody(), true);
                $totalMovies = $data['total_results'];

                if ($totalMovies > 0) {
                    $languageCounts[] = [
                        'iso_639_1' => $language['iso_639_1'],
                        'language' => $language['english_name'],
                        'totalMovies' => $totalMovies,
                    ];
                }
            }

            usort($languageCounts, function ($a, $b) {
                return $b['totalMovies'] <=> $a['totalMovies'];
            });

            return $languageCounts;
        });

        // Fetch genres
        $genresResponse = $this->client->request('GET', 'https://api.themoviedb.org/3/genre/movie/list', [
            'query' => [
                'api_key' => $this->apiKey,
                'language' => 'en',
            ],
        ]);
        $genres = json_decode($genresResponse->getBody(), true)['genres'];

        // Build query parameters
        $queryParams = [
            'sort_by' => $sort,
            'with_original_language' => $selectedLanguage,
        ];

        if (!empty($selectedGenre)) {
            $queryParams['with_genres'] = implode(',', $selectedGenre);
        }


        // Fetch movies with pagination
        $data = $this->fetchMoviesWithPagination('https://api.themoviedb.org/3/discover/movie', $page, $queryParams);

        $movies = $data['results'];
        $totalMovies = $data['total_results'];
        $totalPages = ceil($totalMovies / $moviesPerPage);

        return view('lists.movies_list', [
            'movies' => $movies,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'moviesPerPage' => $moviesPerPage,
            'sort' => $sort,
            'selectedLanguage' => $selectedLanguage,
            'selectedGenre' => $selectedGenre,
            'languageCounts' => $languageCounts,
            'genres' => $genres,
        ]);
    }

    //world popular movies list
    public function wpmoviesList(Request $request)
    {
        $moviesPerPage = 20;
        $page = $request->query('page', 1);

        $data = $this->fetchMoviesWithPagination('https://api.themoviedb.org/3/movie/popular', $page, [
            'sort_by' => 'popularity.desc',
        ]);

        $movies = $data['results'];
        $totalPages = $data['total_pages'];

        return view('lists/world_popular_movies_list', [
            'movies' => $movies,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'moviesPerPage' => $moviesPerPage,
        ]);
    }
    //top rated movies list
    public function trmoviesList(Request $request)
    {
        $moviesPerPage = 20;
        $page = $request->query('page', 1);

        $data = $this->fetchMoviesWithPagination('https://api.themoviedb.org/3/movie/top_rated', $page, [
            'sort_by' => 'popularity.desc',
        ]);

        $movies = $data['results'];
        $totalMovies = $data['total_results'];
        $totalPages = ceil($totalMovies / $moviesPerPage);

        return view('lists/top_rated_ml', [
            'movies' => $movies,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'moviesPerPage' => $moviesPerPage,
        ]);
    }
    //telugu popular movies list
    public function tpmoviesList(Request $request)
    {
        $moviesPerPage = 20;
        $page = $request->query('page', 1);

        $response = $this->client->request('GET', 'https://api.themoviedb.org/3/discover/movie', [
            'query' => [
                'api_key' => $this->apiKey,
                'sort_by' => 'popularity.desc',
                'language' => 'en-US',
                'region' => 'IN',
                'with_original_language' => 'te',
                'page' => $page,
            ],
        ]);

        // Decode the JSON response to an associative array
        $data = json_decode($response->getBody(), true);

        // Now you can access the data as an array
        $movies = $data['results'];
        $totalMovies = $data['total_results'];
        $totalPages = ceil($totalMovies / $moviesPerPage);

        return view('lists.telugu_pml', [
            'movies' => $movies,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'moviesPerPage' => $moviesPerPage,
        ]);

    }
}
