<?php

if (!function_exists('limitWords')) {
    function limitWords($string, $word_limit)
    {
        $words = explode(' ', $string);
        return implode(' ', array_slice($words, 0, $word_limit)) . (count($words) > $word_limit ? '...' : '');
    }
}
