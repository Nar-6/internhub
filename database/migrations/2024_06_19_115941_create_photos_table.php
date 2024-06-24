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
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('lien');
            $table->unsignedBigInteger('test_id');
            $table->unsignedBigInteger('candidature_id');
            $table->timestamps();

            $table->foreign('test_id')->references('test_id')->on('tester');
            $table->foreign('candidature_id')->references('candidature_id')->on('tester');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
