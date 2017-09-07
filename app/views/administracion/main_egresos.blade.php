@section('scripts')
<script src="{{ URL::asset('js/chosen.jquery.js') }}"> </script>
<script src="{{ URL::asset('js/prism.js') }}"></script>

<script type="text/javascript"> 
      
$(document).on('ready', function(){

      window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 4000);
 $(".ventas").chosen({   
    no_results_text: "No hay resultados para:",    
    'placeholder_text_multiple':'Da clic para escoger productos...',
    width: "277px"
  });



      $(document).ready(function (e) {
  $('#Edit').on('show.bs.modal', function(e) {    
     var id = $(e.relatedTarget).data().id;
      $(e.currentTarget).find('#Edit').val(id);

  });
});

        // Cargar  la lista sueldo e impuestos
  $.ajax("{{ action('ReporteMensualControlador@getSueldos') }}")
    .success(function(data){
      $('#sueldo_impuesto').typeahead({
        source: data,
        display: 'nombre',
        val: 'id',
        itemSelected: function(item){
          $('.id').val(item);
        }
      });
    });
      // Cargar  la lista gastos admon
  $.ajax("{{ action('ReporteMensualControlador@getAdmon') }}")
    .success(function(data){
      $('#gasto_admon').typeahead({
        source: data,
        display: 'nombre',
        val: 'id',
        itemSelected: function(item){
          $('.id').val(item);
        }
      });
    });
          // Cargar  la lista gastos operacion
  $.ajax("{{ action('ReporteMensualControlador@getOperacion') }}")
    .success(function(data){
      $('#gasto_operacion').typeahead({
        source: data,
        display: 'nombre',
        val: 'id',
        itemSelected: function(item){
          $('.id').val(item);
        }
      });
    });
              // Cargar  la lista gastos mttp capilla
  $.ajax("{{ action('ReporteMensualControlador@getMttoCapilla') }}")
    .success(function(data){
      $('#gasto_mtto_capilla').typeahead({
        source: data,
        display: 'nombre',
        val: 'id',
        itemSelected: function(item){
          $('.id').val(item);
        }
      });
    });
              // Cargar  la lista gastos constr capilla
  $.ajax("{{ action('ReporteMensualControlador@getContCapilla') }}")
    .success(function(data){
      $('#gasto_cont_capilla').typeahead({
        source: data,
        display: 'nombre',
        val: 'id',
        itemSelected: function(item){
          $('.id').val(item);
        }
      });
    });
              // Cargar  la lista gastos corporativo
  $.ajax("{{ action('ReporteMensualControlador@getCorp') }}")
    .success(function(data){
      $('#gasto_corp').typeahead({
        source: data,
        display: 'nombre',
        val: 'id',
        itemSelected: function(item){
          $('.id').val(item);
        }
      });
    });
$("#div_monto").show();
$("#div_sueldo_impuesto").hide();
$("#div_gasto_admon").hide();
$("#div_gasto_operacion").hide();
$("#div_gasto_mtto_capilla").hide();
$("#div_gasto_const_capilla").hide();
$("#div_corp").hide();
$("#div_sueldo_impuesto2").hide();
$("#div_gasto_admon2").hide();
$("#div_gasto_operacion2").hide();
$("#div_gasto_mtto_capilla2").hide();
$("#div_gasto_const_capilla2").hide();
$("#div_corp2").hide();

      $("#individual").click(function () {  
        $("#div_sueldo_impuesto").show();
        $("#div_monto").show();
        $("#div_sueldo_impuesto2").hide();
       
    });
        $("#conjunto").click(function () {  
        $("#div_sueldo_impuesto2").show();
        $("#div_sueldo_impuesto").hide();
        $("#div_monto").hide();
      

    });
          $("#individual2").click(function () {
        $("#div_gasto_admon").show();
        $("#div_monto2").show();
        $("#div_gasto_admon2").hide();
     

    });
        $("#conjunto2").click(function () {
        $("#div_gasto_admon").hide();
        $("#div_monto2").hide();
        $("#div_gasto_admon2").show();
  


    });
        $("#individual3").click(function () {
        $("#div_gasto_operacion").show();
        $("#div_monto3").show();
        $("#div_gasto_operacion2").hide();

    });
        $("#conjunto3").click(function () {
        $("#div_gasto_operacion").hide();
        $("#div_monto3").hide();
        $("#div_gasto_operacion2").show();


    });
        $("#individual4").click(function () {
        $("#div_gasto_mtto_capilla").show();
        $("#div_monto4").show();
        $("#div_gasto_mtto_capilla2").hide();
    });
        $("#conjunto4").click(function () {
        $("#div_gasto_mtto_capilla").hide();
        $("#div_monto4").hide();
        $("#div_gasto_mtto_capilla2").show();
  

    });
        $("#individual5").click(function () {
        $("#div_gasto_const_capilla").show();
        $("#div_monto5").show();
        $("#div_gasto_const_capilla2").hide();
    });
        $("#conjunto5").click(function () {
        $("#div_gasto_const_capilla").hide();
        $("#div_monto5").hide();
        $("#div_gasto_const_capilla2").show();
    });
        $("#individual6").click(function () {
        $("#div_corp").show();
        $("#div_monto6").show();
        $("#div_corp2").hide();
    });
        $("#conjunto6").click(function () {
        $("#div_corp").hide();
        $("#div_monto6").hide();
        $("#div_corp2").show();

    });
       
 }); 
