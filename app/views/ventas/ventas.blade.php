@section('module')
<div class="widget">
	<div class="widget-head">
		<div class="pull-left"> @if($db->base_datos_produccion == 0)<h2><span class="label label-danger">  Advertencia, estas en la base de datos de pruebas  </span> </h2> @endif Cotizaciones activas</div>
		<div class="pull-right">
			<a alt="Nueva cotización" href="{{ action('ClienteControlador@getCreate') }}" class="btn btn-primary"><i class="fa fa-cart-plus"></i> Cotizar</a>
		</div>  
		<div class="clearfix"></div>
	</div>
	<div class="widget-content">
		<div class="padd">		
			@if(count($cotizaciones) > 0)
			<!-- Table Page -->
			<div class="page-tables">
				<!-- Table -->
				<div class="table-responsive">
					<table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
						<thead>
							<tr>
								<th>Solicitud</th>
								<th>Fecha</th>
								<th>Cliente</th>
								<th>Total</th>
								<th>Mensualidad</th>
								<th>meses</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($cotizaciones as $planpagoventa=>$cotizacion)
							<tr>
								<td>{{{ $cotizacion->folio_solicitud }}}</td>
								<td>{{{ $cotizacion->fecha }}}</td>
								<td><strong>{{{ $cotizacion->cliente->persona->nombres }}} {{{ $cotizacion->cliente->persona->apellido_paterno }}} {{{ $cotizacion->cliente->persona->apellido_materno }}}</strong></td>
								<td class="text-right">$ {{{ number_format($cotizacion->total, 2, '.', ',') }}}</td>
								<td class="text-right">$ {{{ number_format($cotizacion->pago_regular, 2, '.', ',') }}}</td>
								<td class="text-right">{{{$cotizacion->descripcion}}}</td>
								@if($cotizacion->autorizado == 1)
								<td><span class="label label-success">Autorizado</span></td>
								@else
								<td><span class="label label-warning">Pendiente</span></td>
								@endif
								<td class="text-right">
									<div class="btn btn-group">
										@if($cotizacion->autorizado == 1)
										<a href="{{{ action('CotizacionControlador@getContratar', [$cotizacion->id]) }}}" class="btn btn-xs btn-default"><i class="fa fa-briefcase"></i></a>
										<a href="{{{ action('CotizacionControlador@getBloquear', [$cotizacion->id]) }}}" class="btn btn-xs btn-default"><i class="fa fa-lock"></i></a>
										@else
										<a href="{{{ action('CotizacionControlador@getAutorizar', [$cotizacion->id]) }}}" class="btn btn-xs btn-default"><i class="fa fa-unlock"></i> </a>
										@endif
										<a href="" class="btn btn-xs btn-default"><i class="fa fa-search"></i></a>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="clearfix"></div>
				</div>
			</div>
			@else
			<div class="text-center">No hay cotizaciones activas</div>
			@endif
		</div>
	</div>
	<div class="widget-foot">
		<!-- Footer goes here -->
	</div>
</div>
@stop