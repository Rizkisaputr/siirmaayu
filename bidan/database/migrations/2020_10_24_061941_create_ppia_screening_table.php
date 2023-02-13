<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePpiaScreeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppia_screening', function (Blueprint $table) {
            $table->id();
            $table->integer('ppia_id');
            $table->string('kode')->nullable();
            $table->date('tgl')->nullable();
            $table->string('kode_specimen')->nullable();
            $table->integer('hasil')->length(1);
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
        Schema::dropIfExists('ppia_screening');
    }
}
