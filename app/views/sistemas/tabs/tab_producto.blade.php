<!-- pestaña productos-->
    
                      <div @if ($tab=='tab4'and $registro=='edit_tab4') class="tab-pane fade in active"@else class="tab-pane fade" @endif id="productos">
                        <!-- pestaña de plan de pago -->
                      
                        <p> <!-- widget productos -->
   <div class="col-md-6">  
 
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                
              <div align="center"> Planes de pago </div>
                  <div class="widget-icons pull-right">                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
               <div class="padd">
                  @if($status=='plan_created')
      <div class="alert alert-info alert-dismissible" role="alert" align="center">
     
     <strong><h4> Nuevo de pago creado!!</h4></strong>
    </div>  

      @endif
      @if($status=='plan_baja')
      <div class="alert alert-danger alert-dismissible" role="alert" align="center">
     
     <strong><h4> Plan de pago desactivado </h4></strong>
    </div>  

      @endif
      @if($status=='plan_alta')
      <div class="alert alert-warning alert-dismissible" role="alert" align="center">
     
     <strong><h4> Plan de pago reactivado </h4></strong>
    </div>  

      @endif  
              <!-- Table Page -->
              <div class="page-tables">
                <!-- Table -->
                <div class="table-responsive">
                  <table cellpadding="0" cellspacing="0" border="0" id="data-table3" width="100%">
                    <thead>
                      <tr>
                      <th>#</th>
                        <th>Descripcion</th>
                        <th>Anticipo</th>
                        <th>Acción</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      
                      <tr>
                      @foreach($plan_pago as $plan)
                         <td>{{{$plan->id}}}</td>
                        <td>{{{$plan->descripcion}}}</td>
                        <td>{{{$plan->porcentaje_anticipo}}}%</td>
                        <td> @if($plan->activo == 1)

                                   
                                   <a class="btn btn-xs btn-success" href="{{URL::to('configuracion-general/bajapago/'.$plan->id)}}" title="Dar de Baja Plan"> <i class="fa fa-check"></i></a>
                                   

                                    @else 
                                 

                                   <a class="btn btn-xs btn-danger" href="{{URL::to('configuracion-general/altapago/'.$plan->id)}}" title="Reactivar Plan"> <i class="fa fa-times"></i></a>
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

     <!-- widget nuevo plan de pago -->
   <div class="col-md-6">  
 
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">                
               <div align="center">Nuevo Plan de Pago </div>                  
                    
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                <div class="padd">
    {{ Form::open(array('action' => 'ConfiguracionControlador@postNuevoPlan', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'empresa','files' => true)) }}        
                @foreach($empresa as $empresa_activa)                
                         
                <div class="form-group">
                                  <label class="col-lg-3 control-label">Descripcion</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="Escriba descripcion del plan"  
                                    id="descripcion" name="descripcion"  required value="{{Input::old('descripcion')}}">
                                    @if($errors->has('descripcion')) <div align="center" class="alert alert-danger">{{$errors->first('descripcion')}}</div> @endif
                                  </div>
                                </div>
                <div class="form-group">
                
                                  <label class="col-lg-3 control-label">Anticipo</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="Anticipo" id="porcentaje_anticipo" name="porcentaje_anticipo" required value="{{Input::old('porcentaje_anticipo')}}">
                                    @if($errors->has('porcentaje_anticipo')) <div align="center" class="alert alert-danger">{{$errors->first('porcentaje_anticipo')}}</div> @endif
                                  </div>
                                </div>                
        
           <div class="form-group">
                
                                  <label class="col-lg-3 control-label">Periodo</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="periodo" id="periodo" name="periodo" required value="{{Input::old('periodo')}}">
                                    @if($errors->has('periodo')) <div align="center" class="alert alert-danger">{{$errors->first('periodo')}}</div> @endif
                                  </div>
                                </div>
                                
                       <div class="form-group">
                 
                                  <label class="col-lg-3 control-label">Numero de Pagos</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="Pagos" id="numero_pagos" name="numero_pagos" required value="{{Input::old('numero_pagos')}}">
                                    @if($errors->has('numero_pagos')) <div align="center" class="alert alert-danger">{{$errors->first('numero_pagos')}}</div> @endif
                                  </div>
                                </div> 
                      <div class="form-group">
                
                                  <label class="col-lg-3 control-label">Interés Mensual</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="Interes Mensual"  id="interes_mensual" name="interes_mensual" required value="{{Input::old('interes_mensual')}}">
                                    @if($errors->has('interes_mensual')) <div align="center" class="alert alert-danger">{{$errors->first('interes_mensual')}}</div> @endif
                                  </div>
                                </div>                                            
                                                               
              <div class="clearfix"></div>             
                @endforeach  
      </div>
      </div>
      <div class="widget-foot">
      <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>
      <input type="hidden" name="tab" id="tab" value="2">
      {{form::close()}}
      </div>   
    </div>
    <!-- fin planes de pago --></p>
                      </div>
    <!-- fin pestaña prodcutos -->