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
            
               <div align="rigth">Lista de acciones realizadas</div>                  
                    
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
          
                
                <div class="padd">
                          <div class="page-tables">
                <!-- Table -->
                <div class="table-responsive">
                  <table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                    <thead>
                      <tr>
                     	
                        <th><strong>Usuario</strong></th>
                        <th><strong>Acción</strong></th>
                        <th><strong>Producto</strong></th>
                        <th><strong>Fecha</strong></th>
                        <th><strong>Fecha automatica</strong></th>
                        <th><strong>Cantidad</strong></th>                       
  
                        
                      </tr>
                    </thead>
                    <tbody>
                      
                      <tr>

                      @foreach($movimientos as $movimiento)

                       
                        <td>{{{$movimiento->pnombre}}} {{{$movimiento->p_paterno}}} {{{$movimiento->p_materno}}}</td>
                        <td>{{{$movimiento->accion_id}}}</td> 
                        <td>{{{$movimiento->producto}}}</td>
                        @if($movimiento->fecha == 000-00-00)
                        <td>{{{$movimiento->fecha}}}</td>
                        @else
                        <td>{{{date('d-m-Y', strtotime($movimiento->fecha))}}}</td>
                        @endif
                        <td>{{{date('d-m-Y h:i:s a', strtotime($movimiento->created_at))}}}</td>
                        <td><strong>{{{$movimiento->cantidad}}}</strong></td>                      
                  				

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