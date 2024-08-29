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

<div class="container" style="margin-top:7rem !important;">
    <h1 class="mb-4 text-center text-light">World Popular Movies</h1>

    <!-- Movies Grid -->
    <div class="row">
        @foreach ($movies as $movie)
                @php
                    $posterUrl = blankPoster($movie['poster_path']);
                @endphp
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <!-- Movie Image -->
                        <img src="{{ $posterUrl }}" class="card-img-top" alt="{{ $movie['title'] }}">
                        <div class="card-body bg-dark text-light">
                            <h5 class="card-title">{{ limitWords($movie['title'], 3)}}</h5>
                            <p class="card-text">{{ limitWords($movie['overview'], 10) }}</p>
                            <p class="text-center"><i class="bi bi-calendar-event"
                                    style="color:#ffee00;"></i>&nbsp;{{$movie['release_date']}}</p>
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
                        <a class="page-link" href="{{ url('movies/wpml?page=' . ($currentPage - 1)) }}">Previous</a>
                    </li>
                @endif

                <!-- Show Pagination Links Dynamically -->
                @php
                    $startPage = max(1, $currentPage - 5); // Adjust this to control the range of pages shown
                    $endPage = min($totalPages, $currentPage + 4); // Show 10 pages at most
                @endphp

                @for ($i = $startPage; $i <= $endPage; $i++)
                    <li class="page-item @if ($i == $currentPage) active @endif">
                        <a class="page-link" href="{{ url('movies/wpml?page=' . $i) }}">{{ $i }}</a>
                    </li>
                @endfor

                @if ($currentPage < $totalPages)
                    <li class="page-item">
                        <a class="page-link" href="{{ url('movies/wpml?page=' . ($currentPage + 1)) }}">Next</a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>




@endsection