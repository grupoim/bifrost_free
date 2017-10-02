@section('scripts')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script type="text/javascript">
$(document).on('ready', function(){

$(document).on('click','.open_modal_personas',function(){

var id = $(this).val();

$.get('{{ action('ProspectosControlador@getDetalle') }}/' + id, function (data) {
	$('#personas').text(data.empleado);
	$('#puesto').text(data.puesto);
	$('#fecha_nacimiento').text(data.fecha_nacimiento);
	$('#edad').text(data.edad);
	$('#lugar_nacimiento').text(data.lugar_nacimiento);
    $('#estado_civil').text(data.estado_civil);
    $('#domicilio').text(data.domicilio);
    $('#calle').text(data.calle);
    $('#num_interior').text(data.numero_interior);
    $('#num_exterior').text(data.numero_exterior);
    $('#telefono').text(data.telefono);
    $('#tipo_telefono').text(data.tipo_telefono);

       console.log(data);
            $('#id').val(data.id);
});
$('#informacion').modal('show');




});
});
</script>
@stop


@section('module')

<div class="widget">

 <div class="widget-head">    
     <div class="pull-right">      

           </div>           
               <div align="rigth">Relación del personal </div>         
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
                         	 <th><strong>Nombre</strong></th>
                             <th><strong>Puesto</strong></th>
                             <th><strong>Fecha ingreso</strong></th>
                             <th><strong>NSS</strong></th>
                             <th><strong>SDI</strong></th>
                             <th><strong>CURP</strong></th>
                             <th><strong>RFC</strong></th>  
                             <th></th>                                    
                          </tr>
                       </thead>
                    <tbody>
                             
                         @foreach($personal as $p)              
								<tr>
                                      <td>{{$p->solicitante}}</td>
                                      <td>{{$p->puesto}}</td>
                                      <td>{{{date('d-m-Y h:i:s a', strtotime($p->fecha_contratacion))}}}</td>
                                      <td>{{$p->imss}}</td>
                                      <td>${{{number_format($p->sueldo, 0, '.', ',')}}}</td>
                                      <td>{{strtoupper($p->curp)}}</td>
                                      <td>{{strtoupper($p->rfc)}}</td>
                                      <td><button class="btn btn-xs btn-default open_modal_personas "  title="Perfil de {{{$p->solicitante}}}" value="{{$p->solicitud_id}}"><i class="fa fa-user" aria-hidden="true"></i></button></td>

          
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

<div class="widget-foot" align="right">
      <a  href= "{{URL::to('prospectos/')}}" class="btn btn-default" >Regresar</a>  
      </div>
    <div id="informacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Relación de personal</h4>
          </div>
            <div class="modal-body"> <!-- en action mando a llamar el Controlador@function (anteponiendo el post) -->
                  <!-- contenido modal -->

					<div class="container-fluid" align="center">
					<div class="well">
					<div class="alert alert-success">
					  <h4><strong><i class="fa fa-user" aria-hidden="true"></i> <span id = "personas"></span></strong></strong></h4>
					  <h4><i class="fa fa-briefcase" aria-hidden="true"></i> <span id="puesto"></span></h4>
					  </div>

					  <div class="row" align="center">
					    <div class="col-sm-6" ><h4><strong><i class="fa fa-calendar" aria-hidden="true"></i> Fecha nacimiento:</strong> <span id="fecha_nacimiento"></span> </h4></div>
					    <div class="col-sm-6" ><h4><strong><i class="fa fa-heart" aria-hidden="true"></i> Edad:</strong> <span id="edad"></span></h4></div>
					    <div class="col-sm-6" ><h4><strong><i class="fa fa-globe" aria-hidden="true"></i> Lugar nacimiento:</strong> <span id="lugar_nacimiento"></span></h4></div>
					    <div class="col-sm-6" ><h4><strong><i class="fa fa-university" aria-hidden="true"></i> Estado civil:</strong> <span id="estado_civil"></span></h4></div>
					    <div class="col-sm-6" ><h4><strong><i class="fa fa-phone" aria-hidden="true"></i> Telefono:</strong> <span id="telefono"></span></h4></div>
					    <div class="col-sm-6" ><h4><strong><i class="fa fa-phone" aria-hidden="true"></i> Tipo:</strong> <span id="tipo_telefono"></span></h4></div>
							</div>
				    <br> </div>
				    <div class="alert alert-info">
					    <h4><strong><i class="fa fa-home" aria-hidden="true"></i> Domicilio:</strong> <span id="domicilio"></span></h4>
					    <h4><strong><i class="fa fa-road" aria-hidden="true"></i> Calle:</strong> <span id="calle"></span></h4>
					    <div class="col-sm-6" ><h4><strong><i class="fa fa-home" aria-hidden="true"></i> Numero interior:</strong> <span id="num_interior"></span></h4></div>
					    <div class="col-sm-6" ><h4><strong><i class="fa fa-home" aria-hidden="true"></i> Numero exterior:</strong> <span id="num_exterior"></span></h4></div>
					<br></div>
			      </div>
			      </div>
                <div class="modal-footer">           
                  <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cerrar</button>                 
               </div>       
            </div>
        </div>

        </div>

@stop