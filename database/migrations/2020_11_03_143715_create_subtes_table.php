<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSubtesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subtes', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kategori');
            $table->bigInteger('durasi')->nullable();
            $table->timestamps();
        });

        DB::table('subtes')->insert([
            ['nama' => 'PENALARAN UMUM',
            'kategori' => 'TPS'],
            ['nama' => 'PEMAHAMAN BACAAN DAN MENULIS',
            'kategori' => 'TPS'],
            ['nama' => 'PENGETAHUAN DAN PEMAHAMAN UMUM',
            'kategori' => 'TPS'],
            ['nama' => 'PENGETAHUAN KUANTITATIF',
            'kategori' => 'TPS'],
            ['nama' => 'BAHASA INGGRIS',
            'kategori' => 'TPS'],
            ['nama' => 'MATEMATIKA SAINTEK',
            'kategori' => 'SAINTEK'],
            ['nama' => 'FISIKA',
            'kategori' => 'SAINTEK'],
            ['nama' => 'KIMIA',
            'kategori' => 'SAINTEK'],
            ['nama' => 'BIOLOGI',
            'kategori' => 'SAINTEK'],
            ['nama' => 'MATEMATIKA SOSHUM',
            'kategori' => 'SOSHUM'],
            ['nama' => 'EKONOMI',
            'kategori' => 'SOSHUM'],
            ['nama' => 'GEOGRAFI',
            'kategori' => 'SOSHUM'],
            ['nama' => 'SOSIOLOGI DAN SEJARAH',
            'kategori' => 'SOSHUM'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subtes');
    }
}
