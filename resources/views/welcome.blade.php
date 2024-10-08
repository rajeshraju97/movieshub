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
            <!-- #region -->

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
                    <div class="collapse navbar-collapse" id="navbarSupportedContent1" style="margin-right:5pc;">

                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            @auth
                                <li class="nav-item">
                                    <div class="search-box">
                                        <form action="{{route('search.multi')}}" method="post">
                                            @csrf
                                            <button type="button" class="btn-search"><i class="bi bi-search"></i></button>
                                            <input type="text" class="input-search" name="search_query"
                                                placeholder="Type to Search...">
                                        </form>
                                    </div>
                                </li>

                            @endauth
                            <li class="nav-item">
                                <a class="nav-link text-light fs-5" aria-current="page" href="/">Home</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fs-5" href="movies" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Movies
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('movies.list') }}">All Movies</a></li>
                                    <li><a class="dropdown-item" href="{{ route('wpmovies.list') }}">World Popular
                                            Movies</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('trmovies.list') }}">Top Rated Movies</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('tpmovies.list') }}">Telugu Popular
                                            Movies</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Tv Series
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('tv.series.list') }}">All Tv Series</a></li>
                                    <li><a class="dropdown-item" href="{{ route('top.rated.list') }}">Top Rated Series</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('airing.today.list') }}">Airing Today
                                            Series</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('popular.series.list') }}">Popular
                                            Series</a></li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Anime
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('anime.list') }}">All Anime</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('top.anime.list') }}">Top Anime</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('popular.anime.list') }}">Popular Anime</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('upcoming.anime.list') }}">Upcoming
                                            Anime</a>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Show Profile, Username, and Logout links if the user is authenticated -->
                            @auth
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <!-- Display the username here -->
                                        <i class="bi bi-person-circle"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">{{ auth()->user()->username }}</a></li>

                                        <li><a class="dropdown-item" href="{{route('list')}}">WatchList</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endauth

                            <!-- Show Login and Signup links if the user is a guest -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link text-light fs-5" href="/register">Sign In/Up</a>
                                </li>

                            @endguest


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
            $isInWatchlist = $watchlistItems->contains($movie['id']);
        @endphp
        <div class="item">
            <div class=" text-center text-light">
                <a href="movies/{{$movie['id']}}" class="text-light">
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
                </a>
                @auth
                    <form action="{{ route('watchlist') }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
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
    @endforeach
</div>
<!-- end of the now playing section -->

<!--World Popular movies Section -->
<h1 class="text-left my-5 text-light"><a href="movies/wpml" class="text-light">World Popular Movies</a></h1>
<div class="now-playing owl-carousel">
    @foreach ($popularWorldMovies as $movie)
            @php
                $rating_out_of_five = round($movie['vote_average'] / 2);
                $isInWatchlist = $watchlistItems->contains($movie['id']);

            @endphp
            <div class="item">
                <div class="text-light">
                    <a href="movies/{{$movie['id']}}" class="text-light">
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
                    </a>
                    @auth
                        <form action="{{ route('watchlist') }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
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




<!--Telugu Popular movies Section -->
<h1 class="text-left my-5 text-light"><a href="movies/tpml" class="text-light">Telugu Popular Movies</a></h1>
<div class="now-playing owl-carousel">
    @foreach ($popularTeluguMovies as $movie)
            @php
                $rating_out_of_five = round($movie['vote_average'] / 2);
                $posterUrl = blankPoster($movie['poster_path']);
                $isInWatchlist = $watchlistItems->contains($movie['id']);

            @endphp
            <div class="item">
                <div class="text-light">
                    <a href="movies/{{$movie['id']}}" class="text-light">
                        <img src="{{$posterUrl}}" alt="{{ $movie['title'] }} Poster" class="img-fluid w-60 p-2"
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
                    </a>
                    @auth
                        <form action="{{ route('watchlist') }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                            <input type="hidden" name="action" value="{{ $isInWatchlist ? 'remove' : 'add' }}">
                            <button type="submit" style="border: none; background: none; padding: 0; cursor: pointer;">
                                <i class="bi {{ $isInWatchlist ? 'bi-suit-heart-fill' : 'bi-suit-heart' }}"
                                    style="color: {{ $isInWatchlist ? 'red' : '#ffee00' }}; font-size: 27px;"
                                    title="{{ $isInWatchlist ? 'Added to watchlist' : 'Add to watchlist' }}"></i>
                            </button>
                        </form>
                    @endauth
                </div>
                </a>
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
                $isInWatchlist = $watchlistItems->contains($movie['id']);
            @endphp
            <div class="item">
                <div class="text-light">
                    <a href="movies/{{$movie['id']}}" class="text-light">
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
                    </a>
                    @auth
                        <form action="{{ route('watchlist') }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
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

<!--Upcoming movies Section -->
<h1 class="text-left my-5 text-light">Upcoming Movies</h1>
<div class="now-playing owl-carousel">
    @foreach ($upcomingMovies as $movie)
        @php
            $rating_out_of_five = round($movie['vote_average'] / 2);
            $posterUrl = blankPoster($movie['poster_path']);
            $isInWatchlist = $watchlistItems->contains($movie['id']);

        @endphp
        <div class="item">
            <div class="text-light text-center">
                <a href="movies/{{$movie['id']}}" class="text-light">
                    <img src="{{ $posterUrl }}" alt="{{ $movie['title'] }} Poster" class="img-fluid w-60 p-2"
                        style="border-radius: 17px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ limitWords($movie['title'], 1) }}</h5>
                        <p><i class="bi bi-calendar-event" style="color:#ffee00;"></i>&nbsp;{{$movie['release_date']}}</p>
                    </div>
                </a>
                @auth
                    <form action="{{ route('watchlist') }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
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
    @endforeach
