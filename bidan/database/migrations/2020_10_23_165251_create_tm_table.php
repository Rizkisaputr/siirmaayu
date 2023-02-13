<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tm', function (Blueprint $table) {
            $table->id();
            $table->integer('k1_id');
            $table->integer('ke');
            $table->integer('konjungtiva')->nullable();
            $table->integer('sklera')->nullable();
            $table->integer('kulit')->nullable();
            $table->integer('leher')->nullable();
            $table->integer('gigi_mulut')->nullable();
            $table->integer('tht')->nullable();
            $table->integer('jantung')->nullable();
            $table->integer('paru')->nullable();
            $table->integer('perut')->nullable();
            $table->integer('tungkai')->nullable();
            $table->float('gs')->nullable();
            $table->float('crl')->nullable();
            $table->float('djj')->nullable();
            $table->float('sesuai_usia_kehamilan')->nullable();
            $table->date('taksiran_persalinan')->nullable();
            $table->date('skrining_preeklamsi')->nullable();
            $table->string('kesimpulan')->nullable();
            $table->string('rekomendasi')->default(1)->nullable();
            $table->string('hb')->nullable();
            $table->string('gd_puasa')->nullable();
            $table->string('gd_2jam_pp')->nullable();
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
        Schema::dropIfExists('tm');
    }
}
