<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'fullname',
        'position'
    ];
    protected $guarded = [
        'photo',
        'contact'
    ];
}
