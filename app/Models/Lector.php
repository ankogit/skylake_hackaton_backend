<?php

namespace App\Models;

use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lector extends Model implements HasName
{
    protected $fillable = [
        'first_name',
        'last_name',
        'info',
        'description',
        'contact_email',
        'contact_telegram',
        'contact_link',
    ];

    public function getFullNameAttribute(): ?string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getFilamentName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
