<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventQuestionResource;
use App\Http\Resources\EventQuestionsResource;
use App\Http\Resources\LectorResource;
use App\Http\Resources\LectorsResource;
use App\Models\Category;
use App\Models\Lector;

class LectorController extends Controller
{
    /**
     * List lectors
     * @unauthenticated
     */
    public function index(): LectorsResource
    {
        return new LectorsResource(Lector::all());
    }

    /**
     * Get category
     * @unauthenticated
     */
    public function show(Lector $lector): LectorResource
    {
        return new LectorResource($lector);
    }

}
