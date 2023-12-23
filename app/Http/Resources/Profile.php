<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Profile extends JsonResource
{
    public static $wrap = null;
    
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "email" => $this->email,
            "hash" => $this->hash,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "avatar_url" => $this->avatar_url,
            /** @var array<string> */
            "social_networks" => $this->social_networks,
        ];
    }
}
