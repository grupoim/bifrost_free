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

// buscadores de multi select
$('.searchable').multiSelect({
  selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='Buscar...'>",
  selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='Buscar...'>",
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

 
<div class="widget">
	<div class="widget-head">
		<div class="pull-left"> @if($db->base_datos_produccion == 0)<h2><span class="label label-danger">  Advertencia, estas en la base de datos de pruebas  </span> </h2> @endif Cotizaciones activas</div>
		<div class="pull-right">
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



@stop