@section('scripts')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script type="text/javascript">
$(document).on('ready', function(){ 

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
   $( "#datepicker" ).datepicker({ minDate: "-14D", maxDate: "+14D" });

 });//fin fuincion datepicker

     
$("#guardar").on("click", function() { /* Al boton guardar le asigno el evento onClick */
				$("#upload_file").submit();
			});

{{--funcion para formatear numeros --}}
        Number.prototype.formatMoney = function(c, d, t){
			var n = this, 
			    c = isNaN(c = Math.abs(c)) ? 2 : c, 
			    d = d == undefined ? "." : d, 
			    t = t == undefined ? "," : t, 
			    s = n < 0 ? "-" : "", 
			    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
			    j = (j = i.length) > 3 ? j % 3 : 0;
			   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
			 }; {{--fin function formatMoney --}}
 

});
//lanza modal para editar
$(document).on('click','.open_modal_edit',function(){

var id = $(this).val();

$.get('{{ action('ComisionControlador@detalle') }}/'+ id, function (data) {
	$('input[name=porcentaje]').val(data.porcentaje);
	//$('input[name=total_comisionable]').val(data.total_comisionable);
	$('input[name=venta_id]').val(data.venta_id);
	$('input[name=producto_id]').val(data.producto_id);
	$('textarea[name=observaciones_comision]').val(data.observaciones);

console.log(data);
            $('#id').val(data.id);
});

$('#edit_window').modal('show');


$('#edit_button').on('click', function(){
		$('#edit_form').submit();
	});


}); 
//lanza modal para advertencia
$(document).on('click','.open_modal_warning',function(){

var id = $(this).val();

$.get('{{ action('ComisionControlador@detalle') }}/'+ id, function (data) {
	
	$('input[name=venta_id]').val(data.venta_id);
	
if (data.advertencia_id) {
	
	$('input[name=estatus]').val("update");
	$('input[name=advertencia_id]').val(data.advertencia_id);
	$('textarea[name=motivos]').text(data.advertencia);

}else{
	$('input[name=estatus]').val("add");
	$('input[name=advertencia_id]').val(0);
	
}


console.log(data);
            $('#id').val(data.id);
});

$('#warning_window').modal('show');


$('#warning_button').on('click', function(){
		$('#warning_form').submit();
	});


});
//lanza modal de detalles
$(document).on('click','.open_modal',function(){

        
		{{--llamada ajax para traer los valores en json desde el controlador --}}
		var id = $(this).val();

        $.get('{{ action('ComisionControlador@detalle') }}/' + id, function (data) {
            {{--success data --}}
            console.log(data);
            $('#id').val(data.id);
           
            {{--accede a los abonos de cada comision y los manda en consola  --}}
           $.each(data.vistaabonocomisionperiodo, function(index, val) {
           	 console.log(val.periodo_comision_id);
           });
            
                  /* $('#span_pagos').text(data.producto);*/
   

           {{--para determinar el tipo de producto que se vendió --}}
           if (data.nombre_corto == 'V') {
           	$("#tipo_venta").text("contrato");
           } else if(data.nombre_corto == 'O') {
           	$("#tipo_venta").text("Paquete");
           } else if(data.nombre_corto == 'R') {
           	$("#tipo_venta").text("Recubrimiento");
           }

           
           	 {{--si la comision no trae abonos, envía un ,mensaje en blanco en el div donde deberia de estar la tabla --}}
           if (data.pagado == 0) {
           	$("#contenido").html("<h5><strong> <i class="+"fa fa-exclamation-triangle" +"aria-hidden="+"true"+"></i> No se han dado pagos de mensualidad a esta comisión <i class="+"fa fa-exclamation-triangle"+" aria-hidden="+"true"+"></i></strong></h5>"
                     );
           {{--manda la tabla con los resultados --}}
           }else {

           			 

           			{{--crear una variable para darle salida a la tabla --}}
           			 var output =  " ";
           			 
            
            
            {{--crear los encabezados de la tabla --}}
           output+=  "<table class="+"table table-condensed"+">"+
						    "<thead>"+
						      "<tr>"+
						        "<th class="+"text-center"+">Id Comision</th>"+
						        "<th class="+"text-center"+">Folio comisión</th>"+
						        "<th class="+"text-center"+">Pago</th>"+
						        "<th class="+"text-center"+">Fecha</th>"+
						      "</tr>"+
						    "</thead>"+
						    "<tbody>" +						     
								
								"</tr> ";
		  {{--recorre los abonos y crea un renglon para la tabla y los va añadiendo a la variable output --}}
		  $.each(data.vistaabonocomisionperiodo, function(userkey, uservalue) {

		  

            	 output += '<tr>';
            	 output += '<td>' + '<a href='+ "/comision/abonos/"+ uservalue.periodo_comision_id +'>'+ uservalue.periodo_comision_id + ' </a> </td>';
            	 output += '<td>' + uservalue.folio_comision + '</td>';
            	 output += '<td> $' + uservalue.monto.formatMoney(2, '.', ',') + '</td>';
            	 output += '<td>' + uservalue.fecha_inicio +' al '+ uservalue.fecha_fin + '</td>';
            	 output += '</tr>';
            	 
            	 
            });
		  {{--al terminar el recorrido de los valores, pongo  el cierre del body de la tabla y el cierre de la tabla y lo agrego a la variabel output --}}
		  output +=  "</tbody>"+ "</table> ";
       	
       	{{--asigno el contenido de output al div donde mostraré la tabla si la comision trae abonos--}}
       	$("#contenido").html(output);


           }{{--termina la condicionante else para determinar si hay pagos en la comision --}}

           
           {{--si la comision viene con observaciones se lo asigno al elemento que contiene las observaciones --}}
           if (data.observaciones == null) {
          		$('#observaciones').text(" ");
           }else{ {{-- si está vacio el campo de observaciones mando una cadena vacía en el elemento --}}
           			$('#observaciones').text("*Nota: "+ data.observaciones);
           }

            
               {{--asigno los valores de tipo texto a cada elemento segun su id en la ventana modal, --}}
               $('#vendedor').text(data.vendedor);
               $('#cliente').text(data.cliente);
               $('#producto').text(data.producto);
               $('#folio').text(data.folio_solicitud);
               $('#venta_id').text(data.venta_id);
               $('#porcentaje').text(data.porcentaje + "%");
               

               $('#pagado').text("$"+ (data.pagado).formatMoney(2, '.', ','));
               $('#total').text("$"+(data.total).formatMoney(2, '.', ','));
	           $('#total_comisionable').text("$"+(data.total_comisionable).formatMoney(2, '.', ','));
	           $('#por_pagar').text("$"+(data.por_pagar).formatMoney(2, '.', ','));
	           
	           $('#btn-save').text("update");
	           $('#abonos_window').modal('show');  
                                
        }) 

     

    });	

