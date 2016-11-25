<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Noticiadestaque;
use Zofe\Rapyd\Rapyd;

class NoticiadestaqueController extends Controller
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

        $filter = \DataFilter::source(new Noticiadestaque());
		$filter->add('titulo','Titulo', 'text');
        $filter->add('descricao','Descrição', 'text');
        $filter->submit('Procurar');
        $filter->reset('Resetar');
        $filter->link("noticiadestaque/create","Nova notícia");
        $filter->build();

        $grid = \DataGrid::source($filter)->orderBy('visualizar','desc');
		$grid->attributes(array("class"=>"table table-striped"));
        $grid->add('visualizar','Visualizar', true);
        $grid->add('titulo','Titulo', true);
//        $grid->add('descricao', true);
        $grid->edit('edit', 'Editar','modify|delete');
        $grid->paginate(20);
        $grid->build();
        return  view('noticiadestaque.index', compact('filter', 'grid', 'page_title', 'page_description'));    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$page_title ="Not&#237;cias";
		$page_description = "Nova not&#237;cia";

        $form = \DataForm::source(New Noticiadestaque());

        $form->add('visualizar','Visualizar','datetime')->rule('required');
        $form->add('ativo','Ativar', 'checkbox');
		$form->add('orientacao','Orientação','radiogroup')
				->option('0','Retrato')
				->option('1','Paisagem')->rule('required');
		$form->add('titulo','Titulo', 'text')->rule('max:32');
		$form->add('descricao','Descricao', 'text')->rule('max:128');
        $form->add('banner','Foto em destaque', 'image')->rule('mimes:jpeg,jpg,png,gif|required|max:10000')->move('upload/noticiadestaque/banner/')->preview(120,80);
		$form->add('texto','Texto', 'textarea')->attr('id','texto');
/*        $form->add('foto1','Foto 1', 'image')->move('uploads/noticias/')->fit(240, 160)->preview(120,80);
*/
		$form->submit('Save');

        $form->saved(function () use ($form) {
            $form->link("/noticiadestaque/create","Nova notícia");
			return \Redirect::to('noticiadestaque/index')->with("message","Noticía atualizada com sucesso!");
        });
		$form->build();
        Rapyd::js('summernote/summernote.min.js');
        Rapyd::js('summernote/lang/summernote-pt-BR.js');
        Rapyd::css('summernote/summernote.css');
		Rapyd::css('summernote\plugin\databasic\summernote-ext-databasic.css');
		Rapyd::js('summernote\plugin\databasic\summernote-ext-databasic.js');
		Rapyd::js('summernote\plugin\hello\summernote-ext-hello.js');
		Rapyd::js('summernote\plugin\specialchars\summernote-ext-specialchars.js');
		Rapyd::script("$('#texto').summernote({
            height: ($(window).height() - 300),
			lang: 'pt-BR',
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage(image[0]);
                }
            }
        });

        function uploadImage(image) {
            var data = new FormData();
            data.append('image', image);
            $.ajax({
                url: '/imageupload',
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: 'post',
                success: function(url) {
                    var image = $('<img>').attr('src', 'http://' + url);
                    $('#texto').summernote('insertNode', image[0]);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        };");
		return $form->view('noticiadestaque.create', compact('form', 'page_title', 'page_description'));
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

        $edit = \DataEdit::source(New Noticiadestaque());
		$edit->link("/noticiadestaque/index","Voltar", "BL")->back('');
        $edit->add('visualizar','Visualizar','datetime')->rule('required');
        $edit->add('ativo','Ativar', 'checkbox');
		$edit->add('orientacao','Orientação','radiogroup')
				->option('0','Retrato')
				->option('1','Paisagem')->rule('required');
		$edit->add('titulo','Titulo', 'text')->rule('max:32');
		$edit->add('descricao','Descricao', 'text')->rule('max:128');
        $edit->add('banner','Foto em destaque', 'image')->rule('mimes:jpeg,jpg,png,gif|required|max:10000')->move('upload/noticiadestaque/banner/')->preview(120,80);
		$edit->add('texto','Texto', 'textarea')->attr('id','texto');


        $edit->saved(function () use ($edit) {
			$message = \Input::get('texto','<p></p>'); // Summernote input field
			return \Redirect::to('noticiadestaque/index')->with("message","Noticía atualizada com sucesso!");
        });
		$edit->build();
        Rapyd::js('summernote/summernote.min.js');
        Rapyd::js('summernote/lang/summernote-pt-BR.js');
        Rapyd::css('summernote/summernote.css');
		Rapyd::css('summernote\plugin\databasic\summernote-ext-databasic.css');
		Rapyd::js('summernote\plugin\databasic\summernote-ext-databasic.js');
		Rapyd::js('summernote\plugin\hello\summernote-ext-hello.js');
		Rapyd::js('summernote\plugin\specialchars\summernote-ext-specialchars.js');
		Rapyd::script("$('#texto').summernote({
            height: ($(window).height() - 300),
			lang: 'pt-BR',
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage(image[0]);
                }
            }
        });

        function uploadImage(image) {
            var data = new FormData();
            data.append('image', image);
            $.ajax({
                url: '/imageupload',
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: 'post',
                success: function(url) {
                    var image = $('<img>').attr('src', 'http://' + url);
                    $('#texto').summernote('insertNode', image[0]);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        };");
		return $edit->view('noticiadestaque.edit', compact('edit', 'page_title', 'page_description'));
	}
}
