<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Station;
use App\Models\Route;
use Illuminate\Support\Str;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get stations by code for easier reference
        $stations = Station::all()->keyBy('code');

        $routes = [
            // Jakarta - Bandung
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['GMR']->id,
                'destination_station_id' => $stations['BD']->id,
                'base_price' => 150000,
                'infant_price' => 0,
                'distance_km' => 150,
                'estimated_duration' => '03:30:00',
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['BD']->id,
                'destination_station_id' => $stations['GMR']->id,
                'base_price' => 150000,
                'infant_price' => 0,
                'distance_km' => 150,
                'estimated_duration' => '03:30:00',
                'is_active' => true
            ],

            // Jakarta - Yogyakarta
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['GMR']->id,
                'destination_station_id' => $stations['YK']->id,
                'base_price' => 250000,
                'infant_price' => 0,
                'distance_km' => 560,
                'estimated_duration' => '07:45:00',
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['YK']->id,
                'destination_station_id' => $stations['GMR']->id,
                'base_price' => 250000,
                'infant_price' => 0,
                'distance_km' => 560,
                'estimated_duration' => '07:45:00',
                'is_active' => true
            ],

            // Jakarta - Surabaya
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['GMR']->id,
                'destination_station_id' => $stations['SBY']->id,
                'base_price' => 350000,
                'infant_price' => 0,
                'distance_km' => 730,
                'estimated_duration' => '09:00:00',
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['SBY']->id,
                'destination_station_id' => $stations['GMR']->id,
                'base_price' => 350000,
                'infant_price' => 0,
                'distance_km' => 730,
                'estimated_duration' => '09:00:00',
                'is_active' => true
            ],

            // Jakarta - Solo
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['GMR']->id,
                'destination_station_id' => $stations['SLO']->id,
                'base_price' => 200000,
                'infant_price' => 0,
                'distance_km' => 550,
                'estimated_duration' => '06:30:00',
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['SLO']->id,
                'destination_station_id' => $stations['GMR']->id,
                'base_price' => 200000,
                'infant_price' => 0,
                'distance_km' => 550,
                'estimated_duration' => '06:30:00',
                'is_active' => true
            ],

            // Jakarta - Semarang
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['GMR']->id,
                'destination_station_id' => $stations['SMG']->id,
                'base_price' => 180000,
                'infant_price' => 0,
                'distance_km' => 440,
                'estimated_duration' => '05:45:00',
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['SMG']->id,
                'destination_station_id' => $stations['GMR']->id,
                'base_price' => 180000,
                'infant_price' => 0,
                'distance_km' => 440,
                'estimated_duration' => '05:45:00',
                'is_active' => true
            ],

            // Bandung - Yogyakarta
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['BD']->id,
                'destination_station_id' => $stations['YK']->id,
                'base_price' => 220000,
                'infant_price' => 0,
                'distance_km' => 420,
                'estimated_duration' => '06:00:00',
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['YK']->id,
                'destination_station_id' => $stations['BD']->id,
                'base_price' => 220000,
                'infant_price' => 0,
                'distance_km' => 420,
                'estimated_duration' => '06:00:00',
                'is_active' => true
            ],

            // Yogyakarta - Surabaya
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['YK']->id,
                'destination_station_id' => $stations['SBY']->id,
                'base_price' => 160000,
                'infant_price' => 0,
                'distance_km' => 320,
                'estimated_duration' => '04:30:00',
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['SBY']->id,
                'destination_station_id' => $stations['YK']->id,
                'base_price' => 160000,
                'infant_price' => 0,
                'distance_km' => 320,
                'estimated_duration' => '04:30:00',
                'is_active' => true
            ],

            // Solo - Surabaya
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['SLO']->id,
                'destination_station_id' => $stations['SBY']->id,
                'base_price' => 140000,
                'infant_price' => 0,
                'distance_km' => 280,
                'estimated_duration' => '04:00:00',
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['SBY']->id,
                'destination_station_id' => $stations['SLO']->id,
                'base_price' => 140000,
                'infant_price' => 0,
                'distance_km' => 280,
                'estimated_duration' => '04:00:00',
                'is_active' => true
            ],

            // Surabaya - Malang
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['SBY']->id,
                'destination_station_id' => $stations['MLG']->id,
                'base_price' => 80000,
                'infant_price' => 0,
                'distance_km' => 90,
                'estimated_duration' => '02:00:00',
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['MLG']->id,
                'destination_station_id' => $stations['SBY']->id,
                'base_price' => 80000,
                'infant_price' => 0,
                'distance_km' => 90,
                'estimated_duration' => '02:00:00',
                'is_active' => true
            ],

            // Jakarta - Cirebon
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['GMR']->id,
                'destination_station_id' => $stations['CRB']->id,
                'base_price' => 120000,
                'infant_price' => 0,
                'distance_km' => 255,
                'estimated_duration' => '03:45:00',
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['CRB']->id,
                'destination_station_id' => $stations['GMR']->id,
                'base_price' => 120000,
                'infant_price' => 0,
                'distance_km' => 255,
                'estimated_duration' => '03:45:00',
                'is_active' => true
            ],

            // Jakarta - Purwokerto
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['GMR']->id,
                'destination_station_id' => $stations['PWK']->id,
                'base_price' => 160000,
                'infant_price' => 0,
                'distance_km' => 350,
                'estimated_duration' => '05:00:00',
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'origin_station_id' => $stations['PWK']->id,
                'destination_station_id' => $stations['GMR']->id,
                'base_price' => 160000,
                'infant_price' => 0,
                'distance_km' => 350,
                'estimated_duration' => '05:00:00',
                'is_active' => true
            ]
        ];

        foreach ($routes as $route) {
            Route::create($route);
        }
    }
}