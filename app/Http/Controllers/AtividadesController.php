<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Atividade;
use Zofe\Rapyd\Rapyd;

class AtividadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Atividades';
        $page_description = 'Pesquisar Atividade';

//        $url = new \Zofe\Rapyd\Url();
        $filter = \DataFilter::source(new Atividade());
        $filter->add('titulo','Titulo', 'text');
        $filter->add('descricao','Descricao', 'text');
        $filter->submit('Procurar');
        $filter->reset('Resetar');
        $filter->link("atividades/create","Nova atividade");
        $filter->build();

        $grid = \DataGrid::source($filter)->orderBy('visualizar','desc');
		$grid->attributes(array("class"=>"table table-striped"));
        $grid->add('visualizar','Visualizar', true);
        $grid->add('titulo','Titulo', true);
        $grid->add('descricao', true);
        $grid->edit('edit', 'Editar','modify|delete');
        $grid->paginate(20);
        $grid->build();
        return  view('atividades.index', compact('filter', 'grid', 'page_title', 'page_description'));    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$page_title ="Atividades";
		$page_description = "Nova atividade";

        $form = \DataForm::source(New Atividade());
		$form->attributes(['id'=>'atividade']);
        $form->add('visualizar','Visualizar','datetime')->rule('required');
        $form->add('ativo','Ativar', 'checkbox');
		$form->add('titulo','Titulo', 'text')->rule('required|max:32');
		$form->add('descricao','Descricao', 'text')->rule('required|max:128');
        $form->add('banner','Foto em destaque', 'image')->move('upload/atividades/banner/')->preview(120,80);
		$form->add('texto','Texto', 'textarea')->attributes(["id"=>"texto"])->rule('required');

		$form->submit('Salvar');

        $form->saved(function () use ($form) {
            $form->message("Atividade salva com sucesso!");
            $form->link("/atividades/create","Nova atividade");
        });
		$form->build();
        Rapyd::js('summernote/summernote.min.js');
        Rapyd::js('summernote/lang/summernote-pt-BR.js');
        Rapyd::css('summernote/summernote.css');
		Rapyd::css('summernote\plugin\databasic\summernote-ext-databasic.css');
		Rapyd::js('summernote\plugin\databasic\summernote-ext-databasic.js');
		Rapyd::js('summernote\plugin\hello\summernote-ext-hello.js');
		Rapyd::js('summernote\plugin\specialchars\summernote-ext-specialchars.js');
		Rapyd::script("
		var IMAGE_PATH = '{{ base_path() }}' + '/upload/atividades/imageUpload/';
						$.ajaxSetup({
							headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content')     }
						});
						$('#texto').summernote({
							height: 400,
							lang: 'pt-BR',
							onImageUpload: function(files) {
								data = new FormData();
								data.append('image', files[0]);
								$.ajax({
									data: data,
									type: 'POST',
									url: '/atividades/imageUpload',
									cache: false,
									contentType: false,
									processData: false,
									success: function(filename) {
										var file_path = IMAGE_PATH + filename;
										console.log(file_path);
										$('#texto').summernote('insertImage', file_path);
									}
								});
							}
						});");
        return $form->view('atividades.create', compact('form', 'page_title', 'page_description'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
		$page_title ="Atividades";
		$page_description = "Alterar atividade";

        $edit = \DataEdit::source(New Atividade());
		$edit->link("atividades/index","Voltar", "BL")->back('');
        $edit->add('visualizar','Visualizar','datetime')->rule('required');
        $edit->add('ativo','Ativar', 'checkbox');
		$edit->add('titulo','Titulo', 'text')->rule('required|max:32');
		$edit->add('descricao','Descricao', 'text')->rule('required|max:128');
        $edit->add('banner','Foto em destaque', 'image')->rule('mimes:jpeg,jpg,png,gif|required|max:10000')->move('upload/atividades/banner/')->preview(120,80);
		$edit->add('texto','Texto', 'textarea')->attributes(["id"=>"texto"])->rule('required');

//		$edit->submit('Save');

        $edit->saved(function () use ($edit) {
			return \Redirect::to('atividades/index')->with("message","Atividade atualizada com sucesso!");
        });
		$edit->build();
        Rapyd::js('summernote/summernote.min.js');
        Rapyd::js('summernote/lang/summernote-pt-BR.js');
        Rapyd::css('summernote/summernote.css');
		Rapyd::css('summernote\plugin\databasic\summernote-ext-databasic.css');
		Rapyd::js('summernote\plugin\databasic\summernote-ext-databasic.js');
		Rapyd::js('summernote\plugin\hello\summernote-ext-hello.js');
		Rapyd::js('summernote\plugin\specialchars\summernote-ext-specialchars.js');
		Rapyd::script("
		var IMAGE_PATH = '{{ base_path() }}' + '/upload/atividades/imageUpload/';
						$.ajaxSetup({
							headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content')     }
						});
						$('#texto').summernote({
							height: 400,
							lang: 'pt-BR',
							onImageUpload: function(files) {
								data = new FormData();
								data.append('image', files[0]);
								$.ajax({
									data: data,
									type: 'POST',
									url: '/atividades/imageUpload',
									cache: false,
									contentType: false,
									processData: false,
									success: function(filename) {
										var file_path = IMAGE_PATH + filename;
										console.log(file_path);
										$('#texto').summernote('insertImage', file_path);
									}
								});
							}
						});");
        return $edit->view('atividades.edit', compact('edit', 'page_title', 'page_description'));
	}

	public function imageUpload(Request $request)
    {
		if($request->hasFile('image')){
			$filename = str_random(20).'_'.$request->file('image')->getClientOriginalName();
//	        $image_path = base_path() . '/public/images/thread/';
		    $request->file('image')->move(public_path()."/upload/atividades/imageUpload/", $fileName);
		    return $filename;    
	    }
		else{
		    return 'Ups! A transferência da imagem falhou.';
	    }

//          $file = \Input::file('file');
//          $fileName = time().'.'.$file->getClientOriginalExtension();
//		  $move = $file->move();
//		  return '<img src="/upload/atividades/imageUpload/'. $fileName.'" />';
    }

	public function fileUpload(Request $request)
    {

          $file = \Input::file('file');
          $fileName = $file->getClientOriginalName();
		  $realfileName = $file->getClientOriginalName();
		  $move = $file->move(public_path()."/upload/atividades/fileUpload/", $fileName);
		  return '<A HREF="'.url().'/upload/atividades/fileUpload/' . $fileName . '">'.$fileName.'</A>';
    }
}
