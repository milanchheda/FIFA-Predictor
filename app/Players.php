<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    protected $fillable = ['name'];

    public $timestamps = false;
}
