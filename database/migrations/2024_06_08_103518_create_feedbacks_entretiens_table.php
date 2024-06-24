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
        Schema::create('feedbacks_entretiens', function (Blueprint $table) {
            $table->id('feedback_id');
            $table->text('commentaires');
            $table->integer('note');
            $table->unsignedBigInteger('entretien_id');
            $table->timestamps();

            // Clé étrangère
            $table->foreign('entretien_id')->references('entretien_id')->on('entretiens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks_entretiens');
    }
};
