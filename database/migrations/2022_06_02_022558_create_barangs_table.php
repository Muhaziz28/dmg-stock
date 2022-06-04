<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();

            $table->string('nama_barang');
            $table->string('kode_barang')->nullable();
            $table->string('ukuran');
            $table->string('id_bahan')->constrained('bahans')->onDelete('cascade');
            $table->foreignId('id_variasi')->constrained('variasis')->onDelete('cascade');
            $table->integer('stok');

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
        Schema::dropIfExists('barangs');
    }
}
