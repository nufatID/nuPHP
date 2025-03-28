<?php

use LasseRafn\InitialAvatarGenerator\InitialAvatar;
function getRandomColor() {
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

$randomBgColor = getRandomColor();
// Membuat instance dari InitialAvatar
$avatar = new InitialAvatar();
$str = $_GET["str"];
// Generate avatar dengan inisial, warna latar belakang, warna teks, ukuran, dan font
$image = $avatar
    ->name($str)    // Nama yang akan digunakan untuk menghasilkan inisial
    ->length(2)           // Panjang inisial (misalnya: JD untuk John Doe)
    ->size(100)           // Ukuran gambar dalam piksel (misalnya: 100x100)
    ->background($randomBgColor) // Warna latar belakang (misalnya: biru)
    ->color('#000000')     // Warna teks (misalnya: putih)
    ->generate();

// Menyimpan gambar sebagai file PNG
$image->save('assets/img/number/'.$str.'.png');

// Atau langsung menampilkan gambar ke browser
header('Content-Type: image/png');
echo $image->stream('png');