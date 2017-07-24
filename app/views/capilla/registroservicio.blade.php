
@section('scripts')
<script src="{{ URL::asset('js/jquery.maskedinput.min.js') }}"> </script>
  <link rel="stylesheet" href="{{ URL::asset('css/multi-select.css') }}">  
<script>  
$(document).on('ready', function(){

      window.setTimeout(function() {
  $("#alerta").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 2000);
   
    {{-- fin ocultar mensajes de alerta automaticamente ======= --}}




             jQuery(function($){
            $("#numero1").mask("9,99", {
 
                // Generamos un evento en el momento que se rellena
                completed:function(){
                    $("#numero1").addClass("ok")
                }
            });
 
            $("#telefono").mask("(999) 999 - 9999");

       
        });
   

// buscadores de multi select
$('.searchable').multiSelect({
  selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='Buscar...'>",
  selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='Buscar...'>",
  afterInit: function(ms){
    var that = this,
        $selectableSearch = that.$selectableUl.prev(),
        $selectionSearch = that.$selectionUl.prev(),
        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
    .on('keydown', function(e){
      if (e.which === 40){
        that.$selectableUl.focus();
        return false;
      }
    });

    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
    .on('keydown', function(e){
      if (e.which == 40){
        that.$selectionUl.focus();
        return false;
      }
    });
  },
  afterSelect: function(){
    this.qs1.cache();
    this.qs2.cache();
  },
  afterDeselect: function(){
    this.qs1.cache();
    this.qs2.cache();
  }
});

        });
</script>
@stop
@section('module')

   <div class="col-md-6">  
    
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                
              <div align="left">Datos del inhumado </div>
                  <div class="widget-icons pull-right">                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
               <div class="padd">
           
                     {{ Form::open(array('action' => 'ServicioFuneralControlador@postRescatista', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'registro')) }}

              <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Nombre </strong></label>
                         <div class="col-lg-7">
                           <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Nombre"  id="nombres" name="nombres" required>  
                            </div>                            
                   </div>
                  </div>
                   <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Apellido paterno </strong></label>
                         <div class="col-lg-7">
                       <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Apellido paterno"  id="apellido_paterno" name="apellido_paterno" required>                               
                        </div>
                        </div>
                  </div>
                    <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Apellido materno </strong></label>
                         <div class="col-lg-7">
                         <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Apellido materno"  id="apellido_materno" name="apellido_materno" required>                               
                        </div>
                        </div>
                  </div>
                     <div class="form-group">
                                  <label class="col-lg-3 control-label">Fecha nacimiento</label>
                                  <div class="col-lg-5">
                                   <div id="datetimepicker1" class="input-append input-group date" >
                                        <input data-format="yyyy-MM-dd" type="text" class="form-control " name="fecha_nacimiento">                                                    
                                        <span class="input-group-addon add-on" >
                                        <i data-time-icon="fa fa-times" data-date-icon="fa fa-calendar"></i>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                   <div class="form-group">
                                  <label class="col-lg-3 control-label">Fecha deceso</label>
                                  <div class="col-lg-5">
                                   <div id="datetimepicker1" class="input-append input-group date" >
                                        <input data-format="yyyy-MM-dd" type="text" class="form-control " name="fecha_deceso">                                                    
                                        <span class="input-group-addon add-on" >
                                        <i data-time-icon="fa fa-times" data-date-icon="fa fa-calendar"></i>
                                      </span>
                                    </div>
                                  </div>
                                </div>
              <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Edad </strong></label>
                         <div class="col-lg-4">
                               <input type="text" class="form-control" placeholder="Edad" name="edad" id="edad" required>
                        </div>
                  </div>

              <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Datos fisicos </strong></label>
                         <div class="col-lg-3">
                          <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-child" aria-hidden="true"></i></span>    
                               <input type="text" class="form-control" placeholder="Peso" name="peso" id="peso" required>
                        </div>
                        </div>
                        <div class="col-lg-4">
                        <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-child" aria-hidden="true"></i></span>    
                               <input type="text" class="form-control" placeholder="Estatura" name="estatura" id="estatura" required>
                        </div>
                        </div>
                  </div>
             <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Causa de defunción </strong></label>
                         <div class="col-lg-5">
                               <textarea type="text" class="form-control" placeholder="Descripción" name="descripcion" id="descripcion" required></textarea>
                        </div>
                        <div class="col-lg-3">
                        <label class="radio"><input type="radio" name="infecciosa" value="" id="infecciosa"><strong>No infecciosa</strong></label>
                          <label class="radio"><input type="radio" name="infecciosa" value="" id="infecciosa"><strong>Infecciosa</strong></label>
                          
                        </div>
                  </div>{{ Form::close() }}  
     
      </div>

      </div>
      </div>   
</div>
   <div class="col-md-6">  
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                
              <div align="left">Testigo del inhumado </div>
                  <div class="widget-icons pull-right">                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
               <div class="padd">
              {{ Form::open(array('action' => 'ServicioFuneralControlador@postRescatista', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'registro')) }}

  
                  <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Nombre </strong></label>
                         <div class="col-lg-7">
                           <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Nombre"  id="nombres" name="nombres" required>  
                            </div>                            
                   </div>
                  </div>
                   <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Apellido paterno </strong></label>
                         <div class="col-lg-7">
                       <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Apellido paterno"  id="apellido_paterno" name="apellido_paterno" required>                               
                        </div>
                        </div>
                  </div>
                    <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Apellido materno </strong></label>
                         <div class="col-lg-7">
                         <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                              <input type="text" class="form-control" placeholder="Apellido materno"  id="apellido_materno" name="apellido_materno" required>                               
                        </div>
                        </div>
                  </div>
                  <div class="form-group">                                
                   <label  class="col-md-3 control-label">Parentezco </label> 
                       <div  class="col-md-7">
                           <select  class="form-control" name="parentezco_id" id="parentezco_id" >
                           <option value="0">Seleccione una opción</option>
                              @foreach($parentezcos as $parentezco)   
                                       <option value="{{$parentezco->id}}"> {{{$parentezco->descripcion}}}</option>                                            
                             @endforeach   
                          </select>                    
                        </div>
                 </div>
                 <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Telefono </strong></label>
                        <div class="col-lg-3">                   
                               <input type="number" class="form-control" placeholder="52" value="52" name="codigo_pais" id="codigo_pais" required>
                        </div>
                          <div class="col-lg-4">
                       <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>                       
                     <input type="text" class="form-control" placeholder="Numero" id="telefono" name="telefono" required >
                    </div>
                  </div>
                </div>
                 <div class="form-group">                                
                   <label  class="col-md-3 control-label">Tipo de telefono</label> 
                       <div class="col-md-7">
                           <select class="form-control" name="tipo_telefono_id" id="tipo_telefono_id" >
                                    <option value="0">Seleccione una opción</option>                                        
                                    @foreach($tipo_telefonos as $tipo_telefono)   
                                       <option value="{{$tipo_telefono->id}}"> {{{$tipo_telefono->descripcion}}}</option>                                            
                                     @endforeach                                     
                          </select>                    
                        </div>
                        {{ Form::close() }}  
                 </div>
          </div>
          </div>   
        </div>
        </div>     <div class="clearfix"></div>
   <div class="col-md-6">  
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                
              <div align="left">Datos del rescate</div>
                  <div class="widget-icons pull-right">                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
               <div class="padd">
              {{ Form::open(array('action' => 'ServicioFuneralControlador@postRescatista', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'registro')) }}

  
                  <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Colonia </strong></label>
                         <div class="col-lg-8">
                            <input type="text" class="form-control" placeholder="Colonia"  id="colonia_id" name="colonia_id" required>                               
                   </div>
                  </div>
                   <div class="form-group" >
                      <label class="col-lg-3 control-label"> <strong>Edificio defunción </strong></label>
                         <div class="col-lg-4">
                         <div class="input-group">
                         <span class="input-group-addon"> <i class="fa fa-building" aria-hidden="true"></i></span>                       
                            <input type="text" class="form-control" placeholder="Nombre"  id="planta_nombre" name="planta_nombre" required>     
                         </div>  
                         </div>
                       <div class="col-lg-4">
                         <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></span>                       
                          <input type="text" class="form-control" placeholder="Piso"  id="planta_piso" name="planta_piso" required>     
                         </div>  
                       </div>   
                     </div>               
                  <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Calle </strong></label>
                         <div class="col-lg-8">
                          <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-road" aria-hidden="true"></i> </span>     
                            <input type="text" class="form-control" placeholder="Calle"  id="calle" name="calle" required>                               
                      </div>
                    </div>
                  </div>
                 <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Numero </strong></label>
                        <div class="col-lg-4"> 
                        <div class="input-group">
                         <span class="input-group-addon"># </span>                   
                               <input type="text" class="form-control" placeholder="exterior"  name="numero_exterior" id="numero_exterior" required>
                        </div>
                        </div>
                      <div class="col-lg-4">  
                         <div class="input-group">
                         <span class="input-group-addon"># </span>                   
                     <input type="text" class="form-control" placeholder="Interior" id="numero_interior" name="numero_interior" required >
                  </div>
                  </div>
                </div>
                <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Ruta </strong></label>
                        <div class="col-lg-4"> 
                         <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-street-view" aria-hidden="true"></i> </span>                     
                               <input type="text" class="form-control" placeholder="Latitud"  name="latitud" id="latitud" required>
                        </div>
                        </div>
                          <div class="col-lg-4">
                           <div class="input-group">
                         <span class="input-group-addon"><i class="fa fa-street-view" aria-hidden="true"></i> </span>                       
                     <input type="text" class="form-control" placeholder="Longitud" id="longitud" name="longitud" required >
                  </div>
                </div>
             </div>
                 <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Referencias</strong></label>
                         <div class="col-lg-8">
                               <textarea type="text" class="form-control" placeholder="Descripción" name="descripcion" id="descripcion" required></textarea>
                        </div>
                  </div>
   
   {{ Form::close() }}  
        </div>  
      </div>
    </div>
    </div>
   <div class="col-md-6">  
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                
              <div align="left">Asignar rescatistas </div>
                  <div class="widget-icons pull-right">                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
               <div class="padd">
       {{ Form::open(array('action' => 'ServicioFuneralControlador@postRescatista', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'registro')) }}

        <div class="form-group">
       <label class="col-lg-2 control-label"><strong>Rescatistas </strong></label>
        <div class="col-lg-3">
              <select  id='rescatista_id' class="searchable" multiple='multiple' name="rescatista_id[]">
              @foreach($rescatistas as $rescatista)   
               <option value="{{$rescatista->rescatista_id}}"> {{{$rescatista->rescatista}}}</option>                                            
               @endforeach  
              </select>
        </div>
        </div>
        </div>
      </div>

 

<div class="widget-foot" align="right">
      <a  href= "{{URL::to('servicio-funeral/index')}}" class="btn btn-default" >Regresar</a>  
      <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>
      <input type="hidden" name="tab" id="tab" value="2">
     {{form::close()}}
      </div>      
 </div> 
    <!-- fin planes de pago -->
    </div>
                 @stop