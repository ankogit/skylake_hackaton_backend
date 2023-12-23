<?php

namespace App\Domains\Auth\Requests;

use App\Domains\Client\Models\Client;
use App\Domains\Verification\Models\ClientVerification;
use App\Http\Requests\BaseRequest;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;

class ResetPasswordRequest extends BaseRequest
{
    public ?Client $client;

    public function rules(): array
    {
        return [
            'token' => ['required', 'max:255'],
            'new_password' => ['required', 'max:255', 'min:8'],
            'confirm_new_password' => ['required', 'same:new_password']
        ];
    }

    protected function moreValidation(ValidatorContract $validator): void
    {
        $validator->after(function (ValidatorContract $validator) {
            $this->validateTokenExists($validator);
        });
    }

    protected function validateTokenExists(ValidatorContract $validator): void
    {
        $verification = ClientVerification::query()
            ->where('code', $this->token)
            ->first();

        if (is_null($verification))
        {
            $validator->errors()->add('token', 'Invalid reset password token');
        }
    }

}
