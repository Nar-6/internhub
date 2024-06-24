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
        Schema::table('departements', function (Blueprint $table) {
            $table->foreign('employe_id')->references('employe_id')->on('employes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('departements', function (Blueprint $table) {
            $table->dropForeign(['employe_id']);
        });
    }
};
