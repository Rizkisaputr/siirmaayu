<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnteNatalCareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ante_natal_care', function (Blueprint $table) {
            $table->id();
            $table->integer('k1_id');
            $table->date('tgl');
            $table->integer('jkn');
            $table->integer('usia_kehamilan');
            $table->integer('trimester');
            $table->text('keluhan');
            $table->integer('bb');
            $table->integer('td');
            $table->integer('lila');
            $table->char('status_gizi')->length(1);
            $table->integer('tfu');
            $table->char('refleks_patella');
            $table->char('ddj')->length(1);
            $table->char('kepala_pap')->length(1);
            $table->integer('tbj');
            $table->char('presentasi')->length(2);
            $table->integer('jam');
            $table->integer('injeki_td');
            $table->integer('catat_buku_kia');
            $table->integer('fe');
            $table->integer('pmt_bumil_kek');
            $table->integer('ikut_tkelas_ibu');
            $table->text('konseling')->nullable();
            $table->integer('hemoglobin');
            $table->integer('glucosa_urine');
            $table->integer('pmtct_sifilis');
            $table->integer('pmtct_hbsag')->length(1);
            $table->integer('pmtct_hiv');
            $table->integer('pmtct_arv_profilaksis');
            $table->integer('malaria')->length(1);
            $table->integer('malaria_obat');
            $table->integer('malaria_kelambu_berinsektisida')->length(1);
            $table->integer('tbc_skrinng_anamnesis')->length(1);
            $table->integer('tbc_dahak')->length(1);
            $table->integer('tbc')->length(1);
            $table->integer('tbc_obat');
            $table->integer('covid19_sehat');
            $table->integer('covid19_kontak_erat');
            $table->integer('covid19_suspek');
            $table->integer('covid19_terkonfirmasi');
            $table->integer('komplikasi')->length(1);
            $table->text('tata_laksana_awal')->nullable();
            $table->integer('dirujuk_ke')->length(1)->nullable();
            $table->string('tiba')->nullable();
            $table->string('pulang')->nullable();
            $table->text('keterangan')->nullable();

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
        Schema::dropIfExists('ante_natal_care');
    }
}
