@extends('layouts.app')
@section('content')



<!-- //owl caurosel of the -->
<div class="home-slider owl-carousel js-fullheight position-relative">
    @foreach ($nowPlayingMovies as $movie)
        @php
            $rating_out_of_five = round($movie['vote_average'] / 2);
            $rating = $movie['adult'] ? 'Above 17' : 'PG-13'; // Determine the rating
        @endphp
        <!-- Single Slider Item -->
        <div class="slider-item js-fullheight"
            style="background-image: url('{{ 'https://image.tmdb.org/t/p/w500' . $movie['backdrop_path'] }}');backround-size:cover;">
            <div class="overlay"></div>

            <!-- Navbar Inside Each Carousel Slide -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-transparent position-absolute top-0 start-0 w-100"
                style="z-index: 10;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">
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
                                <span class="border p-1 ml-2">{{$rating}}</span>
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
    @foreach ($nowPlayingMovies as $movie)
        @php
            $rating_out_of_five = round($movie['vote_average'] / 2);
            $posterUrl = blankPoster($movie['poster_path']);
        @endphp
        <div class="item">
            <div class="text-light">

                <img src="{{ $posterUrl }}" alt="{{ $movie['title'] }} Poster" class="img-fluid w-60 p-2"
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
<!-- end of the now playing section -->

<!--World Popular movies Section -->
<h1 class="text-left my-5 text-light"><a href="movies/wpml" class="text-light">World Popular Movies</a></h1>
<div class="now-playing owl-carousel">
    @foreach ($popularWorldMovies as $movie)
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


<!--Telugu Popular movies Section -->
<h1 class="text-left my-5 text-light"><a href="movies/tpml" class="text-light">Telugu Popular Movies</a></h1>
<div class="now-playing owl-carousel">
    @foreach ($popularTeluguMovies as $movie)
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

<!--Top Rated movies Section -->
<h1 class="text-left my-5 text-light"><a href="movies/trml" class="text-light">Top Rated Movies</a></h1>
<div class="now-playing owl-carousel">
    @foreach ($topRatedMovies as $movie)
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

<!--Upcoming movies Section -->
<h1 class="text-left my-5 text-light">Upcoming Movies</h1>
<div class="now-playing owl-carousel">
    @foreach ($upcomingMovies as $movie)
        @php
            $rating_out_of_five = round($movie['vote_average'] / 2);
            $posterUrl = blankPoster($movie['poster_path']);
        @endphp
        <div class="item">
            <div class="text-light">

                <img src="{{ $posterUrl }}" alt="{{ $movie['title'] }} Poster" class="img-fluid w-60 p-2"
                    style="border-radius: 17px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ limitWords($movie['title'], 1) }}</h5>
                    <p><i class="bi bi-calendar-event" style="color:#ffee00;"></i>&nbsp;{{$movie['release_date']}}</p>
                    <!-- <div class="star-rating">
                                                                                                                                                                                                                                                                    @for ($i = 0; $i < 5; $i++)
                                                                                                                                                                                                                                                                        @if ($i < $rating_out_of_five)
                                                                                                                                                                                                                                                                            <i class="bi bi-star-fill text-warning"></i> 
                                                                                                                                                                                                                                                                        @else
                                                                                                                                                                                                                                                                            <i class="bi bi-star text-warning"></i> 
                                                                                                                                                                                                                                                                        @endif
                                                                                                                                                                                                                                                                    @endfor
                                                                                                                                                                                                                                                                </div> -->
                </div>
            </div>
        </div>
    @endforeach
</div>

