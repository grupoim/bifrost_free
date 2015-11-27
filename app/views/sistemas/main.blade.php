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
			@include('menu.submenu.comision')
			@include('menu.submenu.queja')
			@include('menu.submenu.almacen')		
		</ul>
	</li>
	<li class="has_sub">
		@include('menu.capilla')
		<ul>
			@include('menu.submenu.serviciofuneral')
		</ul>
	</li>
	<li class="has_sub">
		@include('menu.recubrimientos')
		<ul>
			@include('menu.submenu.recubrimiento')
			@include('menu.submenu.material')
		</ul>
	</li>
	<li class="has_sub">
		@include('menu.mantenimiento')
		<ul>
			@include('menu.submenu.mantenimiento')
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
			@include('menu.submenu.listaasistencia')
			@include('menu.submenu.personaloperativo')
			@include('menu.submenu.inhumacion')
			@include('menu.submenu.exhumacion')
			@include('menu.submenu.lotefunerario')
			
		</ul>
	</li>
	<li class="has_sub">
		@include('menu.configuraciones')
		<ul>
			@include('menu.submenu.configuracion')
			@include('menu.submenu.producto')
			@include('menu.submenu.planpago')
			@include('menu.submenu.notacredito')
			@include('menu.submenu.asesor')
			
		</ul>
	</li>
@stop