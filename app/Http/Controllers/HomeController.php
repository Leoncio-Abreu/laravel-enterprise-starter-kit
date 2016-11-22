<?php namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Redirect;
use Setting;

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
 //dd(Carbon::today()->toDateString()));
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
		
		$page_title = trans('general.text.welcome');
        $page_description = "This is the welcome page";

        return view('welcome', compact('noticias', 'atividades'));
    }

    public function viewatividade($id, $flag = null)
    {
		if ( preg_match('/\d/', $id) === 1  ){

		$dnow = \DB::table('atividades')
				->where('id', '=', $id)
				->value('visualizar');

		$prevPages = \DB::table('atividades')
                    ->orderBy('visualizar','desc')
                    ->where('visualizar', '>', $dnow)
                    ->where('ativo', '=', '1')
                    ->count();

		$nextPages = \DB::table('atividades')
                    ->orderBy('visualizar','desc')
                    ->where('visualizar', '<', $dnow)
                    ->where('ativo', '=', '1')
                    ->count();


		if ( ($flag == 'next') & ($nextPages > 0) ) {
			$prevPages += 1;
			$atividade = \DB::table('atividades')
                    ->orderBy('visualizar','desc')
                    ->where('visualizar', '<', $dnow)
                    ->where('ativo', '=', '1')
					->first();
		}
		else if ( ($flag == 'prev') & ($prevPages > 0) ) {
			$prevPages -= 1;
			$atividade = \DB::table('atividades')
                    ->orderBy('visualizar','desc')
                    ->where('visualizar', '>', $dnow)
                    ->where('ativo', '=', '1')
					->first();
		}
		else {
			$atividade = \DB::table('atividades')
				->where('id', '=', $id)
				->first();
		}

        return view('atividades', compact('atividade', 'prevPages', 'nextPages'));
		}
    }

    public function viewnoticia($id, $flag = null)
    {
		if ( preg_match('/\d/', $id) === 1  ){

		$dnow = \DB::table('noticias')
				->where('id', '=', $id)
				->value('visualizar');

		$prevPages = \DB::table('noticias')
                    ->orderBy('visualizar','desc')
                    ->where('visualizar', '>', $dnow)
                    ->where('ativo', '=', '1')
                    ->count();

		$nextPages = \DB::table('noticias')
                    ->orderBy('visualizar','desc')
                    ->where('visualizar', '<', $dnow)
                    ->where('ativo', '=', '1')
                    ->count();


		if ( ($flag == 'next') & ($nextPages > 0) ) {
			$prevPages += 1;
			$noticia = \DB::table('noticias')
                    ->orderBy('visualizar','desc')
                    ->where('visualizar', '<', $dnow)
                    ->where('ativo', '=', '1')
					->first();
		}
		else if ( ($flag == 'prev') & ($prevPages > 0) ) {
			$prevPages -= 1;
			$noticia = \DB::table('noticias')
                    ->orderBy('visualizar','desc')
                    ->where('visualizar', '>', $dnow)
                    ->where('ativo', '=', '1')
					->first();
		}
		else {
			$noticia = \DB::table('noticias')
				->where('id', '=', $id)
				->first();
		}

        return view('noticias', compact('noticia', 'prevPages', 'nextPages'));
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

}
