<?php namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Redirect;
use Setting;
use App\Atividade;
use App\Noticia;
use App\Slide;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Input;

class HomeController extends Controller
{
	public function __construct() {
        // this function will run before every action in the controller
        $this->beforeFilter(function()
        {
 		$slides = Slide::orderBy('visualizar','desc')
                    ->where('visualizar', '<', \DB::raw('CURRENT_TIMESTAMP'))
                    ->where('ativo', '=', '1')
                    ->get();
		view::share('slides',$slides);
        });
    }
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $homeRouteName = 'welcome';

        try {
            $homeCandidateName = Setting::get('app.home_route');
            $homeRouteName = $homeCandidateName;
        }
        catch (Exception $ex) { } // Eat the exception will default to the welcome route.

        $request->session()->reflash();
        return Redirect::route($homeRouteName);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome()
    {
		$noticia0 = Noticia::orderBy('visualizar','desc')
                    ->where('visualizar', '<', \DB::raw('CURRENT_TIMESTAMP'))
                    ->where('posicao', '=', '1')
                    ->where('ativo', '=', '1')
                    ->first();
		$noticia1 = Noticia::orderBy('visualizar','desc')
                    ->where('visualizar', '<', \DB::raw('CURRENT_TIMESTAMP'))
                    ->where('ativo', '=', '1')
					->skip(0)
					->take(10)
                    ->get();
 		$atividade = Atividade::orderBy('visualizar','desc')
                    ->where('visualizar', '<', \DB::raw('CURRENT_TIMESTAMP'))
                    ->where('ativo', '=', '1')
					->skip(0)
					->take(10)
                    ->get();
		return view('welcome',compact('noticia0', 'noticia1', 'atividade'));
    }

	public function viewatividade($id)
    {
		if ( preg_match('/\d/', $id) === 1  ){

			$dnow = Atividade::where('id', '=', $id)
					->value('visualizar');
			If (!is_null($dnow)){
				$prevPages = Atividade::orderBy('visualizar','desc')
						->where('visualizar', '>', $dnow)
						->where('ativo', '=', '1')
						->first();
			If (is_null($prevPages)){ $prevPages = null;}		
				$nextPages = Atividade::orderBy('visualizar','desc')
						->where('visualizar', '<', $dnow)
						->where('ativo', '=', '1')
						->first();
			If (is_null($nextPages)){ $nextPages = null;}		
	
				$atividade = Atividade::where('id', '=', $id)->first();
			}
			else{
				$prevPages = null;
				$nextPages = null;
				$atividade = null;
				return view('welcome', compact('atividade', 'prevPages', 'nextPages'));
			}
			if (!is_null($atividade)) {
				return view('atividade', compact('atividade', 'prevPages', 'nextPages'));
			}
			else {
				return view('welcome', compact('atividade', 'prevPages', 'nextPages'));
			
			}
		}
	}

    public function viewnoticia($id)
    {
		if ( preg_match('/\d/', $id) === 1  ){

			$dnow = Noticia::where('id', '=', $id)
					->value('visualizar');
			If (!is_null($dnow)){
				$prevPages = Noticia::orderBy('visualizar','desc')
						->where('visualizar', '>', $dnow)
						->where('ativo', '=', '1')
						->first();
			If (is_null($prevPages)){ $prevPages = [];}		
				$nextPages = Noticia::orderBy('visualizar','desc')
						->where('visualizar', '<', $dnow)
						->where('ativo', '=', '1')
						->first();
			If (is_null($nextPages)){ $nextPages = [];}		
	
				$noticia = Noticia::where('id', '=', $id)->first();
			}
			else{
				$prevPages = null;
				$nextPages = null;
				$noticia = null;
				return view('welcome', compact('noticia', 'prevPages', 'nextPages'));
			}
			if (!is_null($noticia)) {
				return view('noticia', compact('noticia', 'prevPages', 'nextPages'));
			}
			else {
				return view('welcome', compact('noticia', 'prevPages', 'nextPages'));
			
			}
		}
	}

	public function unidades()
    {
        $page_title = trans('general.text.welcome');
        $page_description = "This is the welcome page";

        return view('unidades', compact('page_title', 'page_description'));
    }

    public function historia()
    {
        $page_title = trans('general.text.welcome');
        $page_description = "This is the welcome page";

        return view('historia', compact('page_title', 'page_description'));
    }

    public function contato()
    {
        $page_title = trans('general.text.welcome');
        $page_description = "This is the welcome page";

        return view('contato', compact('page_title', 'page_description'));
    }

    public function painel()
    {
        $page_title = "Bem vindo";
        $page_description = "";

        return view('blank', compact('page_title', 'page_description'));
    }
	
	public function imageupload()
	{
		if(\Request::ajax())
		{
			$file = \Input::file('image');
			if (!is_null($file))
			{
				$fileName = time().'.'.$file->getClientOriginalExtension();
			  //$move = Image::make($file->getRealPath())->fit(300,120)->save('public/uploads/images/topics/'.$fileName);
				$move = $file->move(public_path()."/upload/imageUpload/", $fileName);
				return \Response::json(\Request::server('HTTP_HOST').'/upload/imageUpload/'. $fileName);
			}
		}
	}
}
