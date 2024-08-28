<?php

if (!function_exists('limitWords')) {
    function limitWords($string, $word_limit)
    {
        $words = explode(' ', $string);
        return implode(' ', array_slice($words, 0, $word_limit)) . (count($words) > $word_limit ? '...' : '');
    }
}

function blankPoster($posterPath)
{
    $baseUrl = 'https://image.tmdb.org/t/p/w500';
    $defaultImage = asset('images/blank_poster.jpg'); // Replace with the actual path to your default image

    return $posterPath ? $baseUrl . $posterPath : $defaultImage;
}
function animeBlankPoster($posterPath)
{
    $defaultImage = asset('images/blank_poster.jpg'); // Replace with the
    return $posterPath ? $posterPath : $defaultImage;
}