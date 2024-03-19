<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizModeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('quiz_modes')->insert([
            ['code'=> 'binary', 'name' => 'Binary', 'is_default' => 1],
            ['code'=> 'multiple', 'name' => 'Multiple choice', 'is_default' => 0],
        ]);
    }
}
