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
                    <a class="nav-link text-light fs-5" href="{{ route('movies.list') }}">Movies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light fs-5" href="{{ route('tv.series.list') }}">Tv Series</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
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
    <h1 class="mb-4 text-center text-light">TV Series List</h1>
    <div class="row">
        <div class="col-md-3">
            <!-- Filters -->
            <div class="mb-4">
                <h5 class="text-light">Filters</h5>
                <form method="GET" action="{{ route('tv.series.list') }}">
                    <div class="mb-3">
                        <div class="me-2 mb-3">
                            <label for="sort" class="form-label text-light">Sort By:</label>
                            <select id="sort" name="sort" class="form-select" onchange="this.form.submit()">
                                <option value="popularity.desc" {{ $sort === 'popularity.desc' ? 'selected' : '' }}>
                                    Popularity
                                    Descending</option>
                                <option value="popularity.asc" {{ $sort === 'popularity.asc' ? 'selected' : '' }}>
                                    Popularity
                                    Ascending</option>
                                <option value="name.asc" {{ $sort === 'name.asc' ? 'selected' : '' }}>Title Ascending
                                    (A-Z)
                                </option>
                                <option value="name.desc" {{ $sort === 'name.desc' ? 'selected' : '' }}>Title Descending
                                    (Z-A)
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="language" class="form-label text-light">Language:</label>
                            <select id="language" name="language" class="form-select" onchange="this.form.submit()">
                                @foreach ($languageCounts as $language)
                                    @if(is_array($language) && isset($language['iso_639_1'], $language['language'], $language['totalSeries']))
                                        <option value="{{ $language['iso_639_1'] }}" {{ $selectedLanguage === $language['iso_639_1'] ? 'selected' : '' }}>
                                            {{ $language['language'] }} ({{ $language['totalSeries'] }})
                                        </option>
                                    @endif
                                @endforeach
                            </select>

                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- list for TV Series -->
        <div class="col-md-9">
            <!-- TV Series Grid -->
            <div class="row">
                @foreach ($series as $tvShow)
                                @php
                                    $rating_out_of_five = round($tvShow['vote_average'] / 2);
                                    $posterUrl = blankPoster($tvShow['poster_path']);
                                @endphp
                                <div class="col-md-3 mb-4">
                                    <div class="text-light">

                                        <img src="{{ $posterUrl }}" alt="{{ $tvShow['name'] }} Poster" class="img-fluid w-60 p-2"
                                            style="border-radius: 17px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">{{ limitWords($tvShow['name'], 1) }}</h5>
                                            <p><i class="bi bi-calendar-event"
                                                    style="color:#ffee00;"></i>&nbsp;{{$tvShow['first_air_date']}}</p>
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
            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
                <nav>
                    <ul class="pagination">
                        @if ($currentPage > 1)
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ url('tv_series?page=' . ($currentPage - 1) . '&language=' . $selectedLanguage . '&sort=' . $sort) }}">Previous</a>
                            </li>
                        @endif

                        @php
                            $startPage = max(1, $currentPage - 5); // Adjust this to control the range of pages shown
                            $endPage = min($totalPages, $currentPage + 4); // Show 10 pages at most
                        @endphp

                        @for ($i = $startPage; $i <= $endPage; $i++)
                            <li class="page-item @if ($i == $currentPage) active @endif">
                                <a class="page-link"
                                    href="{{ url('tv_series?page=' . $i . '&language=' . $selectedLanguage . '&sort=' . $sort) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        @if ($currentPage < $totalPages)
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ url('tv_series?page=' . ($currentPage + 1) . '&language=' . $selectedLanguage . '&sort=' . $sort) }}">Next</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
            <!-- Jump to Page Form -->
            <div class="d-flex justify-content-center mt-3">
                <form action="{{ url('tv_series') }}" method="get" class="form-inline">
                    <label for="jumpToPage" class="mr-2 text-light fw-bold">Jump to Page:</label>
                    <input type="number" id="jumpToPage" name="page" class="form-control" min="1"
                        max="{{ $totalPages }}" value="{{ $currentPage }}">
                    <button type="submit" class="btn btn-primary ml-2">Go</button>
                </form>
            </div>
            <p class=" text-center text-light"><span class="fw-bold">Total Pages:</span>{{$totalPages}}</p>

            <p class=" text-center text-light"><span class="fw-bold">Total Pages:</span>{{$totalPages}}</p>
        </div>
    </div>



</div>

@endsection