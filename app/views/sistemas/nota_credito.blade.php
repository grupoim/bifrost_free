@section('scripts')
<script type="text/javascript">	
      window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 4000);

      $.ajax("{{ action('ClienteControlador@getAll') }}")
    .success(function(data){
      $('#cliente').typeahead({
        source: data,
        display: 'nombre',
        val: 'id',
        itemSelected: function(item){
          $('#cliente').val(item);
        }
      });
    });

</script>
@stop
@section('module')
<?php $status=Session::pull('status'); ?>
<div class="row">
<!-- widget plan pago -->
   <div class="col-md-6">  
  @if($status=='cupon_baja')
      <div class="alert alert-danger alert-dismissible" role="alert" align="center">
     
     <strong><h4> Nota de crédito desactivada </h4></strong>
    </div>  

      @endif
      @if($status=='cupon_alta')
      <div class="alert alert-warning alert-dismissible" role="alert" align="center">
    
     <strong><h4> Nota de crédito activada </h4></strong>
    </div>  @endif
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                
              <div align="center"> Catálogo de Notas de crédito </div>
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
                  <table cellpadding="0" cellspacing="0" border="0" id="data-table2" width="100%">
                    <thead>
                      <tr>
                      <th>#</th>
                        <th>cliente</th>
                        <th>Tipo de descuento</th>
                        <th>cantidad</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      
                      <tr>
                      @foreach($nota_credito as $cupon)
                         <td>{{{$cupon->id}}}</td>
                        <td>{{{$cupon->cliente->persona->nombres}}} {{{$cupon->cliente->persona->apellido_paterno}}} {{{$cupon->cliente->persona->apellido_materno}}}</td>
                        <td>{{{$cupon->descripcion}}}</td>
                        <td> @if($cupon->activo == 1)
                                   
                                  
                                   <a class="btn btn-xs btn-success" href="{{URL::to('nota-credito/baja/'.$cupon->id)}}" title="Dar de Baja Plan"> <i class="fa fa-check"></i></a>
                                   

                                    @else 
                                 

                                   <a class="btn btn-xs btn-danger" href="{{URL::to('nota-credito/alta/'.$cupon->id)}}" title="Reactivar Plan"> <i class="fa fa-times"></i></a>
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
    </div>   
    <!-- fin plan pago -->

     <!-- widget nuevo plan de credito -->
   <div class="col-md-6">  
 
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">                
               <div align="center">Nueva nota de Crédito</div>                  
                    
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                <div class="padd">
    {{ Form::open(array('action' => 'NotaCreditoControlador@postNueva', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'empresa','files' => true)) }}        
                               
              
                <div class="form-group">
                
                                  <label class="col-lg-3 control-label">Cliente</label>
                                  <div class="col-lg-9">
                                    <input type="text"  Class="form-control" name="cliente" id="cliente" placeholder="Escriba nombre del cliente" autocomplete="off">
                                  </div>
                                </div>                
                   
                <div class="form-group">
                                  <label class="col-lg-3 control-label">Descripcion</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="Escriba descripcion del la nota de crédito"  id="descripcion" name="descripcion">
                                  </div>
                                </div>
           <div class="form-group">
                
                                  <label class="col-lg-3 control-label">Periodo</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="periodo" id="periodo" name="periodo" >
                                  </div>
                                </div>
                                
                       <div class="form-group">
                 
                                  <label class="col-lg-3 control-label">Numero de Pagos</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="Pagos" id="numero_pagos" name="numero_pagos" >
                                  </div>
                                </div> 
                      <div class="form-group">
                
                                  <label class="col-lg-3 control-label">Interés Mensual</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="Interes Mensual"  id="interes_mensual" name="interes_mensual">
                                  </div>
                                </div>
                                            
                                                               
              <div class="clearfix"></div>             
                  
      </div>
      </div>
      <div class="widget-foot">
      <input type="hidden" name="tab" id="tab" value="3">
      <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>
      {{form::close()}}
      </div>   
    </div>
    <!-- fin planes de pago -->


            </div>

 
@stop