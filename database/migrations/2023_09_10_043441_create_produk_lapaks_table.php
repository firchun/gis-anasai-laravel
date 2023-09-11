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
        Schema::create('produk_lapaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_lapak');
            $table->string('nama_produk');
            $table->string('foto')->nullable();
            $table->text('keterangan');
            $table->string('harga')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk_lapaks');
    }
};
