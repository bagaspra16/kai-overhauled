<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KaiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function index()
    {
        $services = KaiService::latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'icon' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['nama_layanan', 'deskripsi', 'icon']);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/services', $imageName);
            $data['gambar'] = 'services/' . $imageName;
        }

        KaiService::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function show(KaiService $service)
    {
        return view('admin.services.show', compact('service'));
    }

    public function edit(KaiService $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, KaiService $service)
    {
        $validator = Validator::make($request->all(), [
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'icon' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['nama_layanan', 'deskripsi', 'icon']);

        if ($request->hasFile('gambar')) {
            if ($service->gambar && Storage::exists('public/' . $service->gambar)) {
                Storage::delete('public/' . $service->gambar);
            }

            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/services', $imageName);
            $data['gambar'] = 'services/' . $imageName;
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(KaiService $service)
    {
        if ($service->gambar && Storage::exists('public/' . $service->gambar)) {
            Storage::delete('public/' . $service->gambar);
        }

        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
