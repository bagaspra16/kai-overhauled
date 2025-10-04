<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KaiProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = KaiProfile::latest()->paginate(10);
        return view('admin.profiles.index', compact('profiles'));
    }

    public function create()
    {
        return view('admin.profiles.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_perusahaan' => 'required|string|max:255',
            'slogan' => 'required|string|max:255',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'alamat' => 'required|string',
            'email' => 'required|email|max:100',
            'telepon' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['nama_perusahaan', 'slogan', 'visi', 'misi', 'alamat', 'email', 'telepon']);

        KaiProfile::create($data);

        return redirect()->route('admin.profiles.index')->with('success', 'Company profile created successfully.');
    }

    public function show(KaiProfile $profile)
    {
        return view('admin.profiles.show', compact('profile'));
    }

    public function edit(KaiProfile $profile)
    {
        return view('admin.profiles.edit', compact('profile'));
    }

    public function update(Request $request, KaiProfile $profile)
    {
        $validator = Validator::make($request->all(), [
            'nama_perusahaan' => 'required|string|max:255',
            'slogan' => 'required|string|max:255',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'alamat' => 'required|string',
            'email' => 'required|email|max:100',
            'telepon' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['nama_perusahaan', 'slogan', 'visi', 'misi', 'alamat', 'email', 'telepon']);

        $profile->update($data);

        return redirect()->route('admin.profiles.index')->with('success', 'Company profile updated successfully.');
    }

    public function destroy(KaiProfile $profile)
    {
        $profile->delete();

        return redirect()->route('admin.profiles.index')->with('success', 'Company profile deleted successfully.');
    }
}
