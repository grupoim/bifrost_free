@section('scripts')
<script>

      window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 1000);
      	$(document).on("ready",function() {  /* Cuando la pagina este totalmente cargada */
			$("#guardar").on("click", function() { /* Al boton guardar le asigno el evento onClick */
				$("#new_queja").submit();
			});
		});


$('.modalSubmit').on("click", function(){
		 	$.post('{{ action('QuejaControlador@postAgregar') }}',
		 		$(this).parent().parent().find('form').serialize()
		 		).done(function(data){
		 			if(data.length > 0){	
		 				$('#queja').html('');		 				
		 				$.each(data, function(index, object){
		 					$('#queja').append('<tr>'		 						
		 						+ '<td class="lead">' + object.rubro_id + '</td>'
		 						+ '<td class="lead">' + object.usuario_id + '</td>'
		 						+ '<td class="lead">' + object.descripcion + '</td>'
		 						+ '</tr>');		 					
		 				});		 				
		 			}
		 		});
		 	$(this).parent().parent().parent().parent().modal('hide');
  		});

</script>
@stop
@section('module')

 <div class="row">
	<div class="col-md-12">
		<div class="btn-group pull-left">
		{{--<a href="#agregarQueja" data-toggle="modal" rel="#modal-form"><i class="fa fa-plus-square-o"></i> Nuevo</a>--}}
		
		</div>		 
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="widget">
			<div class="widget-head">			
		<div class="btn-group pull-right">
		<a href="#myModal" class="btn btn-default" data-toggle="modal"><i class="fa fa-cog fa-spin"></i> Nueva Queja </a></div>
    	<?php $status=Session::pull('status'); ?>
    	@if($status=='no_aplica')
    	<div class="alert alert-danger alert-dismissible" role="alert" align="center">
		 
		  <strong><h4> Queja no válida</h4></strong>
		  </div>		  	

    	@endif
    	<!-- mensaje de exito al Activar registro -->

    	@if($status=='cerrada')
    	<div class="alert alert-success alert-dismissible" role="succcess" align="center">
		 
		 <strong><h4> Queja cerrada</h4></strong>
		</div>    	

    	@endif

    	@if($status=='nueva')
    	<div class="alert alert-success alert-dismissible" role="info" align="center">
		 
		 <strong><h4> Nueva queja creada</h4></strong>
		</div>    	

    	@endif

			<!-- fin mensajes acciones -->
				<div class="pull-left">Historial de Quejas</div>
				<div class="widget-icons pull-right">
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
										<th>Fecha</th>
										<th>Rubro</th>
										<th>Departamento</th>
										<th>Usuario</th>										
										<th>Descripcion corta</th>
										<th>Estatus</th>
										<th>Historial</th>
										<th>Acciones</th>

									</tr>
								</thead>
								<tbody>
									@foreach($quejas as $queja)

									
									<tr> 
										<td> {{{$queja->id}}}</td>
										<td>{{{date("d-m-Y", strtotime($queja->created_at))}}}</td>										
										<td>{{{$queja->rubro->descripcion}}}</td>
										<td>{{{$queja->rubro->departamento->nombre}}}</td>
										<td> {{{Str::title($queja->usuario->nombre)}}}</td>																				
										<td title="{{{$queja->descripcion}}}"> {{{str_limit($queja->descripcion, $limit = 25, $end = '...')}}}</td>
										
										<td> @if ( $queja->cerrada == 0 )										

													<span class="label label-success">Activa</span> @if ($queja->gravedad == 1) <span class="label label-warning"><i class="fa fa-exclamation-triangle"></i> Prioridad</span>@endif</td>												


												@else												
												<span class="label label-danger">Cerrada</span></td>
												
													@endif
																	 
													
										<td>@if ($queja->numero_mensajes > 0 and $queja->aplica == 0 and $queja->cerrada == 0 )
																						
													<span class="label label-info">Atendiendo</span></td>												

												@elseif ($queja->aplica == 1 )
																								
												<span class="label label-default">No aplica</span></td>
												
												@elseif ( $queja->aplica == 0 and $queja->cerrada == 0)
													
													<span class="label label-warning">Pendiente</span></td>

												@elseif ( $queja->aplica == 0 and $queja->cerrada == 1)
													
													<span class="label label-success">Finalizada</span></td>

												@elseif ( $queja->aplica == 0 and $queja->cerrada == 1 and $queja->numero_mensajes < 0 )
													
													<span class="label label-success">Finalizada</span></td> <!--finalizada con historial-->

													@endif			
									<td>
										@if ($queja->aplica == 0 and $queja->cerrada == 0)										
										<a class="btn btn-xs btn-default" href="{{action('QuejaControlador@getCerrar', $queja->id)}}" title="Cerrar queja"><i class="fa fa-check"></i></a>
										<a class="btn btn-xs btn-default" href="{{action('QuejaControlador@getNoaplica', $queja->id)}}" title="No aplica como queja"><i class="fa fa-thumbs-o-down"></i></a>
										@else
										@endif
										<a class="btn btn-xs btn-default" href="{{action('QuejaControlador@getRecupera', $queja->id)}}" class="btn btn-info " title="Ver Historial"><i class="fa fa-search"></i></a> 											
										
									</td>
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
				<!-- Footer goes here -->
			</div>
		</div>
	</div>  
</div>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
            	<div class="modal-header">
                	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    	<h4 class="modal-title">Registrar una Queja</h4>
                </div>
                <div class="modal-body"> <!-- en action mando a llamar el Controlador@function (anteponiendo el post) -->
               		{{ Form::open(array('action' => 'QuejaControlador@postAgregar', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'new_queja','files' => true )) }}
<div class="form-group">
	<label for="sector" class="col-md-3 control-label">Asunto de la queja </label>
	<div class="col-md-9">
			<select class="form-control" name="rubro_id" id="rubro_id" >                                
            
             	@foreach($rubros as $rubro)

				
            		<option value="{{$rubro->id}}"> {{{$rubro->descripcion}}}</option>
             	

            	 @endforeach 
       
         </select> <br>   
		
	</div>
</div>
<div class="form-group">
	<label for="queja" class="col-md-3 control-label">Queja </label>
	<div class="col-md-9">
		<textarea id="descripcion" name="descripcion" focus placeholder="Escriba su queja"  class="form-control" required></textarea>
		<input type="hidden" name="usuario_id" value="{{ Auth::user()->id}}">
		
	</div>
	 <div class="form-group">
	            <label class="col-lg-2 control-label">Gravedad</label>
	            <div class="col-lg-5">							             	                
	                
            
	                <div>
	                 	{{form::radio('gravedad', '0', true)}}
	                  	{{form::label ('normal', 'Normal')}}
	                 </div>
	                 <div>
	                 	{{form::radio('gravedad', '1')}} 	                 
	                  	{{form::label ('alta', 'Alta')}}
	                 </div>
	              							              
	         	</div>
	         	</div>
	         	 <div class="form-group">
	            <label class="col-lg-2 control-label">Evidencia</label>
	            <div class="col-lg-5"> 
	            {{ Form::file('foto') }}	              
	         	</div>
	         	</div>
</div>
 
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