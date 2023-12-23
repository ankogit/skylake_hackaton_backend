<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventQuestionResource;
use App\Http\Resources\EventQuestionsResource;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * List categories
     * @unauthenticated
     */
    public function index(): EventQuestionsResource
    {
        return new EventQuestionsResource(Category::all());
    }

    /**
     * Get category
     * @unauthenticated
     */
    public function show(Category $category): EventQuestionResource
    {
        return new EventQuestionResource($category);
    }

}
