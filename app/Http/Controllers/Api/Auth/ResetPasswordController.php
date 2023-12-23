<?php

namespace App\Http\Controllers\Api\Auth;

use App\Domains\ApiResponse\ApiResponse;
use App\Domains\Auth\Requests\ResetPasswordRequest;
use App\Domains\Auth\Requests\SendResetRequest;
use App\Domains\Client\Models\Client;
use App\Domains\Verification\Models\ClientVerification;
use App\Domains\Verification\Services\VerificationService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ResetPasswordController extends Controller
{
    public function sendVerificationCode(SendResetRequest $request, VerificationService $service): JsonResponse
    {
        $client = Client::where('email', $request->email)->first();

        if (!is_null($client)) {
            Log::info('Client found, mail send');
            $service->createEmaiLResetCode($client->id);
        } else {
            Log::error('CLIENT NOT FOUND 404');
        }

        return ApiResponse::success();
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $verification = ClientVerification::query()
            ->where('code', $request->token)
            ->first();

        $client = $verification->client;

        $client->changePassword($request->new_password);

        $verification->delete();

        return ApiResponse::success();
    }

}
