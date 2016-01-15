@section('scripts')
<script src="{{ URL::asset('js/chosen.jquery.js') }}"> </script>
<link href="{{ URL::asset('css/chosen.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/jquery.growl.js') }}" ></script>
<link rel="stylesheet" href="{{ URL::asset('css/jquery.growl.css') }}"> 
<script>
$(function() {
$("#fecha").datepicker({ minDate: 0 });
});
</script>
<script>

  $(document).on('ready', function(){


  	 window.setTimeout(function() {
  $(".alerta").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 9000);
	$("#folio_venta").show();
	$("#pieza_entera").show();
  $("#pieza_entera_p").hide();
  $("#pieza_entera_p").hide();
	$(".corte_especial").hide();
  $("#area_uso_p").hide();
  $("#").hide();
	$(".stock").show();
	$("#motivo_de_reposicion").hide();
	$("#cantidad_stock").hide();
	$("#password").hide();	
	

    $("#r1").click(function () {
        $("#motivo_de_reposicion").hide();
        $("#password").hide();
        $("#folio_venta").show();
         $("#cantidad_stock").hide();
    });
    $("#r2").click(function () {
        $("#motivo_de_reposicion").show();
        $("#password").show();
       	$("#folio_venta").hide();
       	$("#cantidad_stock").hide();
    });
     $("#r3").click(function () {
       $("#motivo_de_reposicion").hide();
       $("#password").hide();
       $("#folio_venta").hide();
       $("#cantidad_stock").show();
    });

      $("#r1corte").click(function () {
       $("#pieza_entera").show();
       $(".corte_especial").hide();
       
    });
       
      $("#r2corte").click(function () {
       $("#pieza_entera").hide();
       $(".corte_especial").show();
       $(".stock").hide();
       $(".stock").disable();
       
    });

       $("#r3corte").click(function () {
       $("#pieza_entera").hide();
       $(".corte_especial").show();
       $(".stock").hide();
       $(".stock").disable();
       
    });

  /* === MODALS === */
		$( document ).on('click', '.solsoShowModal', function(){
			modalTitle = $(this).attr('data-modal-title')
			
			$.ajax({
				url: $(this).attr('data-href'),
				dataType: 'html',
				success:function(data) {
					$('.solsoModalTitle').text(modalTitle.toString());
					$('.solsoShowForm').html(data);
				}
			});		
		});
		
		$( document ).on('click', '.solsoSave', function(e){
			e.preventDefault();
			
			var solsoSelector	= $(this);
			var solsoFormAction = $('.solsoForm').attr('action');
			var solsoFormMethod = $('.solsoForm').attr('method');
			var solsoFormData	= $('.solsoForm').serialize();
			
			$.ajax({
				url: 	solsoFormAction,
				type: 	solsoFormMethod,
				data: 	solsoFormData,
				cache: 	false,
				dataType: 'html',
				success:function(data) {
					if (data == 0 ) {
						console.log('error');
					} else {
						
						if ($(data).filter('table.solsoRefresh').length == 1) {
							$('#solsoCrudModal').modal('hide');
														
							$.growl.notice({ title: solsoSelector.attr('data-message-title'), message: solsoSelector.attr('data-message-success') });
						} else {
							$('.solsoShowForm').html(data);
							$.growl.error({ title: solsoSelector.attr('data-message-title'), message: solsoSelector.attr('data-message-error') });
						}
						
						$('#data-table').dataTable();

					}
				}
			});	
			
			return false;
		});				
		
		$( document ).on('click', '.solsoConfirm', function(){
			$("#solsoDeletForm").prop('action', $(this).attr('data-href'));
		});
		
		$( document ).on('click', '.solsoDelete', function(e){
			e.preventDefault();
			
			var solsoSelector	= $(this);
			var solsoFormAction = $('#solsoDeletForm').attr('action');
			
			$.ajax({
				url: 	solsoFormAction,
				type: 	'delete',
				cache: 	false,
				dataType: 'html',
				success:function(data) {
					$('#solsoDeleteModal').modal('hide');					
					$('#ajaxTable').html(data);
					$('#countClients').text( $('.solsoTable').attr('data-all') );
					$.growl.notice({ title: solsoSelector.attr('data-message-title'), message: solsoSelector.attr('data-message-success') });
					
					$('#data-table').dataTable();

				}
			});	
			
			return false;
		});		
		/* === END MODALS === */		
     

    $(".proveedor").chosen({   
    no_results_text: "No hay resultados para:",        
    width: "100%"    
  });

    $(".material_color").chosen({   
    no_results_text: "No hay resultados para:",    

    width: "100%"    
  });

  });
  </script>
 

    @stop
@section('module')
 <div class="row">
            <div class="col-md-5">
@if($venta_error=='error')
      <div class="alert alert-warning alert-dismissible alerta" role="alert" align="center">
     
     <strong><h4> No se puede agregar producto a esa venta </h4></strong>
    </div>  

      @endif

@if($material_error =='error')
      <div class="alert alert-danger alert-dismissible alerta" role="alert" align="center">
     
     <strong><h4> No hay suficiente material </h4></strong>
    </div>  

      @endif      
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Detalles del corte de material</div>
                  <div class="widget-icons pull-right">                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                    {{ Form::open(array('action' => 'InventarioRecubControlador@postBaja', 'class' => 'form-horizontal', 'role' => 'form')) }} 

                     @if($errors->has('motivo_de_reposicion')) <div align="center" class="alert alert-danger alerta">{{$errors->first('motivo_de_reposicion')}}</div> @endif
                     @if($errors->has('justificacion_de_corte')) <div align="center" class="alert alert-danger alerta">{{$errors->first('justificacion_de_corte')}}</div> @endif
                     @if($errors->has('largo')) <div align="center" class="alert alert-danger alerta">{{$errors->first('largo')}}</div> @endif
					 @if($errors->has('alto')) <div align="center" class="alert alert-danger alerta">{{$errors->first('alto')}}</div> @endif
                      <div class="form-group">
                                  <label class="col-lg-3 control-label">Fecha</label>
                                  <div class="col-lg-8">
                                   @if($errors->has('fecha')) 


                                   <div align="center" class="alert alert-danger alerta">{{$errors->first('fecha')}}</div> @endif
                                        <div id="datetimepicker1" class="input-append input-group dtpicker">
              										        <input name="fecha" id="fecha" data-format="yyyy-MM-dd" type="text" @if($status == 'add') value="{{{ date("Y-m-d")}}}"@else value="{{Input::old('fecha')}}" @endif class="form-control" required>
                        										<span class="input-group-addon add-on">
                        											<i data-time-icon="fa fa-times" data-date-icon="fa fa-calendar"></i>
                        										</span>
              									       </div>
                                  </div>
                      </div>
                      <hr>
                       <div class="form-group">
                        <label class="col-lg-3 control-label">Tipo de corte</label>
                        <div class="col-lg-9">
                          					<label class="radio-inline"><input type="radio" name="tipo_corte" value="1" id="r1corte" checked="true">Pieza entera</label>
        									<label class="radio-inline"><input type="radio" name="tipo_corte" value="2" id="r2corte">Corte especial</label>
        									
                                            
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-lg-3 control-label">Tipo de baja</label>
                        <div class="col-lg-9">
                          					<label class="radio-inline"><input type="radio" name="tipo_baja" value="1" id="r1" checked="true">Venta</label>
        									<label class="radio-inline"><input type="radio" name="tipo_baja" value="2" id="r2">Reposición</label>
        									<label class="radio-inline"><input type="radio" name="tipo_baja" value="3" id = "r3">Stock</label>
                                            
                        </div>
                      </div>

                      {{-- <div class="form-group" id = "password">
                        <label class="col-lg-3 control-label">Autorización</label>
                      <div class="col-lg-9">
                        <input type="password" class="form-control" name="password" placeholder="Ingrese Password de autorización" title="password Autorización">                        
                      </div>
                    </div> --}}
                     <div class="form-group" id = "motivo_de_reposicion">
                        <label class="col-lg-3 control-label">Motivo de Reposicion</label>
                      <div class="col-lg-9">                        
                        <textarea type="textarea" row = "5" class="form-control"  name="motivo_de_reposicion" placeholder="" title="¿Por que se quiere reportar una reposicion?"></textarea>
                       
                      </div>
                    </div>
                      	
                      <div class="form-group" id="folio_venta">
                        <label class="col-lg-3 control-label">Folio de venta</label>
                      <div class="col-lg-9">
                       @if($errors->has('folio_venta')) <div align="center" class="alert alert-danger alerta">{{$errors->first('folio_venta')}}</div> @endif
                        <input type="text" @if($status == 'add') value="{{{ $venta_r->folio}}}"@else value="{{Input::old('folio_venta')}}" @endif class="form-control" name="folio_venta" placeholder="" title="Ingrese folio de venta">
                      </div>
                    </div>

                     <div class="form-group" id="cantidad_stock">
                                  <label class="col-lg-3 control-label">Cantidad</label>                                  
                                  <div class="col-lg-6">
                                    <input type="number" min="1" max="10" class="form-control" placeholder="0" name="cantidad"   required value="1">
                                  </div>                                  
                                </div>
                    
                    <div class="form-group">
										    <label for="numero_exterior" class="col-lg-3 control-label">Precio de venta </label>
  										<div class="col-lg-9">
  										 @if($errors->has('precio_venta')) <div align="center" class="alert alert-danger alerta">{{$errors->first('precio_venta')}}</div> @endif
  											 <input type="number"  min="500" max="50000"name="precio_venta" class="form-control" required placeholder="Costo de venta de la pieza a crear" aria-describedby="basic-addon2">
  										</div>
									  </div>
									  
                    <hr>
                   

 <div class="form-group">
                        <label class="col-lg-3 control-label"></label>
                        <div class="col-lg-9">
                                    <label class="radio-inline"><input type="radio" name="proporcion_corte" value="1" id="r3corte" checked="true">Medida estándar</label>
                          <label class="radio-inline"><input type="radio" name="proporcion_corte" value="2" id="r3corte">Medida especial</label>
                          
                                            
                        </div>
                      </div>

					 <div class="form-group" id="pieza_entera">
                            <label class="col-lg-3 control-label">Pieza a crear</label>
                                  <div class="col-lg-8">
                                   <select class="form-control proveedor chosen-select" data-placeholder="Selecciona una opción" name="pieza_marmoleria_id" id="proveedor" >                                
                       
                                      @foreach($piezas as $pieza)
                                        
                                        <option value="{{{$pieza->id}}}" > {{{$pieza->nombre}}} -- {{{$pieza->area_requerida}}} m2 </option>
                                       @endforeach
                                         </select>
                                  </div>
                                </div>

                                <div class="form-group" id="pieza_entera_p">
                            <label class="col-lg-3 control-label">Pieza a crear</label>
                                  <div class="col-lg-8">
                                   <select class="form-control proveedor chosen-select" data-placeholder="Selecciona una opción" name="pieza_marmoleria_id_p" id="proveedor" >                                
                       
                                      @foreach($piezas as $pieza)
                                        
                                        <option value="{{{$pieza->id}}}" > {{{$pieza->nombre}}}</option>
                                       @endforeach
                                         </select>
                                  </div>
                                </div>

                                 <div class="form-group" id="area_uso_p">
                        <label class="col-lg-3 control-label">Área de uso</label>
                      <div class="col-lg-9">                      
                        <input type="text" class="form-control" name="area_uso_p" placeholder="m2 usados" >
                      </div>
                    </div>

                                <div class="form-group corte_especial">
                        <label class="col-lg-3 control-label">Justificacion de corte</label>
                      <div class="col-lg-9">                        
                        <textarea type="textarea" row = "5" class="form-control"  name="justificacion_de_corte" placeholder="" title="¿Por que se quiere cortar la sección de material?"></textarea>
                       
                      </div>
                    </div>
                        <div class="form-group corte_especial">
                                  <label class="col-lg-3 control-label">Largo/Alto</label>                                  
                                  <div class="col-lg-4">
                                  
                                    <input type="number" min="0.06" step="any" class="form-control" placeholder="Largo" name="largo" id="largo" >
                                  </div>
                                  
                                  <div class="col-lg-4">
                                    
                                    <input type="number" min="0.06" step="any" class="form-control" placeholder="Alto" name="alto" id="alto" >
                                  </div>
                                </div>
								<div class="form-group">
                                  <label class="col-lg-9 control-label"><h3>---<strong>Material Disponible</strong>---</h3></label>
                                  
                                </div>
								@if($errors->has('material_disponible')) <div align="center" class="alert alert-warning alerta">{{$errors->first('material_disponible')}}</div> @endif
                                <hr>
                                <div class="page-tables">
						<!-- Table -->
						<div class="table-responsive" id="StudentTableContainer">
							<table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
								<thead>
									<tr>
									<th><i class="fa fa-check"></i></th>
									{{-- <th>#</th> --}}
										<th>Folio</th>
										<th>Descripción</th>
										{{--<th>Disponible</th>--}}
										
																																																	
									</tr>
								</thead>
								<tbody>
									@foreach($inventarios as $crt => $inventario)									
									
									<td>                                     
                      <label class="radio-inline"><input type="radio" name="material_disponible"  value="{{{$inventario->id}}}" required></label></td>
										{{-- <td>
										 {{ $crt+1 }} 	
										</td> --}}
										<td>{{{ $inventario->folio_lamina}}} @if($inventario->lamina_completa == 0)<span class="label label-info">Retazo</span> @endif</td>
										{{--<td> @if($inventario->lamina_completa == 0)<span class="label label-info">Retazo</span> @endif {{{ $inventario->material_color}}} </td>--}}
										 <td>
									<!-- Checkbox -->
									                        

									                      <p class="p-meta">
									                        <!-- Due date & % Completed -->
									                        <span> {{{ $inventario->material_color}}} @if($inventario->porcentaje_restante == 100) {{{$inventario->porcentaje_restante}}} @else {{{number_format($inventario->porcentaje_restante, 2, '.', ',')}}} @endif %  Disp.: {{{number_format($inventario->area_stock, 2, '.', ',')}}} m<sup>2</sup> </span> 
									                      								
									                      </p>
															
															<!-- Progress bar -->
									                      <div class="progress progress-striped active">
															  <div class="progress-bar @if($inventario->porcentaje_restante == 100) progress-bar-success @elseif($inventario->porcentaje_restante == 50 or $inventario->porcentaje_restante >= 31 ) progress-bar-warning @elseif($inventario->porcentaje_restante <= 30) progress-bar-danger  @endif"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: {{{$inventario->porcentaje_restante}}}%">
																<span class="sr-only">100% Complete</span>
															  </div>
														    </div>
													{{--{{{$inventario->area_stock}}} m<sup>2</sup> <br> <div class="progress progress-animated progress-striped active">
												  <div class="progress-bar @if($inventario->porcentaje_restante == 100) progress-bar-success @elseif($inventario->porcentaje_restante == 50 or $inventario->porcentaje_restante >= 31 ) progress-bar-warning @elseif($inventario->porcentaje_restante <= 30) progress-bar-danger  @endif"  data-percentage="{{{$inventario->porcentaje_restante}}}">
													<span class="sr-only">100% Complete</span>
												  </div>
											  </div> --}}		
					  					</td>										
										
									</tr>
									@endforeach

								</tbody>
								
							</table> </div>
							<div class="clearfix"></div>
                                
                                                          

                  </div>
					

                  </div>
                  <div class="widget-foot">
                     <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-scissors"></i> Cortar</button>
                    <a  type="btn" href="{{action('InventarioRecubControlador@getBaja')}}" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-refresh"></i> Reestablecer</a>
                    
					{{form::close()}}
                  </div>
                </div>
              </div>   
              
            </div>

            <!-- post sidebar -->

            <div class="col-md-7">

              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Concentrado de movimientos</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">					
					<!--tabs -->					
                      <ul id="myTab" class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab"> <i class="fa fa-money"></i> Ventas</a></li>
                        <li><a href="#profile" data-toggle="tab"><i class="fa fa-exchange"></i>  Reposiciones</a></li>
                        <li><a href="#cont" data-toggle="tab"><i class="fa fa-cubes"></i> Stock</a></li>
                      </ul> 

                      <div id="myTabContent" class="tab-content">
                       <!-- tab de ventas--> 
                       <div class="tab-pane fade in active" id="home">
                          <p> @if(count($ventas) == 0)
                          <div class="alert alert-info alert-dismissible " role="alert" align="center">
     
     <strong><h4> No hay registros aún </h4></strong>
    </div> 
                           <!-- empieza contenido tab de ventas -->
							@else	                          
                          <div class="page-tables">
						<!-- Table -->
						<div class="table-responsive" id="StudentTableContainer">
							<table cellpadding="0" cellspacing="0" border="0" id="data-table2" width="100%">
								<thead>
									<tr>
									
										{{--<th>#</th>--}}
										<th>Venta</th>
										<th>Fecha</th>
										<th>Precio</th>
										<th>Contenido</th>
										<th>Options</th>

										
																																																	
									</tr>
								</thead>
								<tbody>
									<tr>
									@foreach($ventas as $crt => $venta)	
									
										{{--<td>{{ $crt+1 }} </td> --}}
										<td>{{{ $venta->folio}}}</td>										
										<td> {{{date("d-m-Y", strtotime($venta->created_at))}}} </td>
										<td>${{{number_format($venta->total_venta, 2, '.', ',')}}}</td>	
										<td>
											@foreach($ventas_detalle as $detalle)
												@if($venta->folio == $detalle->folio) 
													<ul>
														<li>
															{{{$detalle->pieza}}} {{{$detalle->material_color}}} 
																
														</li> 
														@if($detalle->pieza_completa == 0) 
															<p> {{{$detalle->observaciones}}} 
																	lámina {{{$detalle->folio_lamina}}}</p> 

														@endif
													</ul> 
												@endif  
											@endforeach 
										</td>
										<td>
											
											@if(date("d-m-Y", strtotime($venta->created_at)) < date("d-m-Y") and ($venta->venta_normal == 1) )
															<span class="label label-success">Venta Normal</span>
											@elseif (date("d-m-Y", strtotime($venta->created_at)) == date("d-m-Y") and ($venta->venta_normal == 1) )
											<a class="btn btn-xs btn-default" href="{{action('InventarioRecubControlador@getRecuperaventa', $venta->folio )}}" name="folio" value="$venta->folio" class="btn btn-info " title="Añadir a la factura"><i class="fa fa-plus-circle"></i></a>
											<span class="label label-success">Venta Normal</span>
											@elseif (date("d-m-Y", strtotime($venta->created_at)) > date("d-m-Y") and ($venta->venta_normal == 0) )
											<a class="btn btn-xs btn-default" href="{{action('InventarioRecubControlador@getRecuperaventa', $venta->folio )}}" name="folio" value="$venta->folio" class="btn btn-info " title="Añadir a la factura"><i class="fa fa-plus-circle"></i></a>
											<span class="label label-warning">Corte especial</span>
											
											@elseif ($venta->venta_normal == 0)  
											<span class="label label-info"> Venta Stock</span>
											@endif	
										</td>

									</tr>
									@endforeach

								</tbody>
								
							</table> </div>
							<div class="clearfix"></div>

                                 {{--
                                 <div class="form-group">
                                  <label class="col-lg-3 control-label">Tipo de baja</label>
                                  <div class="col-lg-9">
                                    @foreach($piezas as $pieza)
                                    <label class="radio-inline"><input type="radio" name="lamina_completa" ><a href="#">{{{$pieza->nombre}}} Requerido {{{$pieza->area_requerida}}} m<sup>2</sup>  </a></label>
									 @endforeach
                                    
                                  </div>
                                </div> --}}
                                                          

                  </div> @endif </p> <!-- fin contenido tab de ventas-->
                        </div> <!-- fin tab de ventas -->
                        <div class="tab-pane fade" id="profile">
                          <p> 
						@if(count($reposiciones) == 0)
                          <div class="alert alert-info alert-dismissible " role="alert" align="center">
     
					     <strong><h4> No hay registros aún </h4></strong>
					    </div> 
                           <!-- empieza contenido tab de ventas -->
							@else
                          <div class="page-tables">
						<!-- Table -->
						<div class="table-responsive" id="StudentTableContainer">
							<table cellpadding="0" cellspacing="0" border="0" id="data-table3" width="100%">
								<thead>
									<tr>
									
										{{--<th>#</th>--}}										
										{{--<th>Fecha</th>--}}
										<th>Lámina</th>
										<th>Pieza</th>										
										{{--<th>Area</th>--}}
										<th>Material</th>
										<th>Pieza</th>
										<th>Motivos</th>

										
																																																	
									</tr>
								</thead>
								<tbody>
									<tr>
									@foreach($reposiciones as $crt => $reposicion)	
									
										{{--<td>{{ $crt+1 }} </td> --}}
																				
										{{--<td> {{{date("d-m-Y", strtotime($reposicion->created_at))}}} </td>--}}
										<td>{{{$reposicion->folio_lamina}}}</td>
										<td>{{{$reposicion->pieza}}} de {{{$reposicion->material_color}}}</td>										
										{{--<td>{{{$reposicion->area_requerida}}}</td>--}}
										<td>${{{number_format($reposicion->costo_material_usado, 2, '.', ',')}}}</td>
										<td>${{{number_format($reposicion->precio_reposicion, 2, '.', ',')}}}</td>
										<td>{{{date("d-m-Y", strtotime($reposicion->created_at))}}} {{{$reposicion->motivos}}}</td>

									</tr>
									@endforeach

								</tbody>
								
							</table> </div>
							<div class="clearfix"></div>                              
                                                          

                  </div> @endif
                  </p>
                        </div>
                        <div class="tab-pane fade" id="cont">
                        
                          <p> 
                          @if(count($stocks) == 0)
                          <div class="alert alert-info alert-dismissible " role="alert" align="center">
     
     <strong><h4> No hay registros aún </h4></strong>
    </div> 
                           <!-- empieza contenido tab de ventas -->
							@else
                          <div class="page-tables">
						<!-- Table -->
						<div class="table-responsive" id="StudentTableContainer">
							<table cellpadding="0" cellspacing="0" border="0" id="data-table4" width="100%">
								<thead>
									<tr>
									
										{{--<th>#</th>--}}
										<th>Folio</th>
										<th>Pieza</th>
										<th>Lámina</th>
										<th>Precio</th>
										<th>Costo</th>
										<th>Opciones</th>

										
																																																	
									</tr>
								</thead>
								<tbody>
									<tr>
									@foreach($stocks as $crt => $stock)	
									
										{{--<td>{{ $crt+1 }} </td> --}}
										<td>{{{ $stock->folio}}}</td>
										<td> {{{$stock->pieza}}} {{{$stock->material_color}}}</td>
										<td>{{{$stock->folio_lamina}}}</td>		
										{{--<td> {{{date("d-m-Y", strtotime($venta->created_at))}}} </td>--}}
										<td>${{{number_format($stock->precio_venta, 2, '.', ',')}}}</td>
										<td>${{{number_format($stock->costo_material_usado, 2, '.', ',')}}}</td>
										<td><a class="btn btn-xs btn-default" href="{{action('InventarioRecubControlador@getVentastock', $stock->id )}}" name="stock_id" value="" class="btn btn-info " title="Venta"><i class="fa fa-cart-arrow-down"></i></a>
											<a class="btn btn-xs btn-default" href="{{action('InventarioRecubControlador@getVentareposicion', $stock->id )}}" name="stock_id" value="" class="btn btn-info " title="Reposicion"><i class="fa fa-exchange"></i></a>
											</td>
									</tr>
									@endforeach

								</tbody>
								
							</table> </div>
							<div class="clearfix"></div>

                                 {{--
                                 <div class="form-group">
                                  <label class="col-lg-3 control-label">Tipo de baja</label>
                                  <div class="col-lg-9">
                                    @foreach($piezas as $pieza)
                                    <label class="radio-inline"><input type="radio" name="lamina_completa" ><a href="#">{{{$pieza->nombre}}} Requerido {{{$pieza->area_requerida}}} m<sup>2</sup>  </a></label>
									 @endforeach
                                    
                                  </div>
                                </div> --}}
                                                          

                  </div> 
                  @endif
                  </p>
                        </div>
                      </div>
					<!-- fin tabs -->
                  </div>
                   

                  </div>
                  <div class="widget-foot">
                    <!-- Footer goes here -->
                  </div>
                </div>
              </div>  

            </div>

          </div>
 
          

@include('_assets.modals.modal-crud')
@include('_assets.modals.modal-delete')           
@stop
