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
        Schema::create('review_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            $table->foreignId('id_lapak');
            $table->smallInteger('star_rating');
            $table->string('comments');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_lapak')->references('id')->on('lapaks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_ratings');
    }
};
