@section('scripts')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script>
$(document).on('ready', function(){

      window.setTimeout(function() {
  $("#alerta").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 2000);

$(document).ready(function (e) {
  $('#contratar').on('show.bs.modal', function(e) {    
  var id = $(e.relatedTarget).data().id;
      $(e.currentTarget).find('#solicitud_id').val(id);
      	
});
});
  //funcion Para el datepicker
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
   $( "#datepicker" ).datepicker();

 });//fin fuincion datepicker
       });	

</script>
@stop
@section('module')
  <div class="col-md-12" >
   @if($status=='edit')
                  <div class="alert alert-info alert-info " role="alert" align="center" id="alerta">
                 <strong><h4> Contratacion exitosa</h4></strong>
                </div> 
  @endif 

    <div class="clearfix"></div>
        <div class="widget">

 <div class="widget-head">    
     <div class="pull-right">      
             <a  href= "{{URL::to('solicitud/')}}"  class="btn btn-m btn-default"><i class="fa fa-file-o"></i> Llenar solicitud</a> 
             <a  href= "{{URL::to('prospectos/contratados')}}"  class="btn btn-m btn-default"><i class="fa fa-users" aria-hidden="true"></i> Personal activo</a> 
           </div>           
               <div align="rigth">Lista de aspirantes</div>         
               <div class="clearfix"></div>
                </div>
                <div class="widget-content"> 
                <div class="padd">

                          <div class="page-tables">
                <!-- Table -->

                <div class="table-responsive">
                   <table   cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                      <thead>
                          <tr>
                             <th><strong>Puesto</strong></th>
                             <th><strong>Coordinador</strong></th>
                             <th><strong>Zona</strong></th>
                             <th><strong>Aspirante</strong></th>
                             <th><strong>Fecha solicitud</strong></th>                               
                             <th></th>                                                 
                          </tr>
                       </thead>
                    <tbody>
                             
                         @foreach($prospectos as $p)              
								<tr>
                                      <td>{{$p->puesto}}</td>
                                      <td>{{$p->cordinador}}</td>
                                      <td>{{$p->zona}}</td>  
                                      <td>
                              @foreach($solicitante as $s) 
                                    @if ($s->solicitante_id  == $p->solicitante_id )                                     
                                      {{$s->solicitante}} 
                                    @endif 
                             @endforeach 
                                      </td> 
                                       <td>{{{date('d-m-Y h:i:s a', strtotime($p->fecha_solicitud))}}}</td>                                 
                                      <td>
 									   @if ( $p->contratado == 0 )     
                                      <a class="btn btn-xs btn-default" href="" data-id="{{$p->solicitud_id}}"  data-toggle="modal" data-target="#contratar"   title="Contratar aspirante"><i  class="fa fa-check"></i></a>
                                      <a class="btn btn-xs btn-default" href="{{URL::to('solicitud/informacion/'.$p->solicitud_id )}}"   title="Datos sobre el aspirante"> <i class="fa fa-search"></i></a>

									   @else

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
    </div>
       <div id="contratar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Detalles aspirante</h4>
          </div>
            <div class="modal-body"> <!-- en action mando a llamar el Controlador@function (anteponiendo el post) -->
                  <!-- contenido modal -->
   {{ Form::open(array('action' => 'ProspectosControlador@postContratacion', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'registro')) }}
    

    	      <input type="hidden" id="solicitud_id" name="solicitud_id">
               <div class="form-group">
                  <label class="col-md-3 control-label">Sueldo</label>
                   <div class="col-md-7">
                      <input type="number" required class="form-control"  name="sueldo" id="sueldo" placeholder="$0.00">        
                   </div>
                </div>     
                    <div class="form-group">
                     <label class="col-lg-3 control-label">Fecha </label>
                        <div class="col-lg-8">                                 
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                              <p> <input type="text" id="datepicker" placeholder="Seleccione fecha" name="fecha_contratacion"></p>
                            </div>
                         </div>
                      </div>
			      </div>
                <div class="modal-footer">           
                  <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                    <button type="submit"  class="btn btn-primary">Guardar</button>                   
               </div>       
            </div>
        </div>

        </div>
{{ Form::close() }}  
@stop