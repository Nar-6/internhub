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
        Schema::table('stages', function (Blueprint $table) {
            $table->unsignedBigInteger('offre_de_stage_id');
            $table->foreign('offre_de_stage_id')->references('offre_de_stage_id')->on('offres_de_stage')->onDelete('cascade');
            // Ajoutez d'autres clés étrangères au besoin
        });
    }

    public function down()
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->dropForeign(['offre_de_stage_id']);
        });
    }
};
