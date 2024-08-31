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
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trip_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('mood_id')->nullable();
            $table->string('title');
            $table->date('date');
            $table->text('description');
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('trips')->cascadeOnDelete();
            $table->foreign('trip_id')->references('id')->on('trips')->cascadeOnDelete();
            $table->foreign('mood_id')->references('id')->on('moods')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('days', function (Blueprint $table) {
            $table->dropForeign(['trip_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['mood_id']);
        });

        Schema::dropIfExists('days');
    }
};
