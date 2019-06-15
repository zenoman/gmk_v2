<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_details extends Model
{
    //
    protected $fillable=[
        'id','faktur','tgl','kode_barang','barang','harga','jumlah','total_a','diskon','total','admin'
    ];
}
