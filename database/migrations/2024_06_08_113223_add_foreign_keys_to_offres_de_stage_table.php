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
        Schema::table('offres_de_stage', function (Blueprint $table) {
            $table->unsignedBigInteger('departement_id');
            $table->foreign('departement_id')->references('departement_id')->on('departements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offres_de_stage', function (Blueprint $table) {
            $table->dropForeign(['departement_id']);
        });
    }
};
