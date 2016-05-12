@section('scripts')

    @stop
@section('module')

 <div class="row">


                   

            <div class="col-md-5">

              <!-- User widget -->
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Catalogo de colores </div>
                  <div class="widget-icons pull-right"> 
                    <a href= "{{ action('InventarioRecubControlador@getAgregarcolor') }}" class="btn btn-primary" ><i class="fa fa-user-plus"></i> Nuevo </a>       
                  
                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content" id="inventario_general">
                  <div class="padd">
                   <!-- tabla de inventario--> 
                   
 <div class="page-tables">
                        <!-- Table -->
                        <div class="table-responsive" id="StudentTableContainer">
                            <table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                                <thead>
                                    <tr>                                                                        
                                        {{-- <th>#</th> --}}
                                        <th>Id</th>
                                        <th>Detalles</th>
                                        <th>Opciones</th>
                                        

                                                                                                                                                                                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($colores as $crt => $color)                                   
                                                                       
                                        {{--<td>
                                          $crt+1    
                                        </td> --}}
                                        <td>{{{$color->id}}}</td>
                                        <td>{{{ $color->material_color}}} </td>
                                        <td>

                                        <a href= "{{action('InventarioRecubControlador@getRecuperaColor', $color->id)}}"class="btn btn-xs btn-info" value ="{{$color->id}}" ><i class="fa fa-pencil"></i> </a>
                                         @if($color->activo == 1)

                                   
                                   <a class="btn btn-xs btn-success" href="{{URL::to('inventario-recub/bajacolor/'.$color->id)}}" title="Dar de Baja a  {{{Str::title($color->material_color)}}}"> <i class="fa fa-check"></i></a>
                                   

                                    @else 
                                 

                                   <a class="btn btn-xs btn-danger" href="{{URL::to('inventario-recub/altacolor/'.$color->id)}}" title="Reactivar {{{Str::title($color->material_color)}}}"> <i class="fa fa-user-times"></i></a>
                      @endif
                    
                                        
                                        </td>                                     
                                                                       
                                    </tr>
                                    @endforeach

                                </tbody>
                                
                            </table> </div>
                            <div class="clearfix"></div>
          <!-- tabla de inventario -->
                    
                  </div> <!-- end pad-->
                  <div class="widget-foot">
                    <!-- Footer goes here -->
                  </div>
                </div>
              </div>  

            </div>
        
@stop
