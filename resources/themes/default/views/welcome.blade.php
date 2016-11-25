@extends('layouts.frontend_master')
@section('content')
	<div class="row">
		@if(!is_null($noticia))
			@if($noticia->posicao == 0)
		<div class="col-md-5">
			<div class="box">
				<div class="panel panel-default">
					<div class="panel-heading text-center">
						<img class="img-rounded text-center img-responsive" alt="Bootstrap Image Preview" src="/upload/noticias/banner/{!! $noticia->banner !!}">
					</div>
                    <div class="panel-body">
						<div class="bootstrap-eh-pull-bottom clearfix">
							<p>{!! $noticia->descricao !!}</p>
							<a class="btn btn-warning pull-right" href="/view/noticia/{!! $noticia->id !!}" role="button">+ mais »</a>
						</div>
					</div>
				</div>
			</div>
		</div> 
		<div class="col-md-7">
			@endif
		@else
        <div class="col-md-12">
		@endif
				<div class="row">
			@for ($i = 0; $i < count($noticia1); $i++)
					<div class="col-md-6">
						<div class="panel panel-default">
		                    <div class="panel-heading">
								<h2 class="panel-title">{{ $noticia1[$i]->titulo }}</h2>
							</div>
							<div class="panel-body">
								<p>{!! $noticia1[$i]->descricao !!}</p>
								<div class="bootstrap-eh-pull-bottom clearfix">
									<a class="btn btn-warning pull-right" href="/view/noticia/{{ $noticia1[$i]->id }}" role="button">+ mais »</a>
								</div>
							</div>
						</div>
					</div>
				@if($i+1 %2 == 0 & count($noticia1) != $i+1)
				</div>	
				<div class="row">
				@endif
		@endfor
		</div>
		</div>
	<div> {{-- row noticias --}}
@stop