<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourismPlace extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'location',
        'mainImage',
        'open',
        'hours',
        'ticket',
        'description',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $attributes = [
        'mainImage' => '',
    ];

    public function placeGalleries()
    {
        return $this->hasMany(PlaceGallery::class);
    }

}
