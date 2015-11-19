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
								<th>Cliente</th>
								<th>Asesor</th>
								<th>Total</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($comisiones as $comision)
							<tr>
								<td><input type="checkbox" name="marcar"> {{{ $comision->venta->cliente->persona->nombres }}} {{{ $comision->venta->cliente->persona->apellido_paterno }}} {{{ $comision->venta->cliente->persona->apellido_materno }}}
								</td>
								<td><strong>{{{ $comision->asesor->persona->nombres }}} {{{ $comision->asesor->persona->apellido_paterno }}} {{{ $comision->asesor->persona->apellido_materno }}}</strong></td>
								<td class="text-right">$ {{{ $comision->total }}}</td>
								<td class="text-center">@if($comision->venta->cotizacion == 1)
									<span class="label label-warning">Cotización</span></td>
									@else
									<span class="label label-success">Venta</span></td>
									@endif
								</td>
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