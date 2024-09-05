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

                <li class="nav-item">
                    <a class="nav-link text-light fs-5" href="{{route('tv.series.list')}}">Tv Series</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light fs-5" href="{{route('anime.list')}}">Anime</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Porifle</a></li>
                        <li><a class="dropdown-item" href="#">WatchList</a></li>
                        <hr class="dropdown-divider">
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