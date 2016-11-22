﻿@extends('layouts.frontend_master')
@section('content')

<div class="panel panel-default">
	<div class="panel-heading"><h2 class="panel-title"></h2>{{ $atividade->titulo}}</div>
	<div class="panel-body"><div>{!! $atividade->texto !!}</div></br>
		<div class="panel-footer bootstrap-eh-pull-bottom clearfix" style="text-align: center;">
			@if ($prevPages > 0)
				<a class="btn btn-warning pull-left" href="/view/atividade/{{ $atividade->id}}/prev" role="button"><< Anterior</a>
			@endif
			<a class="btn btn-warning" href="/" role="button">Voltar</a>
			@if ($nextPages > 0)
			<a class="btn btn-warning pull-right" href="/view/atividade/{{ $atividade->id}}/next" role="button">Seguinte >></a>
			@endif
        </div>
	</div>
</div>
@stop