@section('scripts')
	<script>
		$('.mensajero').on('click', function(event){
			$('#recibo_id').val($(this).attr('rel'));
		});

		function send(form){
			$.post(form.attr('action'),
				form.serialize()
				).done(function(data){
					
				});
			}

		$('.modalSubmit').on("click", function(){
			var form = $(this).parent().parent().find('form');
			send(form);
			$(this).parent().parent().parent().parent().modal('hide');
			form.trigger('reset');
		});

		$('#notificarMensajero').on('submit', function(event){
			event.preventDefault();
			$('.modalSubmit').click();
		});
	</script>
@stop

@section('module')

<div class="widget">

	<div class="widget-head">
		<div class="pull-left">Recibos en cobranza</div>
		<div class="clearfix"></div>
	</div>

	<div class="widget-content">

		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>Venta</th>
					<th>Cliente</th>
					<th>Monto</th>
					<th>Saldo</th>
					<th>Fecha límite</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				@forelse($recibos as $recibo)
				<tr>
					<td  class="text-center">{{{ $recibo->folio_solicitud}}}</td>
					<td>{{{ $recibo->cliente }}}</td>
					<td class="text-right">$ {{{ number_format($recibo->monto, 2, '.', ',') }}}</td>
					<td class="text-right">
						@if($recibo->fecha_limite < Carbon\Carbon::now())
							<span class="label label-danger">$ {{{ number_format($recibo->monto - $recibo->pagos, 2, '.', ',') }}}</span>
						@else
							$ {{{ number_format($recibo->monto - $recibo->pagos, 2, '.', '.') }}}
						@endif
					</td>
					<td class="text-center">{{{ date("d/m/Y", strtotime($recibo->fecha_limite)) }}}</td>
					<td class="text-center">
						@if($recibo->mensajero == 1)
						<a title="No enviar a mensajero" href="{{{ action('CobranzaControlador@getNoMensajero', $recibo->id) }}}" class="btn btn-xs btn-success">
							<i class="fa fa-cab"></i>
						</a>
						@else
						<a title="Enviar mensajero" href="#notificarMensajero" data-toggle="modal" class="btn btn-xs btn-default mensajero" rel="{{{ $recibo->id }}}">
							<i class="fa fa-cab"></i>
						</a>
						@endif
						<div class="btn-group">
							<a title="Abonar" href="#agregarPago" data-toggle="modal" class="btn btn-xs btn-default">
								<i class="fa fa-credit-card"></i>
							</a>
							<a title="Pagar" href="" class="btn btn-xs btn-default">
								<i class="fa fa-cc-visa"></i>
							</a>
						</div>
						<a title="Ver pagos" href="" class="btn btn-xs btn-default">
							<i class="fa fa-search"></i>
						</a>
					</td>
				</tr>
				@empty
					<div class="alert alert-info">
						No hay recibos pendientes
					</div>
				@endforelse                                       
			</tbody>
		</table>

		<div class="widget-foot">

		</div>

	</div>

</div>
@include('formularios.pago', array('modalId' => 'agregarPago',
'modalTitle' => 'Abonar un recibo',
'modalOk' => 'Abonar',
'modalIcon' => 'credit-card',
'modalCancel' => 'Cancelar'))

@include('formularios.mensajero', array('modalId' => 'notificarMensajero',
'modalTitle' => 'Notificar al mensajero',
'modalOk' => 'Enviar',
'modalIcon' => 'cab',
'modalCancel' => 'Cancelar'))
@stop
