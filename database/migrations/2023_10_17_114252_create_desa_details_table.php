<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desa_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_desa');
            $table->json('data');
            $table->timestamps();

            $table->foreign('id_desa')->references('id')->on('desas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('desa_details');
    }
};
