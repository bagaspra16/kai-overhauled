<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user with specified credentials
        User::updateOrCreate(
            ['username' => 'miklat'],
            [
                'name' => 'Admin Miklat',
                'email' => 'admin@kai.com',
                'username' => 'miklat',
                'password' => Hash::make('miklat023116'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
