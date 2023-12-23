<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSurveyResult;
use App\Http\Resources\EventQuestionResource;
use App\Http\Resources\EventQuestionsResource;
use App\Http\Resources\LectorResource;
use App\Http\Resources\LectorsResource;
use App\Http\Resources\SurveyResource;
use App\Http\Resources\SurveyResultResource;
use App\Http\Resources\SurveyResultsResource;
use App\Http\Resources\SurveysResource;
use App\Models\Category;
use App\Models\Lector;
use App\Models\Survey;
use App\Models\UserSurveyResult;

class SurveyController extends Controller
{
    /**
     * List survey questions
     */
    public function index(): SurveysResource
    {
        return new SurveysResource(Survey::all());
    }

    /**
     * Post survey result
     */
    public function postSurvey(CreateSurveyResult $request): SurveyResultResource
    {
        foreach ($request->input() as $item) {
            UserSurveyResult::query()->updateOrCreate([
                'user_id' => auth()->id(),
                'survey_id' => $item['survey_id'],
            ], [
                'value' => $item['value'],
            ]);
        }
        return new SurveyResultResource(UserSurveyResult::where('user_id', auth()->id())->first());
    }

    /*
     * Get my survey result
     */
    public function getSurveyResults(): SurveyResultsResource
    {
        return new SurveyResultsResource(UserSurveyResult::where('user_id', auth()->id())->get());
    }

}
