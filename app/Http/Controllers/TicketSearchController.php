<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;
use App\Models\Route;
use App\Models\Schedule;
use App\Models\PriceQuery;
use Carbon\Carbon;

class TicketSearchController extends Controller
{
    /**
     * Display the ticket search form
     */
    public function index()
    {
        try {
            $stations = Station::active()
                ->orderBy('province')
                ->orderBy('city')
                ->orderBy('name')
                ->get()
                ->groupBy('province');
                
            // Get popular routes if any exist, otherwise empty collection
            $popularRoutes = collect();
            try {
                $popularRoutes = PriceQuery::popularRoutes(6)
                    ->with(['originStation', 'destinationStation'])
                    ->get();
            } catch (\Exception $e) {
                // If no price queries exist yet, just use empty collection
            }

            return view('ticket-search.index', compact('stations', 'popularRoutes'));
        } catch (\Exception $e) {
            return view('ticket-search.index', [
                'stations' => collect(),
                'popularRoutes' => collect()
            ]);
        }
    }

    /**
     * Search for available tickets
     */
    public function search(Request $request)
    {
        $request->validate([
            'origin_station_id' => 'required|exists:stations,id',
            'destination_station_id' => 'required|exists:stations,id|different:origin_station_id',
            'departure_date' => 'required|date|after_or_equal:today',
            'passenger_count' => 'required|integer|min:1|max:8',
            'infant_count' => 'nullable|integer|min:0|max:4'
        ]);

        // Log the search query
        PriceQuery::createQuery([
            'user_id' => auth()->id(),
            'origin_station_id' => $request->origin_station_id,
            'destination_station_id' => $request->destination_station_id,
            'departure_date' => $request->departure_date,
            'passenger_count' => $request->passenger_count,
            'infant_count' => $request->infant_count ?? 0
        ], $request);

        // Find available routes
        $route = Route::betweenStations(
            $request->origin_station_id,
            $request->destination_station_id
        )->active()->first();

        if (!$route) {
            $errorMessage = 'Maaf, rute yang Anda cari tidak tersedia. Silakan pilih stasiun yang berbeda.';
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ]);
            }
            return back()->withInput()->with('error', $errorMessage);
        }

        // Find available schedules
        $schedules = Schedule::where('route_id', $route->id)
            ->onDate($request->departure_date)
            ->active()
            ->available()
            ->with(['route.originStation', 'route.destinationStation'])
            ->orderBy('departure_time')
            ->get();

        if ($schedules->isEmpty()) {
            $errorMessage = 'Maaf, tidak ada jadwal kereta tersedia untuk tanggal yang dipilih. Silakan coba tanggal lain atau rute berbeda.';
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ]);
            }
            return back()->withInput()->with('error', $errorMessage);
        }

        // Calculate prices for each schedule
        $schedules->each(function ($schedule) use ($request) {
            $schedule->calculated_price = $schedule->calculateTicketPrice(
                $request->passenger_count,
                $request->infant_count ?? 0
            );
            $schedule->price_per_person = $schedule->route->base_price * $schedule->price_modifier;
        });

        $searchParams = $request->only([
            'origin_station_id', 'destination_station_id',
            'departure_date', 'passenger_count', 'infant_count'
        ]);

        if ($request->ajax()) {
            $html = view('ticket-search._results', compact('schedules', 'route', 'searchParams'))->render();
            return response()->json([
                'success' => true,
                'html' => $html
            ]);
        }

        return view('ticket-search.results', compact('schedules', 'route', 'searchParams'));
    }

    /**
     * Get stations by city (AJAX)
     */
    public function getStationsByCity(Request $request)
    {
        $stations = Station::active()
            ->when($request->city, function ($query, $city) {
                return $query->byCity($city);
            })
            ->when($request->province, function ($query, $province) {
                return $query->byProvince($province);
            })
            ->orderBy('name')
            ->get(['id', 'code', 'name', 'city']);

        return response()->json($stations);
    }

    /**
     * Get popular routes (AJAX)
     */
    public function getPopularRoutes()
    {
        $routes = PriceQuery::popularRoutes(10)
            ->with(['originStation', 'destinationStation'])
            ->get()
            ->map(function ($query) {
                return [
                    'origin_station_id' => $query->origin_station_id,
                    'destination_station_id' => $query->destination_station_id,
                    'route_name' => $query->route_name,
                    'query_count' => $query->query_count
                ];
            });

        return response()->json($routes);
    }

    /**
     * Check seat availability (AJAX)
     */
    public function checkAvailability(Request $request)
    {
        $schedule = Schedule::with('route')
            ->findOrFail($request->schedule_id);

        $requestedSeats = $request->passenger_count + ($request->infant_count ?? 0);
        
        return response()->json([
            'available' => $schedule->available_seats >= $requestedSeats,
            'available_seats' => $schedule->available_seats,
            'requested_seats' => $requestedSeats,
            'price' => $schedule->calculateTicketPrice(
                $request->passenger_count,
                $request->infant_count ?? 0
            )
        ]);
    }

    /**
     * Get schedule details (AJAX)
     */
    public function getScheduleDetails($id)
    {
        $schedule = Schedule::with(['route.originStation', 'route.destinationStation'])
            ->findOrFail($id);

        return response()->json([
            'id' => $schedule->id,
            'train_name' => $schedule->train_name,
            'train_class' => $schedule->train_class,
            'departure_time' => $schedule->formatted_departure_time,
            'arrival_time' => $schedule->formatted_arrival_time,
            'journey_duration' => $schedule->journey_duration,
            'available_seats' => $schedule->available_seats,
            'total_seats' => $schedule->total_seats,
            'seat_availability_percentage' => $schedule->seat_availability_percentage,
            'is_almost_full' => $schedule->is_almost_full,
            'base_price' => $schedule->route->base_price,
            'price_modifier' => $schedule->price_modifier,
            'price_per_person' => $schedule->route->base_price * $schedule->price_modifier,
            'route' => [
                'origin' => $schedule->route->originStation->full_name,
                'destination' => $schedule->route->destinationStation->full_name,
                'distance_km' => $schedule->route->distance_km
            ]
        ]);
    }
}