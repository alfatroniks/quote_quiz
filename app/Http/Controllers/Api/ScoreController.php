<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScoreRequest;
use App\Http\Resources\ScoreResource;
use App\Models\Score;

class ScoreController extends Controller
{
    public function index()
    {
        $scores = Score::orderBy('total_score', 'desc')
            ->orderBy('time_used', 'asc')
            ->get();
        return ScoreResource::collection($scores)->resolve();
    }

    public function store(ScoreRequest $request)
    {
        Score::create($request->validated());
        return response()->json([
            'message' => 'Score successfully saved',
        ], 201);
    }

    public function show(Score $score)
    {
        return new ScoreResource($score);
    }

    public function update(ScoreRequest $request, Score $score)
    {
        $score->update($request->validated());

        return new ScoreResource($score);
    }

    public function destroy(Score $score)
    {
        $score->delete();

        return response()->json();
    }
}
