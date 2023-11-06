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
            $table->enum('type', ['wisata', 'lapak', 'kegiatan'])->default('lapak');
            $table->mediumInteger('identity')->nullable();
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
            //
        });
    }
};
