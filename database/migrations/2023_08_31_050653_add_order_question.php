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
        Schema::table('on_boarding_questions', function (Blueprint $table) {
            $table->integer('order')->after('label');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('on_boarding_questions', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