</script>
@stop()

@section('module')
<div class=""><div class="clearfix"></div>
	
	@foreach($promotorias as $promotoria)
	{{ Form::open(array('action' => 'ComisionControlador@postPorcentaje', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'abono')) }}
	<div class="col-md-4">
                        <div  class="alert alert-success  text-center">
                          <h4><i class="fa fa-users"></i> {{{$promotoria->promotor}}} </h4>
							<h4><strong>{{{$mes}}} {{{$year}}},</strong> 
							
								@foreach($porcentajes_comision as $porcentaje)
								@if($promotoria->promotor == $porcentaje->promotor)
								
									<strong> {{{$porcentaje->porcentaje}}} %</strong> </h4>
																
								 @endif
								 <select name="esquema_comision_id" id="inputPorcentaje" class="form-control" required="required">
								 		<option value="">--Edita porcentaje de comision--</option>
								 		@foreach($esquemas as $esquema)
											<option value="{{{$esquema->id}}}">{{{$esquema->porcentaje}}}</option>
								 		@endforeach
								 		
								 </select>
								 <input type="hidden" value="{{{$promotoria->promotor}}}" name="promotor">
                      			 <br>
						
						<button type="submit"  title="Envía el reporte a cada promotor/Asesor"class="btn  btn-xs btn-default" ><i class="fa fa-retweet" aria-hidden="true"></i> cambiar</button> 
						
                       
                        </div>
                      </div>
	@endforeach
        <div class="clearfix"></div>
	<div class="well">

		<p class="lead text-right">
			Total por pagar: <strong>$ {{{ $total }}}</strong>

				

		</p>
	</div>
