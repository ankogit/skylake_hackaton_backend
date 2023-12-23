<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lector extends Model
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
}
