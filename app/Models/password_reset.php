<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class password_reset extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [
       "email","token"
    ];
}
