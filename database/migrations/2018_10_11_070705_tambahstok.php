<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tambahstok extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tambahstoks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('idbarang');                        
            $table->string('barang');            
            $table->string('jumlah');                        
            $table->string('total');            
            $table->string('tgl');                        
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
        Schema::dropIfExists('tb_tambahstoks');
    }
}
