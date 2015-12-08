@section('scripts')

    @stop
@section('module')

 <div class="row">  
                   
@if($inventario)
            <div class="col-md-12">
              <!-- User widget -->
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left"><h3>Lámina {{{$inventario->folio_lamina}}} {{{ $inventario->material_color}}} </h3></div>
                  <div class="widget-icons pull-right"> Costo de Material ${{{number_format($inventario->costo_produccion, 2, '.', ',')}}} 
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"> </i></a> 
                  
                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">

                    
                     <div class="alert  alert-dismissible @if($inventario->utilidad < 0) alert-danger @elseif($inventario->utilidad > 0) alert-success @elseif($inventario->utilidad == 0) alert-default   @endif" role="alert" align="center">
     
                   <strong><h3> <i class="fa fa-calculator"></i> Utilidad ${{{number_format($inventario->utilidad, 2, '.', ',')}}} </h3></strong>
                  </div>
                   <!-- tabla de inventario--> 
                   <div class="col-md-3">
                        <div class="well">
                          <h4><i class="fa fa-database"></i> Inventario ${{{number_format($inventario->precio_stock, 2, '.', ',')}}}</h4>
                          
                          

                        </div>
                      </div>

                      
                      <div class="col-md-3">
                        <div class="well">
                          <h4> <i class="fa fa-money"></i>  Ventas: ${{{number_format($inventario->ventas, 2, '.', ',')}}} </h4>                                                  
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="well">
                          <h4> <i class="fa fa-cubes"></i>  Stock: ${{{number_format($inventario->stock, 2, '.', ',')}}} </h4>                                                  
                        </div>
                      </div>

                    <div class="col-md-3">
                        <div class="well">
                          <h4> <i class="fa fa-exchange"></i>  Reposicion: ${{{number_format($inventario->perdida_reposicion, 2, '.', ',')}}} </h4>                                                  
                        </div>
                      </div>


          <!-- tabla de inventario -->
                    <div class="clearfix"></div>
                  </div> <!-- end pad-->
                  <div class="widget-foot">
                   <p class="p-meta">
                                                            <!-- Due date & % Completed -->
                                                           <h3> <span>@if($inventario->lamina_completa == 0)<span class="label label-info">Retazo</span> @endif   Disponible: {{{number_format($inventario->area_stock, 2, '.', ',')}}} m<sup>2</sup> </span> </h3>
                                                                                        
                                                          </p>
                                                    <div class="progress progress-animated progress-striped active">
                                                  <div class="progress-bar @if($inventario->porcentaje_restante == 100) progress-bar-success @elseif($inventario->porcentaje_restante == 50 or $inventario->porcentaje_restante >= 31 ) progress-bar-warning @elseif($inventario->porcentaje_restante <= 30) progress-bar-danger  @endif"  data-percentage="{{{$inventario->porcentaje_restante}}}">
                                                    <span class="sr-only">100% Complete</span>
                                                  </div>
                                              </div>  
                    <!-- Footer goes here -->
                  </div>
                </div>
              </div>  

            </div>
            @endif


            <div class="col-md-4">
              <!-- Quick setting -->
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left"> <i class="fa fa-money"></i> Ventas</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  
                 
                   <div class="padd invoice">
                    

                    <div class="row">

                      <div class="col-md-12">
                      <table class="table table-striped table-hover table-bordered">
                          <thead>
                            <tr>
                              <th>#</th>                           
                              <th>Pieza</th>
                              <th>Cantidad</th>
                            </tr>
                          </thead>
                          <tbody>
                              
                            
                              @forelse($totales as $ctr => $total)
                 <tr><td>{{{$ctr+1}}}</td>                 
                 <td> {{{$total->pieza}}}</td>
                 <td>{{{$total->piezas}}}</td>                 
                 @empty
               <div class="alert alert-info alert-dismissible " role="alert" align="center">
     
                        <strong><h4> No hay registros aún </h4></strong>
                  </div> 
                 @endforelse
                              
                                                                                                                                                                                           
                            <tr>                                                             
                              <td></td>
                              
                              <td align="left"> <strong>Total</strong></td>
                              <td><strong>{{{$totales->sum('piezas')}}}</strong></td>
                            </tr>
                          </tbody>
                        </table>
                      
                        <hr />
                        <table class="table table-striped table-hover table-bordered">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Venta</th>
                              <th>Pieza</th>
                             
                              <th>Precio</th>                              
                              
                            </tr>
                          </thead>
                          <tbody>
                              
                            
                              @forelse($ventas_detalle as $ctr => $detalle)
                 <tr><td>{{{$ctr+1}}}</td>
                 <td>{{{$detalle->folio}}}</td>
                 <td> {{{$detalle->pieza}}}</td>
                 
                 <td>${{{number_format($detalle->precio_pieza, 2, '.', ',')}}}</td> 
                 </tr>
                 @empty
                 <div class="alert alert-info alert-dismissible " role="alert" align="center">
     
                        <strong><h4> No hay registros aún </h4></strong>
                  </div>                 
                 @endforelse
                              
                                                                                                                                                                                           
                            <tr>  
                              
                              <td></td>
                              <td></td>
                              
                              <td align="left"> <strong>Total</strong></td>
                              <td><strong>${{{number_format($ventas_detalle->sum('precio_pieza'), 2, '.', ',')}}}</strong></td>
                            
                            </tr>
                          </tbody>
                        </table>

                      </div>

                    </div>

                  </div>  
                    

                 
                  <div class="widget-foot">
                  Se @if($totales->sum('piezas') > 1) han @else ha @endif creado {{{$totales->sum('piezas')}}} @if($totales->sum('piezas') > 1)piezas @else pieza @endif
                    <!-- Footer goes here -->
                  </div>
                </div>
              </div>  


            </div>

            <div class="col-md-8">
              <!-- Quick setting -->
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left"><i class="fa fa-exchange"></i> Reposiciones</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                    <div class="padd invoice">
                    

                    <div class="row">

                      <div class="col-md-12">                      
                      
                        <hr />
                        <table class="table table-striped table-hover table-bordered">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Fecha</th>                             
                              <th>Pieza</th>
                             <th>Motivos</th>
                             <th>Requerido</th>
                             <th>Costo</th>
                              <th>Precio</th>
                                                           
                              
                            </tr>
                          </thead>
                          <tbody>
                              
                            
                              @forelse($reposiciones as $ctr => $reposicion)
                 <tr><td>{{{$ctr+1}}}</td>
                 <td>{{{date("d-m-Y", strtotime($reposicion->created_at))}}}</td>
                 <td> {{{$reposicion->pieza}}}</td>                 
                 <td>{{{$reposicion->motivos}}}</td>
                 <td>{{{$reposicion->area_requerida}}} m<sup>2</sup></td>
                 <td>${{{number_format($reposicion->costo_material_usado, 2, '.', ',')}}}</td>                 
                 <td>${{{number_format($reposicion->precio_reposicion, 2, '.', ',')}}}</td> 
                 
                 </tr>
                 @empty
                  <div class="alert alert-info alert-dismissible " role="alert" align="center">
     
                        <strong><h4> No hay registros aún </h4></strong>
                  </div> 
                 @endforelse
                              
                                                                                                                                                                                           
                            <tr>  
                              
                              <td></td>
                              <td></td>
                              <td></td>
                              <td align="left"> <strong>Total</strong></td>
                              <td>{{{$reposiciones->sum('area_requerida')}}} m<sup>2</sup></td>
                              <td><strong>${{{number_format($reposiciones->sum('costo_material_usado'),2, '.', ',')}}}</strong></td>
                              <td><strong>${{{number_format($reposiciones->sum('precio_reposicion'),2, '.', ',')}}}</strong></td>
                            </tr>
                          </tbody>
                        </table>

                      </div>

                    </div>

                  </div>  
                    
                  <div class="widget-foot">
                    <!-- Footer goes here -->
                  </div>
                </div>
              </div>  


            </div>

            <div class="col-md-8">
              <!-- Quick setting -->
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left"><i class="fa fa-database"></i> Stock</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd invoice">
                    

                    <div class="row">

                      <div class="col-md-12">                      
                                              
                        <table class="table table-striped table-hover table-bordered">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Fecha</th>
                              <th>Folio</th>                             
                              <th>Pieza</th>                             
                             <th>Requerido</th>
                             <th>Costo</th>
                              <th>Precio</th>
                                                           
                              
                            </tr>
                          </thead>
                          <tbody>
                              
                            
                              @forelse($stock as $ctr => $s)
                 <tr><td>{{{$ctr+1}}}</td>
                 <td>{{{date("d-m-Y", strtotime($s->created_at))}}}</td>
                 <td>{{{$s->folio}}}</td>
                 <td> {{{$s->pieza}}}</td>                                 
                 <td>{{{$s->area_requerida}}} m<sup>2</sup></td>
                 <td>${{{number_format($s->costo_material_usado, 2, '.', ',')}}}</td>                 
                 <td>${{{number_format($s->precio_venta, 2, '.', ',')}}}</td> 
                 
                 </tr>
                 @empty
                  <div class="alert alert-info alert-dismissible " role="alert" align="center">
     
                        <strong><h4> No hay registros aún </h4></strong>
                  </div> 
                 @endforelse
                              
                                                                                                                                                                                           
                            <tr>  
                              
                              <td></td>
                              <td></td>
                              <td></td>
                              <td align="left"> <strong>Total</strong></td>
                              <td>{{{$stock->sum('area_requerida')}}} m<sup>2</sup></td>
                              <td><strong>${{{number_format($stock->sum('costo_material_usado'),2, '.', ',')}}}</strong></td>
                              <td><strong>${{{number_format($stock->sum('precio_venta'),2, '.', ',')}}}</strong></td>
                            </tr>
                          </tbody>
                        </table>

                      </div>

                    </div>

                  </div>
                  <div class="widget-foot">
                    <!-- Footer goes here -->
                  </div>
                </div>
              </div>  


            </div>           



          </div>            
@stop
