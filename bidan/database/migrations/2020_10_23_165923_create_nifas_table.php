<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNifasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nifas', function (Blueprint $table) {
            $table->id();
            $table->integer('k1_id');
            $table->string('hari_ke');
            $table->integer('td');
            $table->integer('suhu');
            $table->integer('catat_buku_kia')->length(1);
            $table->integer('fe');
            $table->integer('vit_a')->length(1);
            $table->integer('cd4');
            $table->string('anti_malaria');
            $table->string('anti_tb');
            $table->string('arv');
            $table->string('ppp');
            $table->string('infeksi');
            $table->string('hdk');
            $table->string('lainnya');
            $table->text('klasifikasi')->nullable();
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
        Schema::dropIfExists('nifas');
    }
}
