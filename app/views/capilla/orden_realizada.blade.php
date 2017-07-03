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
 </script>
 @stop

@section('module')


 <div class="widget">
 <div class="widget-head">  
            
               <div align="rigth">Ordenes de compras realizadas</div>                 
                    
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">          
                
                <div class="padd">
                          <div class="page-tables">               
                <div class="table-responsive">
                  <table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                    <thead>
                      <tr>                     	
                        <th><strong>Responsable</strong></th>

                        <th><strong>Fecha de pedido</strong></th>
                        <th><strong>Fecha de registro</strong></th>
                        <th><strong>Proveedor</strong></th>
            
                        <th><strong>Folio de orden</strong></th>
                        <th><strong>Estatus</strong></th>
                        <th></th>
                   
                      </tr>
                    </thead>
                    <tbody>                      
                      <tr>
                      @foreach($ordenes as $orden)
                       

                        <td>{{{$orden->pnombre}}} {{{$orden->p_paterno}}} {{{$orden->p_materno}}}</td>
                        @if($orden->fecha == 000-00-00)
                        <td>{{{$orden->fecha}}}</td>
                        @else
                        <td>{{{date('d-m-Y', strtotime($orden->fecha))}}}</td>
                        @endif
                        <td>{{{date('d-m-Y h:i:s a', strtotime($orden->created_at))}}}</td>
                        <td>{{{$orden->proveedor}}}</td>
                        <td><strong>{{{$orden->orden}}}</strong></td>
                     	  <td>
                        @if($orden->activo_orden == 0 && $orden->cancelado == 0 && $orden->aprobado_orden == 0)          
                   	    <span class="label label-default">En proceso</span> 
                        @elseif($orden->activo_orden == 0 && $orden->cancelado == 0 && $orden->aprobado_orden == 1)     
                        <span class="label label-success">Aprobado</span>              
                        @else      
                        <span class="label label-danger">Cancelada</span> 
                     </td>               
                    	@endif          			  
                     <td> @if ($orden->activo_orden == 0 && $orden->cancelado == 0 && $orden->aprobado_orden == 0 )    
                     <a class="btn btn-xs btn-default" href="{{URL::to('orden-compra/pedido/'.$orden->orden )}}"  title="Ver detalles de orden"> <i class="fa fa-search"></i></a>
                     <a class="btn btn-xs btn-default" href="{{URL::to('orden-compra/surtir/'.$orden->orden )}}"  onclick=" return confirm('¿Estas seguro recibir la orden?')" title="Aprobar orden"> <i class="fa fa-check"></i></a>
                     <a class="btn btn-xs btn-default" href="{{URL::to('orden-compra/denegar/'.$orden->orden )}}"  onclick=" return confirm('¿Estas seguro de revocar la orden?')" title="Denegar orden"> <i class="fa fa-times"></i></a>

                       @else                       

                      @endif  
                    </td> 
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
    <div class="col-lg-2 control-label">                             
       <a href= "{{ action('InventarioCafeteriaControlador@getIndex') }}" class="btn btn-primary" >Regresar</a> 

     </div> 



@stop