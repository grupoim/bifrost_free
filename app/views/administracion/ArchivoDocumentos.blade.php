@section('scripts')
<script src="{{ URL::asset('js/chosen.jquery.js') }}"> </script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript">
$(document).on('ready', function(){

      window.setTimeout(function() {
  $("#alerta").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 2000);
   
    {{-- fin ocultar mensajes de alerta automaticamente ======= --}}
            $(function() {
   
//Array para dar formato en español
 $.datepicker.regional['es'] = 
 {
 closeText: 'Cerrar', 
 prevText: 'Previo', 
 nextText: 'Próximo',
 
 monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
 'Jul','Ago','Sep','Oct','Nov','Dic'],
 monthStatus: 'Ver otro mes', yearStatus: 'Ver otro año',
 dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
 dateFormat: 'yy-mm-dd', firstDay: 0, 
 initStatus: 'Selecciona la fecha', isRTL: false};
$.datepicker.setDefaults($.datepicker.regional['es']);

//miDate: fecha de comienzo D=días | M=mes | Y=año
//maxDate: fecha tope D=días | M=mes | Y=año
   $( "#datepicker" ).datepicker({ maxDate: "0"});

 });//fin fuincion datepicker
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
           
      $(document).ready(function (e) {
  $('#entrega').on('show.bs.modal', function(e) {    
     var id = $(e.relatedTarget).data().id;
      $(e.currentTarget).find('#entrega').val(id);

  });
});

     });
 </script>

@stop

@section('module')

   @if($status=='estatus-A')
                  <div class="alert alert-info alert-info " role="alert" align="center" id="alerta">
                 <strong><h4> Se ha prestado un archivo</h4></strong>
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


 <div class="widget">
 <div class="widget-head">  
    <div class="btn-group pull-right">
      <a href="#nuevoprestamo" data-toggle="modal" class="btn btn-default" ><i class="fa fa-plus-square"></i> Nuevo </a>      
    </div>
               <div align="rigth">Prestamo de documentos</div>                 
                    
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">          
                
                <div class="padd">
                          <div class="page-tables">               
                <div class="table-responsive">
                  <table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                    <thead>
                      <tr>
                        <th><strong>Folio</strong></th>
                        <th><strong>Fecha salida</strong></th>
                        <th><strong>Fecha de regreso</strong></th>
                        <th><strong>Comentario</strong></th>
                        <th><strong>Persona</strong></th>
                        <th><strong>Estatus</strong></th>
                        <th><strong>Operación</strong></th>
                        
                      </tr>
                    </thead>
                    <tbody>  
                       @foreach($archivos as $archivo)                                           
                      <tr>
                        <td><strong>{{{$archivo->folio}}}</strong></td>
                        <td>{{{$archivo->fecha_salida}}}</td>
                        <td>{{{$archivo->fecha_regreso}}}</td>
                        <td>{{{$archivo->comentario}}}</td>
                        <td><strong>{{{$archivo->nombre}}}</strong></td>
                        <td> @if ( $archivo->activo == 1 )                   
                          <span class="label label-danger">Prestado</span>                        
                        @else                       
                        <span class="label label-success">Devuelto</span>
                          @endif</td>
                        <td> @if($archivo->activo == 1)
                        <a  href=""  data-id="{{$archivo->id}}" data-toggle="modal" data-target="#entrega" title="Devolver archivo"  class="btn btn-xs btn-danger"  ><i class="fa fa-check"></i> </a>
                        @else 
                        <a class="btn btn-xs btn-success" disabled href="{{URL::to('archivo-control/alta/'.$archivo->id )}}"><i class="fa fa-check"></i></a>
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
             <div class="widget-foot">
               <!-- Footer goes here -->
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
             <label class="col-lg-3 control-label">Fecha prestamo</label>
               <div class="col-lg-7">
                <div class='input-group date' id='datetimepicker1'>
                    <input data-format="yyyy-MM-dd" type='text' class="form-control" name="fecha_salida" />
                  <span class="input-group-addon add-on"> <i data-date-icon="fa fa-calendar" ></i></span>
                </div>
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
                    <button type="submit"  class="btn btn-primary">Guardar</button>
                </div>
            </div>
    </div>
  </div>
   {{form::close()}}   

<div id="entrega" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Registrar un prestamo</h4>
                </div>
                <div class="modal-body"> <!-- en action mando a llamar el Controlador@function (anteponiendo el post) -->
                  <!-- contenido modal -->

     {{ Form::open(array('action' => 'ArchivoDocumentosControlador@postEntrega', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'registro')) }}  
  
                     <input  type="hidden" id="entrega" name="archivo_id">
                    <div class="form-group">
                                  <label class="col-lg-3 control-label">Fecha regreso </label>
                                  <div class="col-lg-8">                                 
                                    <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                     <p> <input type="text" id="datepicker"  placeholder="Seleccione fecha" name="fecha_regreso"></p>
                                    </div>
                                  </div>
                      </div>

            </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    <button type="submit"  class="btn btn-primary">Guardar</button>
                </div>
            </div>
    </div>
  </div>
   {{form::close()}}   


@stop