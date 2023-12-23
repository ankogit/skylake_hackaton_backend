<?php

namespace App\Domains\Auth\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class RegisterAuthRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'unique:clients,email', 'max:50'],
            'fname' => ['required', 'string'],
            'lname' => ['required', 'string'],
            'password' => ['required', 'min:6', 'max:256'],
            'invite_code' => ['sometimes', 'required', 'exists:invites,code'],
        ];
    }

}
