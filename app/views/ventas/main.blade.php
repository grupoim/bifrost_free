@extends('master')

@section('nav')
	@parent
	<li class="has_sub">
		@include('menu.ventas')
		<ul>
			@include('menu.submenu.cotizacion')
		</ul>
		<ul>
			@include('menu.submenu.ventas')
		</ul>
		
	</li>
	
	<li class="has_sub">
		@include('menu.administracion')
		<ul>
			@include('menu.submenu.queja')	
		</ul>
	</li>
@stop
