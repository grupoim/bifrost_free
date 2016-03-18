@section('module')
{{-- ocultar mensajes de alerta automaticamente =======--}}
    
<script type="text/javascript">
      window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 2000);
    </script>
    {{-- fin ocultar mensajes de alerta automaticamente ======= --}}


<!-- Matter -->
	<div class="widget">
    	<div class="widget-head">
    	<!-- mensaje de exito al ingresar registro -->
		
		<?php $status=Session::pull('status'); ?>
		@if($status=='ok_create')
    	<div class="alert alert-success alert-dismissible" role="alert" align="center">
		 
		  <strong><h4> El registro se agregó con éxito</h4></strong> 
		</div>	    	

    	@endif

    	<!-- mensaje de exito al cancelar registro -->
		
    	@if($status=='ok_cancel')
    	<div class="alert alert-danger alert-dismissible" role="alert" align="center">
		 
		  <strong><h4> El registro se ha dado de baja</h4></strong>
		  </div>		  	

    	@endif
    	<!-- mensaje de exito al Activar registro -->

    	@if($status=='ok_activar')
    	<div class="alert alert-success alert-dismissible" role="alert" align="center">
		 
		 <strong><h4> El registro se reactivado</h4></strong>
		</div>    	

    	@endif
<!-- mensaje de exito al editar registro -->

    		@if($status=='ok_update')
    	<div class="alert alert-info alert-dismissible" role="alert" align="center">
		 
		 <strong><h4> Registro actualizado!!</h4></strong>
		</div>	

    	@endif


            <div class="pull-left"> <strong>Listas de asistencia</strong> </div>
			<div class="pull-right"><a  type="btn" href="{{{URL::to('personal-operativo/agregarperiodo')}}}" class="btn btn-m btn-default" id="btn_send" title="Agregar un nuevo periodo"><i class="fa fa-plus"></i> Agregar periodo</a> </div>

            <div class="clearfix"></div>
        </div>
        <div class="widget-content">
            <div class="padd">  
            
				<!-- Table Page -->
				<div class="page-tables">
					<!-- Table -->
					<div class="table-responsive">
						<table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%" align="center" >
							<thead>
								<tr>
									<th><strong>Id</strong></th>
									<th><strong>Inicio</strong></th>
									<th><strong>Fin</strong></th>
									<th><strong>Estatus</strong></th>
									<th>Acciones</th>
																		
								</tr>
							</thead>
							<tbody>
							@foreach($listas as $lista)
									<tr>
										<td> {{{$lista->id}}} </td>
										
										
										<td> {{{date("d-m-Y", strtotime($lista->fecha_inicio))}}} </td>
										<td> {{{date("d-m-Y", strtotime($lista->fecha_fin))}}} </td>
										
											<td>
											 @if ( $lista->activa == 1 )										

													<span class="label label-success">Activa</span></td>												


												@else												
												<span class="label label-warning">Cerrada</span></td>
												
													@endif
										<td> <a  type="btn" href="{{URL::to('personal-operativo/asistencia/'.$lista->id)}}" class="btn btn-sm btn-default" id="btn_send" title="ver detalles"><i class="fa fa-search"></i></a> 
											 <a  type="btn" href="{{URL::to('personal-operativo/nomina/'.$lista->id)}}" class="btn btn-sm btn-default" id="btn_send" title="Pagos de nomina"><i class="fa fa-usd"></i></a> 
												@if($lista->activa == 1) 

										    	@if((Auth::user()->departamento->id == 4) or (Auth::user()->departamento->id == 1 ))
										    	<a  type="btn" href="{{URL::to('personal-operativo/cierraperiodo/'.$lista->id)}}" class="btn btn-m btn-default" id="btn_send" title="Cierra periodo"><i class="fa fa-lock"></i> Cerrar</a>
												@else
												<span class="label label-info">Abierta</span></td>
												@endif

												@else
												@if((Auth::user()->departamento->id == 4) or (Auth::user()->departamento->id == 1 ))
												<a  type="btn" href="{{URL::to('personal-operativo/abreperiodo/'.$lista->id)}}" class="btn btn-m btn-default" id="btn_send" title="Abre periodo"><i class="fa fa-unlock"></i> Abrir</a>
												@else
												<span class="label label-warning">Revisada</span></td>
												@endif
												@endif
										</td>										
										                   
										
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

@stop