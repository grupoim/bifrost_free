
@section('scripts')
<script src="{{ URL::asset('js/jquery.maskedinput.min.js') }}"> </script>
<script src="{{ URL::asset('js/chosen.jquery.js') }}"> </script>
<script src="{{ URL::asset('js/prism.js') }}"></script>
<script>  
$(document).on('ready', function(){

      window.setTimeout(function() {
  $("#alerta").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 2000);
    $(".solicitud").chosen({   
    no_results_text: "No hay resultados para:",    
    'placeholder_text_multiple':'Da clic para escoger productos...',
    width: "286px"
  });
    {{-- fin ocultar mensajes de alerta automaticamente ======= --}}
           

             jQuery(function($){
            $("#telefono").mask("(999) 999 - 9999");
            $("#telefono1").mask("(999) 999 - 9999");
            $("#telefono2").mask("(999) 999 - 9999");

            
        });
   $("#otro").show();
   $("#especifique").hide();

      $("#otro").click(function () {  
        $("#especifique").toggle();

           });


    //carga la lista de domicilios
      $.ajax("{{ action('SolicitudEmpleoControlador@getDomicilio') }}")
    .success(function(data){
      $('#colonia').typeahead({
        source: data,
        display: 'colonia', 
        val: 'colonia_id',
        itemSelected: function(item){
          $('#colonia').val(item);
        }
      });
    });
        //carga la lista de domicilios
      $.ajax("{{ action('SolicitudEmpleoControlador@getDomicilio') }}")
    .success(function(data){
      $('#colonia1').typeahead({
        source: data,
        display: 'colonia',
        val: 'colonia_id',
        itemSelected: function(item){
          $('#colonia1').val(item);
        }
      });
    });
        //carga la lista de domicilios
      $.ajax("{{ action('SolicitudEmpleoControlador@getDomicilio') }}")
    .success(function(data){
      $('#colonia2').typeahead({
        source: data,
        display: 'colonia',
        val: 'colonia_id',
        itemSelected: function(item){
          $('#colonia2').val(item);
        }
      });
    });
    @foreach($datos as $d) 
  $.ajax("{{ action('SolicitudEmpleoControlador@getDomicilio') }}")
    .success(function(data){
      $('#{{$d->id}}').typeahead({
        source: data,
        display: 'colonia',
        val: 'colonia_id',
        itemSelected: function(item){
          $('#{{$d->id}}').val(item);
        }
      });
    });
@endforeach
        });
</script>
@stop
@section('module')
  {{ Form::open(array('action' => 'SolicitudEmpleoControlador@postSolicitud', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'registro')) }}
    
  
   <div class="col-md-12">  
   @if($status=='registro')
                  <div class="alert alert-info alert-info " role="alert" align="center" id="alerta">
                 <strong><h4> Solicitud registrada correctamente</h4></strong>
                </div> 
  @endif 
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                
              <div align="left">Empleo </div>
                  <div class="widget-icons pull-right">                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
               <div class="padd">
   

              <div class="form-group" >
                      <label class="col-lg-4 control-label"><strong>Puesto </strong></label>
                         <div class="col-lg-4">
                           <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-black-tie" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Puesto que solicita"  id="puesto" name="puesto" required>  
                            </div>                            
                   </div>
                  </div>
                   <div class="form-group" >
                      <label class="col-lg-4 control-label"><strong>Coordinador </strong></label>
                         <div class="col-lg-4">
                      <select class="form-control solicitud chosen-select" name="cordinador" id="cordinador">
                          <option value="0">Seleccione</option>
                             @foreach($cordinador as $c)
                               <option value="{{{$c->cordinador_id}}}" >{{{$c->cordinador}}}</option>
                              @endforeach
                      </select>
                        </div>
                  </div>
                    <div class="form-group" >
                      <label class="col-lg-4 control-label"><strong>Zona asignada </strong></label>
                         <div class="col-lg-4">
                         <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-street-view" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Zona asignada"  id="zona" name="zona">                               
                        </div>
                        </div>
                  </div>
 
     
      </div>

      </div>
      </div>   
</div>
   <div class="col-md-12">  

    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                
              <div align="left">Datos personales </div>
                  <div class="widget-icons pull-right">                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
               <div class="padd">

   <div class="container-fluid">
  <div class="row">
    <div class="col-sm-6">
                        <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Nombre </strong></label>
                         <div class="col-lg-8">
                           <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Nombre"  id="nombres" name="nombres" required>  
                            </div>                            
                   </div>
                  </div>
                   <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Apellido paterno </strong></label>
                         <div class="col-lg-8">
                       <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Apellido paterno"  id="apellido_paterno" name="apellido_paterno" required>                               
                        </div>
                        </div>
                  </div>
                    <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Apellido materno </strong></label>
                         <div class="col-lg-8">
                         <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Apellido materno"  id="apellido_materno" name="apellido_materno" required>                               
                        </div>
                        </div>
                  </div>

                     <div class="form-group" >
                          <label class="col-lg-3 control-label"><strong>Telefono </strong></label>
                            <div class="col-lg-3">                   
                                   <input type="number" class="form-control" placeholder="52" value="52" name="codigo_pais" id="codigo_pais" required>
                            </div>
                              <div class="col-lg-5">
                           <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>                       
                         <input type="text" class="form-control" placeholder="Numero" id="telefono" name="telefono" required >
                        </div>
                      </div>
                    </div>  
                     <div class="form-group">
                          <label class="col-lg-3 control-label">Tipo telefono</label>
                                <div class="col-lg-8">
                                   <select class="form-control" name="tipo_telefono" id="tipo_telefono">
                                     <option value="0">Seleccione</option>
                                     @foreach($tipo_telefono as $t)
                                      <option value="{{{$t->id}}}" >{{{$t->descripcion}}}</option>
                                      @endforeach
                                    </select>                                    
                                  </div>
                                </div>
                  <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Edad </strong></label>
                         <div class="col-lg-8">
                           <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-heart" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Edad"  id="edad" name="edad" required>  
                            </div>                            
                   </div>
                  </div>
                 <div class="form-group" >
                    <label class="col-lg-3 control-label"><strong>Sexo </strong></label>
                     <div class="col-lg-8" >
                         <label class="radio-inline" ><input type="radio" name="sexo"  value="1" id="sexo" ><strong>Masculino</strong> </label>
                         <label class="radio-inline"><input type="radio" name="sexo" value="0" id="sexo"><strong>Femenino</strong></label>
                      </div>
                     </div>                     
                   <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Estado civil</strong></label>
                        <div class="col-lg-8" >
                         @foreach($estado_civil as $es_civ)
                         <label class="radio-inline" ><input type="radio" name="estado_civil"  value="{{$es_civ->id}}" id="estado_civil" ><strong>{{$es_civ->descripcion}}</strong> </label>
                         @endforeach                   
                        </div>
                     </div>

    </div>
    <div class="col-sm-6">
      

                                         <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Colonia</strong></label>
                         <div class="col-lg-8">
                         <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-home" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Colonia"  id="colonia" name="colonia" required>                               
                        </div>
                        </div>
                   </div>

                    <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Calle</strong></label>
                         <div class="col-lg-8">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-road" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Calle"  id="calle" name="calle" required>                               
                         </div>
                        </div>
                   </div>                   
                    <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Numeros</strong></label>
                        <div class="col-lg-4">                   
                         <div class="input-group">
                           <span class="input-group-addon">#</span>                       
                           <input type="text" class="form-control" placeholder="Interior" id="numero_interior" name="numero_interior" >
                        </div>                       
                     </div>
                    <div class="col-lg-4">
                       <div class="input-group">
                         <span class="input-group-addon">#</span>                       
                     <input type="text" class="form-control" placeholder="Exterior" id="numero_exterior" name="numero_exterior" >
                    </div>
                  </div>
                    </div>
                      <div class="form-group">
                          <label class="col-lg-3 control-label">Lugar nacimiento</label>
                                <div class="col-lg-8">
                                   <select class="form-control solicitud chosen-select" name="lugar_nacimiento" id="lugar_nacimiento">
                                     <option value="0">Seleccione</option>
                                     @foreach($estados as $estado)
                                      <option value="{{{$estado->nombre}}}" >{{{$estado->nombre}}}</option>
                                      @endforeach
                                    </select>                                    
                                  </div>
                                </div>
                 <div class="form-group">
                    <label class="col-lg-3 control-label">Fecha nacimiento</label>
                        <div class="col-lg-8">
                          <div id="datetimepicker1" class="input-append input-group date" >
                             <input data-format="yyyy-MM-dd" type="text" class="form-control " name="fecha_nacimiento" id="fecha_nacimiento">                                                    
                             <span class="input-group-addon add-on" >
                             <i data-time-icon="fa fa-times" data-date-icon="fa fa-calendar"></i>
                            </span>
                        </div>
                     </div>
                 </div>
                 <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Vive con</strong></label>
                        <div class="col-lg-8" >
                         @foreach($datos as $d)
                         @if($d->vive_con ==1)
                         <label class="radio-inline" ><input type="radio" name="vive_con"  value="{{$d->id}}" id="vive_con" ><strong>{{$d->nombre}}</strong> </label>
                         @endif
                         @endforeach                   
                     </div>
                     </div>
                  <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Dependientes</strong></label>
                         <div class="col-lg-8">
                          <label class="checkbox-inline"><input type="checkbox"  name="hijos" value="hijos"><strong>Hijos</strong></label>
                          <label class="checkbox-inline"><input type="checkbox"  name="conyuge" value="cónyuge"><strong>Cónyuge</strong></label>
                          <label class="checkbox-inline"><input type="checkbox"  name="padres" value="padres"><strong>Padres</strong></label> 
                          <label class="checkbox-inline"><input type="checkbox" id="otro" ><strong>Otro</strong></label> 
                         </div>
                    </div>
                    <div class="form-group" id="especifique" >
                      <label class="col-lg-3 control-label"><strong>Especifique</strong></label>
                         <div class="col-lg-8">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Especifique"   name="otros" >                               
                         </div>
                        </div>
                    </div>
                 </div>   
               <div class="clearfix"></div> 
                 <div class="well">                        
                      <div class="form-group" >
                          <label class="col-lg-4 control-label"><strong>CURP </strong></label>
                               <div class="col-lg-4">
                                   <div class="input-group">
                                   <span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                                   <input type="text" class="form-control" style="text-transform: uppercase;" placeholder="CURP"  id="curp" name="curp" required>  
                                  </div>                            
                                </div>
                              </div>
                             <div class="form-group" >
                              <label class="col-lg-4 control-label"><strong>RFC </strong></label>
                                <div class="col-lg-4">
                                  <div class="input-group">
                                   <span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                                   <input type="text" class="form-control" style="text-transform: uppercase;" placeholder="RFC"  id="rfc" name="rfc" required>                               
                                  </div>
                               </div>
                            </div>
                           <div class="form-group" >
                              <label class="col-lg-4 control-label"><strong>IMSS </strong></label>
                                <div class="col-lg-4">
                                  <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-hospital-o" aria-hidden="true"></i></span>
                                   <input type="text" class="form-control" style="text-transform: uppercase;" placeholder="IMSS"  id="imss" name="imss" required>                               
                                 </div>
                              </div>
                            </div> 
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
          </div> 
 <div class="clearfix"></div>     
   
<div class="col-md-12">  
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                
              <div align="left">Datos Familiares</div>
                  <div class="widget-icons pull-right">                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
               <div class="padd">               
             <div class="page-tables">               
                <div class="table-responsive">
                  <table  class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th><strong>Familiar</strong></th>
                        <th><strong>Nombre</strong></th>
                        <th><strong>Estatus</strong></th>
                        <th><strong>Domicilio</strong></th>
                        <th><strong>Ocupación</strong></th>

                        
                      </tr>
                    </thead>
                    <tbody>   
                      @foreach($datos as $d)
                      @if($d->familiares ==1)
                      <tr>
                      <td><input type="hidden" value="{{$d->id}}" name="id_f[{{$d->id}}]"></td>
                      <td><strong>{{$d->nombre}}</strong></td>

                    <td>
                        <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Nombre completo"  id="nombres_f" name="nombres_f[{{$d->id}}]" required>                             
                   </div>
                   </td>
                   <td>
                         <label class="radio-inline" ><input type="radio" name="vive[{{$d->id}}]"  value="1" id="vive" ><strong>Vive</strong> </label><br>
                         <label class="radio-inline"><input type="radio" name="vive[{{$d->id}}]" value="0" id="vive"><strong>Finado</strong></label>
                   </td>
                   <td>
                     <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-home" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Colonia"  id="{{$d->id}}" name="colonia_f[{{$d->id}}]" required>                               
                        </div><br>
                        <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-road" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Calle"  id="calle_f" name="calle_f[{{$d->id}}]" required>                               
                        </div><br>
                 <div class="form-group" >
                        <div class="col-lg-5">                   
                         <div class="input-group">
                           <span class="input-group-addon">#</span>                       
                           <input type="text" class="form-control" placeholder="Interior" id="numero_interior_f" name="numero_interior_f[{{$d->id}}]">
                        </div>                       
                     </div>
                    <div class="col-lg-5">
                       <div class="input-group">
                         <span class="input-group-addon">#</span>                       
                     <input type="text" class="form-control" placeholder="Exterior" id="numero_exterior_f" name="numero_exterior_f[{{$d->id}}]">
                    </div>
                  </div>
                </div>  
                   </td>
                   <td>
                      <select class="form-control solicitud chosen-select" name="ocupacion_f[{{$d->id}}]" id="ocupacion_f">
                          <option value="0">Seleccione</option>
                             @foreach($datos as $d)
                             @if($d->ocupacion == 1)
                               <option value="{{{$d->nombre}}}" >{{{$d->nombre}}}</option>
                             @endif 
                              @endforeach
                      </select>
                   </td>
                     </tr>
                      @endif
                      @endforeach
                    </tbody>                    
                  </table> 
                  <div class="clearfix"></div>                      
                </div>
              </div> 
        </div>  
      </div>
    </div>
    </div>
  
   <div class="col-md-12">  
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                
              <div align="left">Referencias</div>
                  <div class="widget-icons pull-right">                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
               <div class="padd">
   <div class="container-fluid">
  <div class="row">
    <div class="col-sm-6">
                  <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Nombre </strong></label>
                         <div class="col-lg-8">
                           <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Nombre"  id="nombres_r1" name="nombres_r1" required>  
                            </div>                            
                   </div>
                  </div>
                   <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Apellido paterno </strong></label>
                         <div class="col-lg-8">
                       <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Apellido paterno"  id="apellido_paterno_r1" name="apellido_paterno_r1" required>                               
                        </div>
                        </div>
                  </div>
                    <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Apellido materno </strong></label>
                         <div class="col-lg-8">
                         <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Apellido materno"  id="apellido_materno_r1" name="apellido_materno_r1" required>                               
                        </div>
                        </div>
                  </div>

                 <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Telefono </strong></label>
                        <div class="col-lg-3">                   
                               <input type="number" class="form-control" placeholder="52" value="52" name="codigo_pais_r1" id="codigo_pais_r1" required>
                        </div>
                          <div class="col-lg-5">
                       <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>                       
                     <input type="text" class="form-control" placeholder="Numero" id="telefono1" name="telefono1" required >
                    </div>
                  </div>
                </div> 
               <div class="form-group" > 
                  <label class="col-lg-3 control-label">Tipo telefono</label>
                       <div class="col-lg-8">
                           <select class="form-control" name="tipo_telefono_r1" id="tipo_telefono_r1">
                             <option value="0">Seleccione</option>
                                @foreach($tipo_telefono as $t)
                                  <option value="{{{$t->id}}}" >{{{$t->descripcion}}}</option>
                                @endforeach
                            </select>                                    
                          </div>
                      </div>       
                <div class="form-group" >
                    <label class="col-lg-3 control-label"><strong>Tiempo conocerlo </strong></label>
                      <div class="col-lg-4"> 
                        <div class="input-group"> 
                           <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>                                        
                           <input type="number" class="form-control"  name="tiempo_conocerlo_r1" id="tiempo_conocerlo_r1" required>
                        </div>
                        </div>
                         <div class="col-lg-4">
                          <select  class="form-control"  name="tiempo_r1">
                                 <option value="Años">Años</option>
                                <option value="Meses">Meses</option>
                                <option value="Dias">Dias</option>
                        </select>     
                  </div>
                </div>  
                    <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Colonia</strong></label>
                         <div class="col-lg-8">
                         <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-home" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Colonia"  id="colonia1" name="colonia1" required>                               
                        </div>
                        </div>
                   </div>

                    <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Calle</strong></label>
                         <div class="col-lg-8">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-road" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Calle"  id="calle_r1" name="calle_r1" required>                               
                         </div>
                        </div>
                   </div>                   
                    <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Numeros</strong></label>
                        <div class="col-lg-4">                   
                         <div class="input-group">
                           <span class="input-group-addon">#</span>                       
                           <input type="text" class="form-control" placeholder="Interior" id="numero_interior_r1" name="numero_interior_r1">
                        </div>                       
                     </div>
                    <div class="col-lg-4">
                       <div class="input-group">
                         <span class="input-group-addon">#</span>                       
                     <input type="text" class="form-control" placeholder="Exterior" id="numero_exterior_r1" name="numero_exterior_r1" >
                    </div>
                  </div>
                    </div>
                    <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Ocupación</strong></label>
                         <div class="col-lg-8">
                      <select class="form-control solicitud chosen-select" name="ocupacion_r1" id="ocupacion_r1">
                          <option value="0">Seleccione</option>
                             @foreach($datos as $d)
                             @if($d->ocupacion == 1)
                               <option value="{{{$d->id}}}" >{{{$d->nombre}}}</option>
                             @endif 
                              @endforeach
                      </select>
                        </div>
                  </div>
                      </div>
    <div class="col-sm-6">  
                
                  <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Nombre </strong></label>
                         <div class="col-lg-8">
                           <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Nombre"  id="nombres_r2" name="nombres_r2" required>  
                            </div>                            
                   </div>
                  </div>
                   <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Apellido paterno </strong></label>
                         <div class="col-lg-8">
                       <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Apellido paterno"  id="apellido_paterno_r2" name="apellido_paterno_r2" required>                               
                        </div>
                        </div>
                  </div>
                    <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Apellido materno </strong></label>
                         <div class="col-lg-8">
                         <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Apellido materno"  id="apellido_materno_r2" name="apellido_materno_r2" required>                               
                        </div>
                        </div>
                  </div>

                 <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Telefono </strong></label>
                        <div class="col-lg-3">                   
                               <input type="number" class="form-control" placeholder="52" value="52" name="codigo_pais_r2" id="codigo_pais_r2" required>
                        </div>
                          <div class="col-lg-5">
                       <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>                       
                     <input type="text" class="form-control" placeholder="Numero" id="telefono2" name="telefono2" required >
                    </div>
                  </div>
                </div> 
                <div class="form-group" >  
                  <label class="col-lg-3 control-label">Tipo telefono</label>
                       <div class="col-lg-8">
                           <select class="form-control" name="tipo_telefono_r2" id="tipo_telefono_r2">
                             <option value="0">Seleccione</option>
                                @foreach($tipo_telefono as $t)
                                  <option value="{{{$t->id}}}" >{{{$t->descripcion}}}</option>
                                @endforeach
                            </select>                                    
                          </div>
                      </div>       
                 <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Tiempo conocerlo </strong></label>
                        <div class="col-lg-4"> 
                        <div class="input-group"> 
                             <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>                                        
                             <input type="number" class="form-control"  name="tiempo_conocerlo_r2" id="tiempo_conocerlo_r2" required>
                        </div>
                        </div>
                         <div class="col-lg-4">
                          <select  class="form-control"  name="tiempo_r2">
                                 <option value="Años">Años</option>
                                <option value="Meses">Meses</option>
                                <option value="Dias">Dias</option>
                        </select>     
                  </div>
                </div> 
                    <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Colonia</strong></label>
                         <div class="col-lg-8">
                         <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-home" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Colonia"  id="colonia2" name="colonia2" required>                               
                        </div>
                        </div>
                   </div>
                    <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Calle</strong></label>
                         <div class="col-lg-8">
                          <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-road" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Calle"  id="calle_r2" name="calle_r2" required>                               
                         </div>
                        </div>
                   </div>                   
                    <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Numeros</strong></label>
                        <div class="col-lg-4">                   
                         <div class="input-group">
                           <span class="input-group-addon">#</span>                       
                           <input type="text" class="form-control" placeholder="Interior" id="numero_interior_r2" name="numero_interior_r2">
                        </div>                       
                     </div>
                    <div class="col-lg-4">
                       <div class="input-group">
                         <span class="input-group-addon">#</span>                       
                     <input type="text" class="form-control" placeholder="Exterior" id="numero_exterior_r2" name="numero_exterior_r2" >
                    </div>
                  </div>
                    </div>
                    <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Ocupación</strong></label>
                         <div class="col-lg-8">
                      <select class="form-control solicitud chosen-select" name="ocupacion_r2" id="ocupacion_r2">
                          <option value="0">Seleccione</option>
                             @foreach($datos as $d)
                             @if($d->ocupacion == 1)
                               <option value="{{{$d->id}}}" >{{{$d->nombre}}}</option>
                             @endif 
                              @endforeach
                      </select>
                        </div>
                  </div>          
             </div>
           </div>
         </div>
        </div>  
      </div>
    </div>
  </div>

   <div class="col-md-12">  
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                
              <div align="left">Escolaridad</div>
                  <div class="widget-icons pull-right">                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
               <div class="padd">               
             <div class="page-tables">               
                <div class="table-responsive">
                  <table  class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th><strong>Estudios</strong></th>
                        <th><strong>Nombre</strong></th>
                        <th><strong>Fechas De - A</strong></th>
                        <th><strong>Años</strong></th>
                        <th><strong>Direccion</strong></th>
                        <th><strong>Titulo recibido</strong></th>
                        
                      </tr>
                    </thead>
                    <tbody>   
                      @foreach($datos as $d)
                      @if($d->nivel_estudio == 1)
                      <tr>
                      <td><input type="hidden" value="{{$d->id}}" name="id_e[{{$d->id}}]"></td>
                      <td><strong>{{$d->nombre}}</strong></td>
                    <td>
                        <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Nombre"  id="nombres_e" name="nombres_e[{{$d->id}}]">
                   </td>
                   <td>
                      <input type="date"  placeholder="Fecha inicio" name="fecha_inicio[{{$d->id}}]"><br>
                      <input type="date"   placeholder="Fecha fin" name="fecha_fin[{{$d->id}}]">
                   </td>
                   <td>
                        <div class="input-group"> 
                             <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>                                        
                             <input type="number" class="form-control"  name="años[{{$d->id}}]" id="años" >
                        </div>

                   </td>
                   <td>
                     <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-home" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Colonia"  id="{{$d->id}}" name="colonia_e[{{$d->id}}]" >                               
                        </div><br>
                        <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-road" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Calle"  id="calle_e" name="calle_e[{{$d->id}}]">                               
                        </div><br>
                 <div class="form-group" >
                        <div class="col-lg-5">                   
                         <div class="input-group">
                           <span class="input-group-addon">#</span>                       
                           <input type="text" class="form-control" placeholder="Interior" id="numero_interior_e" name="numero_interior_e[{{$d->id}}]" >
                        </div>                       
                     </div>
                    <div class="col-lg-5">
                       <div class="input-group">
                         <span class="input-group-addon">#</span>                       
                     <input type="text" class="form-control" placeholder="Exterior" id="numero_exterior_e" name="numero_exterior_e[{{$d->id}}]" >
                    </div>
                  </div>
                </div>  
                   </td>
                   <td>
                      <select class="form-control " name="titulo[{{$d->id}}]" id="titulo">
                          <option value="0">Selec</option>
                             @foreach($datos as $d)
                             @if($d->titulo == 1)
                               <option value="{{{$d->nombre}}}" >{{{$d->nombre}}}</option>
                             @endif 
                              @endforeach
                      </select>
                   </td>
                     </tr>
                      @endif
                      @endforeach
                    </tbody>                    
                  </table> 
                  <div class="clearfix"></div>                      
                </div>
              </div> 
        </div>  
      </div>
    </div>
    </div>



<div class="widget-foot" align="right">
      <a  href= "{{URL::to('prospectos/')}}" class="btn btn-default" >Regresar</a>  
      <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>
{{ Form::close() }}       
           @stop
