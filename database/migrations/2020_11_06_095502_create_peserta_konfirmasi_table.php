<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaKonfirmasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_konfirmasi', function (Blueprint $table) {
            $table->id();
            $table->string('id_peserta');
            $table->string('id_tryout');
            $table->string('harga');
            $table->string('status');
            $table->string('kelompok_ujian');
            $table->string('kode_unik')->unique()->nullable();
            $table->text('subtes_done')->nullable();
            $table->dateTime('waktu_mulai')->nullable();
            $table->dateTime('waktu_selesai')->nullable();
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
        Schema::dropIfExists('peserta_konfirmasi');
    }
}
