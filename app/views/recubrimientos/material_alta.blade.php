@section('scripts')
<script src="{{ URL::asset('js/chosen.jquery.js') }}"> </script>
<link href="{{ URL::asset('css/chosen.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/jquery.growl.js') }}" ></script>
<link rel="stylesheet" href="{{ URL::asset('css/jquery.growl.css') }}"> 

<script>

  $(document).on('ready', function(){

  	 window.setTimeout(function() {
  $(".alerta").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 9000);
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

{{--
@if(Auth::user()->departamento->id == 1)
<a class="btn btn-xs btn-default" href="{{action('InventarioRecubControlador@getBoom')}}" name="folio" value=""  title="Borrar todos los registros del inventario"> <i class="fa fa-bomb"></i> Boom!!</a>
  <div class="row">
@if($boom=='apocalipsis')
      <div class="alert alert-danger alert-dismissible " role="alert" align="center">
     <h1>BOOOOOOOOOM! <i class="fa fa-bomb fa-spin"></i> <i class="fa fa-bomb fa-spin"></i> <i class="fa fa-bomb fa-spin"></i> </h1>
     <P><strong><h4> <i class="fa fa-exclamation-triangle"></i> Explotaste la bomba ATÓMICA, se acabará el mundo mi chavo, acabas de borrar todo el inventario  <i class="fa fa-exclamation-triangle"></i></h4></strong></P>
    </div>  

      @endif
      @endif --}}
      
            <div class="col-md-4">
				@if($factura_error=='error')
      <div class="alert alert-danger alert-dismissible alerta" role="alert" align="center">
     
     <strong><h4> No se puede agregar producto a esa factura </h4></strong>
    </div>  

      @endif

      
              <div class="widget wred">
                <div class="widget-head">
                  <div class="pull-left">Registro de láminas </div> 
                  <div class="widget-icons pull-right">                    
                  </div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">
                    
                    <br />
                    <!-- Form starts.  -->
                     
                    {{ Form::open(array('action' => 'InventarioRecubControlador@postAlta', 'class' => 'form-horizontal', 'role' => 'form')) }} 

                      <div class="form-group">
                                  <label class="col-lg-3 control-label">Folio</label>
                                  <div class="col-lg-8">
                                  @if($errors->has('folio_factura')) <div align="center" class="alert alert-danger alerta">{{$errors->first('folio_factura')}}</div> @endif
                                    <input type="text" @if($status == 'add') value="{{{ $alta_r->folio_factura}}}"@else value="{{Input::old('folio_factura')}}" @endif class="form-control" required name="folio_factura" placeholder="Factura o nota de remisión" title="Ingrese folio de factura o número de nota de remision entregada por proveedor">
                                  </div>
                                </div>
                      <div class="form-group">
                                  <label class="col-lg-3 control-label">Fecha</label>
                                  <div class="col-lg-8">
                                  @if($errors->has('fecha')) <div align="center" class="alert alert-danger alerta">{{$errors->first('fecha')}}</div> @endif
                                   <div id="datetimepicker1" class="input-append input-group dtpicker">
										<input name="fecha" data-format="yyyy-MM-dd" type="text" @if($status == 'add') value="{{{ date("Y-m-d", strtotime($alta_r->fecha_alta))}}}"@else value="{{Input::old('fecha')}}" @endif class="form-control">
										<span class="input-group-addon add-on">
											<i data-time-icon="fa fa-times" data-date-icon="fa fa-calendar"></i>
										</span>
									</div>
                                  </div>
                                </div>
                                <hr>

                      <div class="form-group">
                                  <label class="col-lg-3 control-label">Proveedor</label>
                                  <div class="col-lg-8">
                                   <select class="form-control proveedor chosen-select" data-placeholder="Select Your Options" name="proveedor_id" id="proveedor" >                                
                       
                      @foreach($proveedores as $proveedor)
                        
                        <option value="{{{$proveedor->id}}}" @if($status == 'add') @if($proveedor->nombre == $alta_r->proveedor) selected @endif @endif> {{{$proveedor->nombre}}}</option>
                       @endforeach
                         </select>
                                  </div>
                                </div>
                                
                       <div class="form-group">
                                  <label class="col-lg-3 control-label">Material/Color</label>
                                  <div class="col-lg-8">
                                  @if($errors->has('material_color_id')) <div align="center" class="alert alert-danger alerta">{{$errors->first('material_color_id')}}</div> @endif
                                   <select class="form-control proveedor chosen-select" name="material_color_id" id="material_color">                                
                       
                     <option value="0"></option>
                      @foreach($material_colores as $material_color)
                        
                        <option value="{{{$material_color->id}}}"> {{{$material_color->material_color }}}</option>
                       @endforeach
                         </select>
                                  </div>
                                </div> 
                                <hr>

                                <div class="form-group">
                                  <label class="col-lg-2 control-label">Cantidad</label>                                  
                                  <div class="col-lg-4">
                                    <input type="number" min="1" max="10" class="form-control" placeholder="0" name="cantidad" id="cantidad"  required value="1">
                                  </div>                                  
                                </div>
                                

                                 <div class="form-group">
                                  <label class="col-lg-3 control-label">Tipo de lámina</label>
                                  <div class="col-lg-9">
                                    <label class="radio-inline"><input type="radio" name="lamina_completa" value="1" checked="true">Entera</label>
									<label class="radio-inline"><input type="radio" name="lamina_completa" value="0">Retazo</label>

                                    
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Largo/Alto</label>                                  
                                  <div class="col-lg-4">
                                  @if($errors->has('largo')) <div align="center" class="alert alert-danger alerta">{{$errors->first('largo')}}</div> @endif
                                    <input type="text" class="form-control" placeholder="Largo" name="largo" id="largo" >
                                  </div>
                                  
                                  <div class="col-lg-4">
                                    @if($errors->has('alto')) <div align="center" class="alert alert-danger alerta">{{$errors->first('alto')}}</div> @endif
                                    <input type="text" class="form-control" placeholder="Alto" name="alto" id="alto" >
                                  </div>
                                </div>
                                <hr> 
                               
                                			<div class="form-group">
										<label for="numero_exterior" class="col-lg-5 control-label">Precio unitario</label>
										<div class="col-lg-4">
										@if($errors->has('precio_total')) <div align="center" class="alert alert-danger alerta">{{$errors->first('precio_total')}}</div> @endif
											<input type="text" name="precio_total" class="form-control" placeholder="$0.00" aria-describedby="basic-addon2">
										</div>
									</div>

                  </div>
                </div>
                  <div class="widget-foot">
                    <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-floppy-o"></i> Guardar</button>
                    <a  type="btn" href="{{action('InventarioRecubControlador@getIndex')}}" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-refresh"></i> Reestablecer</a>
                    <input type="hidden" name="hoy" value="{{{$hoy}}}">
{{form::close()}}
                    <!-- Footer goes here -->
                  </div>
              </div>  

            </div>
            <div class="col-md-8">

              <div class="widget wviolet">
                <div class="widget-head">
                  <div class="pull-left"> Historial de Facturas capturadas</div>
                  <div class="widget-icons pull-right">
                  
                  </div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">

                   <!-- Table Page -->
					<div class="page-tables">
						<!-- Table -->
						<div class="table-responsive" id="StudentTableContainer">
							<table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
								<thead>
									<tr>
										<th>Fecha</th>
										<th>Factura</th>
										<th>Proveedor</th>										
										<th>Laminas</th>										
										<th>Costo Total</th>
										<th>Detalles</th>
									</tr>
								</thead>
								<tbody>
									@foreach($altas as $alta)									
									
										<td>{{{ date("d-m-Y", strtotime($alta->fecha_alta))}}}</td>
										<td> {{{$alta->folio_factura}}}</td>
										<td>{{{$alta->proveedor}}}</dh>																				
										<td>{{{$alta->entrada}}}</td>
										<td>${{{number_format($alta->total_factura, 2, '.', ',')}}}</td>
										<td><button type="button" class="btn btn-xs btn-default solsoShowModal" title="Ver detalle de factura" 
												 data-toggle="modal" data-target="#solsoCrudModal" href= "{{action('InventarioRecubControlador@getShow', $alta->folio_factura)}}" data-modal-title=" Detalles del mantenimiento">
									<i class="fa fa-search"></i> Detalles
									</button>
											@if($alta->factura_abierta == 0)
											<span class="label label-danger">Cerrada</span>
											@else
												<a class="btn btn-xs btn-default" href="{{action('InventarioRecubControlador@getRecupera', $alta->folio_factura)}}" name="folio_factura" value="$alta->folio_factura" class="btn btn-info " title="Añadir a la factura"><i class="fa fa-plus-circle"></i></a>
												<span class="label label-success">Abierta</span>
											@endif 
										</td>
									</tr>
									@endforeach

								</tbody>
								
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

            </div>

          </div>
          

@include('_assets.modals.modal-crud')
@include('_assets.modals.modal-delete')           
@stop
