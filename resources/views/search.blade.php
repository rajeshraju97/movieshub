@extends('layouts.app')
@section('content')
@include('layouts.navbar')


<div class="container" style="margin-top: 7rem !important;">
    <!-- #region -->
    <h1 class="text-center text-light">Search Results for "{{$search_query}}"</h1>

    <div class="row">




        @foreach ($results as $result)
                @php
                    if ($result['media_type'] == 'person') {
                        // Handle 'person' media type
                        $rating_out_of_five = Null; // No rating for persons
                        $rating = 'N/A'; // No rating category for persons
                        $posterUrl = blankPoster($result['profile_path']); // Use profile_path for persons
                        $overview = ''; // Persons typically don't have an overview
                        $title = $result['name'] ?? 'Unknown Name';

                        // Use the first item in the 'known_for' array if available
                        $known_for_item = $result['known_for'][0] ?? null;
                        if ($known_for_item) {
                            $posterUrl = blankPoster($known_for_item['poster_path']);
                            $overview = limitWords($known_for_item['overview'], 30);
                            $title = $known_for_item['title'] ?? 'Unknown Title';
                        }
                    } else {
                        // Handle other media types (e.g., movies, TV shows)
                        $rating_out_of_five = isset($result['vote_average']) ? round($result['vote_average'] / 2) : null;
                        $rating = isset($result['adult']) && $result['adult'] ? 'Above 17' : 'PG-13';
                        $posterUrl = blankPoster($result['poster_path']);
                        $overview = limitWords($result['overview'], 30);
                        $title = $result['title'] ?? $result['name'] ?? 'Unknown Title';
                    }
                @endphp


                <div class="col-md-3 mb-4">
                    <div class="text-light">
                        @if ($result['media_type'] == 'movie')
                            <a href="{{ url('movies/' . $result['id']) }}" class="text-light">
                                <img src="{{ $posterUrl }}" alt="{{ $title }} Poster" class="img-fluid w-60 p-2"
                                    style="border-radius: 17px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{$title }}</h5>
                                    <div class="star-rating">
                                        @if ($rating_out_of_five !== null)
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $rating_out_of_five)
                                                    <i class="bi bi-star-fill text-warning"></i> <!-- Filled star -->
                                                @else
                                                    <i class="bi bi-star text-warning"></i> <!-- Empty star -->
                                                @endif
                                            @endfor
                                        @else
                                            <p>No Rating Available</p>
                                        @endif
                                    </div>

                                </div>
                            </a>
                        @else
                            <a href="tv_series/{{$result['id']}}" class="text-light">
                                <img src="{{ $posterUrl }}" alt="{{ $title }} Poster" class="img-fluid w-60 p-2"
                                    style="border-radius: 17px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{$title }}</h5>
                                    <div class="star-rating">
                                        @if ($rating_out_of_five !== null)
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $rating_out_of_five)
                                                    <i class="bi bi-star-fill text-warning"></i> <!-- Filled star -->
                                                @else
                                                    <i class="bi bi-star text-warning"></i> <!-- Empty star -->
                                                @endif
                                            @endfor
                                        @else
                                            <p>No Rating Available</p>
                                        @endif
                                    </div>
                                </div>
                            </a>

                        @endif

                    </div>
                </div>

        @endforeach

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            <nav>
                <ul class="pagination">
                    @if ($currentPage > 1)
                        <li class="page-item">
                            <a class="page-link"
                                href="{{ url('search?query=' . urlencode($search_query) . '&page=' . ($currentPage - 1)) }}">Previous</a>
                        </li>
                    @endif

                    @php
                        $startPage = max(1, $currentPage - 5);
                        $endPage = min($totalPages, $currentPage + 4);
                    @endphp

                    @for ($i = $startPage; $i <= $endPage; $i++)
                        <li class="page-item @if ($i == $currentPage) active @endif">
                            <a class="page-link"
                                href="{{ url('search?query=' . urlencode($search_query) . '&page=' . $i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    @if ($currentPage < $totalPages)
                        <li class="page-item">
                            <a class="page-link"
                                href="{{ url('search?query=' . urlencode($search_query) . '&page=' . ($currentPage + 1)) }}">Next</a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>

        <!-- Jump to Page Form -->
        <div class="d-flex justify-content-center mt-3">
            <form action="{{ url('search') }}" method="get" class="form-inline">
                <label for="jumpToPage" class="mr-2 text-light fw-bold">Jump to Page:</label>
                <input type="hidden" name="query" value="{{ $search_query }}">
                <input type="number" id="jumpToPage" name="page" class="form-control" min="1" max="{{ $totalPages }}"
                    value="{{ $currentPage }}">
                <button type="submit" class="btn btn-primary ml-2">Go</button>
            </form>
        </div>

        <p class="text-center text-light"><span class="fw-bold">Total Pages:</span> {{ $totalPages }}</p>



    </div>
</div>
@endsection