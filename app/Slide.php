<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
protected $table = 'slide';
protected $fillable = ['banner','ativo','visualisar'];
protected $dates = ['deleted_at', 'created_at', 'updated_at', 'visualisar'];

}
