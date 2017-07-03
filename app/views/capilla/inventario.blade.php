@section('scripts')

<script src="{{ URL::asset('js/chosen.jquery.js') }}"> </script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
{{-- ocultar mensajes de alerta automaticamente =======--}}
    
<script type="text/javascript">
$(document).on('ready', function(){

      window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 2000);
   
    {{-- fin ocultar mensajes de alerta automaticamente ======= --}}

$(document).ready(function(){
 
@foreach($inventarios as $inventario) 
       $("#{{$inventario->codigo}}").JsBarcode("{{$inventario->codigo}} ",{format:"CODE128",displayValue:true,fontSize:42}); 
       $("#s{{$inventario->codigo}}").JsBarcode("{{$inventario->codigo}} ",{format:"CODE128",displayValue:true,fontSize:42});
@endforeach
    });
//chosen grafica vendedor
    $(".personas").chosen({   
    no_results_text: "No hay resultados para:",    
    
    width: "100%"    
  });
    // Cargar  la lista
    $.ajax("{{ action('InventarioCafeteriaControlador@getPersonas') }}")
    .success(function(data){
      $('#usuario').typeahead({
        source: data,
        display: 'usuario',
        val: 'id',
        itemSelected: function(item){
          $('#usuario_id').val(item);
        }
      });
    });  
  $(".proveedor").chosen({   
    no_results_text: "No hay resultados para:",    
    
    width: "100%"    
  });
    // Cargar  la lista
    $.ajax("{{ action('InventarioCafeteriaControlador@getProveedor') }}")
    .success(function(data){
      $('#proveedor').typeahead({
        source: data,
        display: 'nombre',
        val: 'id',
        itemSelected: function(item){
          $('#proveedor_id').val(item);
        }
      });
    });
$(document).ready(function (e) {
  $('#movimiento').on('show.bs.modal', function(e) {    
  var id = $(e.relatedTarget).data().id;
      $(e.currentTarget).find('#lista').val(id);

});
});
$(document).ready(function (e) {
  $('#edit').on('show.bs.modal', function(e) {    
     var id = $(e.relatedTarget).data().id;
      $(e.currentTarget).find('#edit').val(id);

  });
});
  //funcion Para el datepicker
      $(function() {
   
//Array para dar formato en español
 $.datepicker.regional['es'] = 
 {
 closeText: 'Cerrar', 
 prevText: 'Previo', 
 nextText: 'Próximo',
 
 monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
 'Jul','Ago','Sep','Oct','Nov','Dic'],
 monthStatus: 'Ver otro mes', yearStatus: 'Ver otro año',
 dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
 dateFormat: 'yy-mm-dd', firstDay: 0, 
 initStatus: 'Selecciona la fecha', isRTL: false};
$.datepicker.setDefaults($.datepicker.regional['es']);

//miDate: fecha de comienzo D=días | M=mes | Y=año
//maxDate: fecha tope D=días | M=mes | Y=año
   $( "#datepicker" ).datepicker({ minDate: "0"});

 });//fin fuincion datepicker
//funcion Para el datepicker
      $(function() {
   
//Array para dar formato en español
 $.datepicker.regional['es'] = 
 {
 closeText: 'Cerrar', 
 prevText: 'Previo', 
 nextText: 'Próximo',
 
 monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
 'Jul','Ago','Sep','Oct','Nov','Dic'],
 monthStatus: 'Ver otro mes', yearStatus: 'Ver otro año',
 dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
 dateFormat: 'yy-mm-dd', firstDay: 0, 
 initStatus: 'Selecciona la fecha', isRTL: false};
$.datepicker.setDefaults($.datepicker.regional['es']);

//miDate: fecha de comienzo D=días | M=mes | Y=año
//maxDate: fecha tope D=días | M=mes | Y=año
   $( "#datepicker2" ).datepicker();

 });//fin fuincion datepicker
        });
 </script>
 @stop

