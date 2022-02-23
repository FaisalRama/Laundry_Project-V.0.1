<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangInventarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_inventaris', function (Blueprint $table) {
            $table->id('id')->autoIncrement();
            $table->string('nama_barang', 200);
            $table->string('merk_barang', 200);
            $table->integer('qty')->unsigned();
            $table->enum('kondisi', ['layak_pakai', 'rusak_ringan', 'rusak_berat']);
            $table->date('tanggal_pengadaan');
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
        Schema::dropIfExists('barang_inventari');
    }
}
