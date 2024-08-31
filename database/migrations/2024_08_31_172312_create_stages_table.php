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
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('day_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('mood_id')->nullable();
            $table->string('title');
            $table->string('thumb')->nullable();
            $table->text('description');
            // $table->string('address');
            // $table->decimal('latitude', $precision = 11, $scale = 8)->default(0);
            // $table->decimal('longitude', $precision = 11, $scale = 8)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('days', function (Blueprint $table) {
            $table->dropForeign(['day_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['mood_id']);
        });

        Schema::dropIfExists('stages');
    }
};
