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
			@include('menu.submenu.cobranza')
			@include('menu.submenu.queja')	
		</ul>
	</li>
	<li class="has_sub">
		@include('menu.capilla')
		<ul>
			@include('menu.submenu.serviciofuneral')
		</ul>
	</li>
	<li class="has_sub">
		@include('menu.tramites')
		<ul>
			@include('menu.submenu.contratacion')
			@include('menu.submenu.cesionderecho')
			@include('menu.submenu.titulopropiedad')
			@include('menu.submenu.cartabeneficiario')
		</ul>
	</li>
	<li class="has_sub">
		@include('menu.operaciones')
		<ul>
			@include('menu.submenu.inhumacion')
			@include('menu.submenu.exhumacion')
		</ul>
	</li>
@stop