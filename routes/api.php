<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\LectorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::middleware('auth')->group(function () {
//Route::apiResource('events', EventController::class);
//});
//
//Route::post('register', 'API\RegisterController@register');
//Route::post('login', 'API\RegisterController@login');
Route::middleware('auth:api')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

    Route::post('/events/{event}/join', [EventController::class, 'join'])->name('joinEvent');
    Route::post('/events/{event}/left', [EventController::class, 'left'])->name('leftEvent');
    Route::post('/events/{event}/rate', [EventController::class, 'rate'])->name('rateEvent');
    Route::post('/events/{event}/question', [EventController::class, 'createQuestion'])->name('createQuestionEvent');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/social/auth', [AuthController::class, 'socialAuth'])->name('socialAuth');

Route::get('/categories', [CategoryController::class, 'index'])->name('categoryList');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('getCategory');

Route::get('/lectors', [LectorController::class, 'index'])->name('lectorList');
Route::get('/lectors/{lector}', [LectorController::class, 'show'])->name('getLector');

Route::get('/events', [EventController::class, 'index'])->name('eventsList');
Route::get('/events/{event}', [EventController::class, 'show'])->name('getEvents');

## Password Reset
//Route::post('/reset-password', [ResetPasswordController::class, 'sendVerificationCode']);
//Route::post('/reset-password/update', [ResetPasswordController::class, 'resetPassword']);
