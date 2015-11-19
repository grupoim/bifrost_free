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
              <div class="pull-left"> <h4> {{{count($sector_r )}}} @if ($nicho_r > 0) Nicho(s) @else Lote(s)  @endif disponible(s) en  {{{Str::title($sector->nombre)}}}</h4></div>               
              <div class="clearfix"></div>
            </div>
            <div class="widget-content">
              <div class="padd">
                <!-- Content goes here -->
                 @if (count($sector_r) == 0)
                 	<span label class="label label-warning"> No hay lotes dados de alta en la lista aún</span>
				@else						
						<!-- Table Page -->
							<div class="page-tables" >
								<!-- Table -->
									
								<div class="table-responsive">
									<table cellpadding="0" cellspacing="0" border="0" id="data-table2" width="100%">
										
											<thead>
												
													<tr>
														<th>FILA</th>
														<th>LOTE</th>
														@if ($nicho_r > 0)
														<th>RECINTO</th>
														@endif
														<th>PRECIO</th>														
														<th>DETALLES</th>
														
														
													</tr>
											</thead>
											<tbody>
													@foreach($sector_r as $sector)
													<tr>
														<td> {{{$sector->fila}}} </td>
														<td>{{{$sector->columna}}}</td>
														@if (!empty($sector->recinto))
														<td>{{{$sector->recinto}}}</td>
														@endif
														<td>${{{$sector->monto}}}.00</td>
														<td align="center">
															<a href= "#"class="btn btn-xs btn-default"><i class="fa fa-search"></i>Detalles</a>															
                                         				</td>
														
													</tr>
													@endforeach

											</tbody>
									</table>
									<div class="clearfix"></div>

								</div>
							</div>


                <!-- Content goes here -->			
					
					
				@endif



				
				


                <!-- Content goes here -->
              </div>
              <div class="widget-foot">
              
				@if (count($sector_r) <> 0)
              <a href="{{ action('LoteFunerarioControlador@getIndex') }}" class="btn btn-default"><i class="fa fa-print"></i>Imprimir</a>
              <a href="{{ action('LoteFunerarioControlador@getIndex') }}" class="btn btn-default"> Atras </a>
              	@else              	
              <a href="{{ action('LoteFunerarioControlador@getIndex') }}" class="btn btn-default"> Atras </a>
              	@endif
             Valor del stock total: <strong>${{{$valor_stock}}}.00</strong>
                <!-- Footer goes here -->
              </div>
            </div>
          </div>  
        </div> 
      </div>
       
@stop