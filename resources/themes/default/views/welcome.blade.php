@extends('layouts.frontend_master')
@section('content')
	<div class="row"> {{-- row noticias --}}
		@if(!is_null($noticia0))
			@if(!is_null($noticia0->posicao))
				@switch($noticia0{0}->posicao)
					@tipo(0) {{--Vertical--}}
		<div class="col-md-5">
			<div class="box">
				<div class="panel panel-default">
					<div class="panel-heading text-center">
						<img class="img-rounded text-center img-responsive" alt="Bootstrap Image Preview" src="/upload/noticias/banner/{!! $noticia0->banner !!}">
					</div>
                    <div class="panel-body">
						<div class="bootstrap-eh-pull-bottom clearfix">
							<p>{!! $noticias0->descricao !!}</p>
							<a class="btn btn-warning pull-right" href="/view/noticia/{!! $noticia0->id !!}" role="button">+ mais »</a>
						</div>
					</div>
				</div>
					@break  {{--Vertical--}}
			</div>
				@endswitch {{--Posicao--}}
		</div> 
			@endif {{--noticia1--}}
		<div class="col-md-7">
		@else
        <div class="col-md-12">
		@endif
		@foreach($noticia1 as $noticia)
			<div class="box">
				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-default">
						@if(!is_null($noticia->titulo))
		                    <div class="panel-heading">
								<h2 class="panel-title">{!! $noticia->titulo !!}</h2>
							</div>
						@endif
						@if(!is_null($noticia->descricao))
							<div class="panel-body">
								<p>{!! $noticia->descricao !!}</p>
								<div class="bootstrap-eh-pull-bottom clearfix">
									<a class="btn btn-warning pull-right" href="/view/noticia/{!! $noticia->id !!}" role="button">+ mais »</a>
								</div>
							</div>
						</div>
						@endif
					</div>
				</div>
		@endforeach
			</div>
		</div>
	<div> {{-- row noticias --}}
@stop