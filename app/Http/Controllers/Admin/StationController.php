<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StationController extends Controller
{
    public function index()
    {
        $stations = Station::latest()->paginate(10);
        return view('admin.stations.index', compact('stations'));
    }

    public function create()
    {
        return view('admin.stations.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:10|unique:stations,code',
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Station::create($request->all());

        return redirect()->route('admin.stations.index')->with('success', 'Station created successfully.');
    }

    public function show(Station $station)
    {
        $station->load(['originRoutes.destinationStation', 'destinationRoutes.originStation']);
        return view('admin.stations.show', compact('station'));
    }

    public function edit(Station $station)
    {
        return view('admin.stations.edit', compact('station'));
    }

    public function update(Request $request, Station $station)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:10|unique:stations,code,' . $station->id,
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $station->update($request->all());

        return redirect()->route('admin.stations.index')->with('success', 'Station updated successfully.');
    }

    public function destroy(Station $station)
    {
        $station->delete();

        return redirect()->route('admin.stations.index')->with('success', 'Station deleted successfully.');
    }
}