<!--Popular Anime Section -->
<h1 class="text-left my-5 text-light">Popular Anime</h1>
<div class="now-playing owl-carousel">
    @foreach ($popularAnime as $anime)
        @php
            $rating_out_of_five = round($anime['score'] / 2);
            $posterUrl = animeBlankPoster($anime['images']['jpg']['image_url']);
        @endphp
        <div class="item">
            <div class="text-light">

                <img src="{{ $posterUrl }}" alt="{{ $anime['title'] }} Poster" class="img-fluid w-60 p-2"
                    style="border-radius: 17px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                <div class="card-body text-center">
                    <h6 class="card-title">{{ $anime['title_english'] }}</h6>
                    <p><span style="color:#ffee00;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-vignette" viewBox="0 0 16 16">
                                <path d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8" />
                                <path
                                    d="M8.5 4.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 7a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m1.683-6.281a.5.5 0 1 1-.866-.5.5.5 0 0 1 .866.5m-3.5 6.062a.5.5 0 1 1-.866-.5.5.5 0 0 1 .866.5m4.598-4.598a.5.5 0 1 1-.5-.866.5.5 0 0 1 .5.866m-6.062 3.5a.5.5 0 1 1-.5-.866.5.5 0 0 1 .5.866M11.5 8.5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m-7 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m6.281 1.683a.5.5 0 1 1 .5-.866.5.5 0 0 1-.5.866m-6.062-3.5a.5.5 0 1 1 .5-.866.5.5 0 0 1-.5.866m4.598 4.598a.5.5 0 1 1 .866-.5.5.5 0 0 1-.866.5m-3.5-6.062a.5.5 0 1 1 .866-.5.5.5 0 0 1-.866.5" />
                            </svg></span>&nbsp;{{$anime['status']}}</p>
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

<!--Upcoming Anime Section -->
<h1 class="text-left my-5 text-light">Upcoming Anime</h1>
<div class="now-playing owl-carousel">
    @foreach ($upcomingAnime as $anime)
        @php
            $rating_out_of_five = round($anime['score'] / 2);
            $posterUrl = animeBlankPoster($anime['images']['jpg']['large_image_url']);
            $title = $anime['title_english'] ?? $anime['title']; // Use the English title if it exists, otherwise the original title
        @endphp

        <div class="item">
            <div class="text-light">

                <img src="{{ $posterUrl }}" alt="{{ $anime['title'] }} Poster" class="img-fluid w-60 p-2"
                    style="border-radius: 17px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                <div class="card-body text-center">

                    <h6 class="card-title">{{$title}}</h6>
                    <!-- <p><span style="color:#ffee00;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                    fill="currentColor" class="bi bi-vignette" viewBox="0 0 16 16">
                                                                    <path d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8" />
                                                                    <path
                                                                        d="M8.5 4.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 7a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m1.683-6.281a.5.5 0 1 1-.866-.5.5.5 0 0 1 .866.5m-3.5 6.062a.5.5 0 1 1-.866-.5.5.5 0 0 1 .866.5m4.598-4.598a.5.5 0 1 1-.5-.866.5.5 0 0 1 .5.866m-6.062 3.5a.5.5 0 1 1-.5-.866.5.5 0 0 1 .5.866M11.5 8.5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m-7 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m6.281 1.683a.5.5 0 1 1 .5-.866.5.5 0 0 1-.5.866m-6.062-3.5a.5.5 0 1 1 .5-.866.5.5 0 0 1-.5.866m4.598 4.598a.5.5 0 1 1 .866-.5.5.5 0 0 1-.866.5m-3.5-6.062a.5.5 0 1 1 .866-.5.5.5 0 0 1-.866.5" />
                                                                </svg></span>&nbsp;{{$anime['status']}}</p>
                                                        <p>&nbsp;&nbsp;&nbsp;{{$anime['aired']['string']}}</p> -->

                    <!-- <div class="star-rating">
                                                            @for ($i = 0; $i < 5; $i++)
                                                                @if ($i < $rating_out_of_five)
                                                                    <i class="bi bi-star-fill text-warning"></i> 
                                                                @else
                                                                    <i class="bi bi-star text-warning"></i> 
                                                                @endif
                                                            @endfor
                                                        </div> -->
                </div>
            </div>
        </div>
    @endforeach
</div>




@endsection