</div>



<!--Top Rated Section -->
<h1 class="text-left my-5 text-light">Top Rated Tv Series</h1>
<div class="now-playing owl-carousel">
    @foreach ($top_rated_tvs as $top_rated_tv)
        @php
            $rating_out_of_five = round($top_rated_tv['vote_average'] / 2);
            $posterUrl = blankPoster($top_rated_tv['poster_path']);
            $isInWatchlist = $watchlistItems->contains($top_rated_tv['id']);

        @endphp
        <div class="item">
            <div class="text-light text-center">
                <a href="tv_series/{{$top_rated_tv['id']}}" class="text-light">
                    <img src="{{ $posterUrl }}" alt="{{ $top_rated_tv['name'] }} Poster" class="img-fluid w-60 p-2"
                        style="border-radius: 17px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ limitWords($top_rated_tv['name'], 1) }}</h5>
                        <p><i class="bi bi-calendar-event"
                                style="color:#ffee00;"></i>&nbsp;{{$top_rated_tv['first_air_date']}}</p>
                    </div>
                </a>
                @auth
                    <form action="{{ route('watchlist') }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="tv_series_id" value="{{ $top_rated_tv['id'] }}">
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
    @endforeach
</div>



<!--tv airing_today Section -->
<h1 class="text-left my-5 text-light">Tv Series Airing Today</h1>
<div class="now-playing owl-carousel">
    @foreach ($air_today_tvs as $air_today_tv)
        @php
            $rating_out_of_five = round($air_today_tv['vote_average'] / 2);
            $posterUrl = blankPoster($air_today_tv['poster_path']);
            $isInWatchlist = $watchlistItems->contains($air_today_tv['id']);

        @endphp
        <div class="item">
            <div class="text-light text-center">
                <a href="tv_series/{{$air_today_tv['id']}}" class="text-light">
                    <img src="{{ $posterUrl }}" alt="{{ $air_today_tv['name'] }} Poster" class="img-fluid w-60 p-2"
                        style="border-radius: 17px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ limitWords($air_today_tv['name'], 1) }}</h5>
                        <p><i class="bi bi-calendar-event"
                                style="color:#ffee00;"></i>&nbsp;{{$air_today_tv['first_air_date']}}</p>
                    </div>
                </a>
                @auth
                    <form action="{{ route('watchlist') }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="tv_series_id" value="{{ $air_today_tv['id'] }}">
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
    @endforeach
</div>


<!--Popular Section -->
<h1 class="text-left my-5 text-light">Popular Tv Series</h1>
<div class="now-playing owl-carousel">
    @foreach ($popular_tvs as $popular_tv)
        @php
            $rating_out_of_five = round($popular_tv['vote_average'] / 2);
            $posterUrl = blankPoster($popular_tv['poster_path']);
            $isInWatchlist = $watchlistItems->contains($popular_tv['id']);

        @endphp
        <div class="item">
            <div class="text-light text-center">
                <a href="tv_series/{{$popular_tv['id']}}" class="text-light">
                    <img src="{{ $posterUrl }}" alt="{{ $popular_tv['name'] }} Poster" class="img-fluid w-60 p-2"
                        style="border-radius: 17px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ limitWords($popular_tv['name'], 1) }}</h5>
                        <p><i class="bi bi-calendar-event"
                                style="color:#ffee00;"></i>&nbsp;{{$popular_tv['first_air_date']}}</p>
                    </div>
                </a>
                @auth
                    <form action="{{ route('watchlist') }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="tv_series_id" value="{{ $popular_tv['id'] }}">
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
    @endforeach
</div>





<!--Popular Anime Section -->
<h1 class="text-left my-5 text-light"><a href="anime/popular_anime" class="text-light">Popular Anime</a></h1>
<div class="now-playing owl-carousel">
    @foreach ($popularAnime as $anime)
            @php
                $rating_out_of_five = round($anime['score'] / 2);
                $posterUrl = animeBlankPoster($anime['images']['jpg']['image_url']);
                $isInWatchlist = $watchlistItems->contains($anime['mal_id']);
            @endphp
            <div class="item">
                <div class="text-light">
                    <a href="anime/{{$anime['mal_id']}}" class="text-light">
                        <img src="{{ $posterUrl }}" alt="{{ $anime['title'] }} Poster"
                            class="img-fluid w-60 p-2 recommendation-img"
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

<!--Upcoming Anime Section -->
<h1 class="text-left my-5 text-light"><a href="anime/upcoming_anime" class="text-light">Upcoming Anime</a></h1>
<div class="now-playing owl-carousel">
    @foreach ($upcomingAnime as $anime)
        @php
            $rating_out_of_five = round($anime['score'] / 2);
            $posterUrl = animeBlankPoster($anime['images']['jpg']['large_image_url']);
            $title = $anime['title_english'] ?? $anime['title']; // Use the English title if it exists, otherwise the original title
            $isInWatchlist = $watchlistItems->contains($anime['mal_id']);

        @endphp

        <div class="item">
            <div class="text-light">
                <img src="{{ $posterUrl }}" alt="{{ $anime['title'] }} Poster" class="img-fluid w-60 p-2 recommendation-img"
                    style="border-radius: 17px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                <div class="card-body text-center">
                    <a href="anime/{{$anime['mal_id']}}" class="text-light">
                        <h6 class="card-title">{{ $anime['title_english'] }}</h6>
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



@endsection