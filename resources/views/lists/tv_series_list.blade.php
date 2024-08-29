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

<div class="container" style="margin-top:7rem !important;">
    <h1 class="mb-4 text-center text-light">TV Series List</h1>

    <!-- Filters -->
    <div class="mb-4 text-center">
        <form method="GET" action="{{ route('tv.series.list') }}">
            <div class="d-flex justify-content-center mb-2">
                <div class="me-2">
                    <label for="sort" class="form-label text-light">Sort By:</label>
                    <select id="sort" name="sort" class="form-select" onchange="this.form.submit()">
                        <option value="popularity.desc" {{ $sort === 'popularity.desc' ? 'selected' : '' }}>Popularity
                            Descending</option>
                        <option value="popularity.asc" {{ $sort === 'popularity.asc' ? 'selected' : '' }}>Popularity
                            Ascending</option>
                        <option value="name.asc" {{ $sort === 'name.asc' ? 'selected' : '' }}>Title Ascending (A-Z)
                        </option>
                        <option value="name.desc" {{ $sort === 'name.desc' ? 'selected' : '' }}>Title Descending (Z-A)
                        </option>
                    </select>
                </div>
                <div>
                    <label for="language" class="form-label text-light">Language:</label>
                    <select id="language" name="language" class="form-select" onchange="this.form.submit()">
                        <option value="en" {{ $language === 'en' ? 'selected' : '' }}>English</option>
                        <option value="es" {{ $language === 'es' ? 'selected' : '' }}>Spanish</option>
                        <option value="fr" {{ $language === 'fr' ? 'selected' : '' }}>French</option>
                        <option value="de" {{ $language === 'de' ? 'selected' : '' }}>German</option>
                        <option value="te" {{ $language === 'te' ? 'selected' : '' }}>Telugu</option>
                        <!-- Add more languages as needed -->
                    </select>
                </div>
            </div>
        </form>
    </div>

    <!-- TV Series Grid -->
    <div class="row">
        @foreach ($series as $tvShow)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <!-- TV Series Image -->
                    <img src="https://image.tmdb.org/t/p/w500{{ $tvShow['poster_path'] }}" class="card-img-top"
                        alt="{{ $tvShow['name'] }}">
                    <div class="card-body bg-dark text-light">
                        <h5 class="card-title">{{ limitWords($tvShow['name'], 3)  }}</h5>
                        <p class="text-center"><i class="bi bi-calendar-event"
                                style="color:#ffee00;"></i>&nbsp;{{$tvShow['first_air_date']}}</p>
                        </p>
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
                        <a class="page-link"
                            href="{{ url('tv_series?page=' . ($currentPage - 1) . '&sort=' . $sort . '&language=' . $language) }}">Previous</a>
                    </li>
                @endif

                <!-- Show Pagination Links Dynamically -->
                @php
                    $startPage = max(1, $currentPage - 5); // Adjust this to control the range of pages shown
                    $endPage = min($totalPages, $currentPage + 4); // Show 10 pages at most
                @endphp

                @for ($i = $startPage; $i <= $endPage; $i++)
                    <li class="page-item @if ($i == $currentPage) active @endif">
                        <a class="page-link"
                            href="{{ url('tv_series?page=' . $i . '&sort=' . $sort . '&language=' . $language) }}">{{ $i }}</a>
                    </li>
                @endfor

                @if ($currentPage < $totalPages)
                    <li class="page-item">
                        <a class="page-link"
                            href="{{ url('tv_series?page=' . ($currentPage + 1) . '&sort=' . $sort . '&language=' . $language) }}">Next</a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>

@endsection