@extends('master')

@section('list')
	@include('list')
@stop

@section('nav')
	@parent
	<li class="has_sub">
		@include('menu.ventas')
		<ul>
			@include('menu.submenu.cotizacion')
		</ul>
	</li>
	<li class="has_sub">
		@include('menu.administracion')
		<ul>
			@include('menu.submenu.cobranza')
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
@stop