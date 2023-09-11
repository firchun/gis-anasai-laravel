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
        Schema::create('produk_stoks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_produk_lapak');
            $table->enum('jenis', ['pemasukkan', 'pengeluaran']);
            $table->string('jumlah')->default('0');
            $table->timestamps();

            $table->foreign('id_produk_lapak')->references('id')->on('produk_lapaks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk_stoks');
    }
};
