<?php namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Redirect;
use Setting;
use App\Atividade;
use App\Noticia;
use App\Slide;
class HomeController extends Controller
{
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
		$noticias = \DB::table('noticias')
                    ->orderBy('visualizar','desc')
                    ->where('visualizar', '<', \DB::raw('CURRENT_TIMESTAMP'))
                    ->where('ativo', '=', '1')
					->skip(0)
					->take(10)
                    ->get();
 		$atividades = \DB::table('atividades')
                    ->orderBy('visualizar','desc')
                    ->where('visualizar', '<', \DB::raw('CURRENT_TIMESTAMP'))
                    ->where('ativo', '=', '1')
					->skip(0)
					->take(10)
                    ->get();
 		$slides = \DB::table('slides')
		    ->orderBy('visualizar','desc')
                    ->where('visualizar', '<', \DB::raw('CURRENT_TIMESTAMP'))
                    ->where('ativo', '=', '1')
                    ->get();

        return view('welcome', compact('noticias', 'atividades', 'slides'));
    }

    public function viewatividade($id)
    {
		if ( preg_match('/\d/', $id) === 1  ){

			$dnow = Noticia::where('id', '=', $id)
					->value('visualizar');

			$prevPages = Noticia::orderBy('visualizar','desc')
						->where('visualizar', '>', $dnow)
						->where('ativo', '=', '1')
						->first();
			
			$nextPages = Noticia::orderBy('visualizar','desc')
						->where('visualizar', '<', $dnow)
						->where('ativo', '=', '1')
						->first();

			$atividade = Atividade::where('id', '=', $id)->first();
				
			if (count($atividade)) {
				return view('atividades', compact('atividade', 'prevPages', 'nextPages'));
			}
			else {
				return view('blank');
			
			}
		}
	}

    public function viewnoticia($id)
    {
		if ( preg_match('/\d/', $id) === 1  ){

			$dnow = Noticia::where('id', '=', $id)
					->value('visualizar');

			$prevPages = Noticia::orderBy('visualizar','desc')
						->where('visualizar', '>', $dnow)
						->where('ativo', '=', '1')
						->first();
			
			$nextPages = Noticia::orderBy('visualizar','desc')
						->where('visualizar', '<', $dnow)
						->where('ativo', '=', '1')
						->first();

			$noticia = Noticia::where('id', '=', $id)
					->first();
				
			if (count($noticia)) {
				return view('noticias', compact('noticia', 'prevPages', 'nextPages'));
			}
			else {
				return view('blank');
			
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
}
