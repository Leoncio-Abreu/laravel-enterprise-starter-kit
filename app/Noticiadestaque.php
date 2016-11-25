<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticiadestaque extends Model
{
	protected $table = 'noticiasdestaque';
	protected $fillable = ['visualizar', 'orientacao', 'ativo', 'titulo', 'descricao', 'banner', 'texto'];
	protected $dates = ['deleted_at', 'created_at', 'updated_at'];

}
