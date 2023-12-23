<?php

namespace App\Domains\Auth\Requests;

use App\Domains\Client\Models\Client;
use App\Domains\Verification\Models\ClientVerification;
use App\Domains\Verification\Structures\ClientVerificationTypes;
use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;

class SendResetRequest extends BaseRequest
{
    public ?Client $client;


    public function rules(): array
    {
        return [
            'email' => ['required', 'max:255']
        ];
    }

    protected function moreValidation(ValidatorContract $validator): void
    {
        $this->client = Client::where('email', $this->email)->first();

        $validator->after(function (ValidatorContract $validator) {
            $this->validateForExistingCode($validator);
        });
    }

    private function validateForExistingCode(ValidatorContract $validator): void
    {
        if (is_null($this->client)) {
            return;
        }

        $existing_code = ClientVerification::query()
            ->where('type', ClientVerificationTypes::PASSWORD_RESET)
            ->where('client_id', $this->client->id)
            ->whereFuture('expire_at')
            ->first();

        if (!is_null($existing_code)) {
            $validator->errors()->add('existing_code',
                'There are existing code for you. Check your phone/email.');
        }
    }

}
