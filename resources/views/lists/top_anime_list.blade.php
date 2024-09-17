@extends('layouts.app')
@section('content')

<!-- Navbar Inside Each Carousel Slide -->
@include('layouts.navbar')

<div class="container col-md-12" style="margin-top:7rem !important;">
    <h1 class="mb-1 text-center text-light">Top Anime</h1>
    <p class=" mb-3 text-center text-light"><span>(Total Popular Anime:</span>{{$total_anime}})</p>

    <div class="row anime-row">
        @foreach ($animes as $anime)
                @php
                    $rating_out_of_five = round($anime['score'] / 2);
                    $posterUrl = animeBlankPoster($anime['images']['jpg']['image_url']);
                    $isInWatchlist = $watchlistItems->contains($anime['mal_id']);
                @endphp
                <div class="col anime-col mb-4">
                    <div class="text-light">
                        <a href="anime/{{$anime['mal_id']}}" class="text-light">
                            <img src="{{ $posterUrl }}" alt="{{ $anime['title'] }} Poster" class="img-fluid"
                                style="border-radius: 17px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                            <div class="card-body text-center">
                                <h6 class="card-title">{{ $anime['title_english'] }}</h6>
                                <p>
                                    <span style="color:#ffee00;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-vignette" viewBox="0 0 16 16">
                                            <path d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8" />
                                            <path
                                                d="M8.5 4.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 7a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m1.683-6.281a.5.5 0 1 1-.866-.5.5.5 0 0 1 .866.5m-3.5 6.062a.5.5 0 1 1-.866-.5.5.5 0 0 1 .866.5m4.598-4.598a.5.5 0 1 1-.5-.866.5.5 0 0 1 .5.866m-6.062 3.5a.5.5 0 1 1-.5-.866.5.5 0 0 1 .5.866M11.5 8.5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m-7 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m6.281 1.683a.5.5 0 1 1 .5-.866.5.5 0 0 1-.5.866m-6.062-3.5a.5.5 0 1 1 .5-.866.5.5 0 0 1-.5.866m4.598 4.598a.5.5 0 1 1 .866-.5.5.5 0 0 1-.866.5" />
                                        </svg>
                                    </span>&nbsp;{{$anime['status']}}
                                </p>
                                <p>&nbsp;&nbsp;&nbsp;{{$anime['aired']['string']}}</p>

                                <div class="star-rating">
                                    @for ($i = 0; $i < 5; $i++) @if ($i < $rating_out_of_five) <i
                                        class="bi bi-star-fill text-warning"></i> <!-- Filled star -->
                                    @else
                                        <i class="bi bi-star text-warning"></i> <!-- Empty star -->
                                    @endif
                                    @endfor
                                </div>
                        </a>
                        @auth
                            <form action="{{ route('watchlist') }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="anime_id" value="{{ $anime['mal_id'] }}">
                                <input type="hidden" name="action" value="{{ $isInWatchlist ? 'remove' : 'add' }}">
                                <button type="submit" style="border: none; background: none; padding: 0; cursor: pointer;">
                                    <i class="bi {{ $isInWatchlist ? 'bi-suit-heart-fill' : 'bi-suit-heart' }}"
                                        style="color: {{ $isInWatchlist ? 'red' : '#ffee00' }}; font-size: 27px;"
                                        title="{{ $isInWatchlist ? 'Added to watchlist' : 'Add to watchlist' }}"></i>
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
</div>

<!-- Pagination Links -->
<div class="d-flex justify-content-center">
    <nav>
        <ul class="pagination">
            @if ($currentPage > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ url('anime/popular_anime?page=' . ($currentPage - 1)) }}">Previous</a>
                </li>
            @endif

            @php
                $startPage = max(1, $currentPage - 5); // Adjust this to control the range of pages shown
                $endPage = min($totalPages, $currentPage + 4); // Show 10 pages at most
            @endphp

            @for ($i = $startPage; $i <= $endPage; $i++)
                <li class="page-item @if ($i == $currentPage) active @endif">
                    <a class="page-link" href="{{ url('anime/popular_anime?page=' . $i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($currentPage < $totalPages)
                <li class="page-item">
                    <a class="page-link" href="{{ url('anime/popular_anime?page=' . ($currentPage + 1)) }}">Next</a>
                </li>
            @endif
        </ul>
    </nav>
</div>
<!-- Jump to Page Form -->
<div class="d-flex justify-content-center mt-3">
    <form action="{{ url('anime/popular_anime') }}" method="get" class="form-inline">
        <label for="jumpToPage" class="mr-2 text-light fw-bold">Jump to Page:</label>
        <input type="number" id="jumpToPage" name="page" class="form-control" min="1" max="{{ $totalPages }}"
            value="{{ $currentPage }}">
        <button type="submit" class="btn btn-primary ml-2">Go</button>
    </form>
</div>
<p class="text-center text-light"><span class="fw-bold">Total Pages:</span> {{$totalPages}}</p>
</div>





@endsection