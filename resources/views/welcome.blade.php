@extends('layouts.app')
@section('content')

<div class="home-slider owl-carousel js-fullheight position-relative">
    <!-- First Slider Item -->
    <div class="slider-item js-fullheight" style="background-image: url('{{ asset('images/slider-1.jpg') }}');">
        <div class="overlay"></div>
        <!-- Navbar Inside Each Carousel Slide -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent position-absolute top-0 start-0 w-100"
            style="z-index: 10;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Slider Text -->
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
                <div class="col-md-12 ftco-animate">
                    <div class="text w-100 text-center">
                        <h2>Best Place to Travel</h2>
                        <h1 class="mb-3">Norway</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Slider Item -->
    <div class="slider-item js-fullheight" style="background-image: url('{{ asset('images/slider-2.jpg') }}');">
        <div class="overlay"></div>
        <!-- Navbar Inside Each Carousel Slide -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent position-absolute top-0 start-0 w-100"
            style="z-index: 10;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent2">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Slider Text -->
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
                <div class="col-md-12 ftco-animate">
                    <div class="text w-100 text-center">
                        <h2>Best Place to Travel</h2>
                        <h1 class="mb-3">Japan</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Third Slider Item -->
    <div class="slider-item js-fullheight" style="background-image: url('{{ asset('images/slider-3.jpg') }}');">
        <div class="overlay"></div>
        <!-- Navbar Inside Each Carousel Slide -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent position-absolute top-0 start-0 w-100"
            style="z-index: 10;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent3" aria-controls="navbarSupportedContent3"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent3">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Slider Text -->
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
                <div class="col-md-12 ftco-animate">
                    <div class="text w-100 text-center">
                        <h2>Best Place to Travel</h2>
                        <h1 class="mb-3">Singapore</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Now Playing Section -->
<h1>Now Playing</h1>

<div class="container text-center">
    <div class="row">
        @foreach ($movies as $index => $movie)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-4">
                    <h2>{{ $movie['title'] }}</h2>
                    <img src="{{ 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] }}"
                        alt="{{ $movie['title'] }} Poster" class="img-fluid">
                    <p><strong>Overview:</strong> {{ limitWords($movie['overview'], 20) }}</p>
                    <p><strong>Release Date:</strong> {{ $movie['release_date'] }}</p>
                    <p><strong>Rating:</strong> {{ $movie['vote_average'] }}/10</p>
                </div>

                @if (($index + 1) % 5 == 0)
                    </div>
                    <div class="row">
                @endif
        @endforeach
    </div>
</div>

@endsection