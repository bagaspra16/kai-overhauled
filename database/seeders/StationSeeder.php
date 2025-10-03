<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Station;
use Illuminate\Support\Str;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stations = [
            // Jakarta & Sekitarnya
            [
                'id' => Str::uuid(),
                'code' => 'GMR',
                'name' => 'Gambir',
                'city' => 'Jakarta Pusat',
                'province' => 'DKI Jakarta',
                'latitude' => -6.1744,
                'longitude' => 106.8294,
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'code' => 'PSE',
                'name' => 'Pasar Senen',
                'city' => 'Jakarta Pusat',
                'province' => 'DKI Jakarta',
                'latitude' => -6.1744,
                'longitude' => 106.8406,
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'code' => 'JKK',
                'name' => 'Jakarta Kota',
                'city' => 'Jakarta Barat',
                'province' => 'DKI Jakarta',
                'latitude' => -6.1370,
                'longitude' => 106.8133,
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'code' => 'THB',
                'name' => 'Tanah Abang',
                'city' => 'Jakarta Pusat',
                'province' => 'DKI Jakarta',
                'latitude' => -6.1867,
                'longitude' => 106.8122,
                'is_active' => true
            ],

            // Jawa Barat
            [
                'id' => Str::uuid(),
                'code' => 'BD',
                'name' => 'Bandung',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
                'latitude' => -6.9147,
                'longitude' => 107.6098,
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'code' => 'CMI',
                'name' => 'Cimahi',
                'city' => 'Cimahi',
                'province' => 'Jawa Barat',
                'latitude' => -6.8722,
                'longitude' => 107.5422,
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'code' => 'BKS',
                'name' => 'Bekasi',
                'city' => 'Bekasi',
                'province' => 'Jawa Barat',
                'latitude' => -6.2383,
                'longitude' => 106.9756,
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'code' => 'CRB',
                'name' => 'Cirebon',
                'city' => 'Cirebon',
                'province' => 'Jawa Barat',
                'latitude' => -6.7063,
                'longitude' => 108.5570,
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'code' => 'TSM',
                'name' => 'Tasikmalaya',
                'city' => 'Tasikmalaya',
                'province' => 'Jawa Barat',
                'latitude' => -7.3274,
                'longitude' => 108.2207,
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'code' => 'BGR',
                'name' => 'Bogor',
                'city' => 'Bogor',
                'province' => 'Jawa Barat',
                'latitude' => -6.5971,
                'longitude' => 106.8060,
                'is_active' => true
            ],

            // Jawa Tengah
            [
                'id' => Str::uuid(),
                'code' => 'SMG',
                'name' => 'Semarang Tawang',
                'city' => 'Semarang',
                'province' => 'Jawa Tengah',
                'latitude' => -6.9667,
                'longitude' => 110.4167,
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'code' => 'SLO',
                'name' => 'Solo Balapan',
                'city' => 'Surakarta',
                'province' => 'Jawa Tengah',
                'latitude' => -7.5563,
                'longitude' => 110.8316,
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'code' => 'YK',
                'name' => 'Yogyakarta',
                'city' => 'Yogyakarta',
                'province' => 'DI Yogyakarta',
                'latitude' => -7.7956,
                'longitude' => 110.3695,
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'code' => 'PWK',
                'name' => 'Purwokerto',
                'city' => 'Purwokerto',
                'province' => 'Jawa Tengah',
                'latitude' => -7.4219,
                'longitude' => 109.2344,
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'code' => 'TGL',
                'name' => 'Tegal',
                'city' => 'Tegal',
                'province' => 'Jawa Tengah',
                'latitude' => -6.8694,
                'longitude' => 109.1403,
                'is_active' => true
            ],

            // Jawa Timur
            [
                'id' => Str::uuid(),
                'code' => 'SBY',
                'name' => 'Surabaya Gubeng',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
                'latitude' => -7.2636,
                'longitude' => 112.7521,
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'code' => 'SBP',
                'name' => 'Surabaya Pasar Turi',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
                'latitude' => -7.2456,
                'longitude' => 112.7378,
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'code' => 'MLG',
                'name' => 'Malang',
                'city' => 'Malang',
                'province' => 'Jawa Timur',
                'latitude' => -7.9797,
                'longitude' => 112.6304,
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'code' => 'JR',
                'name' => 'Jember',
                'city' => 'Jember',
                'province' => 'Jawa Timur',
                'latitude' => -8.1844,
                'longitude' => 113.7068,
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'code' => 'PWS',
                'name' => 'Probolinggo',
                'city' => 'Probolinggo',
                'province' => 'Jawa Timur',
                'latitude' => -7.7543,
                'longitude' => 113.2159,
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'code' => 'KDR',
                'name' => 'Kediri',
                'city' => 'Kediri',
                'province' => 'Jawa Timur',
                'latitude' => -7.8181,
                'longitude' => 112.0178,
                'is_active' => true
            ],

            // Sumatera
            [
                'id' => Str::uuid(),
                'code' => 'MDN',
                'name' => 'Medan',
                'city' => 'Medan',
                'province' => 'Sumatera Utara',
                'latitude' => 3.5952,
                'longitude' => 98.6722,
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'code' => 'PDG',
                'name' => 'Padang',
                'city' => 'Padang',
                'province' => 'Sumatera Barat',
                'latitude' => -0.9471,
                'longitude' => 100.4172,
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'code' => 'PLB',
                'name' => 'Palembang',
                'city' => 'Palembang',
                'province' => 'Sumatera Selatan',
                'latitude' => -2.9761,
                'longitude' => 104.7754,
                'is_active' => true
            ],
            [
                'id' => Str::uuid(),
                'code' => 'LPG',
                'name' => 'Lampung',
                'city' => 'Bandar Lampung',
                'province' => 'Lampung',
                'latitude' => -5.4292,
                'longitude' => 105.2610,
                'is_active' => true
            ]
        ];

        foreach ($stations as $station) {
            Station::create($station);
        }
    }
}