<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SendResetRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'provider' => ['required', 'max:255'],
            'token' => ['required'],
            'secret' => ['sometimes', 'required'],
            'invite_code' => ['sometimes', 'required', 'exists:invites,code'],
        ];
    }
}
