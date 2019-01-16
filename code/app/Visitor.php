<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'url',
        'date',
        'time',
        'ip_address',
        'media'
    ];
}
