@extends('master')

@section('nav')
	@parent
	<li class="has_sub">
		@include('menu.administracion')
		<ul>
			@include('menu.submenu.queja')
			@include('menu.submenu.almacen')		
		</ul>
	</li>
	<li class="has_sub">
		@include('menu.mantenimiento')
		<ul>
			@include('menu.submenu.mantenimiento')
		</ul>
	</li>
	<li class="has_sub">
		@include('menu.operaciones')
		<ul>
			@include('menu.submenu.listaasistencia')
			@include('menu.submenu.personaloperativo')
			@include('menu.submenu.inhumacion')
			@include('menu.submenu.exhumacion')
			@include('menu.submenu.lotefunerario')
			
		</ul>
	</li>
@stop