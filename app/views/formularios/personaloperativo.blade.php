@section('module')
	{{-- ocultar mensajes de alerta automaticamente =======--}}
    {{ Form::close() }} 
<script type="text/javascript">
      window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 2000);
    </script>
    {{-- fin ocultar mensajes de alerta automaticamente ======= --}}
 <!-- Form starts.  -->
 @if ($agregar == true)                   
				
   {{ Form::open(array('action' => 'PersonalOperativoControlador@postInsertar', 'class' => 'form-horizontal', 'role' => 'form')) }} 
                    
 @else 
   {{ Form::open(array('action' => array('PersonalOperativoControlador@postEditar',$empleado_r->id), 'class' => 'form-horizontal', 'role' => 'form')) }}
 @endif
     			
  	<div class="form-group">                              
									
    <label class="col-lg-2 control-label">Nombre(s)</label>
                                  
    	<div class="col-lg-5">
            	<input type="text" class="form-control" placeholder="Nombre(s)" id="nombres" name="nombres" 
            @if ($agregar == true)
           	 	value =  "{{Input::old('nombres')}}" >
            @else 
            	 value = "{{$empleado_r->nombres}}" >
            @endif                                     
            
           @if($errors->has('nombres')) <div align="center" class="alert alert-danger">{{$errors->first('nombres')}}</div> @endif
      	</div>
    </div>
                                
        <div class="form-group">
          <label class="col-lg-2 control-label">Apellido Paterno</label>
          <div class="col-lg-5">
            <input type="text" class="form-control" placeholder="Ap. Paterno" id="apellido_paterno" name="apellido_paterno" 
           @if ($agregar == true)	
          	 value= "{{Input::old('apellido_paterno')}}">
           @else 
          	 value = "{{$empleado_r->apellido_paterno}}">
           @endif

           @if($errors->has('apellido_paterno'))<div align="center" class="alert alert-danger"> {{$errors->first('apellido_paterno')}}</div> @endif
          </div>
        </div> 
                                
        <div class="form-group">
          <label class="col-lg-2 control-label">Apellido Materno</label>
          <div class="col-lg-5">
            <input type="text" class="form-control" placeholder="Ap. Paterno" id="apellido_materno" name="apellido_materno" 
           @if ($agregar == true)	
           	value= "{{Input::old('apellido_materno')}}">
           @else 
          	value = "{{{$empleado_r->apellido_materno}}}">
           @endif
          
            @if($errors->has('apellido_materno'))<div align="center" class="alert alert-danger"> {{$errors->first('apellido_materno')}}</div> @endif
          </div>
        </div>                                
                                        
                          
     <div class="form-group">
		<label class="col-lg-2 control-label"> Fecha de Ingreso: </label>
			<div class="col-lg-5">
    			<div id="datetimepicker1" class="input-append input-group dtpicker" >
        			<input data-format="yyyy-MM-dd" type="text" class="form-control" id="fecha_ingreso" name="fecha_ingreso"
        	@if ($agregar == true)	
           	value= "{{Input::old('fecha_ingreso')}}">
           @else 
          	value = "{{$empleado_r->fecha_ingreso}}">
           @endif
       				 <span class="input-group-addon add-on"> <i data-date-icon="fa fa-calendar" ></i></span>                                                                   
    			</div>

      				@if($errors->has('fecha_ingreso'))<div align="center" class="alert alert-danger"> {{$errors->first('fecha_ingreso')}}</div> @endif 
			</div>
	</div>                               
    
   <div class="form-group">
      <label class="col-lg-2 control-label" size="1">Puesto</label>
      	<div class="col-lg-3">
        	<select class="form-control" name="puesto_id" id="puesto_id" >                                
            
             	@foreach($puestos as $puesto)

				@if ($agregar == true)
            		<option value="{{$puesto->id}}"> {{{$puesto->nombre}}}</option>
             	@else 
             		<option value="{{$puesto->id}}" @if ($puesto->nombre == $empleado_r->puesto) selected @endif> {{{$puesto->nombre}}}</option>
           		 @endif

            	 @endforeach 
       
         </select>                                    
         
      </div>
    </div> 

    <hr>
    <div class="form-group">
          <label class="col-lg-2 control-label">Salario diario</label>
          <div class="col-lg-5">
            <input type="number" class="form-control" placeholder="$0.00" id="apellido_materno" name="salario_diario" 
           @if ($agregar == true) 
            value= "{{Input::old('salario_diario')}}">
           @else 
            value = @if(count($empleado_r)> 0) "{{{$empleado_r->salario_diario}}}" @else " " @endif>
           @endif
          
            @if($errors->has('apellido_materno'))<div align="center" class="alert alert-danger"> {{$errors->first('apellido_materno')}}</div> @endif
          </div>
        </div>  

     <div class="form-group">
          <label class="col-lg-2 control-label">Salario Semanal</label>
          <div class="col-lg-5">
            <input type="text" class="form-control" placeholder="$0.00" id="apellido_materno" name="salario_semanal" 
           @if ($agregar == true) 
            value= "{{Input::old('salario_semanal')}}">
           @else 
            value = @if(count($empleado_r->salario_semanal)> 0) "{{{$empleado_r->salario_semanal}}}" @else " " @endif>
           @endif
          
            @if($errors->has('apellido_materno'))<div align="center" class="alert alert-danger"> {{$errors->first('apellido_materno')}}</div> @endif
          </div>
        </div>                     
                                                               
    <div class="col-lg-2 control-label"> 
	    <button type="submit" class="btn btn-sm btn-primary">
		    @if ($agregar == true)
		    	Guardar 
		    @else 
		    	Editar
		    @endif
	    </button>                             
       <a href= "{{ action('PersonalOperativoControlador@getIndex') }}" class="btn btn-primary" >Regresar</a> 

     </div>                            
 
    
  

                  

@stop