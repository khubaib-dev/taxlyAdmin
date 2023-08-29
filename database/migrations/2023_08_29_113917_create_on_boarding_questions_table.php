<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('on_boarding_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('on_boarding_id')->constrained('on_boardings')->onUpdate('cascade')->onDelete('cascade');
            $table->string('label');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('on_boarding_questions');
    }
};
