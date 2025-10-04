<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'sender',
        'message',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public $timestamps = true;

    /**
     * Scope for user messages
     */
    public function scopeUserMessages($query)
    {
        return $query->where('sender', 'user');
    }

    /**
     * Scope for bot messages
     */
    public function scopeBotMessages($query)
    {
        return $query->where('sender', 'bot');
    }

    /**
     * Scope for session
     */
    public function scopeForSession($query, $sessionId)
    {
        return $query->where('session_id', $sessionId);
    }
}
