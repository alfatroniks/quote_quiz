<?php

use App\Http\Controllers\Api\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/questions/all', [QuestionController::class, 'index']);
Route::get('/questions/session', [QuestionController::class, 'getSessionQuestions']);
Route::put('/answer/{question}', [QuestionController::class, 'checkAnswer']);

