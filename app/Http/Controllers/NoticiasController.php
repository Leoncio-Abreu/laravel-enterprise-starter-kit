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
        $grid->add('descricao', true);
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
		$form->add('texto','Texto', 'textarea')->attr('class','redactor')->rule('required');
/*        $form->add('foto1','Foto 1', 'image')->move('uploads/noticias/')->fit(240, 160)->preview(120,80);
*/
		$form->submit('Save');

        $form->saved(function () use ($form) {
            $form->message("Noticía salva com sucesso!");
            $form->link("/noticias/create","Nova notícia");
        });
		$form->build();
        Rapyd::js('redactor/jquery.browser.min.js');
        Rapyd::js('redactor/redactor.min.js');
        Rapyd::css('redactor/css/redactor.css');
        Rapyd::script('$("#texto").redactor({imageUpload: "/noticias/imageUpload", fileUpload: "/noticias/fileUpload", lang: "pt_br", focus: "false", overlay: "false"} );');
        Rapyd::script("$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')} });");

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
		$edit->add('texto','Texto', 'textarea')->attr('class','redactor')->rule('required');
//		$edit->submit('Save');

        $edit->saved(function () use ($edit) {
			return \Redirect::to('noticias/index')->with("message","Noticía atualizada com sucesso!");
        });
		$edit->build();
//		if $form->hasRedirect()
        Rapyd::js('redactor/jquery.browser.min.js');
        Rapyd::js('redactor/redactor.min.js');
        Rapyd::css('redactor/css/redactor.css');
        Rapyd::script('$("#texto").redactor({imageUpload: "/noticias/imageUpload", fileUpload: "/noticias/fileUpload", lang: "pt_br", focus: "false", overlay: "false"} );');
        Rapyd::script("$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')} });");
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
