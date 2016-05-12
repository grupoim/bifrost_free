@section('scripts')
<script src="{{ URL::asset('js/chosen.jquery.js') }}"> </script>
<link href="{{ URL::asset('css/chosen.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/jquery.growl.js') }}" ></script>
<link rel="stylesheet" href="{{ URL::asset('css/jquery.growl.css') }}"> 

<script>

  $(document).on('ready', function(){

    $("#material_color").chosen({   
    no_results_text: "No hay resultados para:",    

    width: "100%"    
  });

  });
    </script>

    @stop
@section('module')

      
            <div class="col-md-12">
			
              <div class="widget wred">
                <div class="widget-head">
                  <div class="pull-left">Registro de láminas </div> 
                  <div class="widget-icons pull-right">                    
                  </div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">
                    
                    <br />
                    <!-- Form starts.  -->
                     
                    {{ Form::open(array('action' => array('InventarioRecubControlador@postEditacolor',$material_color_r->material_color_id), 'class' => 'form-horizontal', 'role' => 'form')) }} 
                                                   
                      <div class="form-group">
                                  <label class="col-lg-4 control-label">Color</label>                                  
                                  <div class="col-lg-4">
                                    <input type="text" class="form-control" value="{{$material_color_r->color}}" placeholder="Nombre del color" name="nombre_color" required>
                                  </div>                                  
                                </div>
                                

                      <div class="form-group">
                                  <label class="col-lg-4 control-label">Material</label>
                                  <div class="col-lg-4">
                                   <select class="form-control  chosen-select" data-placeholder="Select Your Options" id="material_color" name="material_id" >                                
                       
                      @foreach($materiales as $material)
                        
                        <option value="{{{$material->id}}}"> {{{$material->nombre}}}</option>
                       @endforeach
                         </select>
                                  </div>
                                </div>                               

                                
                  </div>
                </div>
                  <div class="widget-foot">
                    <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-floppy-o"></i> Guardar</button>
                    <a  type="btn" href="{{action('InventarioRecubControlador@getIndex')}}" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-refresh"></i> Reestablecer</a>                    
<input type="hidden" name="color_id" value="{{{$material_color_r->color_id}}}">
{{form::close()}}
                    <!-- Footer goes here -->
                  </div>
              </div>  

            </div>
                      
@stop
