<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with(['route.originStation', 'route.destinationStation'])
            ->latest()
            ->paginate(10);
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $routes = Route::with(['originStation', 'destinationStation'])->active()->get();
        $trainClasses = ['Ekonomi', 'Bisnis', 'Eksekutif', 'Luxury'];
        return view('admin.schedules.create', compact('routes', 'trainClasses'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'route_id' => 'required|exists:routes,id',
            'train_name' => 'required|string|max:255',
            'train_class' => 'required|string|max:100',
            'departure_date' => 'required|date|after_or_equal:today',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i',
            'total_seats' => 'required|integer|min:1|max:1000',
            'available_seats' => 'required|integer|min:0|lte:total_seats',
            'price_modifier' => 'required|numeric|min:0.1|max:10',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Schedule::create($request->all());

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule created successfully.');
    }

    public function show(Schedule $schedule)
    {
        $schedule->load(['route.originStation', 'route.destinationStation']);
        return view('admin.schedules.show', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        $routes = Route::with(['originStation', 'destinationStation'])->active()->get();
        $trainClasses = ['Ekonomi', 'Bisnis', 'Eksekutif', 'Luxury'];
        return view('admin.schedules.edit', compact('schedule', 'routes', 'trainClasses'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validator = Validator::make($request->all(), [
            'route_id' => 'required|exists:routes,id',
            'train_name' => 'required|string|max:255',
            'train_class' => 'required|string|max:100',
            'departure_date' => 'required|date',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i',
            'total_seats' => 'required|integer|min:1|max:1000',
            'available_seats' => 'required|integer|min:0|lte:total_seats',
            'price_modifier' => 'required|numeric|min:0.1|max:10',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $schedule->update($request->all());

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}
