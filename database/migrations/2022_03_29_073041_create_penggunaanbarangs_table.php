<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreatePenggunaanbarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penggunaanbarangs', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama_barang', 255);
            $table->dateTime('waktu_pakai');
            $table->dateTime('waktu_beres')->nullable();
            $table->string('nama_pemakai', 255);
            $table->enum('status', ['belum_selesai', 'Selesai']);
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
        Schema::dropIfExists('penggunaanbarangs');
    }
}
