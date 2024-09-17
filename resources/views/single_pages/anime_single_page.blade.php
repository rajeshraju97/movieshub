@extends('layouts.app')
@section('content')

@include('layouts.navbar');

<div class="container col-md-12" style="margin-top:7rem !important;">
    @php
        $rating_out_of_five = round($anime['score'] / 2);
        $posterUrl = animeBlankPoster($anime['images']['jpg']['image_url']);
        $rating = $anime['rating'];

    @endphp

    <div class="movie-container" style="background-image:url({{$posterUrl}});">
        <div class="movie-details">
            <div class="movie-info">
                <h1 class="movie-title">{{ $anime['title_english'] }}</h1>
                <p class="movie-description">
                    {{limitWords($anime['synopsis'], 30)}}
                </p>
                <div class="d-flex fs-5">
                    <p class="me-3"></p>

                    <p><i class="bi bi-calendar-event" style="color:#ffee00;"></i>&nbsp;{{$anime['aired']['string']}}
                    </p>

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
            @if(isset($characters))
                    <div class="movie_cast owl-carousel">
                        @foreach ($characters as $character)
                                    @php
                                        $profileUrl = blankProfile($character['character']['images']['jpg']['image_url']);
                                    @endphp
                                    <div class="item">
                                        <div class="text-light ">
                                            <img src="{{ $character['character']['images']['jpg']['image_url'] }}"
                                                alt="{{ $character['character']['name'] }}" class=" img-fluid w-60 p-2"
                                                style="border-radius: 17px;box-shadow: drop-shadow(rgba(100, 100, 111, 0.2) 0px 7px 29px 0px);"
                                                title="Character: {{  $character['character']['name'] }}">
                                        </div>
                                    </div>
                        @endforeach
                    </div>


            @else
                <p class="fs-4 fw-bolder">No Cast Data Available As Of Now</p>

            @endif

        </div>
    </div>







    <hr style="color:#ffee00;border:2px solid;">

    <!-- #region  video section-->

    <div class="video-section d-flex justify-content-center">
        <h3 class="text-light fs-4 fw-bold">Trailer :</h3>

        <div class="col-md-4 mb-4 text-center">
            <div class="video-item">
                <div class="video-thumbnail" onclick="loadVideo(this, '{{ $anime['trailer']['youtube_id'] }}')">
                    <img src="https://img.youtube.com/vi/{{ $anime['trailer']['youtube_id'] }}/hqdefault.jpg"
                        alt="{{ $anime['title_english'] }}" class="video-thumb-img" width="100%" height="315">
                    <div class="play-button-overlay">
                        <span>▶️</span>
                    </div>
                </div>
                <h4 class="text-light text-center">{{ $anime['title_english'] }}</h4>
            </div>
        </div>
    </div>





</div>
@endsection