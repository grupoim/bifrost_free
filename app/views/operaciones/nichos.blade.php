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

<div class="row" id="nichos"> <!-- empieza el renglon del elemento lotes, y cierra hasta el segundo bloque donde estan los  nichos, 
	la clase "col-md-6 asigna el tamaño al bloque" -->
        <div class="col-md-12">

          <div class="widget">
            <div class="widget-head">
              <div class="pull-left"> <i class="fa fa-{{$icon}}"></i>Nichos disponibles en  Recinto {{{Str::title($recinto_r->nombre)}}}</div>               
              <div class="clearfix"></div>
            </div>
            <div class="widget-content">
              <div class="padd">
                <!-- Content goes here -->
                 @if (count($recinto_r) == 0)
                 	<span label class="label label-warning"> No hay nichos dados de alta en la lista aún</span>
				@else

							<!-- Table Page -->
							<div class="page-tables" >
								<!-- Table -->
									
								<div class="table-responsive">
									<table cellpadding="0" cellspacing="0" border="0" id="data-table2" width="100%">
										
											<thead>
												
													<tr>
														<th>FILA</th>
														<th>COLUMNA</th>														
														<th>PRECIO</th>	
														
													</tr>
											</thead>
											<tbody>
													@foreach($nichos_r as $nicho)
													<tr>
														<td> {{{$nicho->fila}}} </td>
														<td>{{{$nicho->columna}}}</td>														
														<td>${{{$nicho->monto}}}.00</td>																												
													</tr>
													@endforeach

											</tbody>
									</table>
									<div class="clearfix"></div>

								</div>
							</div>
            
				@endif						

                <!-- Content goes here -->
              </div>
              <div class="widget-foot">
              
				
              <a href="{{ action('LoteFunerarioControlador@getIndex') }}" class="btn btn-default"><i class="fa fa-print"></i>Imprimir</a>
              <a href="{{ action('LoteFunerarioControlador@getIndex') }}" class="btn btn-default"> Atras </a>             
             
                <!-- Footer goes here -->
              </div>
            </div>
          </div>  
        </div> 
      </div>
       
@stop