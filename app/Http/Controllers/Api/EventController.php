<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateQuestionRequest;
use App\Http\Requests\GetEventsRequest;
use App\Http\Requests\RateEventRequest;
use App\Http\Resources\EventFeedbackResource;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventsResource;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * List Events
     * @unauthenticated
     */
    public function index(GetEventsRequest $request): EventsResource
    {
        $events = Event::query();

        return new EventsResource($events->get());
    }

    /**
     * Get event
     */
    public function show(Event $event): EventResource
    {
        return new EventResource($event);
    }

    /**
     * Join
     *
     * @param  Event  $event
     * @return EventResource
     */
    public function join(Event $event): EventResource
    {
        return new EventResource($event);
    }

    /**
     * Left
     *
     * @param  Event  $event
     * @return EventResource
     */
    public function left(Event $event): EventResource
    {
        return new EventResource($event);
    }

    /**
     * Create feedback
     *
     * @param  RateEventRequest  $request
     * @param  Event  $event
     * @return EventFeedbackResource
     */
    public function rate(RateEventRequest $request, Event $event): EventFeedbackResource
    {
        return new EventFeedbackResource($event);
    }


    /**
     * Add question
     *
     * @param  CreateQuestionRequest  $request
     * @param  Event  $event
     * @return EventResource
     */
    public function createQuestion(CreateQuestionRequest $request, Event $event): EventResource
    {
        $input = $request->input();
        $event->questions()->create([
            'event_id' => $event->id,
            'user_id' => auth()->id(),
            'message' => $input['message'],
        ]);
        return new EventResource($event);
    }
}
