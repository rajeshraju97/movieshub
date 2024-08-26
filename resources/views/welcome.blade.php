@extends('layouts.app')
@section('content')




<div class="home-slider owl-carousel js-fullheight position-relative">
    @foreach ($now_playing_movies as $movie)
        @php
            $rating_out_of_five = round($movie['vote_average'] / 2);
        @endphp
        <!-- Single Slider Item -->
        <div class="slider-item js-fullheight"
            style="background-image: url('{{ 'https://image.tmdb.org/t/p/w500' . $movie['backdrop_path'] }}');backround-size:cover;">
            <div class="overlay"></div>

            <!-- Navbar Inside Each Carousel Slide -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-transparent position-absolute top-0 start-0 w-100"
                style="z-index: 10;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('images/logo3.png') }}" alt="Logo" class="img-fluid" style="max-height: 80px;">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1"
                        aria-expanded="false" aria-label="Toggle navigation">
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
                                <a class="nav-link text-light fs-5" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light fs-5" href="#">Movies</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light fs-5" href="#">Tv Series</a>
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

            <!-- Slider Text -->
            <div class="container">
                <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
                    <div class="col-md-12 ftco-animate">
                        <div class="text w-100 text-left">
                            <h2>{{$movie['title']}}</h2>
                            <div class="d-flex">
                                <p class="me-3">{{ implode(', ', $movie['genre_names']) }}</p>

                                <p><i class="bi bi-calendar-event"
                                        style="color:#ffee00;"></i>&nbsp;{{$movie['release_date']}}</p>
                            </div>
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
            </div>
        </div>
    @endforeach
</div>


<!-- Now Playing Section -->
<h1 class="text-left my-5 text-light">Now Playing</h1>



<div class="now-playing owl-carousel">
    @foreach ($now_playing_movies as $movie)
        @php
            $rating_out_of_five = round($movie['vote_average'] / 2);
        @endphp
        <div class="item">
            <div class="text-light">

                <img src="{{ 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] }}"
                    alt="{{ $movie['title'] }} Poster" class="img-fluid w-60 p-2"
                    style="border-radius: 17px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ limitWords($movie['title'], 1) }}</h5>
                    <p><i class="bi bi-calendar-event" style="color:#ffee00;"></i>&nbsp;{{$movie['release_date']}}</p>
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

<!-- box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; -->





@endsection