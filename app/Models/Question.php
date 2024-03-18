<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    protected $fillable = [
        'question',
        'answers',
        'correct',
        'quiz_mode',
    ];

    public function mode(): BelongsTo
    {
        return $this->belongsTo(QuizMode::class);
    }
}
