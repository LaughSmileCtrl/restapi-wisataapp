<?php

namespace Database\Seeders;

use App\Models\PlaceGallery;
use App\Models\TourismPlace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourismPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TourismPlace::factory()
            ->has(
                PlaceGallery::factory()
                    ->count(3)
                    ->state(function (array $attributes, TourismPlace $tourismPlace) {
                        return ['tourism_place_id' => $tourismPlace->id];
                    })
                )
            ->count(2)
            ->create();
    }
}
