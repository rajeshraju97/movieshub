<nav class="navbar navbar-expand-lg navbar-dark bg-transparent position-absolute top-0 start-0 w-100 mb-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/logo3.png') }}" alt="Logo" class="img-fluid" style="max-height: 80px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1"
            aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent1" style="margin-right: 5pc;">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth
                    <li class="nav-item">
                        <div class="search-box">
                            <form action="{{route('search.multi')}}" method="post">
                                @csrf
                                <button type="button" class="btn-search"><i class="bi bi-search"></i></button>
                                <input type="text" class="input-search" name="search_query" placeholder="Type to Search...">
                            </form>
                        </div>
                    </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link text-light fs-5" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Movies
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('movies.list') }}">All Movies</a></li>
                        <li><a class="dropdown-item" href="{{ route('wpmovies.list') }}">World Popular Movies</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('trmovies.list') }}">Top Rated Movies</a></li>
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
                        <li><a class="dropdown-item" href="{{ route('airing.today.list') }}">Airing Today Series</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('popular.series.list') }}">Popular Series</a></li>
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
                        <li><a class="dropdown-item" href="{{ route('upcoming.anime.list') }}">Upcoming Anime</a>
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
                            <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
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