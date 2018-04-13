 <!--pestaña terreno y nuicho-->
 <div @if ($tab=='tab2' or $tab == 'edit_tab2') class="tab-pane fade in active"@else class="tab-pane fade" @endif id="categorias">
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
 <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">                
               <div align="left"> Ventas por categoria</div>    
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                <div class="padd">
         {{ Form::open(array('action' => 'ReporteMensualControlador@postCategoria','class' => 'form-horizontal', 'role' => 'form', 'id'=>'empresa','files' => true)) }} 

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
                 <div class="form-group">
                          <label class="col-lg-3 control-label">Categorias</label>
                                <div class="col-lg-8">
                                   <select class="form-control ventas chosen-select" name="categoria" id="categoria">
                                     <option value="0">Seleccione</option>
                                      @foreach($productos as $producto)
                                      <option value="{{{$producto->id}}}" >{{{$producto->nombre}}}</option>
                                      @endforeach
                                    </select>                                    
                                  </div>
                                </div>

                  <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Monto </strong></label>
                         <div class="col-lg-8">
                            <div class="input-group">
                               <span class="input-group-addon" >$</span> 
                                  <input type="number" class="form-control"  onkeypress="return valida(event)"  name="Monto">	                                
	                        </div> 
	                      </div>
	                  </div>
	                
     
      </div>
      <div class="widget-foot">
      <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>
      <input type="hidden" name="tab" id="tab" value="2">
   
      </div>   
    </div>
</div>


   {{form::close()}}   

   <div class="col-md-7">  
   @if($status=='edit')
     <div class="alert alert-info alert-dismissible" role="alert" align="center" id="alerta">
       <strong><h4> Registro modificado correctamente</h4></strong>
     </div> 
  @endif
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                
              <div align="left"> Registros</div>
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
                        <th><strong>Mes</strong></th>
                        <th><strong>Año</strong></th>
                        <th><strong>Monto</strong></th>
                        <th><strong>Categoria</strong></th>  
                        <th><strong>Editar</strong></th>  

                      </tr>
                    </thead>
                    <tbody>  

                       @foreach($product as $p)       
                       @if($p->categoria == 1)

                      <tr>
                        <td><strong>{{{$p->month}}}</strong></td>
                        <td>{{{$p->year}}}</td>
                        <td>${{{number_format($p->monto, 0, '.', ',')}}}</td>
                        <td>{{{$p->producto}}}</td>
                        <td><a  href=""  data-id="{{{$p->total_id}}}" data-toggle="modal" data-target="#Edit" title="Editar monto"  class="btn btn-xs btn-default"  ><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </td>
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