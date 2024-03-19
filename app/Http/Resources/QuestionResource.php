<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Question */
class QuestionResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'question' => $this->question,
            'answers' => json_decode($this->answers),
            'quiz_mode_id' => $this->quiz_mode_id,
        ];

        if (auth()->check() && auth()->user()->isAdmin()) {
            $adminData = [
                'correct_answer' => $this->correct_answer,
            ];
            $data = array_merge($data, $adminData);
        }

        return $data;
    }
}
