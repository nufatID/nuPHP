<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Apikey extends Model
{


    protected $fillable = [
        'nama',
        'apikey',
        'user_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
