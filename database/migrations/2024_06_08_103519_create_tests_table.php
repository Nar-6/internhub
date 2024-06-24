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
        Schema::create('tests', function (Blueprint $table) {
            $table->id('test_id');
            $table->enum('type', ['personnalité', 'technique']);
            $table->text('contenu');
            $table->date('date');
            $table->time('heure');
            $table->unsignedBigInteger('departement_id');
            $table->timestamps();

            // Clé étrangère
            $table->foreign('departement_id')->references('departement_id')->on('departements');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
