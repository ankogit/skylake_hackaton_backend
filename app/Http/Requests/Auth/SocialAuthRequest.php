<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SocialAuthRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'provider' => ['required', 'max:255'],
            'token' => ['required'],
        ];
    }
}
