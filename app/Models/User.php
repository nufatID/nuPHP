<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{

    protected $fillable = ['email', 'username', 'password_hash', 'active_email'];
}
