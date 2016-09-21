@extends('modal')
@section('modal-content')


              <!-- User widget -->
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left"><i><p>Cliente(a)</p></i><h3><strong>{{{ $comision->cliente }}}</strong> </h3>
					
                  </div>
                  <div class="pull-right"><i><p>Vendedor(a)</p></i>
                   <strong>{{{ $comision->vendedor }}}  </strong>
                   
                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">

                   <!-- tabla de inventario--> 
                   <div class="col-md-3">
                        <div  class="alert alert-info  text-center">
                          <h5><i class="fa fa-database"></i> Venta <strong>${{{ number_format($comision->total, 0, ".", ",") }}}</strong></h5>

                        </div>
                      </div>

                      
                      <div class="col-md-3">
                        <div class="alert alert-info text-center">
                          <h5> <i class="fa fa-money"></i> Comision <strong>${{{ number_format($comision->total_comisionable, 0, ".", "," ) }}}</strong></h5>                                                  
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="alert alert-success text-center" >
                          <h5> <i class="fa fa-cubes"></i> Pagado <strong>${{{ number_format($comision->pagado, 0, ".", ",") }}} </strong></h5>                                                  
                        </div>
                      </div>

                    <div class="col-md-3">
                        <div  class="alert alert-danger text-center">
                          <h5> <i class="fa fa-exchange"></i> Resto <strong> ${{{ number_format($comision->por_pagar, 0, ".", ",") }}}</strong> </h4>                                                  
                        </div>
                      </div>


          <!-- tabla de inventario -->
                    <div class="clearfix"></div>
                  </div> <!-- end pad-->
                  <div class="widget-foot">
                  <div class="p-meta" align="center">
                   <h2>{{{$comision->producto}}}</h2>
  <p>Venta de <strong>@if($comision->nombre_corto == "V") Contrato @else Recubrimiento @endif </strong> Folio <strong>{{{$comision->folio_solicitud}}}</strong> ID <strong> {{{$comision->id}}}</strong> Comisión calculada al <strong>{{{$comision->porcentaje}}}%</strong></p>
                  @if($comision['abonos'] == 0) 
                                 
                                                 
		<div class="alert alert-warning text-center" >
                          <h5><strong> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No se han dado pagos de mensualidad a esta comisión <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></strong></h5>                                                  
                        </div>
		@else
			
		
  <table class="table table-condensed">
    <thead>
      <tr>
        <th class="text-center">Folio comisión</th>
        <th class="text-center">Pago</th>
        <th class="text-center">Fecha</th>
      </tr>
    </thead>
    <tbody>
      @foreach($abonos as $abono)
      <tr>
      
		
		@if($modalId == $abono->comision_id)
        <td class="text-center">{{{$abono->folio}}}</td>
        <td class="text-center">$ {{{ number_format($abono->monto, 2, '.', ',') }}}</td>
        <td class="text-center">{{{date("d-m-Y", strtotime($abono->fecha_inicio))}}} al {{{date("d-m-Y", strtotime($abono->fecha_fin))}}}</td>
     @endif

		
		
	     

		</tr>@endforeach

    </tbody>
  </table>
  @endif

           </div>                   

                   @if($comision->observaciones)
					<strong>*Nota: {{{$comision->observaciones}}}</strong>
                   @endif <!-- Footer goes here -->
                  </div>
                </div>
              </div>  

      
@overwrite