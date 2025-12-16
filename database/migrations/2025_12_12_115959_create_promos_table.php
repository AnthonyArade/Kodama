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
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            // Dates d'affichage
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            // Style du message (pour le rendu frontend)
            $table->string('type')->default('info'); // 'info', 'warning', 'success', 'error'
            // Activation/Désactivation manuelle
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
