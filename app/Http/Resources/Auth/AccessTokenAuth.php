<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccessTokenAuth extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            "access_token" => $this['access_token'],
            "refresh_token" => $this['refresh_token'],
            "expires_in" => $this['expires_in'],
            "token_type" => $this['token_type'],
        ];
    }
}
