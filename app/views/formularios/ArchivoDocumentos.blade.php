@section('module')

{{ Form::open(array('action' => 'ArchivoDocumentosControlador@postEditar' ,$fecha_regreso->id ,   'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'new_prestamo','files' => true )) }}
                     
<input type="hidden" value="{{{$fecha_regreso->id}}}" name="id">
     <div class="form-group">
    <label class="col-lg-2 control-label"> Fecha de Ingreso: </label>
      <div class="col-lg-5">
          <div id="datetimepicker1" class="input-append input-group dtpicker" >
              <input data-format="yyyy-MM-dd" type="text" class="form-control" required=""  name="fecha_regreso">

               <span class="input-group-addon add-on"> <i data-date-icon="fa fa-calendar" ></i>                                                                
          </div>
 
      </div>
  </div>                               
        </div>                     
     <br><br>                                                          
    <div class="col-lg-2 control-label"> 
      <button type="submit" class="btn btn-sm btn-primary">Guardar
      </button>                             
       <a href= "{{ action('ArchivoDocumentosControlador@getIndex') }}" class="btn btn-primary" >Regresar</a> 

     </div>                            
     
    {{ Form::close() }}       

@stop