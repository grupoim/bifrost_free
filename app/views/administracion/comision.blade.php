@section('scripts')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">



<script type="text/javascript">
$(document).on('ready', function(){ 

@foreach($comisiones as $comision)
$('#{{{$comision->id}}}').on('shown.bs.modal', function(){
			$.ajax("{{ action('ComisionControlador@getPago',$comision->id) }}")
			.success(function(data){
				$('#loteBuscarLote').typeahead({
					source: data,
					display: 'total',
					val: 'total',
					itemSelected: function(item){
						$('#loteProductoId').val(item);
					}
				});
			});
			
		});
@endforeach


});
	

</script>


<script>

  $(function() {
   
//Array para dar formato en español
 $.datepicker.regional['es'] = 
 {
 closeText: 'Cerrar', 
 prevText: 'Previo', 
 nextText: 'Próximo',
 
 monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
 'Jul','Ago','Sep','Oct','Nov','Dic'],
 monthStatus: 'Ver otro mes', yearStatus: 'Ver otro año',
 dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
 dateFormat: 'yy-mm-dd', firstDay: 0, 
 initStatus: 'Selecciona la fecha', isRTL: false};
$.datepicker.setDefaults($.datepicker.regional['es']);

//miDate: fecha de comienzo D=días | M=mes | Y=año
//maxDate: fecha tope D=días | M=mes | Y=año
   $( "#datepicker" ).datepicker({ minDate: "-14D", maxDate: "+14D" });

 });
  </script>
  <script>    
      	$(document).on("ready",function() {  /* Cuando la pagina este totalmente cargada */
			$("#guardar").on("click", function() { /* Al boton guardar le asigno el evento onClick */
				$("#upload_file").submit();
			});
		});

 
</script>
@stop()

@section('module')
<div class="">
	<div class="well">
		<p class="lead text-right">
			Total por pagar: <strong>$ {{{ $total }}}</strong>

				

		</p>
	</div>
</div>
<div class="widget">
	<div class="widget-head">
		<div class="pull-left">Comisiones pendientes</div>
		<div class="pull-right">
		<a href="#myModal" class="btn btn-primary" data-toggle="modal"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Sube Archivo </a>
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
								<th class="text-center">ID</th>
								{{--<th>Producto</th>--}}
								{{--<th class="text-center">Folio</th>--}}
								<th class="text-center col-md-2">Cliente</th>
								<th class="text-center col-md-2">Asesor</th>
								<th class="text-center">Venta</th>
								<th class="text-center">Comisión</th>
								<th class="text-center">Pagado</th>
								<th class="text-center">Resto</th>
								<th class="text-center">%</th>
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($comisiones as $comision)

							<tr>
								<td class="text-center">{{{$comision->id}}}</td>
								{{--<td class="text-center">{{{$comision->folio_solicitud}}}-{{{$comision->nombre_corto}}}</td>--}}
								{{--<td> {{{$comision->producto}}}</td>--}}
								<td title="{{{$comision->id}}}">{{{ $comision->cliente }}}
								</td>
								<td><strong>{{{ $comision->vendedor }}}</strong></td>
								<td class="text-right">$  {{{ number_format($comision->total, 0, ".", ",") }}}</td>
								<td class="text-right">$ {{{ number_format($comision->total_comisionable, 0, ".", "," ) }}}</td>
								<td class="text-right">$ {{{ number_format($comision->pagado, 0, ".", ",") }}}</td>
								<td class="text-right">$ {{{ number_format($comision->total_comisionable - $comision->pagado, 0, ".", ",")  }}}</td>
								<td class="text-right">{{{ $comision->porcentaje}}}%</td>
								
								<td class="text-left">
									<a href="#{{{$comision->id}}}" data-toggle="modal"  class="btn btn-xs btn-default" rel="#modal-form" ><i class="fa fa-search"></i></a>
									{{--<a href="{{action('ComisionControlador@getPago', $comision->id)}}" name="id" value="{{{$comision->comision_id}}}"  title="Ver detalles de pagos" class="btn btn-xs btn-default"><i class="fa fa-search"></i></a>--}}
									@if($comision->pagada == 0)
									<a href="{{action('ComisionControlador@getPagada', $comision->id)}}" name="id" value="{{{$comision->id}}}"  title="pagar" class="btn btn-xs btn-default"><i class="fa fa-shopping-cart"></i></a>
								
									@endif
									
									@if($comision->pagada == 0)
									<span class="label label-warning">Activa</span></td>												


												@else												
												<span class="label label-success">Pagada</span></td>
												
													@endif
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
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
            	<div class="modal-header">
                	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    	<h4 class="modal-title"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Agregar un archivo excel</h4>
                </div>
                <div class="modal-body"> <!-- en action mando a llamar el Controlador@function (anteponiendo el post) -->
               		<!-- contenido modal -->
{{ Form::open(array('action' => 'ComisionControlador@postArchivo', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'upload_file','files' => true )) }}
					
				
 <div class="form-group">
                                  <label class="col-lg-3 control-label">Fecha Inicio</label>
                                  <div class="col-lg-6">
                                   @if($errors->has('fecha')) 


                                   <div align="center" class="alert alert-danger alerta">{{$errors->first('fecha')}}</div> @endif
                                     <p> <input type="text" id="datepicker" name="fecha_inicio"></p>   
                                  </div>
                      </div>      
	         	 <div class="form-group">
	            <label class="col-lg-3 control-label">Archivo</label>
	            <div class="col-lg-6"> 
	            	<span class="btn btn-info btn-file">
                            <i class="fa fa-upload" aria-hidden="true"></i> Examinar... <input type="file" name="archivo">
                        </span> 	
                        <span class="feedback"></span>             
	         	</div>
	         	</div>	

               		<!-- contenido modal -->
                </div>
                <div class="modal-footer">
                	<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
                </div>
            </div>
		</div>
	</div>
  {{ Form::close() }}

	@foreach($comisiones as $comision)
	<!--Ventanas modales -->
					@include('formularios.pago_comision', 
					array('modalId' => $comision->id,
					'modalTitle' =>  'Historial de pagos de comisión',
					'modalOk' => 'Agregar',					
					'modalIcon' => 'search',
					'cliente' => $comision,
					'modalCancel' => 'Cancelar'))
					<!-- fin ventanas modales -->
	@endforeach

@stop