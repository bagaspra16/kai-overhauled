<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'route_id',
        'train_name',
        'train_class',
        'departure_date',
        'departure_time',
        'arrival_time',
        'total_seats',
        'available_seats',
        'price_modifier',
        'is_active'
    ];

    protected $casts = [
        'departure_date' => 'date',
        'total_seats' => 'integer',
        'available_seats' => 'integer',
        'price_modifier' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    /**
     * Get the route for this schedule
     */
    public function route(): BelongsTo
    {
        return $this->belongsTo(Route::class);
    }

    /**
     * Scope for active schedules only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for available schedules (has seats)
     */
    public function scopeAvailable($query)
    {
        return $query->where('available_seats', '>', 0);
    }

    /**
     * Scope for schedules on specific date
     */
    public function scopeOnDate($query, $date)
    {
        return $query->where('departure_date', $date);
    }

    /**
     * Scope for schedules by train class
     */
    public function scopeByClass($query, $trainClass)
    {
        return $query->where('train_class', $trainClass);
    }

    /**
     * Calculate actual ticket price
     */
    public function calculateTicketPrice($passengerCount = 1, $infantCount = 0)
    {
        return $this->route->calculatePrice(
            $this->price_modifier,
            $passengerCount,
            $infantCount
        );
    }

    /**
     * Get seat availability percentage
     */
    public function getSeatAvailabilityPercentageAttribute()
    {
        if ($this->total_seats == 0) {
            return 0;
        }
        
        return round(($this->available_seats / $this->total_seats) * 100, 1);
    }

    /**
     * Check if schedule is almost full (less than 20% seats available)
     */
    public function getIsAlmostFullAttribute()
    {
        return $this->seat_availability_percentage < 20;
    }

    /**
     * Get formatted departure time
     */
    public function getFormattedDepartureTimeAttribute()
    {
        if (!$this->departure_time) {
            return null;
        }
        
        // Handle if departure_time is already a time string (H:i format)
        if (is_string($this->departure_time)) {
            return $this->departure_time;
        }
        
        // Handle if it's a Carbon instance or datetime
        return \Carbon\Carbon::parse($this->departure_time)->format('H:i');
    }

    /**
     * Get formatted arrival time
     */
    public function getFormattedArrivalTimeAttribute()
    {
        if (!$this->arrival_time) {
            return null;
        }
        
        // Handle if arrival_time is already a time string (H:i format)
        if (is_string($this->arrival_time)) {
            return $this->arrival_time;
        }
        
        // Handle if it's a Carbon instance or datetime
        return \Carbon\Carbon::parse($this->arrival_time)->format('H:i');
    }

    /**
     * Get journey duration
     */
    public function getJourneyDurationAttribute()
    {
        if (!$this->departure_time || !$this->arrival_time) {
            return null;
        }
        
        // Parse times safely
        $departure = is_string($this->departure_time) 
            ? \Carbon\Carbon::parse($this->departure_time) 
            : $this->departure_time;
            
        $arrival = is_string($this->arrival_time) 
            ? \Carbon\Carbon::parse($this->arrival_time) 
            : $this->arrival_time;
        
        // Handle next day arrival
        if ($arrival->lt($departure)) {
            $arrival->addDay();
        }
        
        $diff = $departure->diff($arrival);
        return $diff->format('%hj %im');
    }

    /**
     * Get formatted duration (alias for journey_duration)
     */
    public function getFormattedDurationAttribute()
    {
        return $this->journey_duration;
    }

    /**
     * Reserve seats
     */
    public function reserveSeats($count)
    {
        if ($this->available_seats >= $count) {
            $this->decrement('available_seats', $count);
            return true;
        }
        
        return false;
    }

    /**
     * Release seats
     */
    public function releaseSeats($count)
    {
        $newAvailable = $this->available_seats + $count;
        
        if ($newAvailable <= $this->total_seats) {
            $this->increment('available_seats', $count);
            return true;
        }
        
        return false;
    }
}