@section('module')
    @if($status=='producto_baja')
                  <div class="alert alert-danger" role="alert" align="center" id="alerta">
                 <strong><h4> Producto dado de baja correctamente</h4></strong>
                </div> 
  @endif
    @if($status=='producto_alta')
                  <div class="alert alert-success" role="alert" align="center" id="alerta">
                 <strong><h4> Producto activado correctamente</h4></strong>
                </div> 
  @endif
  @if($status=='producto_editado')
                  <div class="alert alert-success" role="alert" align="center" id="alerta">
                 <strong><h4> Producto editado correctamente</h4></strong>
                </div> 
  @endif
  @if($status=='movimiento')
                  <div class="alert alert-success" role="alert" align="center" id="alerta">
                 <strong><h4> Movimiento realizado correctamente</h4></strong>
                </div> 
  @endif
  @if($status=='movimiento_surtir')
                  <div class="alert alert-success" role="alert" align="center" id="alerta">
                 <strong><h4> Producto añadido al inventario</h4></strong>
                </div> 
  @endif
    @if($status=='movimiento_error')
                  <div class="alert alert-danger" role="alert" align="center" id="alerta">
                 <strong><h4>Error!! datos vacios</h4></strong>
                </div> 
  @endif
  @if($status=='existencia_error')
                  <div class="alert alert-danger" role="alert" align="center" id="alerta">
                 <strong><h4>Error!! cantidad excede el inventario</h4></strong>
                </div> 
  @endif
    @if($status=='proveedor_error')
                  <div class="alert alert-danger" role="alert" align="center" id="alerta">
                 <strong><h4>Error!! no existen productos con dicho proveedor</h4></strong>
                </div> 
  @endif