function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }   
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
        
 
</script>
@stop
@section('module')
<?php $status=Session::pull('status');?> 
<?php $tab=Session::pull('tab');?> 
<?php $registro=Session::pull('registro'); ?> 
<div class="row">
   @if($status=='edit')
     <div class="alert alert-info alert-dismissible" role="alert" align="center" id="alerta">
       <strong><h4> Registro modificado correctamente</h4></strong>
     </div> 
  @endif  
<ul id="myTab" class="nav nav-tabs">
                      <li class= @if($tab == 'tab1' or $tab == '')"active"  @else "" @endif><a href="#sueldos" data-toggle="tab"><h5><strong><i class="fa fa-money" aria-hidden="true"></i> Sueldos e impuestos</strong></h5></a></li>
                      <li class= @if($tab == 'tab2' or $registro=='edit_tab2') "active" @else "" @endif><a href="#admon" data-toggle="tab"><h5><strong><i class="fa fa-university" aria-hidden="true"></i>  Administración</strong></h5></a></li>
                      <li class= @if($tab == 'tab3' or $registro=='edit_tab3') "active" @else "" @endif><a href="#operacion" data-toggle="tab"><h5><strong><i class="fa fa-wrench" aria-hidden="true"></i> Operación </strong></h5></a></li>
                      <li class= @if($tab == 'tab4' or $registro=='edit_tab4') "active" @else "" @endif><a href="#Mcapilla" data-toggle="tab"><h5><strong><i class="fa fa-paint-brush" aria-hidden="true"></i> Mtto Capilla</strong></h5></a></li>
                      <li class= @if($tab == 'tab5' or $registro=='edit_tab5') "active" @else "" @endif><a href="#Ccapilla" data-toggle="tab"><h5><strong><i class="fa fa-gavel" aria-hidden="true"></i> Construcción capilla</strong></h5></a></li>
                      <li class= @if($tab == 'tab6' or $registro=='edit_tab6') "active" @else "" @endif><a href="#corporativo" data-toggle="tab"><h5><strong><i class="fa fa-plus-square" aria-hidden="true"></i> Cargos corporativo</strong></h5></a></li>

                    </ul>
                    <div id="myTabContent" class="tab-content">
                     
                     @include('administracion.tabs.tab_sueldos') 
                     @include('administracion.tabs.tab_admon') 
                     @include('administracion.tabs.tab_operacion') 
                     @include('administracion.tabs.tab_mttocapilla') 
                     @include('administracion.tabs.tab_Constrcapilla')
                     @include('administracion.tabs.tab_cargoscorp')
                                          
                      </div>
                    </div>
                    <div id="Edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Editar montos</h4>
                </div>
                <div class="modal-body"> <!-- en action mando a llamar el Controlador@function (anteponiendo el post) -->
                  <!-- contenido modal -->

     {{ Form::open(array('action' => 'ReporteMensualControlador@postEdit', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'registro')) }}  
  
                     <input  type="hidden" id="Edit" name="id">
                     <div class="form-group">
                                  <label class="col-lg-3 control-label">Monto</label>
                                  <div class="col-lg-7">
                                   <div class="input-group">
                                     <span class="input-group-addon" >$</span> 
                                    <input type="text" class="form-control"  placeholder="Ingrese la contidad correcta" onkeypress="return valida(event)" name="monto_edit" required>                                   
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