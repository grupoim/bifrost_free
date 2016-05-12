@extends('master')

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
			@include('menu.submenu.queja')	
		</ul>
	</li>
@stop
