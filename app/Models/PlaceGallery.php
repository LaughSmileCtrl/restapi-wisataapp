<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'tourism_place_id',
        'url',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'tourism_place_id'
    ];
}
