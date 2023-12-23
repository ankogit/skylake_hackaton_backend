<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventQuestion extends Model
{
    protected $fillable = [
        'event_id',
        'user_id',
        'message',
        'votes',
    ];

    public function isVoted()
    {
        if (auth()?->id()) {
        }
        return false;
    }
}
