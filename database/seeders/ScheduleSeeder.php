<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Route;
use App\Models\Schedule;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $routes = Route::all();
        $trainNames = [
            'Argo Bromo Anggrek', 'Argo Parahyangan', 'Gajayana', 'Bima', 'Sancaka',
            'Turangga', 'Harina', 'Lodaya', 'Mutiara Selatan', 'Bangunkarta',
            'Jayabaya', 'Matarmaja', 'Pasundan', 'Ciremai', 'Sawunggalih'
        ];
        
        $trainClasses = ['Eksekutif', 'Bisnis', 'Ekonomi'];
        
        // Generate schedules for next 30 days
        $startDate = Carbon::now();
        $endDate = Carbon::now()->addDays(30);

        foreach ($routes as $route) {
            // Generate 2-4 schedules per day for each route
            $schedulesPerDay = rand(2, 4);
            
            for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                for ($i = 0; $i < $schedulesPerDay; $i++) {
                    $trainClass = $trainClasses[array_rand($trainClasses)];
                    $trainName = $trainNames[array_rand($trainNames)];
                    
                    // Generate departure times spread throughout the day
                    $baseHour = 6 + ($i * 4); // Start from 6 AM, spread 4 hours apart
                    $departureHour = $baseHour + rand(-1, 1); // Add some variation
                    $departureMinute = rand(0, 3) * 15; // 0, 15, 30, or 45 minutes
                    
                    $departureTime = sprintf('%02d:%02d:00', $departureHour, $departureMinute);
                    
                    // Calculate arrival time based on route duration
                    $estimatedDuration = $route->estimated_duration;
                    $departure = Carbon::parse($departureTime);
                    $durationParts = explode(':', $estimatedDuration);
                    $arrival = $departure->copy()->addHours((int)$durationParts[0])->addMinutes((int)$durationParts[1]);
                    
                    // Adjust seat capacity based on train class
                    $seatCapacity = match($trainClass) {
                        'Eksekutif' => rand(200, 300),
                        'Bisnis' => rand(250, 350),
                        'Ekonomi' => rand(300, 400)
                    };
                    
                    // Random availability (70-100% of capacity)
                    $availableSeats = rand(
                        (int)($seatCapacity * 0.7),
                        $seatCapacity
                    );
                    
                    // Price modifier based on class and demand
                    $priceModifier = match($trainClass) {
                        'Eksekutif' => round(rand(120, 150) / 100, 2), // 1.2x - 1.5x
                        'Bisnis' => round(rand(110, 130) / 100, 2),    // 1.1x - 1.3x
                        'Ekonomi' => round(rand(100, 120) / 100, 2)    // 1.0x - 1.2x
                    };
                    
                    // Weekend and holiday premium
                    if ($date->isWeekend()) {
                        $priceModifier *= 1.1; // 10% weekend premium
                    }
                    
                    Schedule::create([
                        'id' => Str::uuid(),
                        'route_id' => $route->id,
                        'train_name' => $trainName,
                        'train_class' => $trainClass,
                        'departure_date' => $date->format('Y-m-d'),
                        'departure_time' => $departureTime,
                        'arrival_time' => $arrival->format('H:i:s'),
                        'total_seats' => $seatCapacity,
                        'available_seats' => $availableSeats,
                        'price_modifier' => round($priceModifier, 2),
                        'is_active' => true
                    ]);
                }
            }
        }
    }
}