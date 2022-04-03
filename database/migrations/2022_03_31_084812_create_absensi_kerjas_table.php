<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiKerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi_kerjas', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama_karyawan', 255);
            $table->date('tanggal_masuk');
            $table->time('waktu_masuk');
            $table->enum('status', ['masuk', 'sakit', 'cuti']);
            $table->time('waktu_selesai_kerja')->nullable();
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
        Schema::dropIfExists('absensi_kerjas');
    }
}
