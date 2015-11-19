@section('scripts')
<script src="{{ URL::asset('js/chosen.jquery.js') }}"> </script>
<script src="{{ URL::asset('js/prism.js') }}"></script>
<script src="{{ URL::asset('js/jquery.maskedinput.min.js') }}"></script>
<script>

  $(document).on('ready', function(){		
     window.setTimeout(function() {
  $("#error").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 4000);

    //El boton desencadena la accion
/*$('#pagar').click(function() {
    //Se verifica si alguno de los checks esta seleccionado
    if ($('input[name="forma_pago"]').is(':checked') ) {       
       $("#form_renovacion").submit();
    }
    else {
       
        alert('Favor de seleccionar al menos un metodo de pago');
    }
}); */


    $('#check_efectivo').on('click', function(){
      if($(this).is(':checked')){
        $('#valor_efectivo').val(1);
      }else{
        $('#valor_efectivo').val(0);
      }
    });

    $('#check_credito').on('click', function(){
      if($(this).is(':checked')){
        $('#valor_credito').val(1);
      }else{
        $('#valor_credito').val(0);
      }
    });

    $('#check_debito').on('click', function(){
      if($(this).is(':checked')){
        $('#valor_debito').val(1);
      }else{
        $('#valor_debito').val(0);
      }
    });
 
  var elem = document.getElementById('div_efectivo'),      
    checkBox = document.getElementById('check_efectivo');
checkBox.checked = false;
   
checkBox.onchange = function() {
    elem.style.display = this.checked ? 'block' : 'none';
       
};
checkBox.onchange();

var elem2 = document.getElementById('div_credito'),      
    checkBox = document.getElementById('check_credito');
checkBox.checked = false;
checkBox.onchange = function() {
    elem2.style.display = this.checked ? 'block' : 'none';    
};
checkBox.onchange();

var elem3 = document.getElementById('div_debito'),      
    checkBox = document.getElementById('check_debito');
checkBox.checked = false;
checkBox.onchange = function() {
    elem3.style.display = this.checked ? 'block' : 'none';    
};
checkBox.onchange();
//fin select mantenimiento

      
    $(".mtto_types").chosen({   
    no_results_text: "No hay resultados para:",    
    
    width: "100%"    
  });

$(".asesor").chosen({   
    no_results_text: "No hay resultados para:",    
    
    width: "100%"    
  });


  });

  </script>
 

    @stop
@section('module')
 
<div class="row">
	<div class="col-md-12">
		<div class="widget">
			<div class="widget-head">
				<div class="pull-left">
					Renovación de Mantenimiento
				</div>
				<div class="btn-group pull-right">
				
				</div>  
				<div class="clearfix"></div>
			</div>
			<div class="widget-content">
				

					<!--/////////// 2 widgets -->
					<div class="matter">
        <div class="container">

          <div class="row">

            <div class="col-md-6">

              <!-- Widget -->
              <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                  <div class="pull-left">Detalles de la renovación</div>
                  <div class="widget-icons pull-right">                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <!-- Widget content -->
                  <div class="padd">
                  {{ Form::open(array('action' => 'MantenimientoControlador@postRenovacion', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'form_renovacion','files' => true)) }}
                    <div class="support-faq">
@if ($errors->any())
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Por favor corrige los siguentes errores:</strong>
      <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif
     <h4><strong>Vendedor:</strong></h4>
                                
          <select class="form-control asesor chosen-select" name="" id="asesor" >                                
                       
                      @foreach($vendedores as $vendedor)
                        
                        <option value="{{{$vendedor->vendedor_id}}}"> {{{$vendedor->asesor}}}</option>
                       @endforeach
                      <option value="0" selected="true">Gerencia</option>
                         </select>
        
          <hr />
     
     
    
                                <h4><strong>Seleccione un tipo de mantenimiento:</strong></h4>
                                <hr />
                                <div class="clearfix"></div>
                                <select class="form-control mtto_types chosen-select" name="producto_id" id="producto_id" >                                
            					@if(count($tipos_mantenimientos) > 0)	
				             	@foreach($tipos_mantenimientos as $mtto)

				            		<option value="{{{$mtto->producto_id}}}" @if($mtto->producto_id == $mtto_r->producto_id) selected @endif> {{{$mtto->nombre}}} Precio: ${{{$mtto->monto * (($config_gral->porcentaje_iva / 100) +1)}}}.00 </option>
				             	 @endforeach
				             	 @else
				             	 @foreach($tipos_mantenimientos_sin_filtro as $mtto)

				            		<option value="{{{$mtto->producto_id}}}" @if($mtto->producto_id == $mtto_r->producto_id) selected @endif> {{{$mtto->nombre}}} Precio: ${{{$mtto->monto * (($config_gral->porcentaje_iva / 100) +1)}}}.00 </option>
				             	 @endforeach
				             	 @endif 
               					 </select> <br>                                  
                             </div>

                      <br>           
                 <h4> <strong>Seleccione forma(s) de pago:</strong></h4>
                  
                    <div class="input-group">
                     <label class="checkbox-inline">
                          <input type="checkbox" id="check_efectivo" name="forma_pago" > Efectivo
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" id="check_credito"  name="forma_pago" > Tarjeta de crédito
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" id="check_debito"  name="forma_pago" > Tarjeta de débito
                        </label>
                    </div>
                 
               
                <div class="form-group" id="div_efectivo">
                  
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-usd" > </i></span>
                      <input type="text" class="form-control" name="efectivo" id="monto_efectivo" placeholder="Efectivo" aria-describedby="basic-addon2" value="{{Input::old('efectivo')}}">
                      
                    </div>
                  </div>

                </div>                 

                <div class="form-group" id="div_credito">
                  
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-usd" > </i></span>
                      <input type="text" class="form-control" name="credito" id="monto_credito" placeholder="Tarjeta de crédito" aria-describedby="basic-addon2" value="{{Input::old('credito')}}">
                   
                    </div>
                  </div>
                </div>  

                <div class="form-group" id="div_debito">
                  
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-usd" > </i></span>
                     
                      <input type="text" class="form-control" name="debito" id="monto_debito" placeholder="Tarjeta de débito" aria-describedby="basic-addon2" value="{{Input::old('debito')}}" >
                    </div>
                  </div>
                </div>
                <br>
                <h4> <strong>Comentarios</strong></h4>                             
                     <input type="text" class="form-control" placeholder="Observaciones" name="comentarios">    
                  </div>
                  <div class="clearfix"></div>
                  <!-- Widget footer -->
                  <div class="widget-foot">

				<a href="{{ action('MantenimientoControlador@getIndex') }}" class="btn btn-default"><i class="fa fa-reply"></i> Atrás</a>
				
				<button type="submit" class="btn btn-success" id="pagar"><i class="fa fa-usd"></i> Pagar</button>				
			
                    <p>*Nota: El tipo de antenimiento seleccionado corresponde al último que se contrató</p>
                  </div>
                  <input type="hidden" name="id" value="{{{$mtto_r->id}}}">
                  <input type="hidden" name="lote_id" value="{{{$mtto_r->lote_id}}}">
                  <input type="hidden" name="config_gral_id" value="{{{$config_gral->id}}}">
                  <input type="hidden" name="iva" value="{{{(($config_gral->porcentaje_iva / 100) +1)}}}">
                  <input type="hidden" name= "folio_solicitud" value="{{{$config_gral->folio_mtto +1}}}">                  
                  <input type="hidden" name="cliente_id" value="{{{$mtto_r->cliente_id}}}">
                  <input type="hidden"  id="valor_efectivo" name="valor_efectivo">
                  <input type="hidden"  id="valor_credito" name="valor_credito">
                  <input type="hidden"  id="valor_debito" name="valor_debito">

                  
                  {{form::close()}}
                </div>

              </div> 

            </div>

            <div class="col-md-6">

              <!-- Widget -->
              <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                  <div class="pull-left">Datos Generales</div>
                  <div class="widget-icons pull-right">
                   
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <!-- Widget content -->
                  <div class="padd">
                                               <!-- Contact box -->
                             <div class="support-contact">
                             @if($mtto_r->verifica == 0)
								<div class="alert alert-danger">
								 <i class="fa fa-times"></i>  El manteniemiento contratado <strong>NO</strong> corresponde al tipo de propiedad, favor revisar.
								 </div>
								<hr />
								@else
								<div class="alert alert-success">
								  <i class="fa fa-check-square-o"></i> El manteniemiento contratado corresponde correctamente con el tipo de propiedad.
								 </div>
								<hr />
								@endif
                                <!-- Phone, email and address with font awesome icon -->
                                <p>Ubicación: <strong>{{{$mtto_r->ubicacion}}}</strong> </p>
                                <p>Tipo de terreno: <strong>{{{$mtto_r->descripcion}}} </strong>
                                <p> Mtto. contratado: <strong>{{{$mtto_r->producto}}}</strong>.</p>
                                <p> Inhumado(s): <ul> @foreach($inhumados_r as $inhumado)
                                 						@if($mtto_r->ubicacion == $inhumado->ubicacion) 
													<li> <strong><i class="fa fa-plus"></i>   {{{$inhumado->inhumado}}}</strong> </li>
												@endif 
                                 						
                                 				@endforeach
                                 			</ul>
								<hr />
								
																
                                <p><i class="fa fa-user"></i>&nbsp; Contratante actual:<strong> {{{$mtto_r->cliente}}}</strong></p>
                                                                
                                @if($telefono_casa)
                                	{{ Form::open(array('action' => 'MantenimientoControlador@postEditTelCasa', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'cliente','files' => true)) }}
	                                	
	                                	<p><i class="fa fa-phone"></i>&nbsp; Casa<strong>:</strong> <input type="text" class="form-control" placeholder="Escriba telefono (---) -- --"  
	                                    id="tel_casa_edit" name="tel_casa_edit"  required value="{{{$telefono_casa->telefono}}}"> </p> 
                                		<input type="hidden" name="id" value="{{{$telefono_casa->id}}}">								 
								 		<button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-refresh"></i> Editar</button>
                                	
                                	{{@form::close()}}
                                
                                @endif

                                @if($telefono_celular)
                                	
									{{ Form::open(array('action' => 'MantenimientoControlador@postEditTelCel', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'cliente','files' => true)) }}
                                	
                                	<p><i class="fa fa-mobile"></i>&nbsp; Celular<strong>:</strong> <input type="text" class="form-control " placeholder="Escriba telefono (---) -- --"  
	                                    id="tel_casa_edit" name="tel_cel_edit"  required value="{{{$telefono_celular->telefono}}}"> </p> 
                                		<input type="hidden" name="id" value="{{{$telefono_celular->id}}}"> </p>
								 		<button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-refresh"></i> Editar</button>
                                	
                                	{{@form::close()}}
                                
                                @endif 
                                	
                                @if(count($telefono_casa)== 0 and count($telefono_celular) == 0) 
                                
                                {{ Form::open(array('action' => 'MantenimientoControlador@postRenovacionCasaNuevo', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'cliente','files' => true)) }}        
                                
                                <div class="alert alert-warning">
								   <i class="fa fa-warning"> </i> Favor de capturar almenos un numero telefónico
								 <p><i class="fa fa-phone"></i>&nbsp; Casa<strong>:</strong> <input type="text" class="form-control " placeholder="Escriba telefono (---) -- --"  
                                    id="tel_casa" name="tel_casa_new"  required value="{{{Input::old('tel_casa')}}}"> </p>
								 <input type="hidden" name="cliente_id" value="{{{$mtto_r->cliente_id}}}">
								 
								 <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-floppy-o"></i> Guardar</button>
								</div>
								{{@form::close()}}	
                                @endif
                                <hr />
                                @forelse($clientes as $cliente)
								@if($cliente->id == $mtto_r->cliente_id)
                                <p><i class="fa fa-home"></i>&nbsp; Domicilio<strong>:</strong> Calle {{{$cliente->calle}}} @if($cliente->numero_exterior <> '')No. {{{$cliente->numero_exterior}}} @endif @if($cliente->numero_interior <> '') Int. {{{$cliente->numero_interior}}} @endif
									{{{$cliente->referencias}}} Colonia {{{$cliente->colonia}}} C.P. {{{$cliente->codigo_postal}}}, {{{$cliente->municipio}}}
									{{{$cliente->estado}}}
                                </p>
								<hr />
								@endif
                                @empty
                                @endforelse
                                
                                <!-- Button -->
                                <a href="contact.html" class="btn btn-danger btn-sm">Contact Us</a> &nbsp; <a href="faq.html" class="btn btn-info btn-sm">Check out FAQ</a>
                             </div>
                  </div>
                </div>
                
				
              </div> 

            </div>

          </div>         

        </div>
		  </div>
				   <!--///////////// -->
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