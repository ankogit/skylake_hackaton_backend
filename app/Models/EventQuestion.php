<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        if (!auth()?->id()) {
            return false;
        }
        if ($this->voteUsers()->find(auth()?->id())) {
            return true;
        }
        return false;
    }

    public function voteUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_question_votes');
    }
}
