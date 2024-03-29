<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'description'
    ];

    protected $guarded = [
        'image'
    ];
}
