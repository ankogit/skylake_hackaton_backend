<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAuthRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'unique:users,email', 'max:50'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'password' => ['required', 'min:6', 'max:256'],
        ];
    }

}
