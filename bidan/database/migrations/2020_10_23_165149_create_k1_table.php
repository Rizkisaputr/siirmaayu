<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateK1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k1', function (Blueprint $table) {
            $table->id();
            $table->integer('ibu_id');
            $table->integer('bidan_id');
            $table->integer('gravida')->nullable();
            $table->integer('partus')->nullable();
            $table->integer('abortus')->nullable();
            $table->integer('hidup')->nullable();
            $table->date('tgl_periksa')->nullable();
            $table->date('tgl_hpht')->nullable();
            $table->date('taksiran_persalinan')->nullable();
            $table->date('persalinan_sebelum')->nullable();
            $table->string('bb_sebelum_hamil')->nullable();
            $table->string('bb_sekarang')->nullable();
            $table->string('tinggi')->nullable();
            $table->string('lila')->nullable();
            $table->integer('gizi')->length(1)->nullable();
            $table->integer('buku_kia')->length(1)->nullable();
            $table->integer('gol_darah')->length(1)->nullable();
            $table->integer('rhesus')->length(1)->nullable();
            $table->string('komplikasi_kebidanan')->nullable();
            $table->string('riwayat_persalinan')->nullable();
            $table->string('riwayat_penyakit_kronis_alergi')->nullable();
            $table->string('riwayat_penyakit_menular')->nullable();
            $table->string('penyakit_menular_lainnya')->nullable();
            $table->string('riwayat_kb')->nullable();
            $table->date('tgl_rencana')->nullable();
            $table->integer('penolong')->nullable();
            $table->integer('tempat')->nullable();
            $table->integer('pendamping')->nullable();
            $table->integer('transportasi')->nullable();
            $table->integer('pendonor_darah')->nullable();
            $table->integer('pendonor_gol_darah')->nullable();
            $table->text('catatan_khusus')->nullable();
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
        Schema::dropIfExists('k1');
    }
}
