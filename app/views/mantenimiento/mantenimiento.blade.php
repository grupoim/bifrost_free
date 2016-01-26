@section('scripts')
<script src="{{ URL::asset('js/jquery.growl.js') }}" ></script>
<link rel="stylesheet" href="{{ URL::asset('css/jquery.growl.css') }}"> 

<script type="text/javascript">
$(document).on('ready', function(){


	$('#data-table').dataTable();
/* === MODALS === */
		$( document ).on('click', '.solsoShowModal', function(){
			modalTitle = $(this).attr('data-modal-title')
			
			$.ajax({
				url: $(this).attr('data-href'),
				dataType: 'html',
				success:function(data) {
					$('.solsoModalTitle').text(modalTitle.toString());
					$('.solsoShowForm').html(data);
				}
			});		
		});
		
		$( document ).on('click', '.solsoSave', function(e){
			e.preventDefault();
			
			var solsoSelector	= $(this);
			var solsoFormAction = $('.solsoForm').attr('action');
			var solsoFormMethod = $('.solsoForm').attr('method');
			var solsoFormData	= $('.solsoForm').serialize();
			
			$.ajax({
				url: 	solsoFormAction,
				type: 	solsoFormMethod,
				data: 	solsoFormData,
				cache: 	false,
				dataType: 'html',
				success:function(data) {
					if (data == 0 ) {
						console.log('error');
					} else {
						
						if ($(data).filter('table.solsoRefresh').length == 1) {
							$('#solsoCrudModal').modal('hide');
														
							$.growl.notice({ title: solsoSelector.attr('data-message-title'), message: solsoSelector.attr('data-message-success') });
						} else {
							$('.solsoShowForm').html(data);
							$.growl.error({ title: solsoSelector.attr('data-message-title'), message: solsoSelector.attr('data-message-error') });
						}
						
						$('#data-table').dataTable();

					}
				}
			});	
			
			return false;
		});				
		
		$( document ).on('click', '.solsoConfirm', function(){
			$("#solsoDeletForm").prop('action', $(this).attr('data-href'));
		});
		
		$( document ).on('click', '.solsoDelete', function(e){
			e.preventDefault();
			
			var solsoSelector	= $(this);
			var solsoFormAction = $('#solsoDeletForm').attr('action');
			
			$.ajax({
				url: 	solsoFormAction,
				type: 	'delete',
				cache: 	false,
				dataType: 'html',
				success:function(data) {
					$('#solsoDeleteModal').modal('hide');
					$('#ajaxTable').html(data);
					$('#countClients').text( $('.solsoTable').attr('data-all') );
					$.growl.notice({ title: solsoSelector.attr('data-message-title'), message: solsoSelector.attr('data-message-success') });
					$('#data-table').dataTable();
				}
			});	
			
			return false;
		});		
		/* === END MODALS === */

});
</script>
  <script type="text/javascript">
    /**
     * Funcion que se ejecuta cada vez que se añade una letra en un cuadro de texto
     * Suma los valores de los cuadros de texto
     */
    function sumar()
    {
        var valor1=verificar("valor1");
        var valor2=verificar("valor2");
        var valor3=verificar("valor3");
        var valor4=verificar("valor4");
        // realizamos la suma de los valores y los ponemos en la casilla del
        // formulario que contiene el total
        document.getElementById("total").value=parseFloat(valor1)+parseFloat(valor2)+parseFloat(valor3)+parseFloat(valor4);
    }
 
    /**
     * Funcion para verificar los valores de los cuadros de texto. Si no es un
     * valor numerico, cambia de color el borde del cuadro de texto
     */
    function verificar(id)
    {
        var obj=document.getElementById(id);
        if(obj.value=="")
            value="0";
        else
            value=obj.value;
        if(validate_importe(value,1))
        {
            // marcamos como erroneo
            obj.style.borderColor="#808080";
            return value;
        }else{
            // marcamos como erroneo
            obj.style.borderColor="#f00";
            return 0;
        }
    }
 
    /**
     * Funcion para validar el importe
     * Tiene que recibir:
     *  El valor del importe (Ej. document.formName.operator)
     *  Determina si permite o no decimales [1-si|0-no]
     * Devuelve:
     *  true-Todo correcto
     *  false-Incorrecto
     */
    function validate_importe(value,decimal)
    {
        if(decimal==undefined)
            decimal=0;
 
        if(decimal==1)
        {
            // Permite decimales tanto por . como por ,
            var patron=new RegExp("^[0-9]+((,|\.)[0-9]{1,2})?$");
        }else{
            // Numero entero normal
            var patron=new RegExp("^([0-9])*$")
        }
 
        if(value && value.search(patron)==0)
        {
            return true;
        }
        return false;
    }
    </script>
    <style>
    
    #total  {font-weight:bold;}
   
    </style>

@stop
@section('module')
 
<div class="row">
	<div class="col-md-12">
		<div class="widget">
			<div class="widget-head">
				<div class="pull-left"></div>
				<div class="btn-group pull-right">
				<a href="#myModal" class="btn btn-info " data-toggle="modal"><i class="fa fa-leaf "></i> Nuevo</a>
				</div>  
				<div class="clearfix"></div>
			</div>
			<div class="widget-content">
				<div class="padd">
					 <div class="row">

                      <div class="col-md-4">
                        <div class="well">
                          <h2><i class="fa fa-leaf"></i> {{{$cesped}}} Metros de césped</h2>
                          <p> Requerido para plantación en mantenimientos nuevos y renovados</p> 
                          <div align="center">@if($cesped > 1) <a href= "#"class="btn btn-xs btn-success">
                        <i class="fa fa-check-square-o"></i> Generar pedido</a> <a href= "#')}}"class="btn btn-xs btn-info">
                       <i class="fa fa-folder-open"></i> Detalles</a>
                        @endif</div>
                        
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="well">
                          <h2> <i class="fa fa-thumbs-up"></i> {{{$nuevos}}} Mttos. Nuevos</h2>
                          <p>Actualmente hay {{{$nuevos}}} mantenimientos nuevos contratados y {{{$renovados}}} mantenimientos renovados, da clic abajo para ver mas detalles </p>
                          <div align="center"> <a href= "#"class="btn btn-xs btn-warning">
                        <i class="fa fa-bar-chart"></i> Estadisticos</a>
                        </div>                        
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="well">
                          <h2><i class="fa fa-money"></i> Ingresos $23232</h2>
                          <p>Recaudado a lo largo del día de hoy sdjfsdfusdnf uhishdfshdf huihsdfhulsdf</p>
                           <div align="center"> <a href= "#"class="btn btn-xs btn-info">
                        <i class="fa fa-search"></i> Detalles</a>
   							<a href= "#"class="btn btn-xs btn-warning">                    
                        <i class="fa fa-history"></i> Corte</a>
                        </div>
                        </div>
                      </div>

                    </div>
					
					<!-- Table Page -->
					<div class="page-tables">
						<!-- Table -->
						<div class="table-responsive" id="ajaxTable" >
							@include('mantenimiento.table')
							<div class="clearfix"></div>
						</div>
					</div>
					</div>
				
			</div>
			<div class="widget-foot">
				<!-- Footer goes here -->
			</div>
		</div>
	</div>  
</div>
@include('_assets.modals.modal-crud')
@include('_assets.modals.modal-delete')
@stop