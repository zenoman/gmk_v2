<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Usermodel extends Model
{
	public $timestamps = false;
    protected $table = 'tb_users';
    protected $guarded = ['id'];
}