</div>

<div class="widget">
	<div class="widget-head">
		<div class="pull-left">Comisiones pendientes</div>
		<div class="pull-right">
		<a href="#myModal" class="btn btn-primary" data-toggle="modal"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Sube Archivo </a>
		<a href="{{action('ComisionControlador@getPeriodos')}}" class="btn btn-success" data-toggle="modal"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Periodos </a>
		</div>  
		<div class="clearfix"></div>
	</div>
	<div class="widget-content">
		<div class="padd">
		
			{{--@if(count($comisiones) > 0) --}}
			<!-- Table Page -->
			<div class="page-tables">
				<!-- Table -->
				<div class="table-responsive">
					<table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
						<thead>
							<tr>
								<th class="text-center">ID</th>
								{{--<th>Producto</th>--}}
								{{--<th class="text-center">Folio</th>--}}
								<th class="text-center col-md-2">Cliente</th>
								<th class="text-center col-md-2">Asesor</th>
								<th class="text-center">Venta</th>
								<th class="text-center">Comisión</th>
								<th class="text-center">Pagado</th>
								<th class="text-center">Resto</th>
								<th class="text-center">%</th>
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($comisiones as $comision)

							<tr>
								<td class="text-center">{{{$comision->id}}}</td>
								{{--<td class="text-center">{{{$comision->folio_solicitud}}}-{{{$comision->nombre_corto}}}</td>--}}
								{{--<td> {{{$comision->producto}}}</td>--}}
								<td title="{{{$comision->id}}}">{{{ $comision->cliente }}}
								</td>
								<td><strong>{{{ $comision->vendedor }}}</strong></td>
								<td class="text-right">$  {{{ number_format($comision->total, 0, ".", ",") }}}</td>
								<td class="text-right">$ {{{ number_format($comision->total_comisionable, 0, ".", "," ) }}}</td>
								<td class="text-right">$ {{{ number_format($comision->pagado, 0, ".", ",") }}}</td>
								<td class="text-right">$ {{{ number_format($comision->total_comisionable - $comision->pagado, 0, ".", ",")  }}}</td>
								<td class="text-right">{{{ $comision->porcentaje}}}%</td>
								
								<td class="text-left">
									
									<button class="btn btn-xs btn-default open_modal"  title="Ver detalles de pagos" value="{{$comision->id}}"><i class="fa fa-search"></i></button>
									
									{{--<button data-quote="{{ $comision->id }}"  data-post="{{ action('ComisionControlador@detalle', [$comision->id]) }}" class="btn btn-success btn-xs send-provider"><i class="fa fa-send"></i></button>--}}
									{{--<a href="{{action('ComisionControlador@getPago', $comision->id)}}" name="id" value="{{{$comision->comision_id}}}"  title="Ver detalles de pagos" class="btn btn-xs btn-default"><i class="fa fa-search"></i></a>--}}
									{{--<a href="#{{{$comision->id}}}" data-toggle="modal"  class="btn btn-xs btn-default" rel="#modal-form" ><i class="fa fa-search"></i></a>--}}
									@if($comision->pagada == 0)
										<button class="btn btn-xs btn-default open_modal_edit"  title="Modificar porcentaje de comision" value="{{$comision->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></i></button>
										
									@if($comision->advertencia <> '0')
										<button class="btn btn-xs btn-default open_modal_warning btn-danger"  title="Quitar advertencia {{{$comision->advertencia}}}" value="{{$comision->id}}"><i class="fa fa-reply" aria-hidden="true"></i></button>
									@else
										<button class="btn btn-xs btn-default open_modal_warning"  title="Agregar advertencia" value="{{$comision->id}}"><i class="fa fa-clock-o" aria-hidden="true"></i></button>
									@endif	

										<a href="{{action('ComisionControlador@getPagada', $comision->id)}}" name="id" value="{{{$comision->id}}}"  title="pagar" class="btn btn-xs btn-default"><i class="fa fa-shopping-cart"></i></a>
									@endif
									
									@if($comision->pagada == 0)
									<span class="label label-warning">Activa</span></td>												


												@else												
												<span class="label label-success">Pagada</span></td>
												
												@endif															
								</td>
								


  				

							@endforeach
						</tbody>
					</table>
					<div class="clearfix"></div>
				</div>
			</div>
			{{--@else
			<div class="text-center">No hay comisiones pendientes</div>
			@endif --}}
		</div>
	</div>


	<div class="widget-foot">
		<div class="pull-right">
			<div class="btn-group">
				<button class="btn btn-danger">Cancelar</button>
				<button class="btn btn-primary">Pagar</button>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>


