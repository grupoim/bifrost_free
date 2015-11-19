@extends('master')

@section('nav')
	@parent
	<li class="has_sub">
		@include('menu.administracion')
		<ul>
			@include('menu.submenu.cobranza')
			@include('menu.submenu.comision')
			@include('menu.submenu.queja')
			@include('menu.submenu.almacen')		
		</ul>
	</li>
	<li class="has_sub">
		@include('menu.tramites')
		<ul>
			@include('menu.submenu.cesionderecho')
			@include('menu.submenu.titulopropiedad')
			@include('menu.submenu.cartabeneficiario')
		</ul>
	</li>
	<li class="has_sub">
		@include('menu.operaciones')
		<ul>
			@include('menu.submenu.personaloperativo')
		</ul>
	</li>
@stop
