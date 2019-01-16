<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'title',
        'description'
    ];

    protected $guarded = [
        'favicon',
        'logo_square',
        'logo_horizontal',
        'logo_white',
        'address',
        'phone',
        'email',
        'social',
        'location'
    ];
}
