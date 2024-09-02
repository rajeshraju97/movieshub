@extends('layouts.app')
@section('content')

<!-- Navbar Inside Each Carousel Slide -->
@include('layouts.navbar')

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