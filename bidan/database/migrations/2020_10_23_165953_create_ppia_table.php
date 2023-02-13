<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePpiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppia', function (Blueprint $table) {
            $table->id();
            $table->integer('k1_id');
            $table->date('hiv_tgl_pdp')->nullable();
            $table->date('hiv_tgl_arv')->nullable();
            $table->integer('sifilis')->length(1)->nullable();
            $table->integer('sifilis_diobati')->length(1)->nullable();
            $table->integer('hep_b')->length(1)->nul290887lable();
            $table->integer('pasangan_tahu')->length(1)->nullable();
            $table->integer('pasangan_diperiksa_sifilis')->length(1)->nullable();
            $table->string('faskes_rujukan')->nullable();
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
        Schema::dropIfExists('ppia');
    }
}
