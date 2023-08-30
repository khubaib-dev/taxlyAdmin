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
        Schema::create('on_boardings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('occupation_id')->constrained('occupations')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('profession_id')->nullable();
            $table->unsignedBigInteger('criteria_id');
            $table->string('icon');
            $table->string('heading');
            $table->string('sub_heading');
            $table->tinyInteger('type')->comment('0=Radio , 1=CheckBox');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('on_boardings');
    }
};
