<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostNatalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_natal', function (Blueprint $table) {
            $table->id();
            $table->integer('k1_id');
            $table->date('tgl')->nullable();
            $table->string('hari_ke')->nullable();
            $table->integer('td')->nullable();
            $table->integer('suhu')->nullable();
            $table->integer('catat_buku_kia')->length(1)->nullable();
            $table->integer('fe')->nullable();
            $table->integer('vit_a')->length(1)->nullable();
            $table->integer('cd4')->nullable();
            $table->string('anti_malaria')->nullable();
            $table->string('anti_tb')->nullable();
            $table->string('arv')->nullable();
            $table->integer('komplikasi')->length(1)->nullable();
            $table->text('klasifikasi')->nullable();
            $table->text('tata_laksana')->nullable();
            $table->integer('dirujuk_ke')->length(1)->nullable();
            $table->string('tiba')->nullable();
            $table->string('pulang')->nullable();
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
        Schema::dropIfExists('post_natal');
    }
}
