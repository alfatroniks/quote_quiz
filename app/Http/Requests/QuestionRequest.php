<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        if (is_array($this->answers)) {
            $this->merge([
                'answers' => json_encode($this->answers),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'question' => ['required'],
            'answers' => ['required', 'json'],
            'correct_answer' => ['required', 'integer'],
            'quiz_mode_id' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
