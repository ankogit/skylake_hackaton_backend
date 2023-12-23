<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateSurveyResult extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'results.*' => 'required|array|min:1',
            'results.*.survey_id' => 'required|numeric',
            'results.*.value' => 'required|numeric',
        ];
    }
}
