<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Score */
class ScoreResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'totalScore' => $this->total_score,
            'timeUsed' => $this->time_used,
            'quiz_mode_id' => $this->quiz_mode_id,
        ];

        if (auth()->check() && auth()->user()->isAdmin()) {
            $adminData = [
                'last_name' => $this->last_name,
                'unanswered' => $this->unanswered,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ];
            $data = array_merge($data, $adminData);
        }

        return $data;
    }
}
