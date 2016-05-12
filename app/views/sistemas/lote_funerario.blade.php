@section('scripts')
<script type="text/javascript">	
      
$(document).on('ready', function(){

	$("#btn_send").on("click", function() { 
        $("#oculto").val(1);
        $("#capture").submit();
        
      });

	var elem = document.getElementById('div_hasta'),      
    checkBox = document.getElementById('s_masivo');
checkBox.checked = false;
checkBox.onchange = function() {
    elem.style.display = this.checked ? 'block' : 'none';    
};
checkBox.onchange();


      window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 4000);

      $.ajax("{{ action('ProductoControlador@getSectoresall') }}")
    .success(function(data){
      $('#sector').typeahead({
        source: data,
        display: 'nombre',
        val: 'id',
        itemSelected: function(item){
          $('#sector_id').val(item);
        }
      });
    });
    $.ajax("{{ action('ProductoControlador@getSectoresnicho') }}")
    .success(function(data){
      $('#recinto').typeahead({
        source: data,
        display: 'nombre',
        val: 'id',
        itemSelected: function(item){
          $('#recinto_id').val(item);
        }
      });
    });

    });

</script>
@stop
@section('module')
 <!-- Matter -->

	              <div class="row">

            <div class="col-md-4">


              <div class="widget wgreen">
                
                <div class="widget-head">
                  <div class="pull-left">Nuevo Lote Funerario</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">

                    <br/>
                    <!-- Form starts.  -->
                     {{ Form::open(array('action' => 'ProductoControlador@postNuevoterreno', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'capture')) }}
                             {{-- <input type="checkbox" id='s_masivo' name="tipo_lote" value="nicho">Captura de Nicho --}}
                                <div class="form-group" id="sector_terreno">
                                  <label class="col-lg-2 control-label">Sector</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="Escribe el nombre del sector" id="sector" name="sector">
                                  	
                                  </div>
                                </div>
                                <label>                             
  
                                <div class="form-group">
                                  <label class="col-lg-2 control-label">Fila/lote</label>                                  
                                  <div class="col-lg-4">
                                    <input type="text" class="form-control" placeholder="Fila" name="fila" id="fila"  required>
                                  </div>
                                  
                                  <div class="col-lg-4">
                                    <input type="text" class="form-control" placeholder="Lote" name="lote" id="lote" required>
                                  </div>
                                </div>
                                
                                {{--<!-- hasta -->
                                
                                <div class="form-group" id="div_hasta">
                                  <label class="col-lg-2 control-label">Hasta</label>                                  
                                  <div class="col-lg-4">
                                    <input type="text" class="form-control" placeholder="Fila fin" name="fila_hasta" id="fila_hasta"  required disabled="true">
                                  </div>
                                  
                                  <div class="col-lg-4">
                                    <input type="text" class="form-control" placeholder="Lote fin" name="lote_hasta" id="lote_hasta"  required disabled="true">
                                  </div>
                                </div>

                                <!--FIN HASTA--> --}}

                                <div class="form-group">
                                  <label class="col-lg-2 control-label">Medidas</label>
                                  <div class="col-lg-4">
                                    <input type="text" class="form-control" placeholder="Largo" name="largo" id="largo">
                                  </div>
                                  
                                  <div class="col-lg-4">
                                    <input type="text" class="form-control" placeholder="Ancho" name="ancho" id="ancho">
                                  </div>
                                </div>                      
                                
                                <div class="form-group">
                                  <label class="col-lg-2 control-label">Tipo</label>
                                  <div class="col-lg-8">
                                    <select class="form-control" id="construccion" name="construccion">
                                      <option>Bajo pasto</option>                                      
                                      <option>Tradicional</option>
                                      <option>Jardin privado</option>
                                    </select>
                                  </div>
                                </div>       

                                <div class="form-group">
									<label class="col-md-2 control-label">Costo</label>
									<div class="col-md-6">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-usd"></i></span>
											<input type="text" class="form-control" name="monto" id="monto" placeholder="00.00" aria-describedby="basic-addon2">
										</div>
									</div>
								</div> 
								<div class="form-group">
									<label class="col-md-2 control-label">Comisión</label>
									<div class="col-md-6">
										<div class="input-group">
											<span class="input-group-addon">%</span>
											<input type="text" class="form-control" name="porcentaje_comision" id="porcentaje_comision" placeholder="00" aria-describedby="basic-addon2">
										</div>
									</div>
								</div>                               
                                
                                
                              
                  </div>
                </div>
                  <div class="widget-foot">
                 <button type="submit" class="btn btn-sm btn-info" id="btn_send" ><i class="fa fa-check"></i> Enviar</button> 
                    <input type="hidden" id="sector_id" name="sector_id">
                    <input type="hidden" id="tipo_producto" name="tipo_producto" value="terreno">
                    {{ Form::close() }}
                    <!-- Footer goes here -->
                  </div>
              </div> 



            </div>
              <!-- widget nicho-->
               <div class="col-md-4">


              <div class="widget wgreen">
                
                <div class="widget-head">
                  <div class="pull-left">Nuevo Nicho</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">

                    <br/>
                    <!-- Form starts.  -->
                     {{ Form::open(array('action' => 'ProductoControlador@postNuevoterreno', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'capture')) }}
                                  
                                     
                                   <div class="form-group">
                                  <label class="col-lg-2 control-label">Recinto</label>
                                  <div class="col-lg-10">
                                    <select class="form-control" name="recinto_id">
                                       
                                       @foreach($recintos as $recinto)
                                      <option value="{{{$recinto->id}}}">{{{$recinto->sector->nombre}}} {{{$recinto->nombre}}}</option>                                      
                                      <input type="hidden" name="">
                                      @endforeach
                                      
                                    </select>
                                  </div>
                                </div>
                                      
                                <div class="form-group">
                                  <label class="col-lg-2 control-label">Fila/lote</label>                                  
                                  <div class="col-lg-4">
                                    <input type="text" class="form-control" placeholder="Fila" name="fila" id="fila"  required>
                                  </div>
                                  
                                  <div class="col-lg-4">
                                    <input type="text" class="form-control" placeholder="Columna" name="lote" id="lote" required>
                                  </div>
                                </div>    

                                <div class="form-group">
                  <label class="col-md-2 control-label">Costo</label>
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                      <input type="text" class="form-control" name="monto" id="monto" placeholder="00.00" aria-describedby="basic-addon2">
                    </div>
                  </div>
                </div> 
                <div class="form-group">
                  <label class="col-md-2 control-label">Comisión</label>
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">%</span>
                      <input type="text" class="form-control" name="porcentaje_comision" id="porcentaje_comision" placeholder="00" aria-describedby="basic-addon2">
                    </div>
                  </div>
                </div>                               
                             
                  </div>
                </div>
                  <div class="widget-foot">
                 <button type="submit" class="btn btn-sm btn-info" id="btn_send" ><i class="fa fa-check"></i> Enviar</button> 
                     
                    <input type="hidden" id="tipo_producto" name="tipo_producto" value="nicho">
                    <input type="hidden" id="construccion" name="construccion" value="Nicho">
                    <input type="hidden" id="largo" name="largo" value="50">
                    <input type="hidden" id="largo" name="ancho" value="50">
                    {{ Form::close() }}
                    <!-- Footer goes here -->
                  </div>
              </div> 



            </div>
              <!-- widget nicho--> 
          </div>

        

		<!-- Matter ends -->

@stop