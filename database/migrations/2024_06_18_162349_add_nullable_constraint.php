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
        Schema::table('tester', function (Blueprint $table) {
            $table->integer('note')->nullable()->change();
            $table->string('decision')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tester', function (Blueprint $table) {
            $table->integer('note')->nullable(false)->change();
            $table->string('decision')->nullable(false)->change();
        });
    }
};
