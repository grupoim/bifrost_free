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
		<a href="#myModal" class="btn btn-primary" data-toggle="modal"><i class="fa fa-bullhorn"></i> Nueva Queja </a></div>
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
						<div class="table-responsive" id="StudentTableContainer">
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
										<th>Acciones</th>

									</tr>
								</thead>
								<tbody>
									@foreach($quejas as $queja)									
									<tr @if($queja->aplica == 1) class="disabled" @elseif($queja->gravedad == 1) class="gravedad" @endif> 
										<td> {{{$queja->id}}}</td>
										<td>{{{ $queja->created_at->format('d/m/Y') }}}</td>										
										<td> {{{$queja->rubro->descripcion}}}</td>
										<td>{{{$queja->rubro->departamento->nombre}}}</td>
										<td> {{{Str::title($queja->usuario->nombre)}}}</td>																				
										<td title="{{{$queja->descripcion}}}"> {{{str_limit($queja->descripcion, $limit = 25, $end = '...')}}}</td>
										
										<td class="text-center"> @if ( $queja->cerrada == 1 )									
													<span class="label label-danger">Cerrada</span> </td>	

												@else							@if($queja->numero_mensajes > 0)
														<span class="label label-success">Activa</span>
													@else
													<span class="label label-primary">Nueva</span>
													@endif
												@endif
																	 
										</td>			
										<td>
										@if ($queja->aplica == 0 and $queja->cerrada == 0 )										
										
										@if(Auth::user()->jefe == 1 and Auth::user()->id <> $queja->usuario_id )
										<a class="btn btn-xs btn-default" href="{{action('QuejaControlador@getCerrar', $queja->id)}}" title="Cerrar queja"><i class="fa fa-check"></i></a>
										<a class="btn btn-xs btn-default" href="{{action('QuejaControlador@getNoaplica', $queja->id)}}" title="No aplica como queja"><i class="fa fa-thumbs-o-down"></i></a>
										@endif
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
               		<!-- contenido modal -->

{{ Form::open(array('action' => 'QuejaControlador@postAgregar', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'new_queja','files' => true )) }}
					
					<div class="form-group">
	                  <label class="col-md-2 control-label">Rubro</label>
	                  <div class="col-md-5">
	                    <div class="input-group">                   

                                <select class="form-control" name="rubro_id">

									<optgroup label="Administración">
									@foreach($rubros as $rubro)
									@if ($rubro->departamento_id == 6 )
									<option value="{{{$rubro->id}}}">{{{$rubro->descripcion}}}</option>                                      
									@endif
									@endforeach
									</optgroup>

									<optgroup label="Mantenimiento">
									@foreach($rubros as $rubro)
									@if ($rubro->departamento_id == 2)
									<option value="{{{$rubro->id}}}">{{{$rubro->descripcion}}}</option>                                      
									@endif
									@endforeach
									</optgroup>

									<optgroup label="Recubrimientos">
									@foreach($rubros as $rubro)
									@if ($rubro->departamento_id == 3)
									<option value="{{{$rubro->id}}}">{{{$rubro->descripcion}}}</option>                                      
									@endif
									@endforeach
									</optgroup>

									<optgroup label="Ventas">
									@foreach($rubros as $rubro)
									@if ($rubro->departamento_id == 5)
									<option value="{{{$rubro->id}}}">{{{$rubro->descripcion}}}</option>                                      
									@endif
									@endforeach
									</optgroup>

									<optgroup label="Trámites">
									@foreach($rubros as $rubro)
									@if ($rubro->departamento_id == 4 or $rubro->departamento_id == 7 )
									<option value="{{{$rubro->id}}}">{{{$rubro->descripcion}}}</option>                                      
									@endif
									@endforeach
									</optgroup>

									
									</select>

					        </div>
					    </div>
					</div>

					<div class="form-group">
                                  <label class="col-lg-2 control-label">Queja</label>
                                  <div class="col-lg-10">
                                    <textarea id="descripcion" name="descripcion" focus placeholder="Escriba su queja"  class="form-control" required></textarea>
									<input type="hidden" name="usuario_id" value="{{ Auth::user()->id}}">
                                  </div>
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
	            <div class="col-lg-10"> 
	            	<span class="btn btn-info btn-file">
                            <i class="fa fa-photo"></i> Examinar... <input type="file" name="foto">
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
@stop