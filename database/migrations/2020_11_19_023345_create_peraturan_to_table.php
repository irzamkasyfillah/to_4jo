<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePeraturanToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peraturan_to', function (Blueprint $table) {
            $table->id();
            $table->text('teks');
            $table->timestamps();
        });

        DB::table('peraturan_to')->insert(
            ['teks' => '1. Peserta try out hanya dapat mengerjakan paling banyak satu kategori soal bersamaan<br>2. Peserta diharapkan mengerjakan try out dengan jujur
            <br>3. ...']
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peraturan_to');
    }
}
