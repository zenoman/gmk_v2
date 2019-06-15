<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Detail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('faktur');                        
            $table->string('kode_pesan');            
            $table->string('kode_barang');                        
            $table->string('barang');                        
            $table->string('harga');            
            $table->string('jumlah');                        
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
        Schema::dropIfExists('tb_details');
    }
}
