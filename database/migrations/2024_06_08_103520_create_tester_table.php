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
        Schema::create('tester', function (Blueprint $table) {
            $table->id('tester_id');
            $table->unsignedBigInteger('test_id');
            $table->unsignedBigInteger('candidature_id');
            $table->integer('note');
            $table->string('decision');
            $table->timestamps();

            // Clés étrangères
            $table->foreign('test_id')->references('test_id')->on('tests');
            $table->foreign('candidature_id')->references('candidature_id')->on('candidatures');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tester');
    }
};
