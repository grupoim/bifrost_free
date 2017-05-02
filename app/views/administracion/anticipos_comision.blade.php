@section('scripts')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


@stop()

@section('module')


<div class="widget">
	<div class="widget-head">
		<div class="pull-left">Catalogo de anticipos</div>
		<div class="pull-right">
		
		</div>  
		<div class="clearfix"></div>
	</div>
	<div class="widget-content">
		<div class="padd">			
			<!-- Table Page -->
			<div class="page-tables">
				<!-- Table -->
				<div class="table-responsive">
					<table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
						<thead>
							<tr>
								<th class="text-left col-md-1">ID</th>
								<th class="text-left col-md-1">Folio Comision</th>
								<th class="text-left col-md-1">Folio venta</th>
								<th class="text-center col-md-3">cliente</th>
								<th class="text-center col-md-3">Asesor</th>
								<th class="text-center"> Total</th>
								<th class="text-center col-md-2">Fecha pago</th>
								{{--<th class="text-center col-md-1">Fecha venta</th>--}}
								<th class="text-center"> Opciones</th>
								
							</tr>
						</thead>
						<tbody>
							@foreach($anticipos as $anticipo)

							<tr>
								<td><a href="{{action('ComisionControlador@getAbonos', $anticipo->id)}}"> {{{$anticipo->id}}} </a></td>
								<td>{{{$anticipo->folio_comision}}}</td>
								<td>{{{$anticipo->folio_solicitud}}}</td>
								<td>{{{$anticipo->cliente}}}</td>
								<td>{{{$anticipo->vendedor}}}</td>
								<td>$  {{{ number_format($anticipo->anticipo, 2, ".", ",") }}}</td>
								<td><strong>{{{ date('d/m/y  h:i:s', strtotime($anticipo->created_at)) }}}</strong></td>
								{{--<td class = "text-center">{{{ date('d/m/Y', strtotime($anticipo->fecha_venta)) }}}</td>--}}
								<td class="text-center">
									<a href="{{action('ComisionControlador@getPdfanticipo', $anticipo->anticipo_id)}}" target="_blank" title="Reipresión de anticipo de comision" class="btn btn-default btn-xs" data-toggle="modal" id="btnsql"><i class="fa fa-print" aria-hidden="true"></i></a> 
									
								</td>
							@endforeach
						</tbody>
					</table>
					<div class="clearfix"></div>
				</div>
			</div>
			
		</div>
	</div>

	
	<div class="widget-foot">
		<div class="pull-right">
			<div class="btn-group">
				
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>


  
</div>



@stop