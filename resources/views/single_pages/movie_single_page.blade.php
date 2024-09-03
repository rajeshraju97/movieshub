@extends('layouts.app')
@section('content')

@include('layouts.navbar')

<div class="container col-md-12" style="margin-top:7rem !important;">
    @php
        $posterUrl = blankPoster($movie['backdrop_path']);

    @endphp

    <div class="movie-container" style="background-image:url({{$posterUrl}});">
        <div class="movie-details">
            <div class="movie-info">
                <h1 class="movie-title">{{$movie['original_title']}}</h1>
                <p class="movie-description">
                    {{$movie['overview']}}
                </p>
            </div>

        </div>

        <div class="cast-section">
            <h3>Cast</h3>
            <div class="movie_cast owl-carousel">
                @foreach ($casts as $cast)
                                @php
                                    $profileUrl = blankProfile($cast['profile_path']);
                                @endphp
                                <div class="item">
                                    <div class="text-light ">
                                        <img src="{{ $profileUrl}}" alt="{{ $cast['original_name'] }} Poster" class="img-fluid w-60 p-2"
                                            style="border-radius: 17px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                                        <div class="text-center movie_hover">
                                            <h5 class="card-title">{{ $cast['original_name'] }}</h5>

                                        </div>
                                    </div>
                                </div>
                @endforeach
            </div>

        </div>
    </div>
    <!-- #region  cast region-->
    <h3 class="text-light fs-3 fw-bold mt-5">Crew:</h3>
    <div class="crew-section mt-2">
        <div class="sub d-flex" style="justify-content:space-around">
            @foreach ($crews as $crew)
                @if ($crew['job'] == 'Director' || $crew['job'] == 'Writer')
                    <div class="item ">
                        <div class="text-light">

                            <h5 class="card-title"><span style="color:#ffee00;">{{ $crew['job'] }}:</span>
                                {{ $crew['original_name'] }}</h5>

                        </div>
                    </div>
                @endif
            @endforeach  
        </div>
        <hr style="color:#ffee00;border:2px solid;">
        <a href="" class="text-light fs-4 fw-bolder">All Cast & Crew Details&nbsp;&nbsp;<span
                class='ion-ios-arrow-forward'></span></a>

    </div>


</div>










@endsection