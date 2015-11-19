<!-- pestaña productos-->
    
                      <div @if ($tab=='tab4'and $registro=='edit_tab4') class="tab-pane fade in active"@else class="tab-pane fade" @endif id="productos">
                        <!-- pestaña de plan de pago -->
                      
                        <p> <!-- widget productos -->
   <div class="col-md-12">  
 
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                
              <div align="center"> Catálogo de colonias disponibles </div>
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
                        <th>Colonia</th>
                        <th>Codigo Postal</th>
                        <th>Municipio</th>
                        <th>Estado</th>                        
                      </tr>
                    </thead>
                    <tbody>
                      
                      <tr>
                      @foreach($colonias as $colonia)
                         <td>{{{$colonia->id}}}</td>
                        <td>{{{$colonia->colonia}}}</td>
                        <td>{{{$colonia->codigo_postal}}}</td>
                        <td>{{{$colonia->municipio}}}</td>
                        <td>{{{$colonia->estado}}}</td>
                        
                        
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
   <div class="col-md-4">  
 
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">                
               <div align="center">Nueva Colonia </div>                  
                    
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                <div class="padd">
    {{ Form::open(array('action' => 'ConfiguracionControlador@postNuevoPlan', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'empresa','files' => true)) }}        
                @foreach($empresa as $empresa_activa)                
                         
                <div class="form-group">
                                  <label class="col-lg-3 control-label">Colonia</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="Escriba nombre de la colonia"  
                                    id="descripcion" name="colonia_nombre"  required value="{{Input::old('colonia_nombre')}}">
                                    {{--@if($errors->has('descripcion')) <div align="center" class="alert alert-danger">{{$errors->first('descripcion')}}</div> @endif--}}
                                  </div>
                                </div>
                <div class="form-group">
                
                                  <label class="col-lg-3 control-label">C.P.</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="Código postal" id="porcentaje_anticipo" name="cp" required value="{{Input::old('cp')}}">
                                  {{--  @if($errors->has('porcentaje_anticipo')) <div align="center" class="alert alert-danger">{{$errors->first('porcentaje_anticipo')}}</div> @endif--}}
                                  </div>
                                </div>                
        
           <div class="form-group">
                
                                  <label class="col-lg-3 control-label">Estado</label>
                                  <div class="col-lg-9">
                                    <select class="form-control" placeholder="Estado" id="estado" name="estado" required value="{{Input::old('estado')}}"> 
                                    <optgroup>pppppp
                                      <option>estadpo</option>
                                    </optgroup>
                                    </select>

                                    {{--@if($errors->has('periodo')) <div align="center" class="alert alert-danger">{{$errors->first('periodo')}}</div> @endif--}}
                                  </div>
                                </div>
                                
                       <div class="form-group">
                 
                                  <label class="col-lg-3 control-label">Municipio</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="Pagos" id="numero_pagos" name="numero_pagos" required value="{{Input::old('numero_pagos')}}">
                                    @if($errors->has('numero_pagos')) <div align="center" class="alert alert-danger">{{$errors->first('numero_pagos')}}</div> @endif
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