<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('employes', function (Blueprint $table) {
            $table->unsignedBigInteger('departement_id');
            $table->foreign('departement_id')->references('departement_id')->on('departements')->onDelete('cascade');

            $table->unsignedBigInteger('candidat_id')->nullable();
            $table->foreign('candidat_id')->references('candidat_id')->on('candidats')->onDelete('set null');

            $table->unsignedBigInteger('stage_id')->nullable();
            $table->foreign('stage_id')->references('stage_id')->on('stages')->onDelete('set null');

            // Ajoutez d'autres clés étrangères ici si nécessaire
        });
    }

    public function down()
    {
        Schema::table('employes', function (Blueprint $table) {
            $table->dropForeign(['departement_id']);
            $table->dropForeign(['candidat_id']);
            $table->dropForeign(['stage_id']);
            // Supprimez d'autres clés étrangères ici si nécessaire
        });
    }
};
