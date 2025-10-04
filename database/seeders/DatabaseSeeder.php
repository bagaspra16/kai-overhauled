<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            KaiProfileSeeder::class,
            KaiAboutSeeder::class,
            KaiServiceSeeder::class,
            KaiNewsSeeder::class,
            StationSeeder::class,
            RouteSeeder::class,
            ScheduleSeeder::class,
        ]);
    }
}
