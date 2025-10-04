<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KaiAbout;
use App\Models\KaiNews;
use App\Models\KaiProfile;
use App\Models\KaiService;
use App\Models\Route;
use App\Models\Schedule;
use App\Models\Station;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        $stats = [
            'about_count' => KaiAbout::count(),
            'news_count' => KaiNews::count(),
            'profiles_count' => KaiProfile::count(),
            'services_count' => KaiService::count(),
            'routes_count' => Route::count(),
            'schedules_count' => Schedule::count(),
            'stations_count' => Station::count(),
            'users_count' => User::count(),
        ];

        $recentNews = KaiNews::latest()->take(5)->get();
        $recentSchedules = Schedule::with(['route', 'route.originStation', 'route.destinationStation'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentNews', 'recentSchedules'));
    }
}
