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
        Schema::table('review_ratings', function (Blueprint $table) {
            $table->dropForeign(['id_lapak']);
            $table->dropColumn('id_lapak');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('review_ratings', function (Blueprint $table) {
            $table->foreignId('id_lapak')->unsigned();
            $table->foreign('id_lapak')->references('id')->on('lapaks');
        });
    }
};
