@extends('layouts.app')
@section('content')
@include('layouts.navbar')


<div class="container" style="margin-top: 7rem !important;">
    <h1 class="text-light text-center">WatchList</h1>

    <!-- Movies Section -->
    <h2 class="text-light">Movies</h2>
    <div class="row">
        @foreach ($mediaDetails as $media)
            @if ($media['type'] == 'movie')
                @php
                    $rating_out_of_five = round($media['details']['vote_average'] / 2);
                    $posterUrl = blankPoster($media['details']['poster_path']);
                    $isInWatchlist = $watchlist_items->contains($media['details']['id']);

                @endphp
                <div class="col-md-3 mb-4">
                    <div class="text-center text-light">
                        <a href="{{ url('movies/' . $media['details']['id']) }}" class="text-light">
                            <img src="{{ $posterUrl }}" alt="{{ $media['details']['title'] }} Poster" class="img-fluid w-60 p-2"
                                style="border-radius: 17px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ limitWords($media['details']['title'], 1) }}</h5>
                                <p><i class="bi bi-calendar-event"
                                        style="color:#ffee00;"></i>&nbsp;{{$media['details']['release_date']}}
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
                            </div>
                        </a>
                        @auth
                            <form action="{{ route('watchlist') }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="movie_id" value="{{$media['details']['id'] }}">
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
            @endif
        @endforeach
    </div>

    <!-- TV Series Section -->
    <h2 class="text-light">TV Series</h2>
    <div class="row">
        @foreach ($mediaDetails as $media)
            @if ($media['type'] == 'tv_series')
                @php
                    $rating_out_of_five = round($media['details']['vote_average'] / 2);
                    $posterUrl = blankPoster($media['details']['poster_path']);
                    $isInWatchlist = $watchlist_items->contains($media['details']['id']);
                @endphp
                <div class="col-md-3 mb-4">
                    <div class="text-center text-light">
                        <a href="{{ url('tv_series/' . $media['details']['id']) }}" class="text-light">
                            <img src="{{ $posterUrl }}" alt="{{ $media['details']['name'] }} Poster" class="img-fluid w-60 p-2"
                                style="border-radius: 17px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ limitWords($media['details']['name'], 1) }}</h5>
                                <p><i class="bi bi-calendar-event"
                                        style="color:#ffee00;"></i>&nbsp;{{$media['details']['first_air_date']}}
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
                            </div>
                        </a>
                        @auth
                            <form action="{{ route('watchlist') }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="tv_series_id" value="{{$media['details']['id'] }}">
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
            @endif
        @endforeach
    </div>
</div>
@endsection