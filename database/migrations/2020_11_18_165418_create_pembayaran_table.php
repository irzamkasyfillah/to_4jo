<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('teks');
            $table->timestamps();
        });

        DB::table('pembayaran')->insert(
            ['teks' => '1. Silakan transfer ke .....<br>2. Konfirmasi pembayaran dengan cara mengirimkan bukti transfer ke admin (WA 08xxx)
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
        Schema::dropIfExists('pembayaran');
    }
}
