<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'theme_id',
        'location',
        'avatar',
        'avatar_status',
        'imageee',
    ];
}