<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
            	<div class="modal-header">
                	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    	<h4 class="modal-title"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Agregar un archivo excel</h4>
                </div>
                <div class="modal-body"> <!-- en action mando a llamar el Controlador@function (anteponiendo el post) -->
               		<!-- contenido modal -->
{{ Form::open(array('action' => 'ComisionControlador@postArchivo', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'upload_file','files' => true )) }}
					
				
 <div class="form-group">
                                  <label class="col-lg-3 control-label">Fecha Inicio</label>
                                  <div class="col-lg-6">
                                   @if($errors->has('fecha')) 


                                   <div align="center" class="alert alert-danger alerta">{{$errors->first('fecha')}}</div> @endif
                                     <p> <input type="text" id="datepicker" name="fecha_inicio"></p>   
                                  </div>
                      </div>      
	         	 <div class="form-group">
	            <label class="col-lg-3 control-label">Archivo</label>
	            <div class="col-lg-6"> 
	            	<span class="btn btn-info btn-file">
                            <i class="fa fa-upload" aria-hidden="true"></i> Examinar... <input type="file" name="archivo">
                        </span> 	
                        <span class="feedback"></span>             
	         	</div>
	         	</div>	

               		<!-- contenido modal -->
                </div>
                <div class="modal-footer">
                	<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
                </div>
            </div>
		</div>
	</div>
  {{ Form::close() }}
  
</div>


