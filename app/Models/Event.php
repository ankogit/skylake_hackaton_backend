<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
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

    public function sources()
    {
        return $this->hasMany(EventSource::class);
    }
}
