@extends('layouts.frontend_master')
@section('content')

      <div class="row">
          <div class="col-md-5">
              <div class="box">
                      <div class="panel panel-default">
                        <div class="panel-heading text-center"><img class="img-rounded text-center img-responsive" alt="Bootstrap Image Preview" src="/upload/noticias/banner/{!! $noticias{0}->banner !!}"></div>
                        <div class="panel-body">
                          <p>{!! $noticias{0}->descricao !!}</p>
                        <div class="bootstrap-eh-pull-bottom clearfix">
                          <a class="btn btn-warning pull-right" href="/view/noticia/{!! $noticias{0}->id !!}" role="button">+ mais »</a>
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
                        <div class="panel-heading"><h2 class="panel-title">{!! $noticias{1}->titulo !!}</h2></div>
                        <div class="panel-body">
                          <p>{!! $noticias{1}->descricao !!}</p>
                          <br>
                        <div class="bootstrap-eh-pull-bottom clearfix">
                          <a class="btn btn-warning pull-right" href="/view/noticia/{!! $noticias{1}->id !!}" role="button">+ mais »</a>
                        </div>
                        </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="panel panel-default">
                        <div class="panel-heading"><h2 class="panel-title">{!! $noticias{2}->titulo !!}</h2></div>
                        <div class="panel-body">
                          <p>{!! $noticias{2}->descricao !!}</p>
                          <br>
                        <div class="bootstrap-eh-pull-bottom clearfix">
                          <a class="btn btn-warning pull-right" href="/view/noticia/{!! $noticias{2}->id !!}" role="button">+ mais »</a>
                        </div>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-6">
                      <div class="panel panel-default">
                        <div class="panel-heading"><h2 class="panel-title">{!! $noticias{3}->titulo !!}</h2></div>
                        <div class="panel-body">
                          <p>{!! $noticias{3}->descricao !!}</p>
                        <div class="bootstrap-eh-pull-bottom clearfix">
                          <a class="btn btn-warning pull-right" href="/view/noticia/{!! $noticias{3}->id !!}" role="button">+ mais »</a>
                        </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                      <div class="panel panel-default">
                        <div class="panel-heading"><h2 class="panel-title">{!! $noticias{4}->titulo !!}</h2></div>
                        <div class="panel-body">
    		              <p>{!! $noticias{4}->descricao !!}<br></p>
                        <div class="bootstrap-eh-pull-bottom clearfix">
                          <a class="btn btn-warning pull-right" href="/view/noticia/{!! $noticias{4}->id !!}" role="button">+ mais »</a>
                        </div>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-6">
                      <div class="panel panel-default">
                        <div class="panel-heading"><h2 class="panel-title">{!! $noticias{5}->titulo !!}</h2></div>
                        <div class="panel-body">
                          <p>{!! $noticias{5}->descricao !!}<br><br></p>
                        <div class="bootstrap-eh-pull-bottom clearfix">
                          <a class="btn btn-warning pull-right" href="/view/noticia/{!! $noticias{5}->id !!}" role="button">+ mais »</a>
                        </div>
                        </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="panel panel-default">
                        <div class="panel-heading"><h2 class="panel-title">{!! $noticias{6}->titulo !!}</h2></div>
                        <div class="panel-body">
            		      <p>{!! $noticias{6}->descricao !!}<br><br></p>
                        <div class="bootstrap-eh-pull-bottom clearfix">
                          <a class="btn btn-warning pull-right" href="/view/noticia/{!! $noticias{6}->id !!}" role="button">+ mais »</a>
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
                  <a href="/view/atividade/{!! $atividades{0}->id !!}"><div class="panel panel-default">
                    <div class="panel-heading text-center"><img alt="Bootstrap Image Preview" src="/upload/atividades/banner/{!! $atividades{0}->banner !!}" class="img-rounded text-center img-responsive"></div>
                    <div class="panel-body">
                      <p>{!! $atividades{0}->descricao !!}</p>
                    </div>
                  </div></a>
          </div>
          <div class="col-md-3">
                  <a href="/view/atividade/{!! $atividades{1}->id !!}"><div class="panel panel-default">
                    <div class="panel-heading text-center"><img alt="Bootstrap Image Preview" src="/upload/atividades/banner/{!! $atividades{1}->banner !!}" class="img-rounded text-center img-responsive"></div>
                    <div class="panel-body">
                      <p>{!! $atividades{1}->descricao !!}</p>
                    </div>
                  </div></a>
          </div>
          <div class="col-md-3">
                  <a href="/view/atividade/{!! $atividades{2}->id !!}"><div class="panel panel-default">
                    <div class="panel-heading text-center"><img alt="Bootstrap Image Preview" src="/upload/atividades/banner/{!! $atividades{2}->banner !!}" class="img-rounded text-center img-responsive"></div>
                    <div class="panel-body">
                      <p>{!! $atividades{2}->descricao !!}</p>
                    </div>
                  </div></a>
          </div>
          <div class="col-md-3">
                  <a href="/view/atividade/{!! $atividades{0}->id !!}"><div class="panel panel-default">
                    <div class="panel-heading text-center"><img alt="Bootstrap Image Preview" src="/upload/atividades/banner/{!! $atividades{3}->banner !!}" class="img-rounded text-center img-responsive"></div>
                    <div class="panel-body">
                      <p>{!! $atividades{3}->descricao !!}</p>
                    </div>
                  </div></a>
          </div>
      </div>
@stop