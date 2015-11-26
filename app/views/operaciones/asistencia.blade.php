@section('scripts')
<script type="text/javascript">	
      


 @foreach($asistencias as  $empleado)
   $("#marcarTodo{{{$empleado->id}}}").change(function () {
    if ($(this).is(':checked')) {
        //$("input[type=checkbox]").prop('checked', true); //todos los check
        $("#diasHabilitados{{{$empleado->id}}} input[type=checkbox]").prop('checked', true); //solo los del objeto #diasHabilitados
    } else {
        //$("input[type=checkbox]").prop('checked', false);//todos los check
        $("#diasHabilitados{{{$empleado->id}}} input[type=checkbox]").prop('checked', false);//solo los del objeto #diasHabilitados
    }
});
   @endforeach  

</script>
<script type="text/javascript">
	$(document).on('ready', function(){
		@if($lista->activa == 0)
		$('.activa').prop('disabled', true);

		@endif
   	});	
</script>


@stop()
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


            <div class="pull-left"> <strong>Lista de asistencia del {{{date("d/M/Y", strtotime($lista->fecha_inicio))}}} al {{{date("d/M/Y", strtotime($lista->fecha_fin))}}}</strong> </div>
	<!-- Button Group -->
    	<div class="btn-group pull-right">
    	@if($lista->activa == 1) 

    	@if((Auth::user()->departamento->id == 4) or (Auth::user()->departamento->id == 1 ))
    	<a  type="btn" href="{{URL::to('personal-operativo/cierraperiodo/'.$lista->id)}}" class="btn btn-m btn-default" id="btn_send" title="Clic"><i class="fa fa-unlock"></i> Cerrar asistencia</a>
		@endif
		@else
		@if((Auth::user()->departamento->id == 4) or (Auth::user()->departamento->id == 1 ))
		<a  type="btn" href="{{URL::to('personal-operativo/abreperiodo/'.$lista->id)}}" class="btn btn-m btn-default" id="btn_send" title="Clic"><i class="fa fa-lock"></i> Abrir asistencia</a>
		@else
		<a  type="btn" href="#" class="btn btn-m btn-danger" title="Esta lista se encuentra cerrada, ya fue revisada por Julio"><i class="fa fa-lock"></i> Lista Revisada</a>
		@endif
		@endif
    	</div>

            <div class="clearfix"></div>
        </div>
        <div class="widget-content">
            <div class="padd"> 
                                                       
				<!-- Table Page -->
				<div class="page-tables">
					<!-- Table -->
					<div class="table-responsive">
						<table cellpadding="0" cellspacing="0" border="0"  width="100%" align="center" >
							<thead>
								<tr>
									<th>#</th>
									<th><strong>Nombre</strong></th>
									<th><strong>Departamento</strong></th>
									<th>Sabado</th>
									<th>Domingo</th>
									<th>Lunes</th>
									<th>Martes</th>
									<th>Miercoles</th>
									<th>Jueves</th>
									<th>Viernes</th>
									<th align="center"><strong>Observaciones</strong></th>
									<th>Operaciones</th>
																		
								</tr>
							</thead>
							<tbody> 
							@foreach($asistencias as $ctr => $empleado)
							{{ Form::open(array('action' => 'PersonalOperativoControlador@postAsis', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'historial','files' => true)) }}
									<tr>
										<td> {{{$ctr+1}}} </td>										
										<td> {{{Str::title($empleado->empleado)}}}</td>	
										<td> {{{Str::title($empleado->departamento)}}}</td>	
																				
										<td><div id="diasHabilitados{{{$empleado->id}}}"> <input class="activa" type="checkbox" id="chs{{{$empleado->id}}}" name="sabado" @if($empleado->sa == 1) checked="true"  @endif > </div></td>                 
										<td><div id="diasHabilitados{{{$empleado->id}}}"> <input class="activa" type="checkbox" id="ch{{{$empleado->id}}}" name="domingo" @if($empleado->do == 1) checked="true"  @endif > </div></td>
										<td><div id="diasHabilitados{{{$empleado->id}}}"> <input class="activa" type="checkbox" id="ch{{{$empleado->id}}}" name="lunes" @if($empleado->lu == 1) checked="true"    @endif > </div></td>
										<td><div id="diasHabilitados{{{$empleado->id}}}"> <input class="activa" type="checkbox" id="ch{{{$empleado->id}}}" name="martes" @if($empleado->ma == 1) checked="true"   @endif > </div></td>
										<td><div id="diasHabilitados{{{$empleado->id}}}"> <input class="activa" type="checkbox" id="ch{{{$empleado->id}}}" name="miercoles" @if($empleado->mi == 1) checked="true" @endif > </div></td>
										<td><div id="diasHabilitados{{{$empleado->id}}}"> <input class="activa" type="checkbox" id="ch{{{$empleado->id}}}" name="jueves" @if($empleado->ju == 1) checked="true" @endif > </div></td>
										<td><div id="diasHabilitados{{{$empleado->id}}}"> <input class="activa" type="checkbox" id="ch{{{$empleado->id}}}" name="viernes" @if($empleado->vi == 1) checked="true" @endif > </div></td>
										 <td> <textarea class="activa" name="observaciones"> @if($empleado->revisado == 1) {{{$empleado->observaciones}}} @endif</textarea> </td>
										 <td>
											  <input  type="checkbox" name="Todo" class="activa" id="marcarTodo{{{$empleado->id}}}" title="Marcar toda la semana" />
											   <button type="submit" class="btn btn-m btn-default activa" id="btn_send" ><i class="fa fa-floppy-o"></i> </button> 
											 @if($lista->activa == 1)
											 <a id="activa" class="btn btn-m btn-default activa" href="{{URL::to('personal-operativo/bajalista/'.$empleado->empleado_id)}}" title="Dar de Baja a  {{{Str::title($empleado->empleado)}}}"> <i class="fa fa-times activa"></i></a>
											@endif
										</td>

							<input type="hidden" name="asistencia_id" value="{{{$empleado->id}}}">
							<input type="hidden" name="empleado_id" value="{{{$empleado->empleado_id}}}">
							<input type="hidden" name= "lista_activa" value="{{{$lista->activa}}}">	
							{{form::close()}}
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
           
        </div>
        
    </div> 

@stop