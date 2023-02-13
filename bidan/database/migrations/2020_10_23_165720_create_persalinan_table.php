<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersalinanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persalinan', function (Blueprint $table) {
            $table->id();
            $table->integer('k1_id');
            $table->integer('rencana_konsultasi_lanjut')->length(1);
            $table->integer('rekomendasi')->length(1);
            $table->integer('rencana_persalinan')->length(1);
            $table->integer('rencana_kontrasepsi')->length(1);
            $table->integer('usia_kehamilan');
            $table->integer('usia_hpht');
            $table->integer('keadaan_ibu')->length(1);;
            $table->integer('keadaan_bayi')->length(1);;
            $table->integer('berat_bayi');
            $table->integer('jenis_kelamin')->length(1);;
            $table->integer('panjang_bayi');
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
        Schema::dropIfExists('persalinan');
    }
}
