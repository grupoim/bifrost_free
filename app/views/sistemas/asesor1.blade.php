@section('module')
	
<div class="row" id="nichos"> <!-- empieza el renglon del elemento lotes, y cierra hasta el segundo bloque donde estan los  nichos, 
    la clase "col-md-6 asigna el tamaño al bloque" -->
        <div class="col-md-7">

<!-- Matter -->
	<div class="widget">
    	<div class="widget-head">
            <div class="pull-left">Asesores y Promotores</div>
	<!-- Button Group -->
    	<div class="btn-group pull-right">
      		<button href="#myModal" class="btn btn-default" data-toggle="modal"><i class="fa fa-plus-square"></i> Nuevo </button>

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
									<th>ID</th>
									<th>Nombre del Asesor</th>
                                    <th>Promotoria</th>
									<th>Estatus</th>
									<th>Control</th>
								</tr>
							</thead>
							<tbody>
								@foreach($vendedores as $vendedor)
                                
									<tr>
										<td> {{{ $vendedor->id_asesor }}} </td>
										
										<td> {{{$vendedor->persona->nombres}}} {{{$vendedor->persona->apellido_paterno}}} {{{$vendedor->persona->apellido_materno}}}</td> 
                                        <td>                        
                                        {{{$vendedor->promotoria}}}
                                        </td>  
										
                                        <td> @if ( $vendedor->activo == 1 ) 
												<span class="label label-success"> Activo </span> </td>
											 @else 
											 	<span class="label label-danger"> Cancelado </span> </td>
											 @endif
										</td>
  			                            <td value="{{{ $vendedor->id_asesor }}}">
                              				<button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> </button>
                              				<button class="btn btn-xs btn-danger"><i class="fa fa-times"></i> </button>
                          				</td>
									</tr>
                                   
								@endforeach
							</tbody>
							<tfoot>
								
							</tfoot>
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
<!-- Matter ends -->

	<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
            	<div class="modal-header">
                	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    	<h4 class="modal-title"> Registrar a un Asesor y/o Promotor </h4>
                </div>
                <div class="modal-body"> <!-- en action mando a llamar el Controlador@function (anteponiendo el post) -->
               		{{ Form::open(array('action' => 'AsesorControlador@postCrearRegistro', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'formaasesor')) }}
                        <div class="form-group">
                        	<label class="col-lg-4 control-label"> Nombre(s): </label>
                            <div class="col-lg-6">
                            	<input type="text" class="form-control" placeholder="Nombre(s)" id="nombres" name="nombres">
                            </div>                            
                        </div>
                        <div class="form-group">
                        	<label class="col-lg-4 control-label"> Apellido Paterno: </label>
                            <div class="col-lg-6">
                            	<input type="text" class="form-control" placeholder="Apellido Paterno" id="apellido_paterno" name="apellido_paterno">
                            </div>                            
                        </div>  
                        <div class="form-group">
                        	<label class="col-lg-4 control-label"> Apellido Materno: </label>
                            <div class="col-lg-6">
                            	<input type="text" class="form-control" placeholder="Apellido Materno" id="apellido_materno" name="apellido_materno">
                            </div>                            
                        </div>  

                        <div class="form-group">
                            <label class="col-lg-4 control-label"> Promotoría: </label>
                            <div class="col-lg-6">
                            	<label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" value="True"> ¿Es Promotor?
                                </label>
                                <select class="form-control" id="promotor_id" name="promotor_id"> 
                                    @foreach ($promotores as $promotor)
                                        <option value="{{{ $promotor->id }}}"> {{{ $promotor->Promotor }}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 

					{{ Form::close() }}
                </div>
                <div class="modal-footer">
                	<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
                </div>
            </div>
		</div>
	</div>

	<script src="{{ URL::asset('js/jquery.js') }}"> </script> <!-- jQuery -->	

	<script>
		$(document).on("ready",function() {  /* Cuando la pagina este totalmente cargada */
			$("#guardar").on("click", function() { /* Al boton guardar le asigno el evento onClick */
				$("#formaasesor").submit();
			});
		});
	</script> 

    </div>
    </div>
@stop