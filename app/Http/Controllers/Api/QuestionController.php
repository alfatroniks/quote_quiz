<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Models\QuizMode;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all()->sortBy('mode');
        return QuestionResource::collection($questions)->resolve();
    }

    public function getSessionQuestions(Request $request)
    {
        $mode = QuizMode::where('code', $request->mode)
            ->orWhere('is_default', 1)
            ->first();
        if ($mode) {
            //todo settings take
            $questions = $mode->questions()->inRandomOrder()->take(10)->get();
        } else {
            return response()->json(false);
        }
        return QuestionResource::collection($questions)->resolve();
    }

    public function checkAnswer(Question $question, Request $request)
    {
        $answer = json_decode($question->answers);
        return response()->json([
            'answer' => $answer[$question->correct],
            'correct' => $question->correct == $request->answer
        ]);
    }
}
