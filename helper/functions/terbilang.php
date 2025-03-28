<?php

function terbilang($number)
{
    $number = abs($number);
    $units = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'];
    $result = '';

    if ($number < 12) {
        $result = ' ' . $units[$number];
    } elseif ($number < 20) {
        $result = terbilang($number - 10) . ' belas ';
    } elseif ($number < 100) {
        $result = terbilang(floor($number / 10)) . ' puluh ' . terbilang($number % 10);
    } elseif ($number < 200) {
        $result = ' seratus ' . terbilang($number - 100);
    } elseif ($number < 1000) {
        $result = terbilang(floor($number / 100)) . ' ratus ' . terbilang($number % 100);
    } elseif ($number < 2000) {
        $result = ' seribu ' . terbilang($number - 1000);
    } elseif ($number < 1000000) {
        $result = terbilang(floor($number / 1000)) . ' ribu ' . terbilang($number % 1000);
    } elseif ($number < 1000000000) {
        $result = terbilang(floor($number / 1000000)) . ' juta ' . terbilang($number % 1000000);
    } elseif ($number < 1000000000000) {
        $result = terbilang(floor($number / 1000000000)) . ' milyar ' . terbilang(fmod($number, 1000000000));
    } elseif ($number < 1000000000000000) {
        $result = terbilang(floor($number / 1000000000000)) . ' triliun ' . terbilang(fmod($number, 1000000000000));
    }

    return trim($result);
}

function convertToWords($number)
{
    if ($number < 0) {
        $result = 'minus ' . trim(terbilang(abs($number))) . ' rupiah';
    } else {
        $result = trim(terbilang($number)) . ' rupiah';
    }

    return ucfirst($result);
}
