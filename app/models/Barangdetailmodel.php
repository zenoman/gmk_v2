<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Barangdetailmodel extends Model
{
    public $timestamps = false;
    protected $table = 'tb_barangs';
    protected $guarded = ['idbarang'];
}
