@section('scripts')

{{-- ocultar mensajes de alerta automaticamente =======--}}
    
<script type="text/javascript">
$(document).on('ready', function(){

      window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 2000);
   
    {{-- fin ocultar mensajes de alerta automaticamente ======= --}}

});

$(document).ready(function(){
 
@foreach($productos as $producto) 
       $("#{{$producto->codigo}}").JsBarcode("{{$producto->codigo}} ",{format:"CODE128",displayValue:true,fontSize:42}); 

@endforeach
    });
$(document).ready(function (e) {
  $('#ordenar').on('show.bs.modal', function(e) {    
  var id = $(e.relatedTarget).data().id;
      $(e.currentTarget).find('#inventario').val(id);

});
});
$(document).ready(function(){
@foreach($productos as $producto) 

    var x = document.getElementById("{{$producto->codigo}}").src;
    document.getElementById("S{{$producto->codigo}}").value = x;

@endforeach
    });
  </script>

 @stop

@section('module')
 @if($status=='orden_vacia')
                  <div class="alert alert-warning" role="alert" align="center" id="alerta">
                 <strong><h4>Error al modificar!. La orden ya se ha cerrado</h4></strong>
                </div> 
  @endif
  @if($status=='orden_cerrar')
                  <div class="alert alert-warning" role="alert" align="center" id="alerta">
                 <strong><h4>No se puede cerrar el pedido con la orden vacía</h4></strong>
                </div> 
  @endif
  <div class="col-md-11" >


    <div class="clearfix"></div>
        <div class="widget">

 <div class="widget-head">    
     <div class="btn-group pull-right">   
        @if($cerrar->activo==1)        
            <a  href= "{{URL::to('orden-compra/pedido/'.$apertura )}}" disabled class="btn btn-m btn-default"><i class="fa fa-file-o"></i> Generar pdf</a> 
        @else
            <a  href= "{{URL::to('orden-compra/pedido/'.$apertura )}}"  class="btn btn-m btn-primary"><i class="fa fa-file-o"></i> Generar pdf</a> 
        @endif 
           </div>           
               <div align="rigth">Lista de productos</div>
           
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
          
                
                <div class="padd">

                          <div class="page-tables">
                <!-- Table -->

                <div class="table-responsive">
                   <table   cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                      <thead>
                          <tr>
                             <th><strong>Producto</strong></th>
                             <th><strong>Proveedor</strong></th>
                             <th><strong>Existencia</strong></th>
                             <th><strong>Registrado</strong></th>
                             <th><strong>Seleccione</strong></th> 
                             <th><strong>Codigo de barras</strong></th>                                                       
                          </tr>
                       </thead>
                    <tbody>
                              <tr>
                         @foreach($productos as $producto)              

                                      <td>{{$producto->producto}}</td>
                                      <td>{{$producto->proveedor}}</td>
                                      <td><strong>{{$producto->existencia}}</strong></td>
                                      <td>
                              @foreach($cantidades as $cantidad) 
                                    @if ($producto->inventario  == $cantidad->inventario )                                     
                                      <label class="checkbox-inline"><input checked="true" disabled  type="checkbox" ></label>
                                    @endif 
                             @endforeach                   
                                      </td>                                  
                                      <td  width="175">            
                                         <input data-id="{{$producto->inventario}}" data-toggle="modal" data-target="#ordenar" type="number" placeholder="Ingrese cantidad" class="form-control" >
                                     </td>  
                                     <td><img  width="100" id="{{$producto->codigo}}"/></td>
                          
                              </tr>
                                   


                       @endforeach
                    </tbody>
                    
                  </table>
                
   <div class="clearfix"></div>             
                
</div>
      </div>   
      </div>   
    </div>
    </div>
              <div class="widget-foot">                           
                @if($cerrar->activo==1)   
                   <a  href= "{{URL::to('orden-compra/cancelar/'.$apertura )}}" onclick=" return confirm('¿Estas seguro de regresar?. se cancelara la operación')" class="btn btn-m btn-default" >Cancelar</a>
                   <a  href= "{{URL::to('orden-compra/cerrar/'.$apertura )}}" onclick=" return confirm('¿Estas seguro de concluir la orden de compra?')" class="btn btn-m btn-primary" >Cerrar pedido</a>                    
                @else
                   <a  href= "{{action('InventarioCafeteriaControlador@getIndex')}}"  class="btn btn-m btn-default" >Regresar</a>                    
                @endif
                   <!-- Footer goes here -->
                  </div>   
  </div>

   <div id="ordenar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
          <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Registrar cantidad</h4>
          </div>
            <div class="modal-body"> <!-- en action mando a llamar el Controlador@function (anteponiendo el post) -->
                  <!-- contenido modal -->
    {{ Form::open(array('action' => 'OrdenCompraControlador@postOrdena', 'class' => 'form-horizontal', 'role' => 'form', 'files' => true)) }}


                @foreach($productos as $producto) 
  
                     <input type="hidden" value=" " name="src[{{$producto->codigo}}]" id="S{{$producto->codigo}}">
                @endforeach

                  <input type="hidden" name="inventario" id="inventario" >

                  <input type="hidden" name="apertura_id" value="{{$apertura}}">
       
                 <div class="form-group">
                      <label class="col-md-3 control-label">Cantidad</label>
                          <div class="col-md-7">
                           <input type="number" required class="form-control" name="cantidad" id="cantidad" placeholder="00"  aria-describedby="basic-addon2">   
                           
                       </div>
                </div>                 
          </div>
                <div class="modal-footer">           
                  <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                    <button type="submit"  class="btn btn-primary">Guardar</button>
                   
              </div>       
          </div>
      </div>

        </div>
   {{ Form::close() }}
@stop