<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
	public $timestamps = false;
    protected $fillable = [
       'name',
       'birthday',
       'position',
   ];
}