<div class="widget">
    <div class="widget-head">    
        <div class="pull-right">

                <a disa data-toggle="modal" data-target="#orden"  class="btn btn-primary" ><i class="fa fa-file-o"></i> Orden de compra </a>     
                <a href="{{URL::to('inventario-capilla/movimientos')}}"  class="btn btn-success" ><i class="fa fa-hand-paper-o"></i> Movimientos </a>
                <a href="{{URL::to('orden-compra/ordenes')}}"  class="btn btn-default" ><i class="fa fa-clipboard"></i> Ordenes realizadas </a>     
       </div>            
              <div align="rigth">Lista de productos en existencia</div>                  
                    
              <div class="clearfix"></div>
    </div>
      <div class="widget-content">
                
           <div class="padd">
                      <div class="page-tables">
                <!-- Table -->
                <div  class="table-responsive">
                    <table   cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                       <thead>
                          <tr>
                            <th><strong>Almacén</strong></th>
                            <th><strong>Tipo</strong></th>
                            <th><strong>Producto</strong></th>
                            <th><strong>Existencia</strong></th>
                            <th><strong>Descripción</strong></th>                       
                            <th><strong>Codigo</strong></th>
                            <th><strong>Combo</strong></th>
                            <th><strong>Estatus</strong></th>
                            <th><strong>Operaciones</strong></th>                            
                          </tr>
                      </thead>
                    <tbody>      
                      @foreach($inventarios as $inventario)  
                      @if ($inventario->existencia <= 6 && $inventario->almacen_id == 1)  
                      <tr class="gravedad odd">
                       
                        <td>{{{$inventario->almacen}}}</td>
                        <td>{{{$inventario->unidad}}}</td> 
                        <td>{{{$inventario->producto}}}</td>
                        <td align="center"><strong>{{{$inventario->existencia}}}</strong></td>
                        <td>{{{$inventario->descripcion}}}</td>                      
                        <td><img  width="100" id="{{$inventario->codigo}}"/></td>           
                   
            <td align="center" > @if ( $inventario->combo == 1 )                                     
              <label class="checkbox-inline"><input checked="true" disabled  type="checkbox" ></label>
                    @else                       
             <label class="checkbox-inline"><input disabled type="checkbox" ></label>                        
                    @endif                    
            </td>

            <td> @if ( $inventario->activo == 1 )                 

                    <span class="label label-warning">Escaso</span>                   
                    @else                       
                    <span class="label label-danger">Inactivo</span> </td>                
                    @endif                    
                   <td>          
                                  @if($inventario->activo == 1)
                                  <a  href="" data-id="{{$inventario->inventario_id}}" disa data-toggle="modal" data-target="#edit" class="btn btn-xs btn-default" value ="{{$inventario->inventario_id}}"  title="Editar registro"> <i class="fa fa-pencil"></i> </a>
                                  <a class="btn btn-xs btn-default" href="{{URL::to('inventario-capilla/baja/'.$inventario->producto_id )}}"  onclick=" return confirm('¿Estas seguro de dar de baja este registro?')" title="Dar de baja "> <i class="fa fa-times"></i></a>
                                  <a href="" data-id="{{$inventario->inventario_id}}"  data-toggle="modal" data-target="#movimiento" class="btn btn-xs btn-default" value ="{{$inventario->inventario_id}}" title="Movimientos"><i class="fa fa-cart-arrow-down" ></i> </a>
                                  @else                                  
                                  <a  href="" data-id="{{$inventario->inventario_id}}" disabled data-toggle="modal" data-target="#edit" class="btn btn-xs btn-default" value ="{{$inventario->inventario_id}}"  title="Editar registro"> <i class="fa fa-pencil"></i> </a>
                                  <a class="btn btn-xs btn-default" href="{{URL::to('inventario-capilla/alta/'.$inventario->producto_id )}}"  onclick=" return confirm('¿Estas seguro de activar este registro?')" title="Activar producto"> <i class="fa fa-check"></i></a>
                                  <a href="" data-id="{{$inventario->inventario_id}}" disabled data-toggle="modal" data-target="#movimiento" class="btn btn-xs btn-default" value ="{{$inventario->inventario_id}}" title="Movimientos"><i class="fa fa-cart-arrow-down" ></i> </a>                                   @endif

                                </td> 
                      </tr>
                      @elseif($inventario->almacen_id == 1)

                      <tr>           
                        <td>{{{$inventario->almacen}}}</td>
                        <td>{{{$inventario->unidad}}}</td> 
                        <td>{{{$inventario->producto}}}</td>
                        <td align="center"><strong>{{{$inventario->existencia}}}</strong></td>
                        <td>{{{$inventario->descripcion}}}</td>                      
                        <td><img  width="100" id="{{$inventario->codigo}}"/></td>            
                   
            <td align="center"> @if ( $inventario->combo == 1 )                   

                                       
              <label class="checkbox-inline"><input checked="true" disabled  type="checkbox" ></label>

                    @else                       
             <label class="checkbox-inline"><input disabled type="checkbox" ></label>
                        
                    @endif                    
            </td>

            <td> @if ( $inventario->activo == 1 )                   

                    <span class="label label-success">Activo</span>                       


                    @else                       
                    <span class="label label-danger">Inactivo</span> 
                        
                    @endif  
              </td>                        
            <td>                 
                                  @if($inventario->activo == 1)

                                  <a  href="" data-id="{{$inventario->inventario_id}}" disa data-toggle="modal" data-target="#edit" class="btn btn-xs btn-default" value ="{{$inventario->inventario_id}}"  title="Editar registro"> <i class="fa fa-pencil"></i> </a>
                                  <a class="btn btn-xs btn-default" href="{{URL::to('inventario-capilla/baja/'.$inventario->producto_id )}}"  onclick=" return confirm('¿Estas seguro de dar de baja este registro?')" title="Dar de baja "> <i class="fa fa-times"></i></a>
                                  <a href="" data-id="{{$inventario->inventario_id}}"  data-toggle="modal" data-target="#movimiento" class="btn btn-xs btn-default" value ="{{$inventario->inventario_id}}" title="Movimientos"><i class="fa fa-cart-arrow-down" ></i> </a>
                                  @else 
                                 
                                  <a  href="" data-id="{{$inventario->inventario_id}}" disabled data-toggle="modal" data-target="#edit" class="btn btn-xs btn-default" value ="{{$inventario->inventario_id}}"  title="Editar registro"> <i class="fa fa-pencil"></i> </a>
                                  <a class="btn btn-xs btn-default" href="{{URL::to('inventario-capilla/alta/'.$inventario->producto_id )}}"  onclick=" return confirm('¿Estas seguro de activar este registro?')" title="Activar producto"> <i class="fa fa-check"></i></a>
                                  <a href="" data-id="{{$inventario->inventario_id}}" disabled data-toggle="modal" data-target="#movimiento" class="btn btn-xs btn-default" value ="{{$inventario->inventario_id}}" title="Movimientos"><i class="fa fa-cart-arrow-down" ></i> </a>
  
                                   @endif          
                          </td> 
                                 </tr>
                                @else

                        <tr>                       
                        <td>{{{$inventario->almacen}}}</td>
                        <td>{{{$inventario->unidad}}}</td> 
                        <td>{{{$inventario->producto}}}</td>
                        <td align="center"><strong>{{{$inventario->existencia}}}</strong></td>
                        <td>{{{$inventario->descripcion}}}</td>                      
                        <td><img  width="100" id="s{{$inventario->codigo}}"/></td>          
                   
            <td align="center"> @if ( $inventario->combo == 1 )                   

                                       
              <label class="checkbox-inline"><input checked="true" disabled  type="checkbox" ></label>

                    @else                       
             <label class="checkbox-inline"><input disabled type="checkbox" ></label>
                        
                    @endif                    
            </td>

            <td> @if ( $inventario->activo == 1 )                   

                    <span class="label label-success">Activo</span>                       


                    @else                       
                    <span class="label label-danger">Inactivo</span> </td>
                        
                    @endif                    
                          <td>                
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
        <!-- EMPIENZA VENTANAS MODALES -->
