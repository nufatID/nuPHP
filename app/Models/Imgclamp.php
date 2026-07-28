<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Imgclamp extends Model
{
  public $timestamps = true;
  protected $fillable = ['member_id', 'type', 'mime', 'base64', 'don_id'];
}
