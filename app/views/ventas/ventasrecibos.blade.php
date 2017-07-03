@section('scripts')

<script type="text/javascript">
$(document).on('ready', function(){ 

	$(document).on('click','.open_modal_reestructura',function(){

$('#reestructura_window').modal('show');

$('#reestructura_button').on('click', function(){
		/*$('#edit_form').submit();*/
	});


});

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

    //pago de atrasado de recibo
    $("#abono_pendiente_option").click(function () {
        $('#monto').prop('disabled', true);
          
    });
    //pago de restante de recibo
    $("#saldo_option").click(function () {
        $('#monto').prop('disabled', true);
          
    });
    //pago de restante de recibo
    $("#diferente_option").click(function () {
        $('#monto').prop('disabled', false);
          
    });



var id = $(this).val();

$.get('{{ action('VentaControlador@abonar') }}/'+{{{$recibos[0]->venta_id}}}+'/'+ id, function (data) {
	
	
	/*$('input[name=monto]').val(data.saldo);*/
	$('#por_pagar').text('$'+data.por_pagar.formatMoney(2, '.', ','));
	$('#abono_pendiente').text('$'+data.abono_pendiente.formatMoney(2, '.', ','));
	$('#saldo').text('$'+data.saldo.formatMoney(2, '.', ','));
	$('#venta_id').val(data.venta_id);
	$('#recibo_id').val(data.recibo_id);
	$('#saldo_value').val(data.saldo);
	$('#por_pagar_value').val(data.por_pagar);
	$('#abono_pendiente_value').val(data.abono_pendiente);
	$('textarea[name=observaciones_comision]').val(data.observaciones);
	

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
<div class="widget-head">
		
		<div class="pull-right">
			
		</div>  
		<div class="clearfix"></div>
	</div>

	
<div class="col-md-12">
	<div class="col-md-3">
		<div class="alert alert-info text-center">
			<h4> <i class="fa fa-shopping-cart"></i> Contrato <strong> $ {{{ number_format($venta->total, 2, '.', ',') }}} </strong></h4>

		</div>
	</div>
	<div class="col-md-3">
	<div class="alert alert-success text-center">
			<h4><i class="fa fa-money"></i> Saldo <strong> $ @if($saldo_venta <= 0) 0.00 @else {{{ number_format($saldo_venta, 2, '.', ',') }}} @endif</div>
	</div>
<div class="col-md-3">
	<div class="alert alert-warning text-center">
		<h4><i class="fa fa-exclamation-triangle"></i> Pagos <strong> $ {{{ number_format($venta->total - $saldo_venta, 2, '.', ',')}}}</strong></h4>

	</div>
</div>
	<div class="col-md-3">
	<div class="alert alert-danger text-center">
		<h4><i class="fa fa-money"></i> Saldo atrasado <strong>@if($abono_pendiente > 0) $ {{{ number_format($abono_pendiente, 2, '.', ',') }}} <br>@if($dias_atraso > 0) {{{$dias_atraso}}} dias @endif @else $0 @endif</strong></h4>                        
	</div>
</div> 

 
</div>
<div class="clearfix"></div>
<div class="col-md-8">
	<div class="pull-right">
		
	</div>
	<div class="clearfix"></div>
	<div class="widget">
		<div class="widget-head"> @if($db->base_datos_produccion == 0)<h2><span class="label label-danger"> <i class="icon-user"></i> Advertencia, estas en la base de datos de pruebas  </span> </h2> @endif
			<div class="pull-left"><div class="pull-left"><h3> <strong> Saldo de Venta $ {{{ number_format($saldo_venta, 2, '.', ',') }}}  </strong> </h3></div>  </div>
			<div class="widget-icons pull-right">			
<button title="Reestructura el saldo total de la venta" type="button" class="btn btn-xl btn-info "><i class="fa fa-balance-scale open_modal_reestructura" aria-hidden="true"></i> Reestructura</button>
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
								<th>#</th>
                              <th>Fecha Limite</th>
                              <th>Monto</th>
                              <th>Abonado</th>
                              <th>Estatus</th>
                              <th>Total</th>									
								</tr>
							</thead>
							<tbody>
								 @foreach($recibos as $r)
							 <tr>
							<td>{{{$r->consecutivo}}}</td>
							<td>{{{$r->fecha_limite}}}</td>
                              <td>$ {{{ number_format($r->monto, 2, '.', ',') }}}</td>
                              <td>
                              
                              @forelse($abono_recibo as $abono)
                              		@if( $abono->recibo_id == $r->id and $abono->abono > 0)
                              		$ {{{ number_format($abono->abono, 2, '.', ',') }}}                              		
                              		@else                              		
                              		@endif
                              		@empty
										                             		
                              	
                              	@endforelse
                              	
                              	
                              </td>
                              <td>@if($r->pagado == 1)  Pagado @else Activo <button class="btn btn-xs btn-default open_modal_edit"  title="Agregar pago" value="{{$r->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></i></button> @endif</td>
                              <td>{{{$r->id}}} </td>
                              
                           </tr> 
                           @endforeach
                           
								
							</tbody>
						</table>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="widget-foot">
			<div class="widget-icons pull-right">
			
			</div>
			<div class="clearfix"></div> <!-- Footer goes here -->
		</div>
	</div>
</div>
<div class="col-md-4">
	<div class="pull-right">
		
	</div>
	<div class="clearfix"></div>
	<div class="widget">
		<div class="widget-head">
			<div class="pull-left ">Datos del cliente  </div>
			<div class="widget-icons pull-right">
				
			</div>  
			<div class="clearfix"></div>
		</div>
		<div class="widget-content">
			 <div class="padd">
                                               <!-- Contact box -->
                             <div class="support-contact">
                                								
                                
                               
                               
                                
                                <p><i class="fa fa-user"></i>&nbsp; Cliente:<strong> {{{ $venta->nombres}}}</strong></p>
                                <p><i class="fa fa-briefcase"></i>&nbsp; RFC: <STRONG> {{{$venta->email}}}</STRONG></p>
                                <hr />
                                <p><i class="fa fa-phone"></i>&nbsp; Telefono<strong>:</strong> {{{$venta->calle}}} </p>
                                
                                <hr />
                           
                                <p><i class="fa fa-home"></i>&nbsp; Domicilio<strong>:</strong>{{{ $venta->pais}}}
                                </p>
								
                             </div>
                  </div>
		</div>
		<div class="widget-foot">
			<!-- Footer goes here -->
		</div>
	</div>
</div>


<!-- //MODAL pago -->
 <div class="modal fade" id="edit_window">
 	<div class="modal-dialog">
 		<div class="modal-content">
 			<div class="modal-header">
 				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
 				<h4 class="modal-title">Agregar pago</h4>
 			</div>
 			<div class="modal-body"> 				
{{ Form::open(array('action' => 'VentaControlador@postPago', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'edit_form')) }}
<div class="form-group">
	<label class="col-lg-3 control-label">Ellije una opción</label>
	<div class="col-lg-9">
		<div class="radio">
			
			@if($abono_pendiente <= 0) 
			<label>
				<input type="radio" name="optionpago" id="por_pagar_option" value="1" checked>
				Resto del recibo <strong> <span id="por_pagar"></span></strong>
			</label>
			@else 
			<label>
				<input type="radio" name="optionpago" id="abono_pendiente_option" value="4" checked>
				Pago para ponerse al corriente <strong> <span id="abono_pendiente"></span></strong>
			</label>
			@endif
			
		</div>
		<div class="radio">
			<label>
				<input type="radio" name="optionpago" id="saldo_option" value="2">
				Pagar el total del adeudo <strong> <span id="saldo"></span></strong>
			</label>
		</div>
		<div class="radio">
			<label>
				<input type="radio" name="optionpago" id="diferente_option" value="3">
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
<input type="hidden" name="saldo_venta" id="saldo_value" value="">
<input type="hidden" name="saldo_recibo" id="por_pagar_value" value="">
<input type="hidden" name="abono_pendiente" id="abono_pendiente_value" value="">
<input type="hidden" name="venta_id" id="venta_id" value="">
<input type="hidden" name="recibo_id" id="recibo_id" value="">
<input type="hidden" name="porcentaje_anticipo" id="porcentaje_anticipo" value="">

{{ Form::close() }}
 			</div>
 			<div class="modal-footer">
 				<button type="button" class="btn btn-default"  data-dismiss="modal">Cerrar</button>
 				<button type="sumbmit" class="btn btn-primary" id="edit_button"><i class="fa fa-floppy-o" aria-hidden="true"></i>Guardar</button>
 			</div>
 		</div>
 	</div>
 </div>

 <!--Modal de //MODAL reestructura -->
 
 <div class="modal fade" id="reestructura_window">
 	<div class="modal-dialog">
 		<div class="modal-content">
 			<div class="modal-header">
 				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
 				<h4 class="modal-title">Agregar pago</h4>
 			</div>
 			<div class="modal-body"> 				
MODAL BODY
 			</div>
 			<div class="modal-footer">
 				<button type="button" class="btn btn-default"  data-dismiss="modal">Cerrar</button>
 				<button type="sumbmit" class="btn btn-primary" id="reestructura_button"><i class="fa fa-floppy-o" aria-hidden="true"></i>Guardar</button>
 			</div>
 		</div>
 	</div>
 </div>

 <!-- -- >

@stop