<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RouteController extends Controller
{
    public function index()
    {
        try {
            $routes = Route::with(['originStation', 'destinationStation'])->latest()->paginate(10);
            return view('admin.routes.index', compact('routes'));
        } catch (\Exception $e) {
            \Log::error('Routes index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading routes: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $stations = Station::active()->orderBy('name')->get();
        return view('admin.routes.create', compact('stations'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'origin_station_id' => 'required|exists:stations,id',
            'destination_station_id' => 'required|exists:stations,id|different:origin_station_id',
            'base_price' => 'required|numeric|min:0',
            'infant_price' => 'required|numeric|min:0',
            'distance_km' => 'required|integer|min:1',
            'estimated_duration' => 'required|date_format:H:i',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Route::create($request->all());

        return redirect()->route('admin.routes.index')->with('success', 'Route created successfully.');
    }

    public function show(Route $route)
    {
        $route->load(['originStation', 'destinationStation', 'schedules']);
        return view('admin.routes.show', compact('route'));
    }

    public function edit(Route $route)
    {
        $stations = Station::active()->orderBy('name')->get();
        return view('admin.routes.edit', compact('route', 'stations'));
    }

    public function update(Request $request, Route $route)
    {
        $validator = Validator::make($request->all(), [
            'origin_station_id' => 'required|exists:stations,id',
            'destination_station_id' => 'required|exists:stations,id|different:origin_station_id',
            'base_price' => 'required|numeric|min:0',
            'infant_price' => 'required|numeric|min:0',
            'distance_km' => 'required|integer|min:1',
            'estimated_duration' => 'required|date_format:H:i',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $route->update($request->all());

        return redirect()->route('admin.routes.index')->with('success', 'Route updated successfully.');
    }

    public function destroy(Route $route)
    {
        $route->delete();

        return redirect()->route('admin.routes.index')->with('success', 'Route deleted successfully.');
    }
}
