@section('scripts')
<script src="{{ URL::asset('js/chosen.jquery.js') }}"> </script>
<script src="{{ URL::asset('js/prism.js') }}"></script>
<script src="{{ URL::asset('js/jquery.maskedinput.min.js') }}"></script>


<script>
	 $(document).on('ready', function(){

      window.setTimeout(function() {
  $("#alerta").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 4000);
//chosen grafica vendedor
    $(".vendedores").chosen({   
    no_results_text: "No hay resultados para:",    
    
    width: "100%"    
  });

    // Cargar  la lista
    $.ajax("{{ action('ReporteMensualControlador@getVendedores') }}")
    .success(function(data){
      $('#vendedor').typeahead({
        source: data,
        display: 'asesor',
        val: 'id',
        itemSelected: function(item){
          $('#asesor_id').val(item);
        }
      });
    });
  });
	 //chosen producto grafica
	     $(".productos").chosen({   
    no_results_text: "No hay resultados para:",    
    
    width: "100%"    
  });

    // Cargar  la lista 
    $.ajax("{{ action('ReporteMensualControlador@getProductos') }}")
    .success(function(data){
      $('#producto').typeahead({
        source: data,
        display: 'nombre',
        val: 'id',
        itemSelected: function(item){
          $('#id').val(item);
        }
      });
    });

function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

</script>
@stop

@section('module')


<div class="row">  


   <div class="col-md-6">  
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">                
               <div align="center"> Registro grafica vendedores - promotorias</div>                  
                    
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
               	@if($status=='created')
                  <div class="alert alert-info alert-dismissible" role="alert" align="center" id="alerta">
                 <strong><h4> Nuevo vendedor agregado</h4></strong>
                </div> 
                @endif 
                
                <div class="padd">
    {{ Form::open(array('action' => 'ReporteMensualControlador@postVendedores', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'empresa','files' => true)) }}  
                    <div class="form-group">
                                  <label class="col-lg-4 control-label">Monto</label>
                                  <div class="col-lg-8">    
                                    <input type="text" class="form-control" placeholder="Monto" required name="monto" onkeypress="return valida(event)"> 
                                </div>
               
                  	</div>
                              <div class="form-group">
                                  <label class="col-lg-4 control-label">Año</label>
                                  <div class="col-lg-6">   
                                   <div class="input-group">
                                    <input type="text" class="form-control" required placeholder="example 2017" maxlength="4"   onkeypress="return valida(event)"  name="years">
                                    <span class="input-group-addon" ><i class="fa fa-calendar" aria-hidden="true"></i></span> 
   								</div>
                                </div>
               
                  	</div>
                                      <div class="form-group">
                                   <label class="col-lg-4 control-label">Mes</label>
                                    <div class="col-lg-8"> 
                                     <select class="form-control"  name="month" >
                                             <option >Seleccione</option>
                                              <option value="1">Enero</option>
                                              <option value="2">Febrero</option>
                                              <option value="3">Marzo</option>
                                              <option value="4">Abril</option>
                                              <option value="5">Mayo</option>
                                              <option value="6">Junio</option>
                                              <option value="7">Julio</option>
                                              <option value="8">Agosto</option>
                                              <option value="9">Septiembre</option>
                                              <option value="10">Octubre</option>
                                              <option value="11">Noviembre</option>
                                              <option value="12">Diciembre</option>
                                            </select>
									</div>
                           
                                </div>

                  		 <div class="form-group" id="div_vendedores">
                                  <label class="col-lg-4 control-label">Vendedores</label>
                                  <div class="col-lg-8">
                                    <select class="form-control vendedores chosen-select" name="vendedor_id">
                                      <option value="ind">Seleccione</option>
                                      @foreach($vendedores as $vendedor)
                                      <option value="{{{$vendedor->asesor_id}}}" >{{{$vendedor->asesor}}}</option>
                                      @endforeach
                                    </select>
                                    
                                  </div>
                                </div> 
                                


                           
              <div class="clearfix"></div>             
                
   
      </div>
      </div>

      <div class="widget-foot">
      <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>
     {{form::close()}}
      </div>   
    </div>

       <div class="col-md-6">  
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">                
               <div align="center"> Registro grafica ventas productos </div>                  
                    
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
               
                <div class="padd">
                  {{ Form::open(array('action' => 'ReporteMensualControlador@postProductos', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'empresa','files' => true)) }}  
                      <div class="form-group">
                                  <label class="col-lg-4 control-label">Monto</label>
                                  <div class="col-lg-8">    
                                    <input type="text" class="form-control" placeholder="Monto" required name="monto" onkeypress="return valida(event)"> 
                                </div>
               
                  	</div>

                          <div class="form-group">
                                  <label class="col-lg-4 control-label">Año</label>
                                  <div class="col-lg-6">   
                                   <div class="input-group">
                                    <input type="text" class="form-control" required placeholder="example 2017" maxlength="4"   onkeypress="return valida(event)"  name="years">
                                    <span class="input-group-addon" ><i class="fa fa-calendar" aria-hidden="true"></i></span> 
   								</div>
                                </div>
               
                  			</div>
							<div class="form-group">
                                   <label class="col-lg-4 control-label">Mes</label>
                                    <div class="col-lg-8"> 
                                     <select class="form-control"  name="month" >
                                             <option >Seleccione</option>
                                              <option value="1">Enero</option>
                                              <option value="2">Febrero</option>
                                              <option value="3">Marzo</option>
                                              <option value="4">Abril</option>
                                              <option value="5">Mayo</option>
                                              <option value="6">Junio</option>
                                              <option value="7">Julio</option>
                                              <option value="8">Agosto</option>
                                              <option value="9">Septiembre</option>
                                              <option value="10">Octubre</option>
                                              <option value="11">Noviembre</option>
                                              <option value="12">Diciembre</option>
                                            </select>
									</div>
                           
                                </div>

                   <div class="form-group" id="div_productos">
                                  <label class="col-lg-4 control-label">Productos</label>
                                  <div class="col-lg-8">
                                    <select class="form-control productos chosen-select" name="productos_id">
                                      <option value="ind">Seleccione</option>
                                      @foreach($productos as $producto)
                                      <option value="{{{$producto->id}}}" >{{{$producto->nombre}}}</option>
                                      @endforeach
                                    </select>
                                    
                                  </div>
                                </div> 
                                


                           
              <div class="clearfix"></div>             
                
   
      </div>
      </div>
      <div class="widget-foot">
      <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>
      {{form::close()}}
   
      </div>   
    </div>

@stop