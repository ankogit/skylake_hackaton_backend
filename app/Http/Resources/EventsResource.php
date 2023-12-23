<?php

namespace App\Http\Resources;

use App\Domains\WorkspaceInvites\Resources\Invite;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EventsResource extends ResourceCollection
{
    public $collects = EventResource::class;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
