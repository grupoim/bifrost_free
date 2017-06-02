@section('scripts')

<script type="text/javascript">
$(document).on('ready', function(){ 

{{--funcion para formatear numeros --}}
        Number.prototype.formatMoney = function(c, d, t){
			var n = this, 
			    c = isNaN(c = Math.abs(c)) ? 2 : c, 
			    d = d == undefined ? "." : d, 
			    t = t == undefined ? "," : t, 
			    s = n < 0 ? "-" : "", 
			    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
			    j = (j = i.length) > 3 ? j % 3 : 0;
			   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
			 }; {{--fin function formatMoney --}}

//lanza modal para editar
$(document).on('click','.open_modal_edit',function(){
$('#monto').prop('disabled', true);
//pago de restante de recibo
    $("#por_pagar_option").click(function () {
        $('#monto').prop('disabled', true);
          
    });
    //pago de restante de recibo
    $("#diferente_option").click(function () {
        $('#monto').prop('disabled', false);
          

    });



var id = $(this).val();

$.get('{{ action('CotizacionControlador@abonar') }}/'+id, function (data) {
	
	
	/*$('input[name=monto]').val(data.saldo);*/
	if ($('#primer_pago').val(data.primer_pago) < $('#saldo_primer_pago').val(data.saldo_primer_pago) ) {
		$('#primer_pago').text('$'+data.primer_pago);
		$('#abono').val(data.primer_pago);

	}else{
		$('#primer_pago').text('$'+data.saldo_primer_pago);	
		$('#abono').val(data.saldo_primer_pago);		
		}

	/*$('#primer_pago').text('$'+data.primer_pago.formatMoney(2, '.', ','));	*/
	
	$('#saldo_primer_pago').val(data.saldo_primer_pago);
	$('#leyenda').text(data.leyenda);
	$('#venta_id').val(data.venta_id);
	$('#consecutivo').val(data.consecutivo);
	$('#pagado').val(data.pagado);
	$('#enganche').val(data.enganche);
	$('#porcentaje_anticipo').val(data.porcentaje_anticipo);
	$('#enganche_monto').val(data.enganche_monto);
	$('#total_primer_pago').val(data.primer_pago);
	$('#mensualidad').val(data.mensualidad);
	$('#no_mensualidad').val(data.numero_mensualidades);
	$('#saldo_total').val(data.saldo_total);
	
	
	


	/*$('textarea[name=observaciones_comision]').val(data.observaciones);*/
	

console.log(data);
            $('#id').val(data.id);
});

$('#edit_window').modal('show');


$('#edit_button').on('click', function(){
		$('#edit_form').submit();
	});


});
 });
</script>
@stop()
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
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($cotizaciones as $cotizacion)
							<tr>
								<td>{{{ $cotizacion->folio_solicitud }}}</td>
								<td>{{{ $cotizacion->fecha }}}</td>
								<td><strong>{{{ $cotizacion->cliente->persona->nombres }}} {{{ $cotizacion->cliente->persona->apellido_paterno }}} {{{ $cotizacion->cliente->persona->apellido_materno }}}</strong></td>
								<td class="text-right">$ {{{ number_format($cotizacion->total, 2, '.', ',') }}}</td>
								@if($cotizacion->autorizado == 1)
								<td><span class="label label-success">Autorizado</span></td>
								@else
								<td><span class="label label-warning">Pendiente</span></td>
								@endif
								<td class="text-right">
									{{{$cotizacion->id}}}<div class="btn btn-group">
										
										@if($cotizacion->autorizado == 1)
										<button class="btn btn-xs btn-default open_modal_edit"  title="Agregar pago" value="{{$cotizacion->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></i></button>
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

{{-- modal para editar comision --}}
 <div class="modal fade" id="edit_window">
 	<div class="modal-dialog">
 		<div class="modal-content">
 			<div class="modal-header">
 				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
 				<h4 class="modal-title">Agregar pago</h4>
 			</div>
 			<div class="modal-body"> 				
{{ Form::open(array('action' => 'CotizacionControlador@postAbonar', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'edit_form')) }}
<div class="form-group">
	<label class="col-lg-3 control-label">Ellije una opción</label>
	<div class="col-lg-9">
		<div class="radio">
			<label>
				<input type="radio" name="optionpago" id="por_pagar_option" value="1" checked>
				<span id="leyenda"></span> <strong> <span id="primer_pago"></span></strong>
			</label>
		</div>		
		<div class="radio">
			<label>
				<input type="radio" name="optionpago" id="diferente_option" value="2">
				Pagar una cantidad diferente
			</label>
		</div>
	</div>
</div>
<div class="form-group">
	<label for="cantidad" class="col-md-3 control-label">Monto</label>
	<div class="col-md-6">
		<input type="number" id="monto" name="monto" placeholder="Indique la cantidad" autocomplete="off" class="form-control" required>
	</div>
</div>
<div class="form-group">
                                  <label class="col-lg-3 control-label">Método de pago</label>
                                  <div class="col-lg-5">
                                  <select name="forma_pago_id" class="form-control" required="required">
                                    	@foreach($formas_pago as $f_pago)
                                    	<option value="{{{$f_pago->id}}}">{{{$f_pago->descripcion}}}</option>                                    	
                                    	@endforeach
                                    </select>  
                                  </div>
                      </div> 

<input type="hidden" name="venta_id" id="venta_id" value="">
<input type="hidden" name="saldo_primer_pago" id="saldo_primer_pago" value="">
<input type="hidden" name="abono" id="abono" value="">
<input type="hidden" name="consecutivo" id="consecutivo" value="">
<input type="hidden" name="enganche" id="enganche" value="">
<input type="hidden" name="pagado" id="pagado" value="">
<input type="hidden" name="porcentaje_anticipo" id="porcentaje_anticipo" value="">
<input type="hidden" name="enganche_monto" id="enganche_monto" value="">
<input type="hidden" name="total_primer_pago" id="total_primer_pago" value="">
<input type="hidden" name="mensualidad" id="mensualidad" value="">
<input type="hidden" name="no_mensualidad" id="no_mensualidad" value="">
<input type="hidden" name="saldo_total" id="saldo_total" value="">



{{ Form::close() }}
 			</div>
 			<div class="modal-footer">
 				<button type="button" class="btn btn-default"  data-dismiss="modal">Cerrar</button>
 				<button type="sumbmit" class="btn btn-primary" id="edit_button"><i class="fa fa-floppy-o" aria-hidden="true"></i>Guardar</button>
 			</div>
 		</div>
 	</div>
 </div>
@stop