<!--/*////////////////////////////////--> 
<div class="modal fade" id="abonos_window">
	<div class="modal-dialog">
		<div class="modal-content">
			
		<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><strong> Detalles de la comision </strong></h4>
			</div>
			<div class="modal-body">
              <!-- User widget -->
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left"><i><p>Cliente(a)</p></i><h3><strong><span id="cliente"></span></strong> </h3>
					
                  </div>
                  <div class="pull-right"><i><p>Vendedor(a)</p></i>
                   <strong><span id = "vendedor"></span> </strong>
                   
                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">

                   <!-- tabla de inventario--> 
                   <div class="col-md-3">
                        <div  class="alert alert-info  text-center">
                          <h5><i class="fa fa-database"></i> Venta <strong><span id = "total"></span></strong></h5>

                        </div>
                      </div>

                      
                      <div class="col-md-3">
                        <div class="alert alert-info text-center">
                          <h5> <i class="fa fa-money"></i> Comision <strong><span id= "total_comisionable"></span></strong></h5>                                                  
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="alert alert-success text-center" >
                          <h5> <i class="fa fa-cubes"></i> Pagado <strong><span id = "pagado"></span></strong></h5>                                                  
                        </div>
                      </div>

                    <div class="col-md-3">
                        <div  class="alert alert-danger text-center">
                          <h5> <i class="fa fa-exchange"></i> Resto <strong> <span id = "por_pagar"></span></strong> </h4>                                                  
                        </div>
                      </div>


          <!-- tabla de inventario -->
                    <div class="clearfix"></div>
                  </div> <!-- end pad-->
                  <div class="widget-foot">
                  <div class="p-meta" align="center">
                   <h2><span id= "producto"></span></h2>
  <p>Venta de <strong><span id= "tipo_venta"></span> </strong> Folio <strong> <span id="folio"></span></strong> ID <strong> <span id="venta_id"></span></strong> Comisión calculada al <strong><span id="porcentaje"></span></strong></p>
                
               
                <div class="text-center" id="divTabla"> </div> 
                <div class="text-center" id="contenido"></div>                  

                  <strong><span id= "observaciones"></span></strong>
                    <!-- Footer goes here --> 
                 
                 </div>
                  </div>
                </div>
              </div>  

		</div>
	</div>
</div>


{{-- modal para editar comision --}}
 <div class="modal fade" id="edit_window">
 	<div class="modal-dialog">
 		<div class="modal-content">
 			<div class="modal-header">
 				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
 				<h4 class="modal-title">Modificar porcentaje de comisión</h4>
 			</div>
 			<div class="modal-body"> 				
{{ Form::open(array('action' => 'ComisionControlador@postEditcomision', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'edit_form')) }}
<div class="form-group">
	<label for="sector" class="col-md-3 control-label">Porcentaje </label>
	<div class="col-md-9">
			     
		<input type="number" step="any"class="form-control" placeholder="12%" id="porcentaje"  name="porcentaje" required>
	</div>
</div>

{{-- <div class="form-group">
	<label for="sector" class="col-md-3 control-label">Comision </label>
	<div class="col-md-9">
	        
      	<input type="number" step="any"class="form-control" placeholder="$0.0" name="total_comisionable" required>     
		
	</div>
</div>  --}}

<div class="form-group">
	<label for="sector" class="col-md-3 control-label">Observaciones </label>
	<div class="col-md-9">
	        
      	<textarea class="form-control" id = "observaciones_comision" name="observaciones_comision"></textarea>
      	<input type="hidden" id="producto_id" name="producto_id" value="">
      	<input type="hidden" id="venta_id" name="venta_id" value="">

		
	</div>
</div>

{{ Form::close() }}
 			</div>
 			<div class="modal-footer">
 				<button type="button" class="btn btn-default"  data-dismiss="modal">Cerrar</button>
 				<button type="sumbmit" class="btn btn-primary" id="edit_button"><i class="fa fa-floppy-o" aria-hidden="true"></i>Guardar</button>
 			</div>
 		</div>
 	</div>
 </div>


<div class="modal fade" id="warning_window">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Añadir una advertencia a la comision</h4>
			</div>
			<div class="modal-body">
				{{ Form::open(array('action' => 'ComisionControlador@postWarning', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'warning_form')) }}


					<div class="alert alert-warning text-center" >
                          <h5><strong> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <strong> Esta comision mostrará una advertencia en cada pago futuro </strong></h5>                                                  
                        </div>

<div class="form-group">
	<label for="sector" class="col-md-3 control-label">Motivos </label>
	<div class="col-md-9">
	        
      	<textarea class="form-control" id = "motivos" name="motivos" value = ""></textarea>      	
      	<input type="hidden" id="venta_id" name="venta_id" value="">
      	<input type="hidden" id="estatus" name="estatus" value="">
      	<input type="hidden" id="advertencia_id" name="advertencia_id" value="">
		
	</div>
</div>

{{ Form::close() }}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button"  id="warning_button" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>Guardar</button>
			</div>
		</div>
	</div>
</div>

{{-- fin modal editar comision --}}
	<!--/////////////////////////////-->
	{{--@foreach($comisiones as $comision)
	<!--Ventanas modales -->
					@include('formularios.pago_comision', 
					array('modalId' => $comision->id,
					'modalTitle' =>  'Historial de pagos de comisión',
					'modalOk' => 'Agregar',					
					'modalIcon' => 'search',
					'cliente' => $comision,
					'modalCancel' => 'Cancelar'))
					<!-- fin ventanas modales -->
	@endforeach--}}

@stop