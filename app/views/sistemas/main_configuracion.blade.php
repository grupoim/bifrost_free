@section('scripts')
<script type="text/javascript">	
      window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 4000);

      $.ajax("{{ action('ClienteControlador@getAll') }}")
    .success(function(data){
      $('#cliente').typeahead({
        source: data,
        display: 'nombre',
        val: 'id',
        itemSelected: function(item){
          $('#cliente_id').val(item);
        }
      });
    });

</script>
@stop
@section('module')
<?php $status=Session::pull('status');?> 
<?php $tab=Session::pull('tab');?> 
<?php $registro=Session::pull('registro'); ?> 
<div class="row">

<ul id="myTab" class="nav nav-tabs">
                      <li class= @if($tab == 'tab1' or $tab == '') "active" @else "" @endif><a href="#empresa" data-toggle="tab"><h4><strong><i class="fa fa-home"></i> Empresa</strong></h4></a></li>
                      <li class= @if($tab == 'tab2' or $registro=='edit_tab2') "active" @else "" @endif><a href="#plan" data-toggle="tab"><h4><strong><i class="fa fa-money"></i> Planes de pago</strong></h4></a></li>
                      <li class= @if($tab == 'tab3' or $registro=='edit_tab3') "active" @else "" @endif><a href="#cupon" data-toggle="tab"><h4><strong><i class="fa fa-ticket"></i> Notas de Crédito</strong></h4></a></li>                      
                    </ul>
                    <div id="myTabContent" class="tab-content">
                     
                     <!-- ************contenido pestaña empresa *************** -->
                      @include('sistemas.tabs.tab_empresa')
                     <!-- ************contenido pestaña plan de pago ***********-->
                      @include('sistemas.tabs.tab_planpago')                                          
                     <!-- ************contenido pestaña nota de credito*********-->
                      @include('sistemas.tabs.tab_notacredito')                        
                      </div>
                    </div>
 	               </div> 
@stop