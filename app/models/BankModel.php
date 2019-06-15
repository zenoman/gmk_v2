<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class BankModel extends Model
{
   	public $timestamps = false;
    protected $table = 'tb_bank';
    protected $guarded = ['id'];
}
