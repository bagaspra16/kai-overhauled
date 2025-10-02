<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;

class KaiAbout extends Model
{
    use HasUuids;

    protected $table = 'kai_about';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'judul',
        'deskripsi',
        'tahun'
    ];

    /**
     * Generate a new UUID for the model like c05563-19a8-428e-8bb5-745ea3de8396.
     */
    public function newUniqueId(): string
    {
        // Characters for UUID generation
        $chars = '0123456789abcdef';
        $uuid = '';
        
        // Generate each segment ensuring good letter/number mix
        $segments = [8, 4, 4, 4, 12]; // Standard UUID format
        
        foreach ($segments as $segmentIndex => $length) {
            if ($segmentIndex > 0) {
                $uuid .= '-';
            }
            
            $segment = '';
            for ($i = 0; $i < $length; $i++) {
                // Special handling for UUID v4 format
                if ($segmentIndex == 2 && $i == 0) {
                    $segment .= '4'; // Version 4
                } elseif ($segmentIndex == 3 && $i == 0) {
                    $segment .= $chars[mt_rand(8, 11)]; // Variant bits (8,9,a,b)
                } elseif ($segmentIndex == 0 && $i == 0) {
                    // First character must be a letter (a-f) to avoid database int interpretation
                    $segment .= $chars[mt_rand(10, 15)]; // a-f
                } else {
                    // Ensure good mix by alternating patterns
                    $position = $segmentIndex * 10 + $i;
                    if ($position % 3 == 0) {
                        // Letter more likely
                        $segment .= $chars[mt_rand(10, 15)]; // a-f
                    } elseif ($position % 3 == 1) {
                        // Number more likely
                        $segment .= $chars[mt_rand(0, 9)]; // 0-9
                    } else {
                        // Random
                        $segment .= $chars[mt_rand(0, 15)];
                    }
                }
            }
            $uuid .= $segment;
        }
        
        return $uuid;
    }
}
