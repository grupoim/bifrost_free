 <!--pestaña mtto-->
                       <div @if ($tab=='tab2'and $registro=='edit_tab2') class="tab-pane fade in active"@else class="tab-pane fade" @endif id="mtto">
                        <p><!-- Matter -->
                

            <div class="col-md-4">


              <div class="widget wgreen">
                @if($status=='mtto_created')
                  <div class="alert alert-info alert-dismissible" role="alert" align="center">
                 
                 <strong><h4> Mantenimiento agregado al inventario</h4></strong>
                </div> 
                @endif
                @if($status=='mtto_repetido')
                  <div class="alert alert-warning alert-dismissible" role="alert" align="center">
                 
                 <strong><h4> Mantenimiento ya existe</h4></strong>
                </div> 
                @endif
                <div class="widget-head">
                  <div class="pull-left">Pago de mantenimiento</div>
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
                     {{ Form::open(array('action' => 'ProductoControlador@postMantenimiento', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'capture')) }}                            
                                
                                <div class="form-group">
                                  <label class="col-lg-2 control-label">Tipo</label>
                                  <div class="col-lg-8">
                                    <select class="form-control" id="construccion" name="construccion">
                                      
                                      @forelse($construcciones as $construccion)                                      
                                      <option>{{{$construccion->descripcion}}}</option>                                     
                                      @empty
                                      @endforelse                                                                           
                                    
                                    </select>
                                  </div>
                                </div>        

                                <div class="form-group">
                  <label class="col-md-2 control-label">Meses</label>
                  <div class="col-md-6">
                    <div class="input-group">
                     <label class="checkbox-inline">
  <input type="checkbox" id="check_3m" value="1"> 3
</label>
<label class="checkbox-inline">
  <input type="checkbox" id="check_6m" value="2"> 6
</label>
<label class="checkbox-inline">
  <input type="checkbox" id="check_12m" value="3"> 12
</label>
                    </div>
                  </div>
                </div> 
                <div class="form-group" id="div_3m">
                  
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-usd" > </i></span>
                      <input type="text" class="form-control" name="monto_3m" id="monto_3m" placeholder="Trimestral" aria-describedby="basic-addon2" value="{{Input::old('monto_3m')}}">
                      @if($errors->has('monto_3m')) <div align="center" class="alert alert-danger">{{$errors->first('monto_3m')}}</div> @endif
                    </div>
                  </div>
                </div> 

                <div class="form-group" id="div_6m">
                  
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-usd" > </i></span>
                      <input type="text" class="form-control" name="monto_6m" id="monto_6m" placeholder="Semestral" aria-describedby="basic-addon2" value="{{Input::old('monto_6m')}}">
                    @if($errors->has('monto_6m')) <div align="center" class="alert alert-danger">{{$errors->first('monto_6m')}}</div> @endif
                    </div>
                  </div>
                </div>  

                <div class="form-group" id="div_12m">
                  
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-usd" > </i></span>
                      @if($errors->has('monto_12m')) <div align="center" class="alert alert-danger">{{$errors->first('monto_12m')}}</div> @endif
                      <input type="text" class="form-control" name="monto_12m" id="monto_12m" placeholder="Anual" aria-describedby="basic-addon2" value="{{Input::old('monto_12m')}}">
                    </div>
                  </div>
                </div>                             
                             
                              
                  </div>
                </div>
                  <div class="widget-foot">
                 <button type="submit" class="btn btn-sm btn-info" id="btn_send" ><i class="fa fa-check"></i> Enviar</button>                     
                    <input type="hidden" id="tipo_producto" name="tipo_producto" value="mtto">
                     
                    
                    {{ Form::close() }}
                    <!-- Footer goes here -->
                  </div>
              </div> 
            </div>

            {{-- <div class="col-md-6">  
 
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
             
              <div align="center"> Precios vigentes </div>
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
                  <table cellpadding="0" cellspacing="0" border="0" id="data-table3" width="100%">
                    <thead>
                      <tr>                      
                        <th>Descripción</th> 
                         <th>Trimestral</th>
                          <th>Semestral</th>
                           <th>Anual</th>
                       
                        
                      </tr>
                    </thead>
                    <tbody>
                      
                       
                       <tr>
                         
                       
                        @foreach($construcciones as $construccion)                     
                        <td> {{{$construccion->descripcion}}} </td>                   
                        
                        </tr>@endforeach
                    </tbody>
                    
                  </table>
                  <div class="clearfix"></div>               
   
                </div>
                </div>
              </div>
      </div>      
      </div> --}}  
    </div>   
    <!-- fin plan pago --> 
              
