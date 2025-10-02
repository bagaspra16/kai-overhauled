<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KaiAbout;
use App\Models\KaiProfile;

class AboutController extends Controller
{
    public function index()
    {
        $profile = KaiProfile::first();
        $aboutItems = KaiAbout::orderBy('tahun')->get();
        
        return view('about', compact('profile', 'aboutItems'));
    }
}
