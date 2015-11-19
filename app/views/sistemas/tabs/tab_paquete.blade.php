<!-- pestaña cupon -->
                      <div @if ($tab=='tab3' and $registro=='edit_tab3') class="tab-pane fade in active"@else class="tab-pane fade" @endif id="paquete">
                        <p><!-- widget plan pago -->
   <div class="col-md-6">  
 
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
                  <table cellpadding="0" cellspacing="0" border="0" id="data-table2" width="100%">
                    <thead>
                      <tr>
                      <th>Add</th>
                      <th>#</th>
                        <th>cliente</th>
                        <th>Tipo de descuento</th>
                        <th>cantidad</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      
                      @foreach($productos as $producto)<tr>
                      <td>                            
                            <span class="uni">
                              <input type='checkbox' value='check1' />
                            </span>
                          </td>
                      	<td>{{{$producto->id}}}</td>
                        <td>{{{$producto->nombre}}}</td>
                        <td>{{{$producto->departamento->nombre}}}</td>
                        <td> ${{{1.5}}} </td> 
                    
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
    <!-- fin plan pago -->

     <!-- widget nuevo plan de credito -->
   <div class="col-md-6">  
 
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">                
               <div align="center">Nuevo paquete</div>                  
                    
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                <div class="padd">

   
   <div class="form-group">
  
 <label for="sector" class="col-md-12 control-label">Productos del combo </label> 
 <div class="col-md-12">
    <select data-placeholder="Choose a Country..." class=" productos chosen-select" multiple style="width:350px;" tabindex="4" side-by-side clearfix>
            <option value=""></option>
              @foreach($productos as $producto)

                <option value="{{$producto->id}}"> {{{$producto->nombre}}}</option>
              
               @endforeach 
       
         </select>          
    
  </div>
</div>
<div class="clearfix"></div>
      </div>
      </div>
      <div class="widget-foot">

      <input type="hidden" name="cliente_id" id="cliente_id">
      <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>
     
      </div>   
    </div>
    <!-- fin paquetes --></p>
</div>