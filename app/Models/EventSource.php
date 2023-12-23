<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSource extends Model
{
    protected $fillable = [
        'event_id',
        'link',
        'name',
    ];
}
