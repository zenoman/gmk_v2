<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Transaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_transaksis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('faktur');            
            $table->string('tgl');
            $table->string('total_a');            
            $table->string('diskon');            
            $table->string('total');            
            $table->string('admin');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_transaksis');
    }
}
