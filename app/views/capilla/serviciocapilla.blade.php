@section('scripts')
<script src="{{ URL::asset('js/jquery.maskedinput.min.js') }}"> </script>
  <link rel="stylesheet" href="{{ URL::asset('css/multi-select.css') }}">  
<script>  
$(document).on('ready', function(){

      window.setTimeout(function() {
  $("#alerta").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 2000);
   
    {{-- fin ocultar mensajes de alerta automaticamente ======= --}}



        });

             jQuery(function($){
            $("#numero1").mask("9,99", {
 
                // Generamos un evento en el momento que se rellena
                completed:function(){
                    $("#numero1").addClass("ok")
                }
            });
 
            $("#telefono").mask("(999) 999 - 9999");

       
        });
//multiselect
         $('#custom-headers').multiSelect({
  selectableHeader: "<div class='custom-header'>Selectable items</div>",
  selectionHeader: "<div class='custom-header'>Selection items</div>",
  selectableFooter: "<div class='custom-header'>Selectable footer</div>",
  selectionFooter: "<div class='custom-header'>Selection footer</div>"
});
// buscadores de multi select
$('#custom-headers').multiSelect({
  selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='try \"12\"'>",
  selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='try \"4\"'>",
  afterInit: function(ms){
    var that = this,
        $selectableSearch = that.$selectableUl.prev(),
        $selectionSearch = that.$selectionUl.prev(),
        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
    .on('keydown', function(e){
      if (e.which === 40){
        that.$selectableUl.focus();
        return false;
      }
    });

    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
    .on('keydown', function(e){
      if (e.which == 40){
        that.$selectionUl.focus();
        return false;
      }
    });
  },
  afterSelect: function(){
    this.qs1.cache();
    this.qs2.cache();
  },
  afterDeselect: function(){
    this.qs1.cache();
    this.qs2.cache();
  }
});

</script>
@stop
@section('module')
    @if($status=='registro_rescatista')
                  <div class="alert alert-info" role="alert" align="center" id="alerta">
                 <strong><h4> Registro exitoso!..Rescatista añadido correctamente</h4></strong>
                </div> 
  @endif
      @if($status=='registro_validacion')
                  <div class="alert alert-danger" role="alert" align="center" id="alerta">
                 <strong><h4> Rescatista ya ha sido registrado</h4></strong>
                </div> 
  @endif
  <div class="col-md-4">
                        <div  class="alert alert-danger  text-center">
                          <h4><i class="fa fa-users"></i> Sala San Miguel </h4>
              <h4><strong>Detalles de velación</strong></h4>
             <h4 align="left"><strong>Inhumado:</strong> Pedro Yepiz Garcia</h4>                 
             <h4 align="left"><strong>Horario:</strong> 18 de Julio 10:00 am a 12:00 pm</h4>
             <a alt="" href="" class="btn btn-default"><i class="fa fa-plus-square"></i> Mas información</a>

                             <br>         
                        </div>
                      </div>
                
  <div class="col-md-4">
                        <div  class="alert alert-success  text-center">
                          <h4><i class="fa fa-users"></i> Sala San Gabriel </h4>
              <h4><strong>Detalles de velación</strong></h4>               
                 <input type="hidden" value="" name="promotor">
                             <br>
                       </div>
                      </div>
                        <div class="col-md-4">
                        <div  class="alert alert-success  text-center">
                          <h4><i class="fa fa-users"></i> Sala San Rafael </h4>
              <h4><strong>Detalles de velación</strong></h4> 
                     
                 <input type="hidden" value="" name="promotor">
                             <br>

                        </div>
                      </div>
<div class="clearfix"></div>
  <div class="well">
    <p class="lead text-right">
      Servicios realizados en capilla: <strong>120</strong>
    </p>
  </div>
<div class="widget">
	<div class="widget-head">
		<div class="pull-left"> @if($db->base_datos_produccion == 0)<h2><span class="label label-danger">  Advertencia, estas en la base de datos de pruebas  </span> </h2> @endif Cotizaciones activas</div>
		<div class="pull-right">
      <a alt="Catalago de rescatistas" href="" data-toggle="modal" data-target="#rescatista"  class="btn btn-default"><i class="fa fa-plus-square"></i> Rescatistas</a>
			<a alt="Nueva cotización" href="{{ action('ClienteControlador@getCreate') }}" class="btn btn-primary"><i class="fa fa-cart-plus"></i> Cotizar</a>
		</div>  
		<div class="clearfix"></div>
	</div>
	<div class="widget-content">
		<div class="padd">
			@if(count($servicios) > 0)
			<!-- Table Page -->
			<div class="page-tables">
				<!-- Table -->
				<div class="table-responsive">
					<table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
						<thead>
							<tr>
								<th class="col-md-1">ID</th>								
								<th class="col-md-1">contrato</th>								
								<th class ="col-md-2">Cliente</th>
								<th class ="col-md-2">Cliente</th>
								<th  class ="col-md-3">Producto</th>
								<th  class ="col-md-1">Total</th>
								<th  class ="col-md-1">cremacion</th>
								{{--<th>Asesor</th>--}}
								<th class ="col-md-2">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($servicios as $s)
							<tr>
								<td>{{{ $s->id }}}</td>
								<td>{{{ $s->folio }}}</td>
								<td>{{{ $s->venta_producto_id }}}</td>
								<td>{{{ $s->cliente }}}</td>
								<td><strong>{{{ $s->nombre}}}</strong></td>
								<td><strong>{{{ $s->cremacion}}}</strong></td>
								<td>$ {{{ number_format($s->total, 2, '.', ',') }}}</td>								
								{{--<td><strong>{{{ $s->asesor}}}</strong></td>--}}
								<td class="text-right">
									zzz
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="clearfix"></div>
				</div>
			</div>
			@else
			<div class="text-center">No hay cotizaciones activas</div>
			@endif
		</div>
	</div>
	<div class="widget-foot">
		<!-- Footer goes here -->
	</div>
</div>

<div id="rescatista" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
          <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Catalogo de rescatistas</h4>
          </div>
            <div class="modal-body"> <!-- en action mando a llamar el Controlador@function (anteponiendo el post) -->
                  <!-- contenido modal -->
      {{ Form::open(array('action' => 'ServicioFuneralControlador@postRescatista', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'registro')) }}

                  <input type="hidden" name="edit" id="edit" >

                  <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Nombre </strong></label>
                         <div class="col-lg-7">
                               <input type="text" class="form-control" placeholder="Nombre" name="nombres" id="nombres" required>
                        </div>
                  </div>

                <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Apellido paterno </strong></label>
                         <div class="col-lg-7">
                               <input type="text" class="form-control" placeholder="Apellido paterno" name="apellido_paterno" name="apellido_peterno" required>
                        </div>
                  </div>
                  <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Apellido materno </strong></label>
                         <div class="col-lg-7">
                               <input type="text" class="form-control" placeholder="Apellido materno" name="apellido_materno" id="apellido_materno" required>
                        </div>
                  </div>
                  <div class="form-group" >
                      <label class="col-lg-3 control-label"><strong>Telefono </strong></label>
                        <div class="col-lg-2">
                               <input type="number" class="form-control" placeholder="52" value="52" name="codigo_pais" id="codigo_pais" required>
                        </div>
                         <div class="col-lg-5">
                               <input type="text" class="form-control" placeholder="Numero" name="telefono" id="telefono" required>
                        </div>
                  </div>
                  <div class="form-group">                                
                   <label  class="col-md-3 control-label">Tipo de telefono</label> 
                       <div class="col-md-7">
                           <select class="form-control" name="tipo_telefono_id" id="tipo_telefono_id" >
                                <option value="0">Seleccione una opción</option>                                         
                                    @foreach($tipo_telefonos as $tipo_telefono)   
                                       <option value="{{$tipo_telefono->id}}"> {{{$tipo_telefono->descripcion}}}</option>                                            
                                     @endforeach                                     
                          </select>                    
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
   {{ Form::close() }}


<select id='custom-headers' multiple='multiple' name="rescatista_">
@foreach($rescatistas as $rescatista)   
 <option value="{{$rescatista->rescatista_id}}"> {{{$rescatista->rescatista}}}</option>                                            
 @endforeach  
</select>
@stop