 <!--pestaña terreno y nuicho-->
 <div @if ($tab=='tab6' or $tab == 'edit_tab6') class="tab-pane fade in active"@else class="tab-pane fade" @endif id="corporativo">
                        <p><!-- Matter -->

 <div class="col-md-5">  
     @if($status=='created')
         <div class="alert alert-info alert-dismissible" role="alert" align="center" id="alerta">
            <strong><h4> Registro exitoso</h4></strong>
          </div> 
     @endif 
  @if($status=='validar')
         <div class="alert alert-info alert-danger" role="alert" align="center" id="alerta">
           <strong><h4> Este registro ya ha sido añadido</h4></strong>
          </div> 
    @endif 
  @if($status=='vacio')
          <div class="alert alert-info alert-warning" role="alert" align="center" id="alerta">
          <strong><h4> Favor de no dejar campos vacios</h4></strong>
          </div> 
    @endif  
 @if($status=='extra')
        <div class="alert alert-info alert-dismissible" role="alert" align="center" id="alerta">
         <strong><h4> Este concepto ya fue registrado, se añadira automaticamente. Registro exitoso</h4></strong>
        </div> 
 @endif         
 <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">                
               <div align="left"> Cargos del corporativo</div>    
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                <div class="padd">
         {{ Form::open(array('action' => 'ReporteMensualControlador@postGcorporativo','class' => 'form-horizontal', 'role' => 'form', 'id'=>'empresa','files' => true)) }} 

                  <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Año </strong></label>
                         <div class="col-lg-8">                            
                      <div class="input-group">
                         <input type="number" class="form-control"  required placeholder="example 2017" min="2014" name="years">
                        <span class="input-group-addon" ><i class="fa fa-calendar" aria-hidden="true"></i></span> 
                  </div>                             
                        </div>
                  </div>

                <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Mes </strong></label>
                         <div class="col-lg-8">                          
								 <select  class="form-control"  name="month">
                                             <option value="0">Seleccione</option>
                                              <option value="1">Enero</option>
                                              <option value="2">Febrero</option>
                                              <option value="3">Marzo</option>
                                              <option value="4">Abril</option>
                                              <option value="5">Mayo</option>
                                              <option value="6">Junio</option>
                                              <option value="7">Julio</option>
                                              <option value="8">Agosto</option>
                                              <option value="9">Septiembre</option>
                                              <option value="10">Octubre</option>
                                              <option value="11">Noviembre</option>
                                              <option value="12">Diciembre</option>
                                            </select>                        </div>
                  </div>
                  <div class="form-group" id="div_monto6" >
                      <label class="col-lg-3 control-label"><strong>Monto </strong></label>
                         <div class="col-lg-8">
                            <div class="input-group">
                               <span class="input-group-addon" >$</span> 
                                  <input type="text" class="form-control"  onkeypress="return valida(event)"  name="Monto">	                                
	                        </div> 
	                      </div>
	                  </div>
                     <div class="col-lg-10" align="right">
                            <label class="radio-inline" ><input type="radio" name="insercion6"  value="1" id="individual6" >Monto individual - Nuevo </label>
                            <label class="radio-inline"><input type="radio" name="insercion6" value="0" id="conjunto6">Montos en conjunto</label>
                     </div>
	                   <div class="form-group" id="div_corp">
                        <label class="col-lg-3 control-label">Nombre gasto</label>
                             <div class="col-lg-8">
                              <div class="input-group">                                 
                               <span class="input-group-addon" ><i class="fa fa-pencil" aria-hidden="true"></i></span>     
                                <input type="text" id="gasto_corp" class="form-control"  placeholder="Descripción"  name="gasto_corp">                         
                             </div>
                         </div>
                      </div> 
                     <div  class="form-group" id="div_corp2">

                              @foreach($gastos as $g)
                              @if($g->cargo_corporativo == 1)
                         
                              <div class="col-lg-6" > 
                              <br><div class="input-group">
                              <span class="input-group-addon" >$</span>                                
                              <input type="text" onkeypress="return valida(event)"  class="form-control" name="gastos[{{$g->id}}]" placeholder='{{$g->nombre}}'>
                              </div>
                              </div>
                              @endif
                             @endforeach                      
                        </div> 
     
      </div><br>
      <div class="widget-foot">
      <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>
      <input type="hidden" name="tab" id="tab" value="2">
   
      </div>   
    </div>
</div>


   {{form::close()}}   

   <div class="col-md-7">  

    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                
              <div align="left"> Resgistros</div>
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
                  <table cellpadding="0" cellspacing="0" border="0" id="data-table6" width="100%">
              <thead>
                      <tr>
                        <th><strong>Mes</strong></th>
                        <th><strong>Año</strong></th>
                        <th><strong>Monto</strong></th>
                        <th><strong>Gastos</strong></th>  
                        <th><strong>Editar</strong></th>  

                      </tr>
                    </thead>
                    <tbody>  

                       @foreach($product as $p)     
                       @if($p->cargo_corporativo == 1)                         
                      <tr>
                        <td><strong>{{{$p->month}}}</strong></td>
                        <td>{{{$p->year}}}</td>
                        <td>${{{number_format($p->monto, 0, '.', ',')}}}</td>
                        <td>{{{$p->producto}}}</td>
                        <td><a  href=""  data-id="{{{$p->total_id}}}" data-toggle="modal" data-target="#Edit" title="Editar monto"  class="btn btn-xs btn-default"  ><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                     </tr>
                     @endif
                      @endforeach
              </tbody>
              <tfoot>
                
              </tfoot>
            </table>
                  <div class="clearfix"></div>               
   
                </div>
                </div>
              </div>
      </div>      
      </div>   
    </div>

    </div>