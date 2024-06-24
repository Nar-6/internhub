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
        Schema::create('reponses', function (Blueprint $table) {
            $table->unsignedBigInteger('num_reponse');
            $table->unsignedBigInteger('num_question');
            $table->unsignedBigInteger('test_id');
            $table->text('enonce');
            $table->unique(['num_question', 'test_id', 'num_reponse']);
            $table->timestamps();

            // Clés étrangères
            $table->foreign('test_id')->references('test_id')->on('tests');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reponses');
    }
};
