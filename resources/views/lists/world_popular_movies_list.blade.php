@extends('layouts.app')
@section('content')

<!-- Navbar Inside Each Carousel Slide -->
@include('layouts.navbar')

<div class="container" style="margin-top:7rem !important;">
    <h1 class="mb-4 text-center text-light">World Popular Movies</h1>


    <!-- Movies Grid -->
    <div class="row">
        @foreach ($movies as $movie)
                @php
                    $rating_out_of_five = round($movie['vote_average'] / 2);
                    $posterUrl = blankPoster($movie['poster_path']);
                    $isInWatchlist = $watchlistItems->contains($movie['id']);
                @endphp
                <div class="col-md-3 mb-4">
                    <div class="text-light">
                        <a href="{{ url('movies/' . $movie['id']) }}" class="text-light">
                            <img src="{{ $posterUrl }}" alt="{{ $movie['title'] }} Poster" class="img-fluid w-60 p-2"
                                style="border-radius: 17px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ limitWords($movie['title'], 1) }}</h5>
                                <p><i class="bi bi-calendar-event" style="color:#ffee00;"></i>&nbsp;{{$movie['release_date']}}
                                </p>
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

<!-- Pagination Links -->
<div class="d-flex justify-content-center">
    <nav>
        <ul class="pagination">
            @if ($currentPage > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ url('movies/wpml?page=' . ($currentPage - 1)) }}">Previous</a>
                </li>
            @endif

            <!-- Show Pagination Links Dynamically -->
            @php
                $startPage = max(1, $currentPage - 5); // Adjust this to control the range of pages shown
                $endPage = min($totalPages, $currentPage + 4); // Show 10 pages at most
            @endphp

            @for ($i = $startPage; $i <= $endPage; $i++)
                <li class="page-item @if ($i == $currentPage) active @endif">
                    <a class="page-link" href="{{ url('movies/wpml?page=' . $i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($currentPage < $totalPages)
                <li class="page-item">
                    <a class="page-link" href="{{ url('movies/wpml?page=' . ($currentPage + 1)) }}">Next</a>
                </li>
            @endif
        </ul>
    </nav>
</div>
<!-- Jump to Page Form -->
<div class="d-flex justify-content-center mt-3">
    <form action="{{ url('movies/wpml') }}" method="get" class="form-inline">
        <label for="jumpToPage" class="mr-2 text-light fw-bold">Jump to Page:</label>
        <input type="number" id="jumpToPage" name="page" class="form-control" min="1" max="{{ $totalPages }}"
            value="{{ $currentPage }}">
        <button type="submit" class="btn btn-primary ml-2">Go</button>
    </form>
</div>
<p class="text-center text-light"><span class="fw-bold">Total Pages:</span> {{$totalPages}}</p>
</div>




@endsection