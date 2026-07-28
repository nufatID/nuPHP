<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    // Nama tabel jika tidak menggunakan konvensi penamaan default
    protected $table = 'payment_types';

    // Kolom yang dapat diisi secara massal
    protected $fillable = ['name', 'description'];

    // Jika ada relasi dengan tabel 'transactions'
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'payment_type_id');
    }
}
