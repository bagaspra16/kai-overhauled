<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Route extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'origin_station_id',
        'destination_station_id',
        'base_price',
        'infant_price',
        'distance_km',
        'estimated_duration',
        'is_active'
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'infant_price' => 'decimal:2',
        'distance_km' => 'integer',
        'estimated_duration' => 'datetime:H:i',
        'is_active' => 'boolean'
    ];

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
     * Get schedules for this route
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Scope for active routes only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for routes between specific stations
     */
    public function scopeBetweenStations($query, $originId, $destinationId)
    {
        return $query->where('origin_station_id', $originId)
                    ->where('destination_station_id', $destinationId);
    }

    /**
     * Get route name
     */
    public function getRouteNameAttribute()
    {
        return "{$this->originStation->name} - {$this->destinationStation->name}";
    }

    /**
     * Calculate actual price with modifier
     */
    public function calculatePrice($priceModifier = 1.00, $passengerCount = 1, $infantCount = 0)
    {
        $adultPrice = $this->base_price * $priceModifier * $passengerCount;
        $infantPrice = $this->infant_price * $infantCount;
        
        return $adultPrice + $infantPrice;
    }

    /**
     * Get formatted duration
     */
    public function getFormattedDurationAttribute()
    {
        if (!$this->estimated_duration) {
            return null;
        }
        
        $duration = \Carbon\Carbon::parse($this->estimated_duration);
        $hours = $duration->format('H');
        $minutes = $duration->format('i');
        
        return "{$hours}j {$minutes}m";
    }
}