<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KaiProfile;
use App\Models\KaiAbout;
use App\Models\KaiService;
use App\Models\KaiNews;

class HomeController extends Controller
{
    public function index()
    {
        $profile = KaiProfile::first();
        $aboutItems = KaiAbout::orderBy('tahun')->take(3)->get();
        $services = KaiService::take(6)->get();
        $latestNews = KaiNews::orderBy('tanggal', 'desc')->take(3)->get();

        return view('home', compact('profile', 'aboutItems', 'services', 'latestNews'));
    }
}
