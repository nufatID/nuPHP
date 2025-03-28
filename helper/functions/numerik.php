<?php

use App\Model\transaction;

use App\Model\PaymentType;
use Carbon\Carbon;

/**
 * Menghasilkan nomor Kas berdasarkan ID tipe pembayaran dan jenisnya.
 *
 * @param int $typeId ID tipe pembayaran.
 * @param string $jenis Jenis nomor Kas.
 * @return string Nomor Kas yang dihasilkan.
 */

function generateKasNumber($typeId)
{
    $paymentType = PaymentType::find($typeId);

    if (!$paymentType) {
        return "Tipe tidak ditemukan";
    }

    $typeCode = strtoupper(substr($paymentType->name, 0, 3));

    $currentDate = Carbon::now();
    $month = $currentDate->format('m');
    $year = $currentDate->format('y');

    $lastKasNumber = transaction::where('judul', 'like', $typeCode . $year . $month . '%')
        ->count();

    $kasNumber = $typeCode . $year . $month . str_pad($lastKasNumber + 1, 4, '0', STR_PAD_LEFT);

    return $kasNumber;
}

function KasNumber($typeId, $jenis)
{
    $faker = \Faker\Factory::create('id_ID');
    $currentDate = Carbon::now();
    $month = $currentDate->format('m');
    $year = $currentDate->format('y');

    if ($jenis == 'kas') {
        $kasNumber = generateKasNumber($typeId);
    } elseif ($jenis == 'tabungan') {
        $kasNumber = $year . $faker->regexify('[A-Z]{3}[0-9]{5}') . $month;
    } elseif ($jenis == 'donasi') {
        $kasNumber = $faker->regexify('[A-Z]{3}[0-9]{7}') . $month . $year;
    } else {
        return $faker->swiftBicNumber();
    }

    return $kasNumber;
}

function midNumber($jenis)
{
    $faker = \Faker\Factory::create('id_ID');
    $currentDate = Carbon::now();
    $month = $currentDate->format('m');
    $year = $currentDate->format('y');


    $kasNumber = $jenis . $month . $year . $faker->regexify('[A-Z]{3}[0-9]{6}');

    return $kasNumber;
}
function ridNumber()
{
    $faker = \Faker\Factory::create('id_ID');
    $currentDate = Carbon::now();
    $month = $currentDate->format('m');
    $year = $currentDate->format('y');


    $kasNumber = $year . $faker->regexify('[A-Z]{3}[0-9]{3}') . $month;

    return $kasNumber;
}
