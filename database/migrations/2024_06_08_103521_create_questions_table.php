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
        Schema::create('questions', function (Blueprint $table) {
            $table->unsignedBigInteger('num_question')->autoIncrement();
            $table->unsignedBigInteger('test_id');
            $table->text('enonce');
            $table->integer('points');
            $table->unique(['num_question', 'test_id']);
            $table->timestamps();
            $table->integer('bonne_reponse_id');

            // Clé étrangère
            $table->foreign('test_id')->references('test_id')->on('tests');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
