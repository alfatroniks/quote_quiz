<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'max:254'],
            'total_score' => ['required', 'integer'],
            'unanswered' => ['required', 'integer'],
            'quiz_mode_id' => ['nullable', 'integer'],
            'time_used' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
