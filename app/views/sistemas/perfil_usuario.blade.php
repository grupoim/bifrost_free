@section('scripts')
<script src="{{ URL::asset('js/strength.js') }}"> </script>
<script src="{{ URL::asset('js/js.js') }}"> </script>
<link rel="stylesheet" href="{{ URL::asset('css/strength.css') }}">

<script type="text/javascript">	
      
$(document).on('ready', function(){

   $('#myPassword').strength({
            strengthClass: 'strength',
            strengthMeterClass: 'strength_meter',
            strengthButtonClass: 'button_strength',
            strengthButtonText: ' Mostrar',
            strengthButtonTextToggle: ' Ocultar'
        }); 

      window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 4000);

    });

</script>
@stop
@section('module')
 <!-- Matter -->

	              <div class="row">

            <div class="col-md-6">


              <div class="widget wgreen">
                
                <div class="widget-head">
                  <div class="pull-left">Perfiles de Usuario</div>
                  <div class="widget-icons pull-right">                    
                  </div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">
                    <!-- Table Page -->
                    <div class="padd scroll-chat">
              <div class="page-tables">
                <!-- Table -->
                <div class="table-responsive">
                  <table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                    <thead>
                      <tr>
                      <th>Usuario</th>
                      
                      
                      </tr>
                    </thead>
                    <tbody>
                      
                       @foreach($usuarios as $usuario)<tr>
                     
                        <td> 
                    
                  
                   <div class="user">
                      <div class="user-pic">
                        <!-- User pic -->
                        <img src="{{ URL::asset('img/upload/usuarios/'.$usuario->avatar) }}" width="80%" />                        
                      </div>

                      
                      <div class="user-details">
                        @if($usuario->jefe == 1)
                        <span class="label label-success">Jefe de departamento</span>                         
                        @endif<h5>{{{$usuario->persona->nombres}}} {{{$usuario->persona->apellido_paterno}}} {{{$usuario->persona->apellido_materno }}} @if($usuario->id <> $user->id)<a href= "{{action('PerfilControlador@getRecupera', $usuario->id)}}"class="btn btn-xs btn-default" title="Editar a {{{$usuario->nombre}}}"><i class="fa fa-pencil"></i></a>@endif</h5>
                        
                        <p> Departamento: {{{$usuario->departamento->nombre}}}.</p>
                        <p> Nombre de usuario: {{{$usuario->nombre}}}.</p>
                        <p> Tipo de permiso: {{{$usuario->rol->nombre}}}.</p>                        
                        
                      </div>                      
                    </div>        
                    
                     </td>
                       
                      

                      </tr>@endforeach 
                     
                    </tbody>
                    
                  </table>
                  <div class="clearfix"></div>               
   
                </div>
                </div>     
                  
                </div>
                  <div class="widget-foot">
                 
                    <!-- Footer goes here -->
                  </div>
                  </div>
                  </div>  
              </div> 


            </div>
              <!-- widget nicho-->
               <div class="col-md-5">


              <div class="widget wgreen">
                
                <div class="widget-head">
                  <div class="pull-left">Nuevo/Editar</div>
                  <div class="widget-icons pull-right">
                   @if ($rol == 'sistemas')
                  <a href= "{{ action('PerfilControlador@getNuevo') }}" class="btn btn-default " title="nuevo"><i class="fa fa-plus"></i> Nuevo</a>                  
                  @endif
                  </div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">
                  Para obtener una contraseña MUY SEGURA es necesario que tu password cubra estos cuatro puntos:
                    
                    <li> Contener 8 o más caracteres </li>
                    <li> Escribir al menos una letra en minúscula</li>
                    <li> Escribir al menos una letra en mayúscula</li>
                    <li> La contraseña debe contener al menos un numero</li>
                   
                    
                   <div class="form quick-post">
                    @if($status == 'edit')                                      
                          {{ Form::open(array('action' => 'PerfilControlador@postEditar', 'class' => 'form-horizontal', 'role' => 'form', 'files' => true)) }}                     
                    
                    @else 
                          {{ Form::open(array('action' => 'PerfilControlador@postAdd', 'class' => 'form-horizontal', 'role' => 'form', 'files' => true)) }}                     
                          @if($status == 'nuevo')
                          <div class="form-group">
                                  <label class="col-lg-2 control-label">Depto.</label>
                                  <div class="col-lg-7">
                                    <select class="form-control" id="departamento_id" name="departamento_id">
                                      @foreach($departamentos as $departamento)
                                      <option value="{{{$departamento->id}}}">{{{$departamento->nombre}}}</option>                                      
                                      @endforeach
                                    </select>
                                  </div>
                                </div>

                          <div class="form-group">
                                  <label class="col-lg-3 control-label">Perfil</label>
                                  <div class="col-lg-8">
                                    <label class="radio-inline">
                                            <input type="radio" name="rol_id" id="inlineRadio1" value="1" checked="true" required title="Registrar como usuario normal">Usuario
                                          </label>
                                          <label class="radio-inline">
                                            <input type="radio" name="rol_id" id="inlineRadio2" value="2" title="Registrar como administrador">Administrador
                                          </label>                                         

                                    </div>
                                </div>
                         <div class="form-group">
                                  <label class="col-lg-3 control-label">Jefe de departamento</label>
                                  <div class="col-lg-8">
                                    <label class="radio-inline">
                                            <input type="radio" name="jefe" id="inlineRadio1" value="1" checked="true" required title="Registrar como usuario normal">Si
                                          </label>
                                          <label class="radio-inline">
                                            <input type="radio" name="jefe" id="inlineRadio2" value="0" title="Registrar como administrador">No
                                          </label>                                         

                                    </div>
                                </div>


                             @endif    

                    @endif
                          
                          @if ($rol == 'sistemas' or $rol == 'jefe')

                          <div class="form-group">
                          <label class="control-label col-md-2" for="sitename"> Nombre</label>
                          <div class="col-md-7">
                           
                            <input class="form-control" type="text" name="nombres" 
                            @if ($status == 'edit') value="{{{$usuario_r->persona->nombres}}}" 
                            @elseif($status == 'nuevo' ) value=""
                            @else value= "{{{$user->persona->nombres}}}" 
                            @endif 
                            required>
                          </div>
                          </div>

                          <div class="form-group">
                          <label class="control-label col-md-2" for="sitename"> Apellido paterno</label>
                          <div class="col-md-7">
                           
                            <input class="form-control" type="text" name="apellido_paterno" 
                            @if ($status == 'edit') value="{{{$usuario_r->persona->apellido_paterno}}}" 
                             @elseif($status == 'nuevo' ) value=""
                            @else value= "{{{$user->persona->apellido_paterno}}}" 
                            @endif 
                            required>
                          </div>
                          </div>

                           <div class="form-group">
                          <label class="control-label col-md-2" for="sitename"> Apellido materno</label>
                          <div class="col-md-7">
                           
                            <input class="form-control" type="text" name="apellido_materno" 
                            @if ($status == 'edit') value="{{{$usuario_r->persona->apellido_materno}}}" 
                            @elseif($status == 'nuevo' ) value=""
                            @else value= "{{{$user->persona->apellido_materno}}}" 
                            @endif 
                            required>
                          </div>
                          </div>

                          @endif

                          <!-- Name -->
                          <div class="form-group">
                          <label class="control-label col-md-2" for="sitename"> Usuario</label>
                          <div class="col-md-7">
                           
                            <input class="form-control" type="text" name="nombre" 
                            @if ($status == 'edit') value="{{{$usuario_r->nombre}}}" 
                            @elseif($status == 'nuevo' ) value=""
                            @else value= "{{{$user->nombre}}}"                             
                            @endif
                            required>
                          </div>
                          </div> 

                            <div class="form-group">
                          <label class="control-label col-md-2" for="sitename"> Contraseña</label>
                          <div class="col-md-7">
                           
                            <input class="form-control" id="myPassword" type="password" name="pass" 
                            @if ($status == 'edit') placeholder = "Ingrese nueva contraseña" 
                            @else placeholder = "asigne contraseña" 
                            @endif
                            @if ($status == 'nuevo')required @endif

                            >
                          </div>
                          </div>  
                                                                     
                           <div class="form-group">
                          <label class="control-label col-md-2" for="sitename"> Imagen</label>
                          <div class="col-md-7">
                           {{ Form::file('foto') }}
                                                    
                          </div>
                          </div>
                          
                       
                      </div>                               
                       
                  </div>
                </div>
                  <div class="widget-foot">              
                           <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-floppy-o"></i> Guardar</button>                            
                           
                  </div>
                    </div>
              </div>
@if($status == 'edit') 
<input type="hidden" name = "usuario_id" value="{{{$usuario_r->id}}}"> 
<input type="hidden" name="persona_id" value = "{{{$usuario_r->persona_id}}}">
@else 
<input type="hidden" name = "usuario_id" value="{{{$user->id}}}">
@endif               



            </div>
              
          </div>

       {{form::close()}} 

		<!-- Matter ends -->

@stop