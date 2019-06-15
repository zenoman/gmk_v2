<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Kategorimodel extends Model
{
	public $timestamps = false;
    protected $table = "tb_kategoris";
    protected $guarded = ['id'];
}
