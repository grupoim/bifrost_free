<!-- pestaña cupon -->
                      <div @if ($tab=='tab3' and $registro=='edit_tab3') class="tab-pane fade in active"@else class="tab-pane fade" @endif id="paquete">
                        <p><!-- widget plan pago -->
    
   
   <div class="col-md-12">  
 
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
               
              <div align="center"> Catálogo paquetes vigentes </div>
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
                      <th>#</th>
                      <th>Nombre del paquete</th>
                      <th>Contenido</th>
                      <th>Precio</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      
                      @foreach($paquetes as $paquete)<tr>
                     
                        <td>{{{$paquete->paquete_id}}}</td>
                        <td>{{{$paquete->producto->nombre}}}</td>
                        <td> @foreach ($contenido_paquete as $item) 
                        
                          @if ($paquete->paquete_id == $item->paquete_id)
                        <li>{{{$item->item}}}</li>
                        @endif
                        @endforeach
                        </td>
                        <td>
                       <!-- -->
                        @foreach($precio_paquete as $p)
                        @if($paquete->paquete_id == $p->id)
                        ${{$p->monto}}
                        @endif
                        @endforeach
                        <!-- -->
                        </td>

                      </tr>@endforeach
                     
                    </tbody>
                    
                  </table>
                  <div class="clearfix"></div>               
   
                </div>
                </div>
              </div>
      </div>      
      </div>   
    </div>   
    
   <div class="col-md-6">
 
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                @if($status=='paquete_created')
                  <div class="alert alert-info alert-dismissible" role="alert" align="center">
                 
                 <strong><h4> Paquete creado</h4></strong>
                </div> 
                @endif                
               <div align="center">Nuevo paquete</div>                  
                    
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                <div class="padd">
<br/>
                    <!-- Form starts.  -->
                     {{ Form::open(array('action' => 'ProductoControlador@postCombo', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'capture')) }}
                             
                                <div class="form-group" id="sector_terreno">
                                  <label class="col-lg-2 control-label">Nombre</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="Escribe el nombre del combo" id="nombre_producto" name="nombre_producto" value="{{Input::old('sector')}}">
                                    
                                  </div>
                                </div>                                                                                                              
                                
                                <div class="form-group">
                                  <label class="col-lg-2 control-label">Departamento</label>
                                  <div class="col-lg-9">
                                    <select class="form-control" id="departamento_id" name="departamento_id">
                                      @foreach($departamentos as $departamento)
                                      <option value="{{{$departamento->id}}}">{{{$departamento->nombre}}}</option>                                      
                                      @endforeach
                                    </select>
                                  </div>
                                </div>

                                 <div class="form-group">
                                
                               <label for="sector" class="col-md-2 control-label">Productos</label> 
                               <div class="col-md-9">
                                  <select  multiple class=" productos chosen-select form-control" name="producto[]" >
                                        
                                       @foreach($productos_combo as $producto)     

                                              <option value="{{$producto->id}}"> {{{$producto->nombre}}}</option>
                                            
                                             @endforeach 
                                     
                                       </select> 
                     
                                </div>
                              </div>

   <div class="form-group">
                  <label class="col-md-2 control-label">Costo</label>
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                      <input type="text" class="form-control" name="monto" id="monto" placeholder="00.00" aria-describedby="basic-addon2" value="{{Input::old('monto')}}">
                    </div>
                  </div>
                </div> 
                <div class="form-group">
                  <label class="col-md-2 control-label">Comisión</label>
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">%</span>
                      <input type="text" class="form-control" name="porcentaje_comision" id="porcentaje_comision" placeholder="00" aria-describedby="basic-addon2" value="{{Input::old('porcentaje_comision')}}">
                    </div>
                  </div>
                </div> 

                <div class="form-group">
                  <label class="col-md-2 control-label">Minimo comisionable</label>
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">%</span>
                      <input type="text" class="form-control" name="porcentaje_minimo_comisionable" id="porcentaje_minimo_comisionable" placeholder="00" aria-describedby="basic-addon2" value="{{Input::old('porcentaje_comision')}}">
                    </div>
                  </div>
                </div> 
<div class="clearfix"></div>
      </div>
      </div>
      <div class="widget-foot">
      
      <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>
     {{ Form::close() }}
      </div>   
    </div>
    <!-- fin paquetes -->
<div class="col-md-5">  
 
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                @if($status== 'producto_created')
                  <div class="alert alert-info alert-dismissible" role="alert" align="center">
                 
                 <strong><h4> Producto creado</h4></strong>
                </div> 
                @endif                
               <div align="center">Producto para venta en paquete</div>                  
                    
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                <div class="padd">
                   
                      {{ Form::open(array('action' => 'ProductoControlador@postProductocombo', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'capture2')) }}
                             
                             <div class="form-group">
                                  <label class="col-lg-3 control-label">Nombre</label>
                                  <div class="col-lg-6">
                                    <input type="text" class="form-control" placeholder="Nombre del producto" name="nombre_producto_c" required>
                                  </div>
                                </div>
              <div class="form-group">
                                  <label class="col-lg-3 control-label">Departamento</label>
                                  <div class="col-lg-6">
                                    <select class="form-control" id="departamento_id_productp" name="departamento_id_producto">
                                      @foreach($departamentos as $departamento)
                                      <option value="{{{$departamento->id}}}">{{{$departamento->nombre}}}</option>                                      
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Tipo Producto</label>
                                  <div class="col-lg-8">
                                    <label class="radio-inline">
                                            <input type="radio" name="tipo_producto" id="inlineRadio1" value="0" checked="true" required title="Sencilla">Normal
                                          </label>
                                          <label class="radio-inline">
                                            <input type="radio" name="tipo_producto" id="inlineRadio2" value="1" title="Doble">Servicio
                                          </label>                                         

                                    </div>
                                </div> 



              <div class="form-group">
                   <label class="col-md-3 control-label">Costo</label>
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                      <input type="text" class="form-control" name="monto_producto" id="monto" placeholder="00.00" required aria-describedby="basic-addon2" value="{{Input::old('monto_producto')}}">
                    </div>
                  </div>
                </div> 
                <div class="form-group">
                  <label class="col-md-3 control-label">Comisión</label>
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">%</span>
                      <input type="text" class="form-control" name="porcentaje_comision_producto" id="porcentaje_comision_producto" required placeholder="00" aria-describedby="basic-addon2" value="{{Input::old('porcentaje_comision_producto')}}">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">Minimo comisionable</label>
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">%</span>
                      <input type="text" class="form-control" name="porcentaje_minimo_comisionable_producto" required id="porcentaje_minimo_comisionable_producto" placeholder="00" aria-describedby="basic-addon2" value="{{Input::old('porcentaje_minimo_comisionable_producto')}}">
                    </div>
                  </div>
                </div>
                                                                                                           
                
<div class="clearfix"></div>
      </div>
      </div>
      <div class="widget-foot">
      
      <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>
     {{ Form::close() }}
      </div>   
    </div>
       <!-- fin paquetes -->

    </p>
</div>