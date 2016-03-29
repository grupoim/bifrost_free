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

	
   
    	
    	
   	});	
</script>


@stop()
@section('module')
{{-- ocultar mensajes de alerta automaticamente =======--}}
    
<script type="text/javascript">
      window.setTimeout(function() {
  $(".alerta").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 2000);
    </script>
    {{-- fin ocultar mensajes de alerta automaticamente ======= --}}

<!--////////////////////////// -->
<div class="widget">
                <div class="widget-head">
                  <div class="pull-left"></div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"> </i></a> 
                  
                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">

                    
                     <div class="alert  alert-dismissible alert-success" role="alert" align="center">
     
                   <strong><h3> <i class="fa fa-calculator"></i> Total ${{{number_format($total, 2, '.', ',')}}} </h3></strong>
                  </div>
                  @if($suma_ss > 0)
                   <div class="col-md-2">
                        <div class="well">
                          <h4><strong>S.S.</strong> ${{{number_format($suma_ss, 2, '.', ',')}}}</h4>
                        </div>
                   </div>
                   @endif
                   
                   @if($suma_h_extra > 0)
                   <div class="col-md-2">
                        <div class="well">
                          <h4><strong>H.E.</strong> ${{{number_format($suma_h_extra, 2, '.', ',')}}}</h4>
                  		</div>
                    </div>
                    @endif 

                    @if($suma_p_dominical > 0)
                    <div class="col-md-2">
                        <div class="well">
                          <h4><strong>P.D.</strong> ${{{number_format($suma_p_dominical, 2, '.', ',')}}}</h4>
                        </div>
                      </div>
                     @endif

                     @if($suma_otras_percepciones > 0)
                      <div class="col-md-2">
                        <div class="well">
                          <h4><strong>O.P.</strong> ${{{number_format($suma_otras_percepciones, 2, '.', ',')}}}</h4>                          
                        </div>
                      </div>
                     @endif

                      @if($suma_bono_mtto > 0)
                      <div class="col-md-2">
                        <div class="well">
                          <h4><strong>B.M.</strong> ${{{number_format($suma_bono_mtto, 2, '.', ',')}}}</h4>                                                  
                        </div>
                      </div>
                      @endif

                      @if($suma_infonavit > 0)
                      <div class="col-md-2">
                        <div class="well">
                          <h4><strong>INF.</strong> -${{{number_format($suma_infonavit, 2, '.', ',')}}}</h4>
                        </div>
                      </div>
                     @endif

                   @if($suma_abono_prestamo)
                    <div class="col-md-2">
                        <div class="well">
                          <h4><strong>PRE.</strong> -${{{number_format($suma_abono_prestamo, 2, '.', ',')}}}</h4>
                        </div>
                      </div>
                    @endif


          <!-- tabla de inventario -->
                    <div class="clearfix"></div>
                  </div> <!-- end pad-->
                  <div class="widget-foot">
                   <p class="p-meta">
                                                            <!-- Due date & % Completed -->
                                                           
                    <!-- Footer goes here -->
                  </div>
                </div>
              </div>
<!--///////////////////////// -->
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
    	<a  type="btn" href="{{URL::to('personal-operativo/asistencia/'.$lista->id)}}" class="btn btn-m btn-default" id="btn_send" title="Clic"><i class="fa fa-check"></i> Ver incidencias</a>
		@if($total_empleados == $revisados_contabilidad)
		<a  type="btn" href="{{URL::to('personal-operativo/excel/'.$lista->id)}}" class="btn btn-m btn-default" id="btn_send" title="Clic"><i class="fa fa-file-excel-o"></i> Exportar a Excel</a>
		@endif
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
					<div class="table-responsive" >
						 <table id="data" class="table table-striped table-bordered " cellpadding="0" cellspacing="0" border="0">
							<thead>
								<tr>
									
									<th class="col-md-3"><strong>Nombre</strong></th>									
									<th>Salario Diario</th>
									<th>Sueldo</th>									
									<th>D.T.</th>
									<th class="col-md-2">Dias pagados</th>
									<th>SS</th>
									<th >Horas Extras</th>									
									<th>Prima Dominical</th>
									<th>Infonavit</th>
									<th class="col-md-1">Prestamo</th>
									<th>Otras Percepciones</th>
									<th class="col-md-2">Bono Mtto</th>
									<th>Total</th>
									<th>Operaciones</th>
																		
								</tr>
							</thead>
							<tbody> 
							@foreach($asistencias as $ctr => $empleado)
							{{ Form::open(array('action' => 'PersonalOperativoControlador@postNomina', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'historial','files' => true)) }}
									<tr>
																		
										<td> {{{Str::title($empleado->empleado)}}}</td>	
										<td>${{{number_format($empleado->salario_diario, 2, '.', ',')}}}</td>                 
										<td>${{{number_format($empleado->salario_semanal, 0, '.', ',')}}}</td>										
										<td>{{{$empleado->dias_trabajados}}}</td>
										<td><input type="number"class="form-control" placeholder="0" min="0" step="any" name="dias_pago" value="{{{$empleado->dias_pago}}}"></td>
										<td>$@if($empleado->revision_contabilidad == 1){{{number_format($empleado->nomina_ss, 0, '.', ',')}}} @else{{{number_format($empleado->ss, 0, '.', ',')}}}@endif</td>        
										<td> {{{$empleado->hora_extra}}} <br> ${{{number_format($empleado->h_extra, 0, '.', ',')}}} </td>
										<td>${{{number_format($empleado->p_dominical, 0, '.', ',')}}}</td>
										<td>${{{number_format($empleado->infonavit, 0, '.', ',')}}}</td>
										<td><input type="number" step="any"class="form-control" placeholder="0" name="abono_prestamo" value="{{{$empleado->abono_prestamo}}}"></td>
										<td><input type="number" step="any"class="form-control" placeholder="0" name="otras_percepciones" value="{{{$empleado->otras_percepciones}}}"></td>										
										<td>									
											@if($empleado->departamento_id == 2)
												<input type="number" step="any"class="form-control" placeholder="0" name="bono_mtto" value="{{{$empleado->bono_mtto}}}">
										 	@endif
										</td>
										
										<td>
											<span class="badge">$ @if($empleado->revision_contabilidad == 1){{{number_format($empleado->nomina, 0, '.', ',')}}} @else {{{number_format($empleado->salario_total, 0, '.', ',')}}}@endif</span>
										</td>
										
										 <td>
											   <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-floppy-o"></i> </button> 											  
											@if($empleado->revision_contabilidad == 1)
											<span class="label label-info"><i class="fa fa-check"></i></span>
											@else
											<span class="label label-warning"><i class="fa fa-warning "></i></span>
											@endif
											
											</td>

							<input type="hidden" name="asistencia_id" value="{{{$empleado->id}}}">
							<input type="hidden" name="empleado_id" value="{{{$empleado->empleado_id}}}">
							<input type="hidden" name= "lista_activa" value="{{{$lista->activa}}}">

							{{form::close()}}
							@endforeach

															
							</tbody>
							<tfoot>
							<tr>
									<th class="col-md-3"><strong>Nombre</strong></th>									
									<th>Salario Diario</th>
									<th>Sueldo</th>									
									<th>D.T.</th>
									<th class="col-md-2">Dias pagados</th>
									<th>SS</th>
									<th >Horas Extras</th>									
									<th>Prima Dominical</th>
									<th>Infonavit</th>
									<th class="col-md-1">Prestamo</th>
									<th>Otras Percepciones</th>
									<th class="col-md-2">Bono Mtto</th>
									<th>Total</th>
									<th>Operaciones</th>
																		
								</tr>
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