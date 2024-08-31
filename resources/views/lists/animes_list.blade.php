@extends('layouts.app')
@section('content')
<!-- Navbar Inside Each Carousel Slide -->
<nav class="navbar navbar-expand-lg navbar-dark bg-transparent position-absolute top-0 start-0 w-100 mb-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/logo3.png') }}" alt="Logo" class="img-fluid" style="max-height: 80px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1"
            aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent1">

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <div class="search-box">
                        <button class="btn-search"><i class="bi bi-search"></i></button>
                        <input type="text" class="input-search" placeholder="Type to Search...">
                    </div>

                </li>
                <li class="nav-item">
                    <a class="nav-link text-light fs-5" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light fs-5" href="movies">Movies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light fs-5" href="tv_series">Tv Series</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-light fs-5" href="anime">Anime</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Porifle</a></li>
                        <li><a class="dropdown-item" href="#">WatchList</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light fs-5" href="#">Signup</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light fs-5" href="#">Login</a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<div class="container col-md-12" style="margin-top:7rem !important;">
    <h1 class="mb-1 text-center text-light">Animes</h1>
    <p class=" mb-3 text-center text-light"><span>(Total Anime:</span>{{$total_anime}})</p>

    <div class="row anime-row">
        @foreach ($animes as $anime)
                @php
                    $rating_out_of_five = round($anime['score'] / 2);
                    $posterUrl = animeBlankPoster($anime['images']['jpg']['image_url']);
                @endphp
                <div class="col anime-col mb-4">
                    <div class="text-light">
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
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $rating_out_of_five)
                                        <i class="bi bi-star-fill text-warning"></i> <!-- Filled star -->
                                    @else
                                        <i class="bi bi-star text-warning"></i> <!-- Empty star -->
                                    @endif
                                @endfor
                            </div>
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
                        <a class="page-link" href="{{ url('anime?page=' . ($currentPage - 1)) }}">Previous</a>
                    </li>
                @endif

                @php
                    $startPage = max(1, $currentPage - 5); // Adjust this to control the range of pages shown
                    $endPage = min($totalPages, $currentPage + 4); // Show 10 pages at most
                @endphp

                @for ($i = $startPage; $i <= $endPage; $i++)
                    <li class="page-item @if ($i == $currentPage) active @endif">
                        <a class="page-link" href="{{ url('anime?page=' . $i) }}">{{ $i }}</a>
                    </li>
                @endfor

                @if ($currentPage < $totalPages)
                    <li class="page-item">
                        <a class="page-link" href="{{ url('anime?page=' . ($currentPage + 1)) }}">Next</a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
    <!-- Jump to Page Form -->
    <div class="d-flex justify-content-center mt-3">
        <form action="{{ url('anime') }}" method="get" class="form-inline">
            <label for="jumpToPage" class="mr-2 text-light fw-bold">Jump to Page:</label>
            <input type="number" id="jumpToPage" name="page" class="form-control" min="1" max="{{ $totalPages }}"
                value="{{ $currentPage }}">
            <button type="submit" class="btn btn-primary ml-2">Go</button>
        </form>
    </div>
    <p class="text-center text-light"><span class="fw-bold">Total Pages:</span> {{$totalPages}}</p>
</div>





@endsection