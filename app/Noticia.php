<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
	protected $table = 'noticias';
	protected $fillable = ['file','caption','description', 'posicao'];
	protected $dates = ['deleted_at', 'created_at', 'updated_at'];

}
