<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KaiAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = KaiAbout::latest()->paginate(10);
        return view('admin.about.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 10),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        KaiAbout::create($request->only(['judul', 'deskripsi', 'tahun']));

        return redirect()->route('admin.about.index')
            ->with('success', 'About entry created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KaiAbout $about)
    {
        return view('admin.about.show', compact('about'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KaiAbout $about)
    {
        return view('admin.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KaiAbout $about)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 10),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $about->update($request->only(['judul', 'deskripsi', 'tahun']));

        return redirect()->route('admin.about.index')
            ->with('success', 'About entry updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KaiAbout $about)
    {
        $about->delete();

        return redirect()->route('admin.about.index')
            ->with('success', 'About entry deleted successfully.');
    }
}
