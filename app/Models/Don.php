<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Don extends Model
{
    protected $fillable = [
        'eventid', 'slug', 'nama_acara', 'deskripsi', 'created_at', 'updated_at', 'member_id', 'status'
    ];

    public function member()
    {
        return $this->belongsTo(member::class, 'member_id');
    }

    public function Donasi()
    {
        return $this->hasMany(Cerit::class, 'don_id');
    }
    public function getdonasi($don_id)
    {
        return $this->Donasi()->where('don_id', $don_id)->where('type','kredit')->sum('jumlah');
    }
}
