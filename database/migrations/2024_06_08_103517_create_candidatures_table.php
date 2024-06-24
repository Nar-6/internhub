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
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id('candidature_id');
            $table->date('date_soumission');
            $table->enum('statut', ['soumis', 'en attente', 'rejeté', 'accepté']);
            $table->unsignedBigInteger('candidat_id');
            $table->unsignedBigInteger('offre_de_stage_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidatures');
    }
};
