<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginAuthRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:50'],
            'password' => ['required'],
        ];
    }
}
