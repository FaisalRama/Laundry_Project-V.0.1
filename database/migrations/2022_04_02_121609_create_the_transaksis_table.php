<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTheTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('the_transaksis', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('id_outlet')->index();
            $table->string('kode_invoice');
            $table->unsignedBigInteger('id_member');
            $table->date('tgl');
            $table->date('batas_waktu');
            $table->datetime('tgl_bayar')->nullable();
            $table->integer('biaya_tambahan');
            $table->double('diskon');
            $table->integer('pajak');
            $table->enum('status', [
                'baru', 'proses', 'selesai', 'diambil'
            ]);
            $table->enum('pembayaran', [
                'dibayar', 'belum_dibayar'
            ]);
            $table->unsignedBigInteger('id_user');
            $table->double('total');
            $table->timestamps();

            // $table->foreign('id_outlet')->references('id')->on('tb_outlet')->onDelete('cascade');
            // $table->foreign('id_member')->references('id')->on('tb_member')->onDelete('cascade');
            // $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('the_transaksis');
    }
}
