<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontrasepsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontrasepsi', function (Blueprint $table) {
            $table->id();
            $table->integer('k1_id');
            $table->integer('kode');
            $table->date('tgl')->nullable();
            $table->string('rencana')->nullable();
            $table->string('pelaksanaan')->nullable();
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
        Schema::dropIfExists('kontrasepsi');
    }
}
