<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KaiNews;
use App\Models\KaiProfile;

class NewsController extends Controller
{
    public function index()
    {
        $profile = KaiProfile::first();
        $news = KaiNews::orderBy('tanggal', 'desc')->paginate(6);
        
        return view('news', compact('profile', 'news'));
    }
    
    public function show($id)
    {
        $profile = KaiProfile::first();
        $news = KaiNews::findOrFail($id);
        $relatedNews = KaiNews::where('id', '!=', $id)->orderBy('tanggal', 'desc')->take(3)->get();
        
        return view('news-detail', compact('profile', 'news', 'relatedNews'));
    }
}
