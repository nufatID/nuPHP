<?php

use App\Helper\Unsplash;

function tanggal_sekarang()
{
    return date('d-m-Y');
}

function getImage()
{
    $image_url = Unsplash::getRandomPhoto();
    return $image_url;
}

function getpic()
{

    $image_url = Unsplash::getRandomLink();
    return $image_url;
}
function strnama($string)
{
    // Pisahkan string menjadi array berdasarkan spasi
    $words = explode(' ', $string);

    // Jika ada lebih dari dua kata, ambil hanya dua kata pertama
    if (count($words) > 2) {
        $words = array_slice($words, 0, 2);
    }

    // Gabungkan kembali array menjadi string dengan spasi
    $result = implode(' ', $words);

    return $result;
}
