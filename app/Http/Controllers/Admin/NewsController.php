<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KaiNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = KaiNews::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'penulis' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only(['judul', 'isi', 'penulis', 'tanggal']);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/news', $imageName);
            $data['gambar'] = 'news/' . $imageName;
        }

        KaiNews::create($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'News created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KaiNews $news)
    {
        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KaiNews $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KaiNews $news)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'penulis' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only(['judul', 'isi', 'penulis', 'tanggal']);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($news->gambar && Storage::exists('public/' . $news->gambar)) {
                Storage::delete('public/' . $news->gambar);
            }

            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/news', $imageName);
            $data['gambar'] = 'news/' . $imageName;
        }

        $news->update($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'News updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KaiNews $news)
    {
        // Delete associated image
        if ($news->gambar && Storage::exists('public/' . $news->gambar)) {
            Storage::delete('public/' . $news->gambar);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'News deleted successfully.');
    }
}
