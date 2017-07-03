 <!--pestaña terreno y nuicho-->
                      <div @if ($tab=='tab9' or $registro == 'edit_tab9') class="tab-pane fade in active"@else class="tab-pane fade" @endif id="cafeteria">
                        <p><!-- Matter -->
                

            <div class="col-md-7">


              <div class="widget wgreen">
                
                <div class="widget-head">
                @if($status=='producto_created')
                  <div class="alert alert-info alert-dismissible" role="alert" align="center">
                 
                 <strong><h4> Producto agregado al inventario</h4></strong>
                </div> 
                @endif 
                 @if($status=='vacios')
                  <div class="alert alert-warning alert-dismissible" role="alert" align="center">
                 
                 <strong><h4> Datos vacios</h4></strong>
                </div> 
                @endif
 
                  <div class="pull-left">Registro de productos</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">

                    <br/>
                    <!-- Form starts.  -->
                     {{ Form::open(array('action' => 'ProductoControlador@postProducto', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'capture')) }}
                                                                                 
                         <div class="form-group" >
                                  <label class="col-lg-3 control-label"><strong>Producto </strong></label>
                                  <div class="col-lg-7">
                                    <input type="text" class="form-control" placeholder="Escribe el producto" id="producto" name="nombre" required >
                                    @if($errors->has('nombre')) <div align="center" class="alert alert-danger">{{$errors->first('nombre')}}</div> @endif
                                  </div>
                                </div> 
                           <div class="form-group">
                                  <label class="col-lg-3 control-label">Departamento</label>
                                  <div class="col-lg-7">
                                    <select class="form-control" id="departamento_id" name="departamento_id" >
                                     <option value="0">Seleccione una opción</option> 
                                      @foreach($departamentos as $departamento)
                                      <option data-id="{{{$departamento->id}}}"  value="{{{$departamento->id}}}">{{{$departamento->nombre}}}</option>                                      
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                            
                     <div class="form-group">                                
                               <label for="sector" class="col-md-3 control-label">Proveedor</label> 
                               <div class="col-md-7">
                                  <select   class=" productos chosen-select form-control" name="proveedor_id" id="proveedor_id" >   
                                  <option value="0">Seleccione una opción</option>                                     
                                       @foreach($proveedores as $proveedor)   
                                              <option value="{{$proveedor->id}}"> {{{$proveedor->nombre}}}</option>                                            
                                             @endforeach                                      
                                       </select>                     
                                </div>
                              </div>                               

                                 <div class="form-group">
                                  <label class="col-lg-3 control-label">Tipo</label>
                                  <div class="col-lg-8">
                                    <label class="radio-inline">
                                            <input type="radio" name="combo" id="r2" value="0" checked="true" title="Sencillo">Sencillo
                                          </label>
                                          <label class="radio-inline">
                                            <input type="radio" name="combo" id="r1" value="1" title="Combo">Combo
                                          </label>                                    
                                    </div>
                                </div> 

                            <div class="form-group" id="div_combo">
                                  <label class="col-lg-3 control-label"><strong>Producto </strong></label>
                                  <div class="col-lg-7">
                                    <input type="text" class="form-control" placeholder="Escribe el producto" id="producto2" name="nombre2" >
                                
                                  </div>
                                </div> 

              <div class="form-group">
                  <label class="col-md-3 control-label">Cantidad</label>
                  <div class="col-md-7">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-cart-plus fa-fw"></i></span>
                      <input type="text" class="form-control" name="cantidad" id="cantidad" aria-describedby="basic-addon2" required>                  
                    </div>
                     @if($errors->has('cantidad')) <div align="center" class="alert alert-danger">{{$errors->first('cantidad')}}</div> @endif
                  </div>
                </div> 
      
               <div class="form-group">                                
                   <label for="sector" class="col-md-3 control-label">Unidad de medida</label> 
                       <div class="col-md-7">
                        <select class="form-control" name="unidad_id" >
                        <option value="0">Seleccione una opción</option>                                         
                            @foreach($unidades as $unidad)   
                              <option value="{{$unidad->id}}"> {{{$unidad->nombre}}}</option>                                            
                            @endforeach                                      
                        </select>                    
                        </div>
              </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Codigo de barras</label>
                  <div class="col-md-7">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-barcode" aria-hidden="true"></i></span>
                      <input type="text" class="form-control" name="codigo" id="codigo"  placeholder="utilice el lector" aria-describedby="basic-addon2" required >                       
                    </div>
                     @if($errors->has('codigo')) <div align="center" class="alert alert-danger">{{$errors->first('codigo')}}</div> @endif
                  </div>
                </div>                               
                             
                  <div class="form-group">
                    <label class="col-md-3 control-label">Descripción</label>
                    <div class="col-md-7">
                        <textarea type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Campo opcional..."  aria-describedby="basic-addon2"></textarea>                       
                    </div>
                  </div>       
                  </div>
                </div>
                  <div class="widget-foot">                 
                 <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-floppy-o"></i> Guardar</button>
                    {{ Form::close() }}
                    <!-- Footer goes here -->
                  </div>
              </div> 



            </div>
              <!-- widget nicho-->
               <div class="col-md-5">


              <div class="widget wgreen">
                
                <div class="widget-head">
                @if($status=='precio_created')
                  <div class="alert alert-info alert-dismissible" role="alert" align="center">
                 
                 <strong><h4> Precio agregado al producto</h4></strong>
                </div> 
                @endif
                @if($status=='precio_repetido')
                  <div class="alert alert-warning alert-dismissible" role="alert" align="center">
                 
                 <strong><h4> Este producto ya tiene registrado precio</h4></strong>
                </div> 
                @endif
                 @if($status=='vacio')
                  <div class="alert alert-warning alert-dismissible" role="alert" align="center">
                 
                 <strong><h4> Datos vacios</h4></strong>
                </div> 
                @endif
                  <div class="pull-left">Agregar precios</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">

                    <br/>
                    <!-- Form starts.  -->
                     {{ Form::open(array('action' => 'ProductoControlador@postPrecio', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'capture')) }}
                                  
                                     
                     <div class="form-group">                                
                               <label for="sector" class="col-md-2 control-label">Productos</label> 
                               <div class="col-md-8">
                                  <select   class=" productos chosen-select form-control" name="producto_precio" id="producto" >   
                                  <option value="0">Seleccione una opción</option>                                     
                                       @foreach($productos_cafeteria as $producto)   
                                              <option value="{{$producto->id}}"> {{{$producto->nombre}}}</option>                                            
                                             @endforeach                                      
                                       </select>                     
                                </div>
                              </div>                               
                      
                                <div class="form-group">
                  <label class="col-md-2 control-label">Precio</label>
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                      <input type="text" class="form-control" name="precio_producto" placeholder="00.00" aria-describedby="basic-addon2">
                    </div>
                 @if($errors->has('precio_producto')) <div align="center" class="alert alert-danger">{{$errors->first('precio_producto')}}</div> @endif
                  </div>
                </div>                             
                             
                  </div>
                </div>
                  <div class="widget-foot">                 
                  <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-floppy-o"></i> Guardar</button>   
                    {{ Form::close() }}
                    <!-- Footer goes here -->
                  </div>
              </div> 



            </div>
              <!-- widget nicho-->          
    <!-- Matter ends -->
</p>
                      </div> <!-- fin pestaña terreno y nicho-->