@section('scripts')
<script src="{{ URL::asset('js/jquery.maskedinput.min.js') }}"> </script>
<script>  
$(document).on('ready', function(){

      window.setTimeout(function() {
  $("#alerta").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 2000);
   
    {{-- fin ocultar mensajes de alerta automaticamente ======= --}}



        });

             jQuery(function($){
            $("#numero1").mask("9,99", {
 
                // Generamos un evento en el momento que se rellena
                completed:function(){
                    $("#numero1").addClass("ok")
                }
            });
 
            $("#telefono").mask("(999) 999 - 9999");

       
        });

</script>
@stop
@section('module')
 

<div class="row">  
      
   <div class="col-md-7">  
                @if($status=='baja_rescatista')
                            <div class="alert alert-danger" role="alert" align="center" id="alerta">
                           <strong><h4> Rescatista ha sido dado de baja</h4></strong>
                          </div> 
            @endif 
             @if($status=='alta_rescatista')
                            <div class="alert alert-info" role="alert" align="center" id="alerta">
                           <strong><h4> Rescatista ha sido dado de alta</h4></strong>
                          </div> 
            @endif
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                
              <div align="left"> Rescatistas </div>
                  <div class="widget-icons pull-right">                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
               <div class="padd">
                    
              <!-- Table Page -->
              <div class="page-tables">
                <!-- Table -->
                <div class="table-responsive">
                  <table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
              <thead>
                <tr>
                  <th><strong>ID</strong></th>
                  <th><strong>Nombre del rescatista</strong></th>
                   <th><strong>Telefono</strong></th>
                   <th><strong>Tipo de telefono</strong></th>
                  <!--<th>Estatus</th> -->
                  <th><strong>Control</strong></th>
                </tr>
              </thead>
              <tbody>
                @foreach($rescatistas as $rescatista)
                                
                  <tr>
                    <td> {{{ $rescatista->rescatista_id }}} </td>
                    
                    <td> {{{$rescatista->rescatista}}}</td> 
                    <td>{{$rescatista->telefono}}</td>  
                    <td>{{$rescatista->descripcion}}</td> 
                    
                                    <td>
                                       
                                       @if($rescatista->activo==1) 
                                       <a href= "{{action('ServicioFuneralControlador@getBaja', $rescatista->rescatista_id )}}" class="btn btn-xs btn-success" value =" {{{ $rescatista->rescatista_id }}}" title="Dar de baja a {{{$rescatista->rescatista}}}"><i class="fa fa-check"></i></a>
                                       @else
                                       <a href= "{{action('ServicioFuneralControlador@getAlta', $rescatista->rescatista_id )}}" class="btn btn-xs btn-danger" value ="" title="Dar de Alta a {{{$rescatista->rescatista}}}"><i class="fa fa-times"></i></a>
                                       @endif
                                       <a href= "{{action('ServicioFuneralControlador@getRecupera', $rescatista->rescatista_id )}} "class="btn btn-xs btn-default" value ="{{$rescatista->rescatista_id}}" title="Editar a {{$rescatista->rescatista}}"><i class="fa fa-pencil"></i></a>
                                    
                                  </td>
                  </tr>
                                   
                @endforeach
              </tbody>
              <tfoot>
                
              </tfoot>
            </table>
                  <div class="clearfix"></div>               
   
                </div>
                </div>
              </div>
      </div>      
      </div>   
    </div>
    
    

     <!-- widget nuevo plan de pago -->
   <div class="col-md-5">  
               @if($status=='registro_rescatista')
                            <div class="alert alert-info" role="alert" align="center" id="alerta">
                           <strong><h4> Registro exitoso!..Rescatista añadido correctamente</h4></strong>
                          </div> 
            @endif
                @if($status=='registro_validacion')
                            <div class="alert alert-danger" role="alert" align="center" id="alerta">
                           <strong><h4> Rescatista ya ha sido registrado</h4></strong>
                          </div> 
            @endif 
            @if($status=='editado')
                  <div class="alert alert-info " role="alert" align="center" id="alerta">
                 
                 <strong><h4> Informacion Actualizada</h4></strong>
                </div> 
            @endif    
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">                
               <div align="left"> Catalago de rescatistas</div>                  
                    
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
        
                <div class="padd">

          @if($status  !='edit')
     {{ Form::open(array('action' => 'ServicioFuneralControlador@postRescatista', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'registro')) }}
                    @else
     {{ Form::open(array('action' => 'ServicioFuneralControlador@postEditar', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'registro')) }}
            @endif 
          
                 @if($status == 'edit')
                <input type="hidden" value="{{$rescatista_edit->rescatista_id}}" name="rescatista_id">
                 @else  
                 <input type="hidden" value=""> 
                 @endif

                  <div class="form-group" >
                      <label class="col-lg-4 control-label"><strong>Nombre </strong></label>
                         <div class="col-lg-7">
                               @if($status == 'edit')
                                    <input type="text" class="form-control" placeholder="Nombre "  id="descripcion" name="nombres" required value =  "{{{$rescatista_edit->nombres}}}">
                                    @else
                                    <input type="text" class="form-control" placeholder="Nombre"  id="descripcion" name="nombres" required value =  "{{Input::old('nombres')}}">
                                    @endif
                        </div>
                  </div>

                <div class="form-group" >
                      <label class="col-lg-4 control-label"><strong>Apellido paterno </strong></label>
                         <div class="col-lg-7">
                              @if($status == 'edit')
                                    <input type="text" class="form-control" placeholder="Apellido paterno"  id="descripcion" name="apellido_paterno" required value =  "{{{$rescatista_edit->apellido_paterno}}}">
                                    @else
                                    <input type="text" class="form-control" placeholder="Apellido paterno"  id="descripcion" name="apellido_paterno" required value =  "{{Input::old('apellido_paterno')}}">
                                    @endif
                        </div>
                  </div>
                  <div class="form-group" >
                      <label class="col-lg-4 control-label"><strong>Apellido materno </strong></label>
                         <div class="col-lg-7">
                                @if($status == 'edit')
                                    <input  value =  "{{{$rescatista_edit->apellido_materno}}}"type="text" class="form-control" placeholder="Apellido materno" id="apellido_materno" name="apellido_materno"  >
                                    @else
                                    <input  value =  "{{{Input::old('apellido_materno')}}}"type="text" class="form-control" placeholder="Apellido materno" id="apellido_materno" name="apellido_materno" required >
                                    @endif                        </div>
                  </div>
                  <div class="form-group" >
                      <label class="col-lg-4 control-label"><strong>Telefono </strong></label>
                        <div class="col-lg-3">
                               <input type="number" class="form-control" placeholder="52" value="52" name="codigo_pais" id="codigo_pais" required>
                        </div>
                         <div class="col-lg-4">
                                   @if($status == 'edit')
                                    <input  value =  "{{{$rescatista_edit->telefono}}}"type="text" class="form-control" placeholder="Numero" id="telefono" name="telefono"  >
                                    @else
                                    <input  value =  "{{{Input::old('telefono')}}}" type="text" class="form-control" placeholder="Numero" id="telefono" name="telefono" required >
                                    @endif   
                  </div>
                  </div>
                  <div class="form-group">                                
                   <label  class="col-md-4 control-label">Tipo de telefono</label> 
                       <div class="col-md-7">
                           <select class="form-control" name="tipo_telefono_id" id="tipo_telefono_id" >
                                <option value="0">Seleccione una opción</option>                                         
                                    @foreach($tipo_telefonos as $tipo_telefono)   
                                       <option value="{{$tipo_telefono->id}}"  @if($status == 'edit') @if($tipo_telefono->id == $rescatista_edit->tipo_telefono_id) selected @endif @endif > {{{$tipo_telefono->descripcion}}}</option>                                            
                                     @endforeach                                     
                          </select>                    
                        </div>
                 </div>
     
      </div>
      <div class="widget-foot">
      <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>
      <input type="hidden" name="tab" id="tab" value="2">
     {{form::close()}}
      </div>   
    </div>

    <!-- fin planes de pago -->
            </div>
    </div>
 
@stop
