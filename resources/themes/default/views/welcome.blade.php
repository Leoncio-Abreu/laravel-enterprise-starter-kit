@extends('layouts.frontend_master')
@section('content')
	<div class="row">
		<div class="col-md-5">
			<div class="box">
				<div class="panel panel-default">
					<div class="panel-heading text-center"><img class="img-rounded text-center img-responsive" alt="Bootstrap Image Preview" src="/upload/noticias/banner/@if (!is_null($noticias)){!! $noticias{0}->banner !!}@endif"></div>
                    <div class="panel-body">
						<p>@if (!is_null($noticias)){!! $noticias{0}->descricao !!}@endif</p>
                        <div class="bootstrap-eh-pull-bottom clearfix">
							<a class="btn btn-warning pull-right" href="/view/noticia/@if (!is_null($noticias)){!! $noticias{0}->id !!}@endif" role="button">+ mais »</a>
                        </div>
					</div>
				</div>
            </div>
        </div>
        <div class="col-md-7">
			<div class="box">
				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-default">
                        <div class="panel-heading"><h2 class="panel-title">@if (!is_null($noticias)){!! $noticias{1}->titulo !!}@endif</h2></div>
                        <div class="panel-body">
                          <p>@if (!is_null($noticias)){!! $noticias{1}->descricao !!}@endif</p>
                        <div class="bootstrap-eh-pull-bottom clearfix">
                          <a class="btn btn-warning pull-right" href="/view/noticia/@if (!is_null($noticias)){!! $noticias{1}->id !!}@endif" role="button">+ mais »</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                      <div class="panel panel-default">
                        <div class="panel-heading"><h2 class="panel-title">@if (!is_null($noticias)){!! $noticias{2}->titulo !!}@endif</h2></div>
                        <div class="panel-body">
                          <p>@if (!is_null($noticias)){!! $noticias{2}->descricao !!}@endif</p>
                        <div class="bootstrap-eh-pull-bottom clearfix">
                          <a class="btn btn-warning pull-right" href="/view/noticia/@if (count($noticias)){!! $noticias{2}->id !!}@endif" role="button">+ mais »</a>
                        </div>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-6">
                      <div class="panel panel-default">
                        <div class="panel-heading"><h2 class="panel-title">@if (count($noticias)){!! $noticias{3}->titulo !!}@endif</h2></div>
                        <div class="panel-body">
                          <p>@if (count($noticias)){!! $noticias{3}->descricao !!}@endif</p>
                        <div class="bootstrap-eh-pull-bottom clearfix">
                          <a class="btn btn-warning pull-right" href="/view/noticia/@if (count($noticias)){!! $noticias{3}->id !!}@endif" role="button">+ mais »</a>
                        </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                      <div class="panel panel-default">
                        <div class="panel-heading"><h2 class="panel-title">@if (count($noticias)){!! $noticias{4}->titulo !!}@endif</h2></div>
                        <div class="panel-body">
    		              <p>@if (count($noticias)){!! $noticias{4}->descricao !!}@endif<br></p>
                        <div class="bootstrap-eh-pull-bottom clearfix">
                          <a class="btn btn-warning pull-right" href="/view/noticia/@if (count($noticias)){!! $noticias{4}->id !!}@endif" role="button">+ mais »</a>
                        </div>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-6">
                      <div class="panel panel-default">
                        <div class="panel-heading"><h2 class="panel-title">@if (count($noticias)){!! $noticias{5}->titulo !!}@endif</h2></div>
                        <div class="panel-body">
                          <p>@if (count($noticias)){!! $noticias{5}->descricao !!}@endif<br><br></p>
                        <div class="bootstrap-eh-pull-bottom clearfix">
                          <a class="btn btn-warning pull-right" href="/view/noticia/@if (count($noticias)){!! $noticias{5}->id !!}@endif" role="button">+ mais »</a>
                        </div>
                        </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="panel panel-default">
                        <div class="panel-heading"><h2 class="panel-title">@if (count($noticias)){!! $noticias{6}->titulo !!}@endif</h2></div>
                        <div class="panel-body">
            		      <p>@if (count($noticias)){!! $noticias{6}->descricao !!}@endif<br><br></p>
                        <div class="bootstrap-eh-pull-bottom clearfix">
                          <a class="btn btn-warning pull-right" href="/view/noticia/@if (count($noticias)){!! $noticias{6}->id !!}@endif" role="button">+ mais »</a>
                        </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
          </div>
      </div>
      <div class="row" style="padding-top:15px;">
          <div class="col-md-3">
                  <a href="/view/atividade/@if (count($atividades)){!! $atividades{0}->id !!}@endif"><div class="panel panel-default">
                    <div class="panel-heading text-center"><img alt="Bootstrap Image Preview" src="/upload/atividades/banner/@if (count($atividades)){!! $atividades{0}->banner !!}@endif" class="img-rounded text-center img-responsive"></div>
                    <div class="panel-body">
                      <p>@if (count($atividades)){!! $atividades{0}->descricao !!}@endif</p>
                    </div>
                  </div></a>
          </div>
          <div class="col-md-3">
                  <a href="/view/atividade/@if (count($atividades)){!! $atividades{1}->id !!}@endif"><div class="panel panel-default">
                    <div class="panel-heading text-center"><img alt="Bootstrap Image Preview" src="/upload/atividades/banner/@if (count($atividades)){!! $atividades{1}->banner !!}@endif" class="img-rounded text-center img-responsive"></div>
                    <div class="panel-body">
                      <p>@if (count($atividades)){!! $atividades{1}->descricao !!}@endif</p>
                    </div>
                  </div></a>
          </div>
          <div class="col-md-3">
                  <a href="/view/atividade/@if (count($atividades)){!! $atividades{2}->id !!}@endif"><div class="panel panel-default">
                    <div class="panel-heading text-center"><img alt="Bootstrap Image Preview" src="/upload/atividades/banner/@if (count($atividades)){!! $atividades{2}->banner !!}@endif" class="img-rounded text-center img-responsive"></div>
                    <div class="panel-body">
                      <p>@if (count($atividades)){!! $atividades{2}->descricao !!}@endif</p>
                    </div>
                  </div></a>
          </div>
          <div class="col-md-3">
                  <a href="/view/atividade/@if (count($atividades)){!! $atividades{3}->id !!}@endif"><div class="panel panel-default">
                    <div class="panel-heading text-center"><img alt="Bootstrap Image Preview" src="/upload/atividades/banner/@if (count($atividades)){!! $atividades{3}->banner !!}@endif" class="img-rounded text-center img-responsive"></div>
                    <div class="panel-body">
                      <p>@if (count($atividades)){!! $atividades{3}->descricao !!}@endif</p>
                    </div>
                  </div></a>
          </div>
      </div>
@stop