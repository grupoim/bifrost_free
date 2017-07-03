@section('scripts')
<script src="{{ URL::asset('js/chosen.jquery.js') }}"> </script>
<script src="{{ URL::asset('js/prism.js') }}"></script>

<script type="text/javascript"> 
      
$(document).on('ready', function(){

 $(".productos").chosen({   
    no_results_text: "No hay resultados para:",    
    'placeholder_text_multiple':'Da clic para escoger productos...',
    width: "365px"
  });


  $("#btn_send").on("click", function() { 
        $("#oculto").val(1);
        $("#capture").submit();
        
      });

  //select de mantenimiento
  var elem = document.getElementById('div_3m'),      
    checkBox = document.getElementById('check_3m');
checkBox.checked = false;
checkBox.onchange = function() {
    elem.style.display = this.checked ? 'block' : 'none';    
};
checkBox.onchange();

var elem2 = document.getElementById('div_6m'),      
    checkBox = document.getElementById('check_6m');
checkBox.checked = false;
checkBox.onchange = function() {
    elem2.style.display = this.checked ? 'block' : 'none';    
};
checkBox.onchange();

var elem3 = document.getElementById('div_12m'),      
    checkBox = document.getElementById('check_12m');
checkBox.checked = false;
checkBox.onchange = function() {
    elem3.style.display = this.checked ? 'block' : 'none';    
};
checkBox.onchange();
//fin select mantenimiento

      window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 4000);

      $.ajax("{{ action('ProductoControlador@getSectoresall') }}")
    .success(function(data){
      $('#sector').typeahead({
        source: data,
        display: 'nombre',
        val: 'id',
        itemSelected: function(item){
          $('#sector_id').val(item);
        }
      });
    });

     $.ajax("{{ action('ProductoControlador@getSectoresall') }}")
    .success(function(data){
      $('#sector_recinto').typeahead({
        source: data,
        display: 'nombre',
        val: 'id',
        itemSelected: function(item){
          $('#sector_recinto_id').val(item);
        }
      });
    });

    $.ajax("{{ action('ProductoControlador@getSectoresnicho') }}")
    .success(function(data){
      $('#recinto').typeahead({
        source: data,
        display: 'product_name',
        val: 'recinto_id',
        itemSelected: function(item){
          $('#recinto_id').val(item);
        }
      });
    });

        $.ajax("{{ action('ProductoControlador@getProductos') }}")
    .success(function(data){
      $('#producto').typeahead({
        source: data,
        display: 'nombre',
        val: 'nombre',
        itemSelected: function(item){
          $('#nombre').val(item);
        }
      });
    });

     $.ajax("{{ action('ProductoControlador@getProductos') }}")
    .success(function(data){
      $('#producto2').typeahead({
        source: data,
        display: 'nombre',
        val: 'nombre',
        itemSelected: function(item){
          $('#nombre').val(item);
        }
      });
    });

        $.ajax("{{ action('ProductoControlador@getProveedor') }}")
    .success(function(data){
      $('#proveedor_id').typeahead({
        source: data,
        display: 'nombre',
        val: 'id',
        itemSelected: function(item){
          $('#id').val(item);
        }
      });
    });;

    $("#div_combo").hide();

    $("#r1").click(function () {
        $("#div_combo").show();

    });
       $("#r2").click(function () {
        $("#div_combo").hide();

    });

    });
 var arrayValores= $.ajax("{{ action('ProductoControlador@getConstrucciones') }}");
        
  
</script>
@stop
@section('module')
<?php $status=Session::pull('status');?> 
<?php $tab=Session::pull('tab');?> 
<?php $registro=Session::pull('registro'); ?> 
<div class="row">

<ul id="myTab" class="nav nav-tabs">
                      <li class= @if($tab == 'tab1' or $tab == '')"active"  @else "" @endif><a href="#terreno-nicho" data-toggle="tab"><h5><strong><i class="fa fa-map-marker fa-fw"></i> Terreno/Nicho</strong></h5></a></li>
                      <li class= @if($tab == 'tab2' or $registro=='edit_tab2') "active" @else "" @endif><a href="#mtto" data-toggle="tab"><h5><strong><i class="fa fa-leaf fa-fw"></i> Mantenimiento</strong></h5></a></li>
                      <li class= @if($tab == 'tab3' or $registro=='edit_tab3') "active" @else "" @endif><a href="#paquete" data-toggle="tab"><h5><strong><i class="fa fa-cubes"></i> Productos y paquetes</strong></h5></a></li>
                      <li class= @if($tab == 'tab4' or $registro=='edit_tab4') "active" @else "" @endif><a href="#servicio" data-toggle="tab"><h5><strong><i class="fa fa-hospital-o fa-fw"></i> Servicio Funeral</strong></h5></a></li>
                      <li class= @if($tab == 'tab5' or $registro=='edit_tab5') "active" @else "" @endif><a href="#tramite" data-toggle="tab"><h5><strong><i class="fa fa-briefcase fa-fw"></i> Trámite</strong></h5></a></li>
                      <li class= @if($tab == 'tab6' or $registro=='edit_tab6') "active" @else "" @endif><a href="#inhumacion" data-toggle="tab"><h5><strong><i class="fa fa-arrow-circle-down fa-fw"></i> Inhumación</strong></h5></a></li>
                      <li class= @if($tab == 'tab7' or $registro=='edit_tab7') "active" @else "" @endif><a href="#exhumacion" data-toggle="tab"><h5><strong><i class="fa fa-arrow-circle-up fa-fw"></i> Exhumación</strong></h5></a></li>
                      <li class= @if($tab == 'tab8' or $registro=='edit_tab8') "active" @else "" @endif><a href="#extra" data-toggle="tab"><h5><strong><i class="fa fa-cart-plus fa-fw"></i> Extra</strong></h5></a></li>
                      <li class= @if($tab == 'tab9' or $registro=='edit_tab9') "active" @else "" @endif><a href="#cafeteria" data-toggle="tab"><h5><strong><i class="fa fa-cutlery"></i> Cafeteria</strong></h5></a></li>

                    </ul>
                    <div id="myTabContent" class="tab-content">
                     
                     
                      @include('sistemas.tabs.tab_terreno_nicho')                    
                      @include('sistemas.tabs.tab_mtto')  
                      @include('sistemas.tabs.tab_paquete')
                      @include('sistemas.tabs.tab_cafeteria')

                                          
                      </div>
                    </div>
            
@stop