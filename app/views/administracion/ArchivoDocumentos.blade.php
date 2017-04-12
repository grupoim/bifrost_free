@section('scripts')
<script src="{{ URL::asset('js/chosen.jquery.js') }}"> </script>

<script>
   $(document).on('ready', function(){
      window.setTimeout(function() {
  $("#alerta").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 4000);
       });

    //chosen grafica vendedor
    $(".persona").chosen({   
    no_results_text: "No hay resultados para:",    
    
    width: "100%"    
  });

    // Cargar  la lista
    $.ajax("{{ action('ArchivoDocumentosControlador@getPersonas') }}")
    .success(function(data){
      $('#persona').typeahead({
        source: data,
        display: 'nombre',
        val: 'id',
        itemSelected: function(item){
          $('#nombre').val(item);
        }
      });
    });

        $(document).on("ready",function() {  /* Cuando la pagina este totalmente cargada */
      $("#guardar").on("click", function() { /* Al boton guardar le asigno el evento onClick */
        $("#new_prestamo").submit();
      });
    });
 </script>

@stop

@section('module')

 @if($status=='registro')
                  <div class="alert alert-info alert-dismissible" role="alert" align="center" id="alerta">
                 <strong><h4> Registro exitoso</h4></strong>
                </div> 
  @endif 
   @if($status=='estatus-A')
                  <div class="alert alert-info alert-danger " role="alert" align="center" id="alerta">
                 <strong><h4> se ha prestado un archivo</h4></strong>
                </div> 
  @endif 
    @if($status=='estatus-B')
                  <div class="alert alert-success" role="alert" align="center" id="alerta">
                 <strong><h4> Archivo devuelto correctamente</h4></strong>
                </div> 
  @endif
 @if($status=='validar')
                  <div class="alert alert-info alert-danger" role="alert" align="center" id="alerta">
                 <strong><h4>El campo persona y folio son obligatorios</h4></strong>
                </div> 
  @endif
 @if($status=='prestamo')
                  <div class="alert alert-info alert-danger" role="alert" align="center" id="alerta">
                 <strong><h4>Este archivo esta en prestamo</h4></strong>
                </div> 
  @endif

     <div class="col-md-12">  
    <div class="widget">


                <!-- Widget title -->
                <div class="widget-head">    
        <div class="btn-group pull-right">
      <a href="#nuevoprestamo" data-toggle="modal" class="btn btn-primary" ><i class="fa fa-plus-square"></i> Nuevo </a>      
  

      </div>            
               <div align="rigth">Bitácora de prestamos</div>                  
                    
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
          
                
                <div class="padd">
                          <div class="page-tables">
                <!-- Table -->
                <div class="table-responsive">
                  <table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                    <thead>
                      <tr>
                        <th><strong>FOLIO</strong></th>
                        <th><strong>FECHA DE SALIDA</strong></th>
                        <th><strong>FECHA DE REGRESO</strong></th>
                        <th><strong>COMENTARIOS</strong></th>
                        <th><strong>PERSONA</strong></th>
                        <th><strong>ESTATUS</strong></th>
                        <th><strong>OPERACIÓN</strong></th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      
                      <tr>

                      @foreach($archivos as $archivo)

                        <td>{{{$archivo->folio}}}</td>
                        <td>{{{date("d-m-Y h:i:s A", strtotime($archivo->fecha_salida))}}}</td>
                        <td>{{{$archivo->fecha_regreso}}}</td>
                        <td>{{{$archivo->comentario}}}</td>
                        <td>{{{$archivo->nombres}}} {{{$archivo->apellido_paterno}}} {{{$archivo->apellido_materno}}}</td>
                        <td> @if ( $archivo->activo == 1 )                   

                          <span class="label label-danger">Prestado</span></td>                        


                        @else                       
                        <span class="label label-success">Devuelto</span></td>
                        
                          @endif
                        <td> @if($archivo->activo == 1)

                                   
                                  <a class="btn btn-xs btn-danger" title="Devolver archivo" href="{{URL::to('archivo-control/baja/'.$archivo->id)}}"><i class="fa fa-check"></i></a>
                                   

                                    @else 
                                 

                                   <a class="btn btn-xs btn-success" disabled href="#"><i class="fa fa-check"></i></a>
                         @endif
                    
          
                                  </td> 
                        
                      </tr>
                      @endforeach
                    </tbody>
                    
                  </table>
                    
                                
              <div class="clearfix"></div>             
                
</div>
      </div>   
      </div>   
    </div>
<div id="nuevoprestamo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Registrar un prestamo</h4>
                </div>
                <div class="modal-body"> <!-- en action mando a llamar el Controlador@function (anteponiendo el post) -->
                  <!-- contenido modal -->

{{ Form::open(array('action' => 'ArchivoDocumentosControlador@postRegistro', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'new_prestamo','files' => true )) }}
  
                     <div class="form-group">
                                  <label class="col-lg-3 control-label">Folio</label>
                                  <div class="col-lg-7">
                                    <input type="text" class="form-control"  name="folio" required>
                                   
                                  </div>
                                </div>

                      <div class="form-group" id="div_persona">
                                  <label class="col-lg-3 control-label">Personas</label>
                                  <div class="col-lg-7">
                                    <select class="form-control persona chosen-select" name="persona_id">
                                      <option value="0">Seleccione</option>                                                                   
                                     @foreach($personas as $persona)
                                      <option value="{{{$persona->id}}}">{{{$persona->nombre}}}</option>
                                      @endforeach
                                    </select>
                               
                                  </div>
                                </div> 

                <div class="form-group">
                
                                  <label class="col-lg-3 control-label">Comentarios</label>
                                  <div class="col-lg-7">
                                    <textarea type="text" class="form-control"  name="comentario" ></textarea>

                                  </div>
                                </div>                
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
                </div>
            </div>
    </div>
  </div>
      {{form::close()}}
@stop