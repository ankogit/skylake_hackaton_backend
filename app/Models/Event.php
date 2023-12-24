<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_image',
        'title',
        'description',
        'date',
        'time',
        'type',
        'link',
        'address',
        'duration',
        'lector_id',
        'category_id',
        'max_participants',
        'active',
        'record_link',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function lector(): BelongsTo
    {
        return $this->belongsTo(Lector::class, 'lector_id');
    }

    public function questions()
    {
        return $this->hasMany(EventQuestion::class);
    }

    public function sources(): HasMany
    {
        return $this->hasMany(EventSource::class);
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(EventFeedback::class);
    }

    public function getSubscribedAttribute()
    {
        if (!auth()?->id()) {
            return false;
        }

        if ($this->users()->find(auth()?->id())) {
            return true;
        }
        return false;
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'event_users');
    }
}
