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


            <div class="pull-left"> <strong>Catálogo de trabajadores</strong> </div>
	<!-- Button Group -->
    	<div class="btn-group pull-right">
    	<a href= "{{ action('PersonalOperativoControlador@getAgregar') }}" class="btn btn-primary" ><i class="fa fa-user-plus"></i> Nuevo </a>     	
      	
      	{{--	<a href= "modalform" class="btn btn-default async-modal" rel="{{action('PersonalOperativoControlador@getCreate')}}" data-toggle="modal"><i class="fa fa-user-plus"></i>Nuevo </a>--}}
      		     		
      		<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle"
          data-toggle="dropdown">
   <i class="fa fa-print"></i>Listas<span class="caret"></span>
  </button>
 
  <ul class="dropdown-menu" role="menu">
    <li><a href="#">Mantenimiento</a></li>
    <li><a href="#">Recubrimientos</a></li>
    <li><a href="#">Construcción</a></li>
      </ul>
</div>

    	</div>

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
									<th><strong>ID</strong></th>
									<th><strong>NOMBRE</strong></th>
									<th><strong>DEPARTAMENTO</strong></th>
									<th><strong>PUESTO</strong></th>
									<th><strong>FECHA DE INGRESO</strong></th>
									<th><strong>ESTATUS</strong> </th>
									<th align="center"><strong>OPERACIONES </strong></th>

																		
								</tr>
							</thead>
							<tbody>
							@foreach($empleados as $empleado)
									<tr>
										<td> {{{$empleado->id}}} </td>
										<td> {{{Str::title($empleado->nombres). " ".Str::title($empleado->apellido_paterno)." ".Str::title($empleado->apellido_materno)}}}</td>	
										<td> {{{Str::title($empleado->departamento)}}} </td>
										<td> {{{Str::title($empleado->puesto)}}} </td>
										
										<td> {{{date("d-m-Y", strtotime($empleado->fecha_ingreso))}}} </td>
										
											<td> @if ( $empleado->activo == 1 )										

													<span class="label label-success">Activo</span></td>												


												@else												
												<span class="label label-warning">Inactivo</span></td>
												
													@endif										
										 <td align="center">
										
										 <input type="hidden" name="persona_id" value="{{$empleado->persona_id}}">
			                               <!--//editar 2.0 -->
			                              <a href= "{{action('PersonalOperativoControlador@getRecupera', $empleado->id)}}"class="btn btn-xs btn-info" value ="{{$empleado->id}}" title="Editar a {{{Str::title($empleado->nombres)}}}"><i class="fa fa-pencil"></i> </a>
			                               <!--//editar 2.0 -->

			                             @if($empleado->activo == 1)

			                             
			                             <a class="btn btn-xs btn-success" href="{{URL::to('personal-operativo/baja/'.$empleado->id)}}" title="Dar de Baja a  {{{Str::title($empleado->nombres)}}}"> <i class="fa fa-check"></i></a>
			                             

			                              @else 
			                           

			                             <a class="btn btn-xs btn-danger" href="{{URL::to('personal-operativo/activar/'.$empleado->id)}}" title="Reactivar {{{Str::title($empleado->nombres)}}}"> <i class="fa fa-user-times"></i></a>
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
{{-- @include('modalframe') --}}
@stop