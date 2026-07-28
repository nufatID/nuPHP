<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Cerit extends Model
{

    protected $fillable = [
        'member_id', 'judul', 'jumlah', 'type', 'status', 'date', 'keterangan',
        'created_at', 'updated_at', 'payment_type', 'input_by', 'don_id'
    ];

    // Tipe data untuk kolom yang memerlukan konversi
    protected $casts = [
        'date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function member()
    {
        return $this->belongsTo(member::class, 'member_id');
    }

    public function inputBy()
    {
        return $this->belongsTo(Member::class, 'input_by');
    }

    public function donasi()
    {
        return $this->belongsTo(Don::class, 'don_id');
    }
}
