<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    protected $fillable = [
        'question',
        'answers',
        'correct_answer',
        'quiz_mode_id',
    ];

    public function mode(): BelongsTo
    {
        return $this->belongsTo(QuizMode::class);
    }
}
