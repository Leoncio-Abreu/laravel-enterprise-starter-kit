<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
	protected $table = 'atividades';
	protected $fillable = ['visualisar','ativo','titulo','descricao','texto','banner'];
	protected $dates = ['deleted_at', 'created_at', 'updated_at', 'visualisar'];

	public function setTextAttribute( $value )
	{
		$message=$request->input($value);

        $dom = new DomDocument();
        $dom->loadHtml( mb_convert_encoding($message, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images = $dom->getElementsByTagName('img');
       // foreach <img> in the submited message
        foreach($images as $img){
            $src = $img->getAttribute('src');
            
            // if the img source is 'data-url'
            if(preg_match('/data:image/', $src)){                
                // get the mimetype
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];                
                // Generating a random filename
                $filename = uniqid();
                $filepath = "/upload/atividades/imageUpload/$filename.$mimetype";    
                // @see http://image.intervention.io/api/
                $image = Image::make($src)
                  // resize if required
                  /* ->resize(300, 200) */
                  ->encode($mimetype, 100)  // encode file to the specified mimetype
                  ->save(public_path($filepath));                
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            } // <!--endif
        } // <!-
        $this->attributes['text'] = $dom->saveHTML();	
	}

}
