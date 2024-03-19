<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('email');
            $table->integer('total_score')->default(0);
            $table->integer('unanswered')->default(0);
            $table->foreignId('quiz_mode_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->integer('total_questions')->default(0);
            $table->integer('time_used');
            $table->timestamps();
            $table->index(['total_score', 'time_used'], 'rating_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
