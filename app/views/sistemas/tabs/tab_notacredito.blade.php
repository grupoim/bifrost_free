<!-- pestaña cupon -->
                      <div @if ($tab=='tab3' and $registro=='edit_tab3') class="tab-pane fade in active"@else class="tab-pane fade" @endif id="cupon">
                        <p><!-- widget plan pago -->
   <div class="col-md-6">  
 
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                @if($status=='nota_created')
      <div class="alert alert-info alert-dismissible" role="alert" align="center">
     
     <strong><h4> Nota de credito creada!!</h4></strong>
    </div>  

      @endif
      @if($status=='nota_baja')
      <div class="alert alert-danger alert-dismissible" role="alert" align="center">
     
     <strong><h4> Nota de credito desactivada </h4></strong>
    </div>  

      @endif
      @if($status=='nota_alta')
      <div class="alert alert-info alert-dismissible" role="alert" align="center">
     
     <strong><h4> Nota de crédito activada </h4></strong>
    </div>  

      @endif
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

                                   
                                   <a class="btn btn-xs btn-success" href="{{URL::to('configuracion-general/bajanota/'.$cupon->id)}}" title="Dar de Baja Nota de Crédito"> <i class="fa fa-check"></i></a>
                                   

                                    @else 
                                 

                                   <a class="btn btn-xs btn-danger" href="{{URL::to('configuracion-general/altanota/'.$cupon->id)}}" title="Reactivar Nota de Crédito"> <i class="fa fa-times"></i></a>
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
    {{ Form::open(array('action' => 'ConfiguracionControlador@postNuevanotacredito', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'empresa','files' => true)) }}        
                @foreach($empresa as $empresa_activa)                
                         
                 <div class="form-group">
                
                                  <label class="col-lg-3 control-label">Cliente</label>
                                  <div class="col-lg-9">
                                    <input type="text"  Class="form-control" name="cliente" id="cliente" placeholder="Escriba nombre del cliente" autocomplete="off" value="{{Input::old('cliente')}}">
                                  </div>
                                </div>
                <div class="form-group">
                
                                  <label class="col-lg-3 control-label">Descuento</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="Descuento" id="descuento" name="descuento" value="{{Input::old('descuento')}}">
                                  </div>
                                </div>                
        
           <div class="form-group">
                
                                  <label class="col-lg-3 control-label">Descripcion</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="Descripcion de la nota de credito" id="descripcion" name="descripcion" value="{{Input::old('descripcion')}}" >
                                  </div>
                                </div>
                                
                       <div class="form-group">
                 
                                  <label class="col-lg-3 control-label">Porcentaje</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="Porcentaje de descuento" id="porcentaje" name="porcentaje" value="{{Input::old('porcentaje')}}">
                                  </div>
                                </div> 
                      
                                            
                                                               
              <div class="clearfix"></div>             
                @endforeach  
      </div>
      </div>
      <div class="widget-foot">

      <input type="hidden" name="cliente_id" id="cliente_id">
      <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>
      {{form::close()}}
      </div>   
    </div>
    <!-- fin planes de pago --></p>
</div>