<div id="movimiento" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
              <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Registrar un movimiento</h4>
             </div>
        <div class="modal-body"> <!-- en action mando a llamar el Controlador@function (anteponiendo el post) -->
                  <!-- contenido modal -->
      {{ Form::open(array('action' => 'InventarioCafeteriaControlador@postMovimiento', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'registro')) }}

                      <input type="hidden" name="lista" id="lista" >


                     <div class="form-group" id="div_personas">
                           <label class="col-lg-3 control-label">Usuario</label>
                                <div class="col-lg-7">
                                    <select class="form-control personas chosen-select" name="usuario_id">
                                      <option value="0">Seleccione una opción</option>
                                       @foreach($usuarios as $usuario)   
                                        <option value="{{$usuario->id}}"> {{{$usuario->usuario}}}</option>                                            
                                       @endforeach 
                                    </select>                                    
                                 </div>
                            </div> 
                     <!-- contenido modal           
                     <div class="form-group">
                                  <label class="col-lg-3 control-label">Fecha</label>
                                  <div class="col-lg-7">
                                   <div id="datetimepicker1" class="input-append input-group date" >
                                        <input data-format="yyyy-MM-dd" type="text" class="form-control " name="fecha">                                                    
                                        <span class="input-group-addon add-on" >
                                        <i data-time-icon="fa fa-times" data-date-icon="fa fa-calendar"></i>
                                      </span>
                                    </div>
                                  </div>
                                </div> 
  -->    
                       <div class="form-group">
                          <label class="col-lg-3 control-label">Fecha </label>
                              <div class="col-lg-8">                                 
                                  <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                     <p> <input type="text" id="datepicker2" placeholder="Seleccione fecha" name="fecha"></p>
                                  </div>
                             </div>
                         </div>

               <div class="form-group">
                  <label class="col-md-3 control-label">Cantidad</label>
                      <div class="col-md-7">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-cart-plus fa-fw"></i></span>
                              <input type="text" class="form-control" name="cantidad" id="cantidad" aria-describedby="basic-addon2" required>                  
                          </div>
                      </div>
                </div>


                <div class="form-group">                                
                   <label  class="col-md-3 control-label">Acción</label> 
                       <div class="col-md-7">
                           <select class="form-control" name="accion_id" >
                                <option value="0">Seleccione una opción</option>                                         
                                    @foreach($acciones as $accion)   
                                       <option value="{{$accion->id}}"> {{{$accion->nombre}}}</option>                                            
                                     @endforeach                                     
                          </select>                    
                        </div>
                 </div>
        </div>

                <div class="modal-footer">           
                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    <button type="submit"  class="btn btn-primary">Guardar</button>                   
                </div>       
         </div>
     </div>
