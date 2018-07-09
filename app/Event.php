<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'url',
        'venue_id',
        'artist_id',
        'starts_at',
        'ends_at',
    ];
}
