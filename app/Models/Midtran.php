<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Midtran extends Model
{

    protected $fillable = [
        'member_id',
        'judul',
        'jumlah',
        'type',
        'status',
        'date',
        'keterangan',
        'payment_type',
        'input_by',
        'don_id',
        'snap_token'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function member()
    {
        return $this->belongsTo(member::class, 'member_id');
    }
}
