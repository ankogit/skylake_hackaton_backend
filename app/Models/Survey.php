<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'survey_category_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(SurveyCategory::class, 'survey_category_id');
    }
}
