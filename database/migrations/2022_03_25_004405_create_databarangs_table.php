<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('databarangs', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama_barang', 255);
            $table->integer('qty')->unsigned();
            $table->string('harga', 255);
            $table->date('waktu_beli');
            $table->string('supplier', 255);
            $table->enum('status_barang', ['diajukan_beli', 'habis', 'tersedia']);
            $table->dateTime('waktu_update_status');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('databarangs');
    }
}
