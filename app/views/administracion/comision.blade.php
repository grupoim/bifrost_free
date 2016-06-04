@section('module')
<div class="">
	<div class="well">
		<p class="lead text-right">
			Total: <strong>$ {{{ $total }}}</strong>
		</p>
	</div>
</div>
<div class="widget">
	<div class="widget-head">
		<div class="pull-left">Comisiones pendientes</div>
		<div class="pull-right">
		</div>  
		<div class="clearfix"></div>
	</div>
	<div class="widget-content">
		<div class="padd">
			@if(count($comisiones) > 0)
			<!-- Table Page -->
			<div class="page-tables">
				<!-- Table -->
				<div class="table-responsive">
					<table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
						<thead>
							<tr>
								<th class="text-center">PKC</th>
								{{--<th>Producto</th>--}}
								<th class="text-center">Folio</th>
								<th class="text-center col-md-2">Cliente</th>
								<th class="text-center col-md-2">Asesor</th>
								<th class="text-center">Venta</th>
								<th class="text-center">Comision</th>
								<th class="text-center">Pagado</th>
								<th class="text-center">Resto</th>
								<th class="text-center">%</th>
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($comisiones as $comision)

							<tr>
								<td>{{{$comision->id}}}</td>
								<td>{{{$comision->folio_solicitud}}}-{{{$comision->nombre_corto}}}</td>
								{{--<td> {{{$comision->producto}}}</td>--}}
								<td>{{{ $comision->cliente }}}
								</td>
								<td><strong>{{{ $comision->vendedor }}}</strong></td>
								<td class="text-right">$  {{{ number_format($comision->total, 0, ".", ",") }}}</td>
								<td class="text-right">$ {{{ number_format($comision->total_comisionable, 0, ".", "," ) }}}</td>
								<td class="text-right">$ {{{ number_format($comision->pagado, 0, ".", ",") }}}</td>
								<td class="text-right">$ {{{ number_format($comision->total_comisionable - $comision->pagado, 0, ".", ",")  }}}</td>
								<td class="text-right">{{{ $comision->porcentaje}}}%</td>
								
								<td class="text-right">
									<a href="" class="btn btn-xs btn-default"><i class="fa fa-search"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="clearfix"></div>
				</div>
			</div>
			@else
			<div class="text-center">No hay comisiones pendientes</div>
			@endif
		</div>
	</div>
	<div class="widget-foot">
		<div class="pull-right">
			<div class="btn-group">
				<button class="btn btn-danger">Cancelar</button>
				<button class="btn btn-primary">Pagar</button>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
@stop