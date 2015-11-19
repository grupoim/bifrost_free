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

<!-- HTML -->
      

{{--lotes funerarios--}}
<div class="row" id="lotes"> <!-- empieza el renglon del elemento lotes, y cierra hasta el segundo bloque donde estan los  nichos, 
	la clase "col-md-6 asigna el tamaño al bloque" -->
        <div class="col-md-12">

          <div class="widget">
            <div class="widget-head">
              <div class="pull-left">Sectores</div>               
              <div class="clearfix"></div>
            </div>
            <div class="widget-content">
              <div class="padd">
                <!-- Content goes here -->
				<!-- Table Page -->
							<div class="page-tables">
								<!-- Table -->
									
								<div class="table-responsive">
									<table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
										
											<thead>
												
													<tr>
														<th>#</th>														
														<th>SECTOR</th>
														
														<th>OPERACIONES</th>
													</tr>
											</thead>
											<tbody>													
													
													@foreach ($sectores as $sector)
												<tr> 
													<td> {{{$sector->id}}}</td>
													
													<td> 
														<ul class="fa-ul">
														
														<strong>{{{Str::title($sector->nombre)}}}</strong> 
															@foreach($sector->recinto as $recinto)															
															<li class="list-group-item">
														<a href="{{action('LoteFunerarioControlador@getRecuperarecinto', $recinto->id)}}"><i class="fa fa-cube"></i>{{{$recinto->id}}} {{{$recinto->nombre}}}</a><span class="badge badge-success label-as-badge">Nichos</span> </li> 															
															@endforeach
														</ul>

													</td>
														<td align="center">

																<a href="{{action('LoteFunerarioControlador@getRecupera', $sector->id)}}" 
																	title="Ver terrenos disponibes de {{{Str::title($sector->nombre)}}}" 
																	class="btn btn-xs btn-default">
																	<i class="fa fa-eye"></i> 
																	Detalles
																</a>

	                                         			</td>
                                         			
												</tr>
													@endforeach												


											</tbody>
									</table>
									<div class="clearfix"></div>

								</div>
							</div>


                <!-- Content goes here -->
              </div>
              <div class="widget-foot">
                <!-- Footer goes here -->
              </div>
            </div>
          </div>  

        </div>     

      {{--recintos nichos funerarios--}}

        <div class="col-md-12" class="target">

          <div class="widget">
            <div class="widget-head">
              <div class="pull-left">Nichos</div>               
              <div class="clearfix"></div>
            </div>
            <div class="widget-content">
              <div class="padd">
               <!-- Content goes here -->
				<!-- Table Page -->
							<div class="page-tables">
								<!-- Table -->
									
								<div class="table-responsive">
									<table cellpadding="0" cellspacing="0" border="0" id="data-table2" width="100%">
										
											<thead>
												
													<tr>
														<th>ID</th>
														<th>SECTOR</th>
														<th>RECINTO</th>
														<th>ACCIONES</th>
														
														
													</tr>
											</thead>
											<tbody>
													@foreach ($recintos as $recinto)
													<tr>													
														<td>{{{$recinto->id}}}</td>
														<td>{{{Str::title($recinto->sector->nombre)}}}</td>
														<td>{{{Str::title($recinto->nombre)}}}</td>
														<td align="center">
															<a href= "{{action('LoteFunerarioControlador@getRecuperarecinto', $recinto->id)}}"class="btn btn-xs btn-default"><i class="fa fa-search"></i>Detalles</a>															
                                         				
                                         				</td>
														
													</tr>
													@endforeach

											</tbody>
									</table>
									<div class="clearfix"></div>

								</div>
							</div>


                <!-- Content goes here -->
				              </div>
              <div class="widget-foot">
                <!-- Footer goes here -->
              </div>
            </div>
          </div>  

        </div>
      </div>
      

       
@stop