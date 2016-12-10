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

    $(".promotorias").chosen({   
    no_results_text: "No hay resultados para:",    
    
    width: "100%"    
  });


    // Cargar  la lista de asesores
    $.ajax("{{ action('AsesorControlador@getPromotorias') }}")
    .success(function(data){
      $('#promotor').typeahead({
        source: data,
        display: 'Promotor',
        val: 'id',
        itemSelected: function(item){
          $('#asesor_id').val(item);
        }
      });
    });
  });
jQuery(function($){
   $("#date").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
   $(".phone").mask("(999) 999-9999");
   $("#tin").mask("99-9999999");
   $("#ssn").mask("999-99-9999");
});
  </script>
    @stop
@section('module')
 

<div class="row">  
      
   <div class="col-md-7">  
 
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                
              <div align="center"> Asesores de ventas </div>
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
                  <th>ID</th>
                  <th>Nombre del Asesor</th>
                                    <th>Promotoria</th>
                  <!--<th>Estatus</th> -->
                  <th>Control</th>
                </tr>
              </thead>
              <tbody>
                @foreach($vendedores as $vendedor)
                                
                  <tr>
                    <td> {{{ $vendedor->asesor_id }}} </td>
                    
                    <td> {{{$vendedor->asesor}}}</td> 
                                        <td>                        
                                        {{{$vendedor->promotor}}}
                                        </td>  
                    
                                       <!-- <td> @if ( $vendedor->activo == 1 ) 
                        <span class="label label-success"> Activo </span> </td>
                       @else 
                        <span class="label label-danger"> Cancelado </span> </td>
                       @endif
                    </td> */ -->
                                    <td>
                                       
                                       @if($vendedor->activo==1) 
                                       <a href= "{{action('AsesorControlador@getBaja', $vendedor->asesor_id)}}"class="btn btn-xs btn-success" value ="{{$vendedor->id}}" title="Dar de baja a {{{$vendedor->asesor}}}"><i class="fa fa-check"></i></a>
                                       @else
                                       <a href= "{{action('AsesorControlador@getAlta', $vendedor->asesor_id)}}"class="btn btn-xs btn-danger" value ="{{$vendedor->id}}" title="Dar de Alta a {{{$vendedor->asesor}}}"><i class="fa fa-times"></i></a>
                                       @endif
                                       <a href= "{{action('AsesorControlador@getRecupera', $vendedor->asesor_id)}}"class="btn btn-xs btn-default" value ="{{$vendedor->id}}" title="Editar a {{{$vendedor->asesor}}}"><i class="fa fa-pencil"></i></a>
                                    
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
 
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">                
               <div align="center"> Operaciones</div>                  
                    
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                 @if($status=='created')
                  <div class="alert alert-info alert-dismissible" role="alert" align="center" id="alerta">
                 
                 <strong><h4> Nuevo vendedor agregado</h4></strong>
                </div> 
                @endif 

                 @if($status=='editado')
                  <div class="alert alert-info alert-dismissible" role="alert" align="center" id="alerta">
                 
                 <strong><h4> Informacion Actualizada</h4></strong>
                </div> 
                @endif              
                <div class="padd">
   
                   @if($status  !='edit')
                    {{ Form::open(array('action' => 'AsesorControlador@postNuevovendedor', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'empresa','files' => true)) }}
                    @else
                    {{ Form::open(array('action' => 'AsesorControlador@postEditar', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'empresa','files' => true)) }}                     
                    @endif                  
                            

                               
                   <div class="form-group" id="div_promotoria">
                                  <label class="col-lg-4 control-label">Promotoria</label>
                                  <div class="col-lg-8">
                                    <select class="form-control promotorias chosen-select" name="promotor_id">
                                      <option value="ind">Independiente</option>
                                      
                                      <option value="new">Nueva Promotoría</option>
                                      
                                      @foreach($promotores as $promotor)
                                      <option value="{{{$promotor->id}}}" @if($status == 'edit') @if($promotor->id == $asesor_r->promotor_id) selected @endif @endif >{{{$promotor->Promotor}}}</option>
                                      @endforeach
                                    </select>
                                    
                                  </div>
                                </div> 
                                

                          <div class="form-group">
                                  <label class="col-lg-4 control-label">Ingreso</label>
                                  <div class="col-lg-8">
                                   <div id="datetimepicker1" class="input-append input-group dtpicker" >
                                        <input data-format="yyyy-MM-dd" type="text" class="form-control" id="fecha_ingreso" name="fecha_ingreso"
                                    @if ($status != 'edit')  
                                      value= "{{{Input::old('fecha_ingreso')}}}">
                                     @else 
                                      value = "{{{$asesor_r->fecha_ingreso}}}">
                                     @endif
                                     
                                      <span class="input-group-addon add-on">
                                        <i data-time-icon="fa fa-times" data-date-icon="fa fa-calendar"></i>
                                      </span>
                                    </div>

                                  </div>
                                </div>


                <div class="form-group">
                                  <label class="col-lg-4 control-label">Nombre</label>
                                  <div class="col-lg-8">
                                    @if($status == 'edit')
                                    <input type="text" class="form-control" placeholder="Nombre del asesor"  id="descripcion" name="nombres" required value =  "{{{$asesor_r->nombres}}}">
                                    @else
                                    <input type="text" class="form-control" placeholder="Nombre del asesor"  id="descripcion" name="nombres" required value =  "{{Input::old('nombres')}}">
                                    @endif
                                  </div>
                                </div>

                                
                <div class="form-group">
                
                                  <label class="col-lg-4 control-label">Apellido Paterno</label>
                                  <div class="col-lg-8">
                                    @if($status == 'edit')
                                    <input type="text" class="form-control" placeholder="Apellido paterno"  id="descripcion" name="apellido_paterno" required value =  "{{{$asesor_r->apellido_paterno}}}">
                                    @else
                                    <input type="text" class="form-control" placeholder="Apellido paterno"  id="descripcion" name="apellido_paterno" required value =  "{{Input::old('apellido_paterno')}}">
                                    @endif

                                  </div>
                                </div>                
        
           <div class="form-group">
                
                                  <label class="col-lg-4 control-label">Apellido Materno</label>
                                  <div class="col-lg-8">
                                    @if($status == 'edit')
                                    <input  value =  "{{{$asesor_r->apellido_materno}}}"type="text" class="form-control" placeholder="Apellido materno" id="apellido_materno" name="apellido_materno"  >
                                    @else
                                    <input  value =  "{{{Input::old('apellido_materno')}}}"type="text" class="form-control" placeholder="Apellido materno" id="apellido_materno" name="apellido_materno" required >
                                    @endif
                                  </div>
                                </div>

                                <div class="form-group">
                
                                  <label class="col-lg-4 control-label">Email</label>
                                  <div class="col-lg-8">
                                    @if($status == 'edit')
                                    <input  value =  "{{{$asesor_r->email}}}"type="text" class="form-control" placeholder="demo@dominio.com" id="email" name="email"  >
                                    @else
                                    <input  value =  "{{{Input::old('email')}}}"type="text" class="form-control" placeholder="demo@dominio.com" id="email" name="email"  >
                                    @endif
                                  </div>
                                </div>
                                
                       <div class="form-group">
                                  <label class="col-md-4 control-label">Telefono *</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                      <span class="input-group-addon">Celular  </span>
                                       @if($status == 'edit')
                                      <input @if($celular) value ="{{{$celular->telefono}}}" @endif type="text" class="form-control phone" name="celular" id="celular" placeholder="Incluir lada" aria-describedby="basic-addon">
                                      
                                      <input type="hidden" name="asesor_id" value="{{{$asesor_r->asesor_id}}}">                                      
                                      @if ($celular)
                                        <input type="hidden" name="id_telefono_c" value="{{{$celular->id}}}">
                                      @else 
                                        <input type="hidden" name="id_telefono_c" value="vacio">
                                      @endif
                                      @else
                                        <input value ="{{{Input::old('celular')}}}" type="text" class="form-control phone" name="celular" id="celular" placeholder="Incluir lada" aria-describedby="basic-addon">
                                      @endif
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-4 control-label sr-only">Teléfono </label>
                                  <div class="col-md-8">
                                    <div class="input-group">
                                      <span class="input-group-addon">Casa  </span>
                                      @if($status == 'edit')
                                      <input @if($telefono) value ="{{{$telefono->telefono}}}" @endif type="text" class="form-control phone" name="telefono" id="telefono" placeholder="Incluir lada" aria-describedby="basic-addon2">
                                      
                                      <input type="hidden" name="asesor_id" value="{{{$asesor_r->asesor_id}}}">                                      
                                      @if ($telefono)
                                        <input type="hidden" name="id_telefono" value="{{{$telefono->id}}}">
                                      @else 
                                        <input type="hidden" name="id_telefono" value="vacio">
                                      @endif
                                      @else
                                        <input value ="{{{Input::old('telefono')}}}" type="text" class="form-control phone" name="telefono" id="telefono" placeholder="Incluir lada" aria-describedby="basic-addon2">
                                      @endif
                                    </div>
                                  </div>
                                 <HR> 

                           
              <div class="clearfix"></div>             
                
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

 
@stop