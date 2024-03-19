<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'total_score',
        'unanswered',
        'quiz_mode_id',
        'time_used',
    ];
}
