<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIbuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibu', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_register');
            $table->string('no_registrasi');
            $table->integer('kader_id');
            $table->integer('posyandu_id');
            $table->integer('puskesmas_id');
            $table->string('nama_ibu');
            $table->string('nama_suami');
            $table->date('tgl_lahir');
            $table->string('nik');
            $table->string('nkk')->nullable();
            $table->string('umur')->nullable();
            $table->string('telp')->nullable();
            $table->text('alamat')->nullable();
            $table->string('rt')->length(3)->nullable();
            $table->string('rw')->length(3)->nullable();
            $table->integer('desa_id')->nullable();
            $table->integer('kecamatan_id')->nullable();
            $table->integer('kabupaten_id')->nullable();
            $table->integer('provinsi_id')->nullable();
            $table->integer('pendidikan_id')->nullable();
            $table->integer('pekerjaan_id')->nullable();
            $table->integer('agama')->nullable();
            $table->integer('pembiayaan')->nullable();
            $table->string('disabilitas')->nullable();
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
        Schema::dropIfExists('ibu');
    }
}
