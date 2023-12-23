<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            /** @var integer */
            'id' => $this->id,
            'main_image' => $this->main_image,
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,

            'time' => $this->time,
            'type' => $this->type,
            'link' => $this->link,
            'address' => $this->address,
            /** @var integer|null */
            'duration' => $this->duration,
            /** @var integer */
            'lector_id' => $this->lector_id,
            /** @var integer */
            'category_id' => $this->category_id,
            /** @var integer|null */
            'max_participants' => $this->max_participants,
            /** @var EventCategoryResource */
            'category' => new EventCategoryResource($this->category),
            /** @var array<EventSourceResource> */
            'sources' => new EventSourcesResource($this->sources),
            /** @var array<EventQuestionResource> */
            'questions' => new EventQuestionsResource($this->questions),
            /** @var LectorResource */
            'lector' => new LectorResource($this->lector),
            /** @var string */
            'created_at' => $this->created_at,
        ];
    }
}
