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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->unsignedBigInteger('day_id'); // Aggiungi il campo day_id
            $table->unsignedBigInteger('user_id'); // Aggiungi il campo user_id
            $table->timestamps();

            // Aggiungi chiavi esterne
            $table->foreign('day_id')->references('id')->on('days')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            // Rimuovi le chiavi esterne prima di eliminare la tabella
            $table->dropForeign(['day_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('notes');
    }
};

