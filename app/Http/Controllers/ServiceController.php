<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KaiService;
use App\Models\KaiProfile;

class ServiceController extends Controller
{
    public function index()
    {
        $profile = KaiProfile::first();
        $services = KaiService::all();
        
        return view('services', compact('profile', 'services'));
    }
}
