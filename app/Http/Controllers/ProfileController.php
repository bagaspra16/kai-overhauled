<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KaiProfile;

class ProfileController extends Controller
{
    public function contact()
    {
        $profile = KaiProfile::first();
        
        return view('contact', compact('profile'));
    }
}
