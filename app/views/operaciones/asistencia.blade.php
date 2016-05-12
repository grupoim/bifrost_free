@section('scripts')
<script type="text/javascript">
	
</script>

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
	
    $('#example').DataTable();
    	
    	
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
						 <table id="table" class="table table-striped table-bordered display" cellpadding="0" cellspacing="0" border="0">
							<thead>
								<tr>
									<th>Check</th>
									<th><strong>Nombre</strong></th>
									<th><strong>Depto.</strong></th>
									<th>Sa</th>
									<th>Do</th>
									<th>Lu</th>
									<th>Ma</th>
									<th>Mi</th>
									<th>Ju</th>
									<th>Vi</th>	
									<th title="Prima Dominical">PD</th>
									<th>Semana</th>																		
									<th>Bono Mantenimiento</th>
									<th>H. Extra</th>
									<th align="center"><strong>Observaciones</strong></th>
									<th>Operaciones</th>
																		
								</tr>
							</thead>
							<tbody> 
							
							@foreach($asistencias as $ctr => $empleado)
							{{ Form::open(array('action' => 'PersonalOperativoControlador@postAsis', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'historial','files' => true)) }}
									<tr>
										<td>{{-- {{{$ctr+1}}} --}}@if($empleado->revisado == 1)
											<span class="label label-info"><i class="fa fa-check"></i></span>
											@else
											<span class="label label-warning"><i class="fa fa-warning "></i></span>
											@endif
											<input  type="checkbox" name="Todo" class="activa" id="marcarTodo{{{$empleado->id}}}" title="Marcar toda la semana" />
											</td>										
										<td> {{{Str::title($empleado->empleado)}}}</td>	
										<td> @if(Str::title($empleado->departamento) == 'Mantenimiento')Mtto.
											@elseif(Str::title($empleado->departamento) == 'Operaciones')Serv.
											@elseif(Str::title($empleado->departamento) == 'Recubrimientos')Recub.
											@elseif(Str::title($empleado->departamento) == 'Administracion')Adm.
											@else {{{Str::title($empleado->departamento)}}}
											@endif	
											</td>
																				
										<td><div id="diasHabilitados{{{$empleado->id}}}"> <input class="activa" type="checkbox" id="chs{{{$empleado->id}}}"name="sabado" title="Sábado" @if($empleado->sa == 1) checked="true"  @endif > </div></td>                 
										<td><div id="diasHabilitados{{{$empleado->id}}}"> <input class="activa" type="checkbox" id="ch{{{$empleado->id}}}" name="domingo" title="Domingo" @if($empleado->do == 1) checked="true"  @endif > </div>										</td>
										<td><div id="diasHabilitados{{{$empleado->id}}}"> <input class="activa" type="checkbox" id="ch{{{$empleado->id}}}" name="lunes" title="Lunes" @if($empleado->lu == 1) checked="true"    @endif > </div></td>
										<td><div id="diasHabilitados{{{$empleado->id}}}"> <input class="activa" type="checkbox" id="ch{{{$empleado->id}}}" name="martes"  title="Martes" @if($empleado->ma == 1) checked="true"   @endif > </div></td>
										<td><div id="diasHabilitados{{{$empleado->id}}}"> <input class="activa" type="checkbox" id="ch{{{$empleado->id}}}" name="miercoles"  title="Miercoles" @if($empleado->mi == 1) checked="true" @endif > </div></td>
										<td><div id="diasHabilitados{{{$empleado->id}}}"> <input class="activa" type="checkbox" id="ch{{{$empleado->id}}}" name="jueves" title="Jueves" @if($empleado->ju == 1) checked="true" @endif > </div></td>
										<td><div id="diasHabilitados{{{$empleado->id}}}"> <input class="activa" type="checkbox" id="ch{{{$empleado->id}}}" name="viernes" title="Viernes" @if($empleado->vi == 1) checked="true" @endif > </div></td>
										<td><div id="diasHabilitados{{{$empleado->id}}}"> <input class="activa" type="checkbox" id="ch{{{$empleado->id}}}" name="prima_dominical" title="Pagar prima dominical" @if($empleado->do == 1 and $empleado->prima_dominical == 1) checked="true" @endif > </div></td>
										<td>
										
										<label class="radio"><input type="radio" name="semana_completa" value="0" id="r1" @if($empleado->dias_trabajados < 8 or $empleado->semana_completa == 0) checked ="true" @endif >Normal</label>
        								<label class="radio"><input type="radio" name="semana_completa" value="1" id="r2" @if($empleado->dias_trabajados == 8 and $empleado->semana_completa == 1) checked ="true" @endif>Completa</label> 
							         
         								</td>
										<td> @if(Str::title($empleado->departamento) == 'Mantenimiento')<div class="col-xs-12"><input type="number" min="0"  class="form-control" placeholder="$0.00" id="bono_mtto" name="bono_mtto" value="{{{$empleado->bono_mtto}}}"> </div>  @endif  </td>
										<td><div class="col-xs-16"><input type="number" min="0" class="form-control" placeholder="0" id="hora_extra" name="hora_extra" value="{{{$empleado->hora_extra}}}"></td>
										<td><textarea  rows="3" class="activa" name="observaciones"> @if($empleado->revisado == 1) {{{$empleado->observaciones}}} @endif</textarea></td>
										 <td>
											   <button type="submit" class="btn btn-m btn-default activa" id="btn_send" ><i class="fa fa-floppy-o"></i> </button> 
											 @if($lista->activa == 1)
											 <a id="activa" class="btn btn-m btn-default activa" href="{{URL::to('personal-operativo/bajalista/'.$empleado->empleado_id)}}" title="Dar de Baja a  {{{Str::title($empleado->empleado)}}}"> <i class="fa fa-times activa"></i></a>
											@endif </td>

							<input type="hidden" name="asistencia_id" value="{{{$empleado->id}}}">
							<input type="hidden" name="empleado_id" value="{{{$empleado->empleado_id}}}">
							<input type="hidden" name= "lista_activa" value="{{{$lista->activa}}}">
							<input type="hidden" name= "departamento_id" value="{{{$empleado->departamento_id}}}">
							<input type="hidden" name= "dias_pago" value="{{{$empleado->dias_pagados}}}">	
							<input type="hidden" name= "nomina" value="{{{$empleado->salario_total}}}">
							<input type="hidden" name= "nomina_ss" value="{{{$empleado->ss}}}">	
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