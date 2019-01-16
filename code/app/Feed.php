<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'date',
        'time',
        'category',
        'tags',
        'content'
    ];

    protected $guarded = [
        'image'
    ];
}
