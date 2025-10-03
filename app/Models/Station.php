<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Station extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'code',
        'name',
        'city',
        'province',
        'latitude',
        'longitude',
        'is_active'
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'is_active' => 'boolean'
    ];

    /**
     * Get routes where this station is origin
     */
    public function originRoutes(): HasMany
    {
        return $this->hasMany(Route::class, 'origin_station_id');
    }

    /**
     * Get routes where this station is destination
     */
    public function destinationRoutes(): HasMany
    {
        return $this->hasMany(Route::class, 'destination_station_id');
    }

    /**
     * Get all routes (both origin and destination)
     */
    public function routes()
    {
        return $this->originRoutes()->union($this->destinationRoutes());
    }

    /**
     * Get price queries from this station
     */
    public function originPriceQueries(): HasMany
    {
        return $this->hasMany(PriceQuery::class, 'origin_station_id');
    }

    /**
     * Get price queries to this station
     */
    public function destinationPriceQueries(): HasMany
    {
        return $this->hasMany(PriceQuery::class, 'destination_station_id');
    }

    /**
     * Scope for active stations only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for stations by city
     */
    public function scopeByCity($query, $city)
    {
        return $query->where('city', $city);
    }

    /**
     * Scope for stations by province
     */
    public function scopeByProvince($query, $province)
    {
        return $query->where('province', $province);
    }

    /**
     * Get full station name with city
     */
    public function getFullNameAttribute()
    {
        return "{$this->name} ({$this->city})";
    }
}