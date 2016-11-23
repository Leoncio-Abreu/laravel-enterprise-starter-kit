<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Noticia;
use Zofe\Rapyd\Rapyd;

class NoticiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Not&#237;cias';
        $page_description = 'Pesquisar Not&#237;cias';

//        $url = new \Zofe\Rapyd\Url();
        $filter = \DataFilter::source(new Noticia());
        $filter->add('titulo','Titulo', 'text');
        $filter->add('descricao','Descrição', 'text');
        $filter->submit('Procurar');
        $filter->reset('Resetar');
        $filter->link("noticias/create","Nova notícia");
        $filter->build();

        $grid = \DataGrid::source($filter)->orderBy('visualizar','desc');
		$grid->attributes(array("class"=>"table table-striped"));
        $grid->add('visualizar','Visualizar', true);
        $grid->add('titulo','Titulo', true);
//        $grid->add('descricao', true);
        $grid->edit('edit', 'Editar','modify|delete');
        $grid->paginate(20);
        $grid->build();
        return  view('noticias.index', compact('filter', 'grid', 'page_title', 'page_description'));    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$page_title ="Not&#237;cias";
		$page_description = "Nova not&#237;cia";

        $form = \DataForm::source(New Noticia());

        $form->add('visualizar','Visualizar','datetime')->rule('required');
        $form->add('ativo','Ativar', 'checkbox');
		$form->add('titulo','Titulo', 'text')->rule('required|max:32');
		$form->add('descricao','Descricao', 'text')->rule('required|max:128');
        $form->add('banner','Foto em destaque', 'image')->rule('mimes:jpeg,jpg,png,gif|required|max:10000')->move('upload/noticias/banner/')->preview(120,80);
		$form->add('texto','Texto', 'textarea')->attr('id','texto')->rule('required');
/*        $form->add('foto1','Foto 1', 'image')->move('uploads/noticias/')->fit(240, 160)->preview(120,80);
*/
		$form->submit('Save');

        $form->saved(function () use ($form) {
            $form->link("/noticias/create","Nova notícia");
			$message = \Input::get('texto','<p></p>'); // Summernote input field
			if ($message)
			$dom = new \DomDocument();
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
					$filepath = "/upload/noticias/imageUpload/$filename.$mimetype";
		
					// @see http://image.intervention.io/api/
					$image = Image::make($src)
					  // resize if required
					  /* ->resize(300, 200) */
					  ->encode($mimetype, 100) 	// encode file to the specified mimetype
					  ->save(public_path($filepath));
					
					$new_src = asset($filepath);
					$img->removeAttribute('src');
					$img->setAttribute('src', $new_src);
				} // <!--endif
			} // <!--endforeach
			dd($form);
			$form->model->texto = $dom->saveHTML();
			$form->model->save();
			return \Redirect::to('noticias/index')->with("message","Noticía atualizada com sucesso!");
        });
		$form->build();
        Rapyd::js('summernote/summernote.min.js');
        Rapyd::js('summernote/lang/summernote-pt-BR.js');
        Rapyd::css('summernote/summernote.css');
		Rapyd::css('summernote\plugin\databasic\summernote-ext-databasic.css');
		Rapyd::js('summernote\plugin\databasic\summernote-ext-databasic.js');
		Rapyd::js('summernote\plugin\hello\summernote-ext-hello.js');
		Rapyd::js('summernote\plugin\specialchars\summernote-ext-specialchars.js');
		Rapyd::script("$('#texto').summernote({ height: 400, lang: 'pt-BR' });");
		return $form->view('noticias.create', compact('form', 'page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
		$page_title ="Not&#237;cias";
		$page_description = "Alterar not&#237;cia";

        $edit = \DataEdit::source(New Noticia());
$edit->link("noticias/index","Voltar", "BL")->back('');
        $edit->add('visualizar','Visualizar','datetime')->rule('required');
        $edit->add('ativo','Ativar', 'checkbox');
		$edit->add('titulo','Titulo', 'text')->rule('required|max:32');
		$edit->add('descricao','Descricao', 'text')->rule('required|max:128');
        $edit->add('banner','Foto em destaque', 'image')->rule('mimes:jpeg,jpg,png,gif|required|max:10000')->move('upload/noticias/banner/')->preview(120,80);
		$edit->add('texto','Texto', 'textarea')->attr('id','texto')->rule('required');


        $edit->saved(function () use ($edit) {
			$message = \Input::get('texto','<p></p>'); // Summernote input field

			$dom = new \DomDocument();
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
					$filepath = "/upload/noticias/imageUpload/$filename.$mimetype";
					// @see http://image.intervention.io/api/
					$image = Image::make($src)
					  // resize if required
					  /* ->resize(300, 200) */
					  ->encode($mimetype, 100) 	// encode file to the specified mimetype
					  ->save(public_path($filepath));
					$new_src = asset($filepath);
					$img->removeAttribute('src');
					$img->setAttribute('src', $new_src);
				} // <!--endif
			} // <!--endforeach
//			dd($edit);
			$edit->model->texto = $dom->saveHTML();
			$edit->model->save();
			return \Redirect::to('noticias/index')->with("message","Noticía atualizada com sucesso!");
        });
		$edit->build();
        Rapyd::js('summernote/summernote.min.js');
        Rapyd::js('summernote/lang/summernote-pt-BR.js');
        Rapyd::css('summernote/summernote.css');
		Rapyd::css('summernote\plugin\databasic\summernote-ext-databasic.css');
		Rapyd::js('summernote\plugin\databasic\summernote-ext-databasic.js');
		Rapyd::js('summernote\plugin\hello\summernote-ext-hello.js');
		Rapyd::js('summernote\plugin\specialchars\summernote-ext-specialchars.js');
		Rapyd::script("$('#texto').summernote({ height: 400, lang: 'pt-BR' });");
		return $edit->view('noticias.edit', compact('edit', 'page_title', 'page_description'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

/*	public function imageUpload(Request $request)
    {

          $file = \Input::file('file');
          $fileName = time().'.jpg';
          //$move = Image::make($file->getRealPath())->fit(300,120)->save('public/uploads/images/topics/'.$fileName);
		  $move = $file->move(public_path()."/upload/noticias/imageUpload/", $fileName);
		  return '<img src="/upload/noticias/imageUpload/'. $fileName.'" />';
    }
*/
	public function imageUpload(Request $request)
    {

          $file = \Input::file('file');
          $fileName = time().'.'.$file->getClientOriginalExtension();
          //$move = Image::make($file->getRealPath())->fit(300,120)->save('public/uploads/images/topics/'.$fileName);
		  $move = $file->move(public_path()."/upload/noticias/imageUpload/", $fileName);
		  return '<img src="/upload/noticias/imageUpload/'. $fileName.'" />';
    }

	public function fileUpload(Request $request)
    {

          $file = \Input::file('file');
          $fileName = $file->getClientOriginalName();
		  $realfileName = $file->getClientOriginalName();
		  $move = $file->move(public_path()."/upload/noticias/fileUpload/", $fileName);
//		  return url().'/upload/noticias/fileUpload/' . $fileName.' '.$fileName.'</A>';
		  return '<A HREF="'.url().'/upload/noticias/fileUpload/' . $fileName . '">'.$fileName.'</A>';
//		  return '<A HREF="http://www.tiexpert.net">TI Expert</A>';
//		  return "/upload/noticias/fileUpload/" . $fileName;
    }
}
