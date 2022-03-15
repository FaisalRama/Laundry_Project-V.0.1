<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJemputlaundriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jemputlaundries', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_member');
            $table->string('petugas_penjemput', 255);
            $table->enum('status', ['tercatat','penjemputan', 'selesai']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_member')->references('id')->on('tb_member')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jemputlaundries');
    }
}
