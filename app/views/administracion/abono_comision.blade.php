@section('scripts')
<script src="{{ URL::asset('js/chosen.jquery.js') }}"> </script>
<link href="{{ URL::asset('css/chosen.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/jquery.growl.js') }}" ></script>
<link rel="stylesheet" href="{{ URL::asset('css/jquery.growl.css') }}"> 

<script type="text/javascript">
$(document).on('ready', function(){	


//console.log($.support);







$("#guardar").on("click", function() { /* Al boton guardar le asigno el evento onClick */
				$("#addAbono").submit();
			});

//busqueda de ventas activas

$("#ventas").chosen({   
		    no_results_text: "No hay resultados para:",        
		    width: "100%"    
		  });	

		  $("#asesor_id").chosen({   
		    no_results_text: "No hay resultados para:",        
		    width: "100%"    
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
		<div class="pull-left">
		
		@if($pendientes > 0) {{{$pendientes}}} Abonos pendientes por revisar
		@else Pagos del {{{date("d-M-Y", strtotime($periodo_comision->fecha_inicio))}}} al {{{date("d-M-Y", strtotime($periodo_comision->fecha_fin))}}} @endif Folio <strong>{{{$periodo_comision->folio}}}</strong></div>		
		
		<div class="clearfix">
		
				<div class="pull-right">
					<a href="#myModal" data-toggle="modal" rel="#modal-form" title="Añade un pago al presente folio " class="btn btn-success" id="btnabono" ><i class="fa fa-plus" aria-hidden="true"></i> Abono</a>
					@if($pendientes == 0)
						<a href="{{action('ComisionControlador@getDownload', $periodo_comision->id)}}" title="Consulta para alta en Sistema PFG" class="btn btn-primary" data-toggle="modal" id="btnsql"><i class="fa fa-download" aria-hidden="true"></i> Alta en Sist. PFG</a> 
						<a href="{{action('ComisionControlador@getPdftotales', $periodo_comision->id)}}"  title="Descarga los totales a recibir por vendedor en un archivo pdf"class="btn btn-default" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i></i> Reporte</a> 
						
					@endif
			
				</div> 
		
		</div>

	</div>
	<div class="widget-content">
		<div class="padd">
			@if(count($abonos) > 0)
			<!-- Table Page -->
			<div class="page-tables">
				<!-- Table -->
				<div class="table-responsive">
					 <table id="table" class="table table-striped table-bordered display" cellpadding="0" cellspacing="0" border="0">
						<thead>
							<tr>
								<th class="text-center">ID</th>							
								<th class="text-center col-md-1">Folio</th>
								<th class="text-center col-md-3"> Cliente</th>
								<th class="text-center col-md-3"> Vendedor</th>
								<th class="text-center col-md-2">Monto</th>
								<th class="text-center col-md-3">estatus</th>

								<th>Operaciones</th>

							</tr>
						</thead>
						<tbody>
							@foreach($abonos as $abono)
							


							{{ Form::open(array('action' => 'ComisionControlador@postAbono', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'abono')) }}
							<tr>
								<td class="text-center">{{{$abono->id}}}</td>
								<td><strong>{{{ $abono->folio }}}</strong></td>
								<td> {{{$abono->cliente}}}</td><td>{{{$abono->abono_asesor}}} @if($abono->vendedor <> $abono->abono_asesor) <span class="label label-warning" ><i  class="fa fa-exclamation-triangle" aria-hidden="true"></i> No pertenece al vendedor</span> @endif </td>
								<td class="text-right"><input type="number" step="any"class="form-control" placeholder="0" name="abono_comision" value="{{{$abono->monto_abono}}}"></td>								
								<td><button type="submit" class="btn btn-m btn-default " id="btn_send" ><i class="fa fa-floppy-o"></i> </button> 									
									
									 <a id="activa" class="btn btn-m  activa btn-default" href="{{URL::to('comision/deleteabono/'.$abono->abono_comision_id)}}" title="Dar de Baja a"> <i class="fa fa-trash-o activa"></i></a>
								{{{round(($abono->pagado * $abono->numero_pagos)/$abono->total_comisionable)}}}	de {{{$abono->numero_pagos}}}
								</td>
								<td>@if($abono->abono_pagado == 0)
									<span class="label label-danger">Activa</span>												


												@else												
												<span class="label label-success">Pagada</span>
												
													@endif	
										@foreach($advertencias as $advertencia)	
									@if($advertencia->comision_id == $abono->id)
									
										<span class="label label-danger" title="{{{$advertencia->motivos}}}">Advertencia</span></td>
									@endif
									@endforeach									

							</td>
							</tr>	  		

							<input type="hidden" name="abono_comision_id" value="{{{$abono->abono_comision_id}}}">
							<input type="hidden" name="comision_id" value="{{{$abono->id}}}">

							{{form::close()}}
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
		<div class="clearfix"></div>

		<table class="table table-hover">
		<thead>
			<tr>
				<th>Asesor</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			@foreach($totales_vendedores as $vendedor)
			<tr>
				<td> {{{$vendedor->asesor}}}</td>
				<td> {{{$vendedor->total}}}</td>
			</tr>
			@endforeach			
		</tbody>
	</table>
	</div>

	<div class="widget-foot">		
		<div class="clearfix"></div>

		<table class="table table-hover">
		<thead>
			<tr>
				<th>Asesor</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			@foreach($promotorias as $promotor)
			<tr>
				<td> {{{$promotor->promotor}}}</td>
				<td> {{{$promotor->total_promotoria}}}</td>
			</tr>
			@endforeach			
		</tbody>
	</table>
	</div>
</div>

  {{ Form::close() }}


  <!--  modal -->
 <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
            	<div class="modal-header">
                	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    	<h4 class="modal-title">Agregar un pago al folio actual</h4>
                </div>
                <div class="modal-body"> <!-- en action mando a llamar el Controlador@function (anteponiendo el post) -->
               		<!-- contenido modal -->

{{ Form::open(array('action' => 'ComisionControlador@postAddabono', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'addAbono')) }}
<div class="form-group">
	<label for="sector" class="col-md-3 control-label">Venta </label>
	<div class="col-md-9">
			<select data-placeholder="Elije una Venta activa..." class="form-control" name="comision_id" id="ventas" class="form-control ventas chosen-select" required >                                
            		<option> </option>
             	@foreach($comisiones_activas as $comision)

				
            		<option value="{{$comision->id}}"> Id: {{{$comision->id}}} {{{$comision->cliente}}} Folio: {{{$comision->folio_solicitud}}} </option>
             	

            	 @endforeach 
       
         </select> <br>     
		
	</div>
</div>
<div class="form-group">
	<label for="sector" class="col-md-3 control-label">Vendedor </label>
	<div class="col-md-9">
			<select  data-placeholder="Elije un vendedor..." class="form-control" name="asesor_id" id="asesor_id" class="form-control asesor_id chosen-select"  required>                                
            
             	<option> </option>
             	@foreach($asesores as $asesor)

				
            		<option value="{{$asesor->asesor_id}}"> {{{$asesor->asesor}}} </option>
             	

            	 @endforeach 
       
         </select> <br>
     
		
		<input type="hidden" id="periodo_comision_id" name="periodo_comision_id" value="{{{$periodo_comision->id}}}">
		<input type="hidden" name="usuario_id" value="{{ Auth::user()->id}}">
		
	</div>
</div>

<div class="form-group">
	<label for="sector" class="col-md-3 control-label">Monto </label>
	<div class="col-md-9">
	        
      	<input type="number" step="any"class="form-control" placeholder="$0.0" name="monto">     
		
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

	
@stop