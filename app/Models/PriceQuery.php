<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceQuery extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'origin_station_id',
        'destination_station_id',
        'departure_date',
        'passenger_count',
        'infant_count',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'departure_date' => 'date',
        'passenger_count' => 'integer',
        'infant_count' => 'integer'
    ];

    /**
     * Get the user who made this query
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the origin station
     */
    public function originStation(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'origin_station_id');
    }

    /**
     * Get the destination station
     */
    public function destinationStation(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'destination_station_id');
    }

    /**
     * Scope for queries by user
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope for queries on specific date
     */
    public function scopeOnDate($query, $date)
    {
        return $query->where('departure_date', $date);
    }

    /**
     * Scope for queries between specific stations
     */
    public function scopeBetweenStations($query, $originId, $destinationId)
    {
        return $query->where('origin_station_id', $originId)
                    ->where('destination_station_id', $destinationId);
    }

    /**
     * Scope for popular routes (most queried)
     */
    public function scopePopularRoutes($query, $limit = 10)
    {
        return $query->selectRaw('origin_station_id, destination_station_id, COUNT(*) as query_count')
                    ->groupBy('origin_station_id', 'destination_station_id')
                    ->orderBy('query_count', 'desc')
                    ->limit($limit);
    }

    /**
     * Get total passenger count (adults + infants)
     */
    public function getTotalPassengersAttribute()
    {
        return $this->passenger_count + $this->infant_count;
    }

    /**
     * Get route name
     */
    public function getRouteNameAttribute()
    {
        return "{$this->originStation->name} - {$this->destinationStation->name}";
    }

    /**
     * Create a new price query with IP tracking
     */
    public static function createQuery($data, $request = null)
    {
        if ($request) {
            $data['ip_address'] = $request->ip();
            $data['user_agent'] = $request->userAgent();
        }

        return static::create($data);
    }
}