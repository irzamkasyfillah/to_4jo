<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban', function (Blueprint $table) {
            $table->id();
            $table->integer('id_soal');
            $table->string('jawaban_benar')->nullable();
            $table->string('jawaban_salah_1')->nullable();
            $table->string('jawaban_salah_2')->nullable();
            $table->string('jawaban_salah_3')->nullable();
            $table->string('jawaban_salah_4')->nullable();
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
        Schema::dropIfExists('jawaban');
    }
}
