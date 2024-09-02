@extends('layouts.app')
@section('content')

<!-- Navbar Inside Each Carousel Slide -->
@include('layouts.navbar')

<div class="container col-md-12" style="margin-top:7rem !important;">
    <h1 class="mb-4 text-center text-light">Movie List</h1>
    <div class="row">


        <div class="col-md-3">
            <!-- Filters -->
            <div class="mb-4">
                <h5 class="text-light">Filters</h5>
                <form method="GET" action="{{ route('movies.list') }}">
                    <div class="mb-3">
                        <label for="sort" class="form-label text-light">Sort By:</label>
                        <select id="sort" name="s" class="form-select" onchange="this.form.submit()">
                            <option value="popularity.desc" {{ $sort === 'popularity.desc' ? 'selected' : '' }}>Popularity
                                Descending</option>
                            <option value="popularity.asc" {{ $sort === 'popularity.asc' ? 'selected' : '' }}>Popularity
                                Ascending</option>
                            <option value="title.asc" {{ $sort === 'title.asc' ? 'selected' : '' }}>Title Ascending (A-Z)
                            </option>
                            <option value="title.desc" {{ $sort === 'title.desc' ? 'selected' : '' }}>Title Descending
                                (Z-A)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="language" class="form-label text-light">Language:</label>
                        <select id="language" name="l" class="form-select" onchange="this.form.submit()">
                            @foreach ($languageCounts as $language)
                                <option value="{{ $language['iso_639_1'] }}" {{ $selectedLanguage === $language['iso_639_1'] ? 'selected' : '' }}>
                                    {{ $language['language'] }} ({{ $language['totalMovies'] }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Genre -->
                    <div class="mb-3">
                        <label for="genre" class="form-label text-light">Genre:</label>
                        <select id="genre" name="g" class="form-select" onchange="this.form.submit()">
                            <option value="">Select Genre</option>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre['id'] }}" {{ in_array($genre['id'], (array) $selectedGenre) ? 'selected' : '' }}>
                                    {{ $genre['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </form>

            </div>
        </div>






        <div class="col-md-9">
            <!-- Movies Grid -->
            <div class="row">
                @foreach ($movies as $movie)
                                @php
                                    $rating_out_of_five = round($movie['vote_average'] / 2);
                                    $posterUrl = blankPoster($movie['poster_path']);
                                @endphp
                                <div class="col-md-3 mb-4">
                                    <div class="text-light">

                                        <img src="{{ $posterUrl }}" alt="{{ $movie['title'] }} Poster" class="img-fluid w-60 p-2"
                                            style="border-radius: 17px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">{{ limitWords($movie['title'], 1) }}</h5>
                                            <p><i class="bi bi-calendar-event"
                                                    style="color:#ffee00;"></i>&nbsp;{{$movie['release_date']}}</p>
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
                                            <li class="page-item @if ($i == $currentPage) active @endif">
                                                <a class="page-link"
                                                    href="{{ url('movies?p=' . $i .
                            '&l=' . (is_array($selectedLanguage) ? implode(',', $selectedLanguage) : $selectedLanguage) .
                            '&s=' . (is_array($sort) ? implode(',', $sort) : $sort) .
                            '&g=' . (is_array($selectedGenre) ? implode(',', $selectedGenre) : $selectedGenre)) }}">
                                                    {{ $i }}
                                                </a>
                                            </li>
                        @endif

                        @php
                            $startPage = max(1, $currentPage - 5); // Adjust this to control the range of pages shown
                            $endPage = min($totalPages, $currentPage + 4); // Show 10 pages at most
                        @endphp

                        @for ($i = $startPage; $i <= $endPage; $i++)
                                            <li class="page-item @if ($i == $currentPage) active @endif">
                                                <a class="page-link"
                                                    href="{{ url('movies?p=' . $i .
                            '&l=' . (is_array($selectedLanguage) ? implode(',', $selectedLanguage) : $selectedLanguage) .
                            '&s=' . (is_array($sort) ? implode(',', $sort) : $sort) .
                            '&g=' . (is_array($selectedGenre) ? implode(',', $selectedGenre) : $selectedGenre)) }}">
                                                    {{ $i }}
                                                </a>
                                            </li>
                        @endfor

                        @if ($currentPage < $totalPages)
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ url('movies?p=' . $i .
                            '&l=' . (is_array($selectedLanguage) ? implode(',', $selectedLanguage) : $selectedLanguage) .
                            '&s=' . (is_array($sort) ? implode(',', $sort) : $sort) .
                            '&g=' . (is_array($selectedGenre) ? implode(',', $selectedGenre) : $selectedGenre)) }}">
                                                    {{ $i }}
                                                </a>
                                            </li>
                        @endif
                    </ul>
                </nav>
                <br>

            </div>

            <!-- Jump to Page Form -->
            <div class="d-flex justify-content-center mt-3 mb-3">
                <form action="{{ url('movies') }}" method="get" class="form-inline">
                    <input type="hidden" name="l"
                        value="{{ htmlspecialchars(is_array($selectedLanguage) ? implode(',', $selectedLanguage) : $selectedLanguage) }}">
                    <input type="hidden" name="s" value="{{ htmlspecialchars($sort) }}">
                    <input type="hidden" name="g"
                        value="{{ htmlspecialchars(is_array($selectedGenre) ? implode(',', $selectedGenre) : $selectedGenre) }}">
                    <label for="jumpToPage" class="mr-2 text-light fw-bold">Jump to Page:</label>
                    <input type="number" id="jumpToPage" name="p" class="form-control" min="1"
                        max="{{ $totalPages }}" value="{{ $currentPage }}">
                    <button type="submit" class="btn btn-primary ml-2">Go</button>
                </form>
            </div>

            <p class=" text-center text-light"><span class="fw-bold">Total Pages:</span>{{$totalPages}}</p>


        </div>
    </div>

</div>
<!-- Initialize select2 -->




@endsection