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

//carga la lista de los extras
  $.ajax("{{ action('ReporteMensualControlador@getExtras') }}")
    .success(function(data){
      $('#extras').typeahead({
        source: data,
        display: 'nombre',
        val: 'id',
        itemSelected: function(item){
          $('.id').val(item);
        }
      });
    });


    // Cargar  la lista de vendedores
    $.ajax("{{ action('ReporteMensualControlador@getVendedores') }}")
    .success(function(data){
      $('#vendedor_id').typeahead({
        source: data,
        display: 'asesor',
        val: 'id',
        itemSelected: function(item){
          $('#asesor_id').val(item);
        }
      });
    });


    // Cargar  la lista de cartera cliente
    $.ajax("{{ action('ReporteMensualControlador@getCarteras') }}")
    .success(function(data){
      $('#cartera_id').typeahead({
        source: data,
        display: 'nombre',
        val: 'id',
        itemSelected: function(item){
          $('#id').val(item);
        }
      });
    });

    // Cargar  la lista de categoria
    $.ajax("{{ action('ReporteMensualControlador@getProductos') }}")
    .success(function(data){
      $('#categoria').typeahead({
        source: data,
        display: 'nombre',
        val: 'id',
        itemSelected: function(item){
          $('#id').val(item);
        }
      });
    });
       

    // Cargar  la lista de tipo de propiedad
    $.ajax("{{ action('ReporteMensualControlador@getTiposPropiedad') }}")
    .success(function(data){
      $('#producto').typeahead({
        source: data,
        display: 'nombre',
        val: 'id',
        itemSelected: function(item){
          $('#id').val(item);
        }
      });
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
                      <li class= @if($tab == 'tab1' or $tab == '')"active"  @else "" @endif><a href="#vendedores" data-toggle="tab"><h5><strong><i class="fa fa-users" aria-hidden="true"></i> Vendedores</strong></h5></a></li>
                      <li class= @if($tab == 'tab2' or $registro=='edit_tab2') "active" @else "" @endif><a href="#categorias" data-toggle="tab"><h5><strong><i class="fa fa-cubes"></i>  Categorias</strong></h5></a></li>
                      <li class= @if($tab == 'tab3' or $registro=='edit_tab3') "active" @else "" @endif><a href="#mtto" data-toggle="tab"><h5><strong><i class="fa fa-leaf fa-fw"></i>D.C Mantenimiento </strong></h5></a></li>
                      <li class= @if($tab == 'tab4' or $registro=='edit_tab4') "active" @else "" @endif><a href="#Pmtto" data-toggle="tab"><h5><strong><i class="fa fa-history" aria-hidden="true"></i> Periodo Mtto</strong></h5></a></li>
                      <li class= @if($tab == 'tab5' or $registro=='edit_tab5') "active" @else "" @endif><a href="#cartera" data-toggle="tab"><h5><strong><i class="fa fa-briefcase fa-fw"></i> Cartera clientes</strong></h5></a></li>
                      <li class= @if($tab == 'tab6' or $registro=='edit_tab6') "active" @else "" @endif><a href="#extra" data-toggle="tab"><h5><strong><i class="fa fa-plus-square" aria-hidden="true"></i> Extras</strong></h5></a></li>

                    </ul>
                    <div id="myTabContent" class="tab-content">                    
                     
                      @include('administracion.tabs.tab_vendedores')                    
                      @include('administracion.tabs.tab_categorias') 
                      @include('administracion.tabs.tab_dcmtto')
                      @include('administracion.tabs.tab_pmtto')
                      @include('administracion.tabs.tab_carteracliente')
                      @include('administracion.tabs.tab_extra')

                                          
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