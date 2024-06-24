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
        Schema::create('candidats', function (Blueprint $table) {
            $table->id('candidat_id');
            $table->integer('age');
            $table->string('cv')->nullable(); // chemin du fichier CV
            $table->string('lettre_de_motivation')->nullable(); // chemin du fichier lettre de motivation
            $table->boolean('retenu')->default(false);
            $table->enum('sexe', ['M', 'F']);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidats');
    }
};
