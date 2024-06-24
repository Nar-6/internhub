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
        Schema::table('administrateurs', function (Blueprint $table) {
            $table->foreign('employe_id')->references('employe_id')->on('employes')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            // Ajoutez d'autres clés étrangères ici si nécessaire
        });
    }

    public function down()
    {
        Schema::table('administrateurs', function (Blueprint $table) {
            $table->dropForeign(['employe_id']);
            $table->dropForeign(['user_id']);
            // Supprimez d'autres clés étrangères ici si nécessaire
        });
    }
};