</div>
   {{ Form::close() }}

   <div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
          <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Editar registros</h4>
          </div>
            <div class="modal-body"> <!-- en action mando a llamar el Controlador@function (anteponiendo el post) -->
                  <!-- contenido modal -->
      {{ Form::open(array('action' => 'InventarioCafeteriaControlador@postEdit', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'registro')) }}

                  <input type="hidden" name="edit" id="edit" >

                  <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Producto </strong></label>
                         <div class="col-lg-7">
                               <input type="text" class="form-control" placeholder="Escriba el nuevo nombre" name="nombre" required>
                        </div>
                  </div>

     

                 <div class="form-group">
                      <label class="col-md-3 control-label">Descripción</label>
                          <div class="col-md-7">
                           <textarea type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Campo opcional..."  aria-describedby="basic-addon2"></textarea>                       
                       </div>
                </div> 
          </div>

                <div class="modal-footer">           
                  <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    <button type="submit"  class="btn btn-primary">Guardar</button>
                   
              </div>       
          </div>
      </div>

        </div>
   {{ Form::close() }}

   <div id="orden" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
          <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Orden de compra</h4>
          </div>
            <div class="modal-body"> <!-- en action mando a llamar el Controlador@function (anteponiendo el post) -->
                  <!-- contenido modal -->
      {{ Form::open(array('action' => 'OrdenCompraControlador@postOrden', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'registro')) }}    
         
              <div class="form-group" id="div_personas">
                      <label class="col-lg-3 control-label">Responsable</label>
                            <div class="col-lg-7">
                               <select class="form-control personas chosen-select" name="usuario_id">
                                    <option value="0">Seleccione una opción</option>
                                     @foreach($usuarios as $usuario)   
                                      <option value="{{$usuario->id}}"> {{{$usuario->usuario}}}</option>                                            
                                       @endforeach 
                                </select>                                    
                            </div>
                        </div>
                    <div class="form-group">
                                  <label class="col-lg-3 control-label">Fecha </label>
                                  <div class="col-lg-8">                                 
                                    <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                     <p> <input type="text" id="datepicker" placeholder="Seleccione fecha" name="fecha"></p>
                                    </div>
                                  </div>
                      </div>
              <div class="form-group" id="proveedor">
                      <label class="col-lg-3 control-label">Proveedor</label>
                            <div class="col-lg-7">
                               <select class="form-control personas chosen-select" name="proveedor_id">
                                    <option value="0">Seleccione una opción</option>
                                     @foreach($proveedores as $proveedor)   
                                      <option value="{{$proveedor->id}}"> {{{$proveedor->nombre}}}</option>                                            
                                       @endforeach 
                                </select>                                    
                            </div>
                        </div>
          </div>

                <div class="modal-footer">           
                  <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    <button type="submit"  class="btn btn-primary">Crear</button>
                   
              </div>       
          </div>
      </div>

        </div>
   {{ Form::close() }}
@stop