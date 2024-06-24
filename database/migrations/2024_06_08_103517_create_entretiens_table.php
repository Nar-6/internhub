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
        Schema::create('entretiens', function (Blueprint $table) {
            $table->id('entretien_id');
            $table->date('date');
            $table->time('heure');
            $table->string('lien');
            $table->enum('statut', ['prévu', 'terminé', 'annulé']);
            $table->enum('type', ['en ligne', 'en présentiel']);
            $table->unsignedBigInteger('candidature_id');
            $table->unsignedBigInteger('employe_id');
            // Ajoutez d'autres colonnes au besoin
            $table->timestamps();

            // Clés étrangères
            $table->foreign('candidature_id')->references('candidature_id')->on('candidatures')->onDelete('cascade');
            $table->foreign('employe_id')->references('employe_id')->on('employes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entretiens');
    }
};
