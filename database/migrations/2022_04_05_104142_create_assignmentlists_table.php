<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignmentlists', function (Blueprint $table) {
            $table->id('id');
            $table->string('fitur', 255);
            $table->enum('status_fitur', ['belum_selesai', 'selesai']);
            $table->dateTime('history_waktu_pengerjaan')->nullable();
            $table->boolean('setor')->default(0);
            $table->dateTime('waktu_setor')->nullable();
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
        Schema::dropIfExists('assignmentlists');
    }
}
