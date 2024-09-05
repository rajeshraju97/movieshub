@extends('layouts.app')
@section('content')

@include('layouts.navbar')

<div class="container col-md-12" style="margin-top:7rem !important;">
    @php
        $posterUrl = blankPoster($movie['backdrop_path']);
        $rating_out_of_five = round($movie['vote_average'] / 2);
        $rating = $movie['adult'] ? 'Above 17' : 'PG-13'; // Determine the rating

    @endphp

    <div class="movie-container" style="background-image:url({{$posterUrl}});">
        <div class="movie-details">
            <div class="movie-info">
                <h1 class="movie-title">{{$movie['original_title']}}</h1>
                <p class="movie-description">
                    {{$movie['overview']}}
                </p>
                <div class="d-flex fs-5">
                    @foreach($movie['genres'] as $genre)
                        {{ $genre['name'] }}@if(!$loop->last), @endif
                    @endforeach
                    <p class="me-3"></p>

                    <p><i class="bi bi-calendar-event" style="color:#ffee00;"></i>&nbsp;{{$movie['release_date']}}</p>

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

        <div class="cast-section">
            <h3>Cast</h3>
            @if(isset($casts) && count($casts) >= 7)
                    <div class="movie_cast owl-carousel">
                        @foreach ($casts as $cast)
                                    @php
                                        $profileUrl = blankProfile($cast['profile_path']);
                                    @endphp
                                    <div class="item">
                                        <div class="text-light ">
                                            <img src="{{ $profileUrl}}" alt="{{ $cast['original_name'] }} Poster" class="img-fluid w-60 p-2"
                                                style="border-radius: 17px;box-shadow: drop-shadow(rgba(100, 100, 111, 0.2) 0px 7px 29px 0px);"
                                                title="Character: {{ $cast['character'] }}">
                                            <div class="text-center movie_hover">
                                                <h5 class="card-title">{{ $cast['original_name'] }}</h5>

                                            </div>
                                        </div>
                                    </div>
                        @endforeach
                    </div>
            @elseif(isset($casts) && count($casts) >= 1)
                    <div class="signle-cast col-md-8 d-grid"
                        style="grid-template-columns: repeat(auto-fill, minmax(136px, 1fr));gap: 20px;">
                        @foreach ($casts as $cast)
                                    @php
                                        $profileUrl = blankProfile($cast['profile_path']);
                                    @endphp
                                    <div class="item">
                                        <div class="text-light ">
                                            <img src="{{ $profileUrl}}" alt="{{ $cast['original_name'] }} Poster" class="img-fluid w-10 p-2"
                                                style="border-radius: 17px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                                            <div class="text-center movie_hover">
                                                <h5 class="card-title">{{ $cast['original_name'] }}</h5>

                                            </div>
                                        </div>
                                    </div>
                        @endforeach
                    </div>

            @else
                <p class="fs-4 fw-bolder">No Cast Data Available As Of Now</p>

            @endif

        </div>
    </div>



    <!-- #region  crew region-->
    <h3 class="text-light fs-3 fw-bold mt-5">Crew:</h3>
    <div class="crew-section mt-2">
        @if(isset($crews) && count($crews) >= 1)
            <div class="sub d-grid" style="grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">

                @foreach ($crews as $crew)
                    @if ($crew['job'] == 'Director' || $crew['job'] == 'Writer' || $crew['job'] == 'Art Direction')
                        <div class="item ">
                            <div class="text-light">
                                <h5 class="card-title">
                                    <span style="color:#ffee00;">{{ $crew['job'] }}:</span>
                                    {{ $crew['original_name'] }}
                                </h5>
                            </div>
                        </div>
                    @endif
                @endforeach  
            </div>

        @else
            <p class="text-light fs-4 fw-bolder">No Crew Data Available As Of Now</p>
        @endif
        <hr style="color:#ffee00;border:2px solid;">
        <a href="" class="text-light fs-4 fw-bolder">All Cast & Crew Details&nbsp;&nbsp;
            <span class='ion-ios-arrow-forward'></span>
        </a>
    </div>



    <hr style="color:#ffee00;border:2px solid;">

    <!-- #region  video section-->

    <div class="video-section">
        <h3 class="text-light fs-4 fw-bold">Teasers & Trailers</h3>
        <div class="row">
            @foreach ($videos as $video)
                @if ($video['type'] == "Trailer" || $video['type'] == 'Teaser')
                    <div class="col-md-4 mb-4">
                        <div class="video-item">
                            <div class="video-thumbnail" onclick="loadVideo(this, '{{ $video['key'] }}')">
                                <img src="https://img.youtube.com/vi/{{ $video['key'] }}/hqdefault.jpg"
                                    alt="{{ $video['name'] }}" class="video-thumb-img" width="100%" height="315">
                                <div class="play-button-overlay">
                                    <span>▶️</span>
                                </div>
                            </div>
                            <h4 class="text-light text-center">{{ $video['name'] }}</h4>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>





</div>










@endsection