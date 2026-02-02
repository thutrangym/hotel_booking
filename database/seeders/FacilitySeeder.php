<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Facility;

class FacilitySeeder extends Seeder
{
    public function run()
    {
        $facilities = [
            ['name' => 'Wifi', 'icon' => 'wifi.svg'],
            ['name' => 'Swimming Pool', 'icon' => 'pool.svg'],
            ['name' => 'Air Conditioning', 'icon' => 'ac.svg'],
            ['name' => 'Restaurant', 'icon' => 'restaurant.svg'],
            ['name' => 'Bar', 'icon' => 'bar.svg'],
            ['name' => 'Bicycle rental', 'icon' => 'bicycle.svg'],
            ['name' => 'TV', 'icon' => 'tv-fill.svg'],
            ['name' => 'Mini mart', 'icon' => 'cart.svg'],
            ['name' => 'Bath', 'icon' => 'bath.svg'],
            ['name' => 'Balcony', 'icon' => 'balcony.svg'],
            ['name' => 'Hair dryer', 'icon' => 'hair.svg'],
            ['name' => 'Desk', 'icon' => 'desk.svg'],
            ['name' => 'Bus service', 'icon' => 'bus.svg'],
            ['name' => 'Fitness center', 'icon' => 'building.svg'],
            ['name' => 'Car parking', 'icon' => 'car-front.svg'],
        ];

        foreach ($facilities as $facility) {

            if (!File::exists(public_path('icons/' . $facility['icon']))) {
                dump('Missing icon: ' . $facility['icon']);
                continue;
            }

            Facility::firstOrCreate(
                ['name' => $facility['name']],
                $facility
            );
        }
    }
}
