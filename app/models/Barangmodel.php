<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Barangmodel extends Model
{
	public $timestamps = false;
    protected $table = 'tb_kodes';
    protected $guarded = ['id'];
}
