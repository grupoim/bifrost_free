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
			@if(count($servicios) > 0)
			<!-- Table Page -->
			<div class="page-tables">
				<!-- Table -->
				<div class="table-responsive">
					<table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
						<thead>
							<tr>
								{{--<th class="col-md-1">ID</th>--}}
								<th class="col-md-1">contrato</th>								
								<th class ="col-md-2">Cliente</th>
								{{--<th class ="col-md-2">Cliente</th>--}}
								<th  class ="col-md-2">Producto</th>
								{{--<th  class ="col-md-1">Total</th>--}}
								<th  class ="col-md-2">Total</th>
								
								{{--<th>Abonado</th>--}}
								<th>Por pagar</th>
								<th>Vendedor</th>
								<th class ="col-md-1">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($servicios as $s)
							
							<tr @if($s->servicio_realizado == 1) class="disabled" @endif>
								{{--<td>{{{ $s->id }}}</td>--}}
								<td>{{{ $s->folio }}}</td>
								{{--<td>{{{ $s->venta_producto_id }}}</td>--}}
								<td>{{{ $s->cliente }}}</td>
								<td>{{{ $s->nombre}}}</td>
								<td>$ {{{ number_format($s->total, 2, '.', ',') }}}</td>
								{{--<td>$ {{{ number_format($s->abono, 2, '.', ',') }}}</td>	--}}
								{{--<td{{{$s->abono}}}</td>--}}
								<td>$ {{{ number_format($s->total - $s->abono, 2, '.', ',') }}}</td>					
								<td>{{{ $s->asesor}}}</td>
								<td class="text-right">
									<a href="{{action('ServicioFuneralControlador@getRecibos', $s->id)}}" name="id" value="{{{$s->id}}}"  title="Detalles" class="btn btn-xs btn-default"><i class="fa fa-search"></i> Detalles</a>
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