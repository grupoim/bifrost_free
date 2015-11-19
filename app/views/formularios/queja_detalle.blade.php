@section('scripts')
<script type="text/javascript">
 /* $('#btn_no').onclick(function(){
    $('#oculto').val(3);
    $('#historial').submit();
  });

  $('#btn_si').onclick(function(){
    $('#oculto').val(2);
    $('#historial').submit();
  });
  $('#btn_send').onclick(function(){
    $('#oculto').val(1);
    $('#historial').submit();
  }); */
$(document).on("ready",function() {     
    
    $('#btn_no').on('click', function() { 
        $('#oculto').val(3);
        $('#historial').submit();
        
      });

    $("#btn_si").on("click", function() { 
        $("#oculto").val(2);
        $("#historial").submit();      
        
      });

    $("#btn_send").on("click", function() { 
        $("#oculto").val(1);
        $("#historial").submit();
        
      });

    });

      window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 4000);


</script>
@stop


@section('module')

<div class="row">
 <!-- inicio queja -->
  <div class="col-md-4">  
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                  <div  align="center"><STRONG>Queja de {{{$queja_r->rubro->departamento->nombre}}}</STRONG></div>
                  <div class="widget-icons pull-right">                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                <div class="padd">
    <h4>Rubro: <strong>{{{$queja_r->rubro->descripcion}}}</strong> </h4>
      <div class="span alert-warning alert-dismissible" role="alert" align="center" >
      
      <h4>{{{$queja_r->descripcion}}}</h4>
      @if (count($queja_r->foto) > 0)

      <div class="gallery">
                      <!-- Full size image link in anchor tag. Thumbnail link in image tag. -->
                      <a href="{{ URL::asset('img/upload/queja_file/'.$queja_r->foto) }}" class="prettyPhoto[pp_gal]">
      <img src="{{ URL::asset('img/upload/queja_file/'.$queja_r->foto) }}" width="80%" height="80%" /> <br>Clic para agrandar imagen</a>
      
      </div>
      @endif
      </div>
      </div>
      </div>
      <div class="widget-foot">
      <div> Fecha: {{{$queja_r->created_at}}} </div> 
      <div> Registro: {{{$queja_r->usuario->nombre}}}  </div>
      </div>
      </div>
      @if($errors->has('observaciones')) <div align="center" class="alert alert-danger">{{$errors->first('observaciones')}}</div> @endif      
    
    </div>
<!-- fin queja-->
 <!-- Chats widget -->
            <div class="col-md-8">
              <!-- Widget -->
              <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                  <div  align="center"><STRONG> Historial</STRONG></div>
                  <div class="widget-icons pull-right">                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <!-- Widget content -->
          <!-- Below class "scroll-chat" will add nice scroll bar. It uses Slim Scroll jQuery plugin. Check custom.js for the code -->
                  <div class="padd scroll-chat">
                    <!-- contenido chat -->
                    <ul class="chats">
                      @forelse($queja_r->QuejaSeguimiento as $historial)   
          
          <ul class="chats">                    
            <li class= @if($historial->usuario_id == $queja_r->usuario_id)"by-me" @else "by-other" @endif>
              <!-- Use the class "pull-left" in avatar -->
              <div class= @if($historial->usuario_id == $queja_r->usuario_id)"avatar pull-left" @else "avatar pull-right" @endif >
                <img src="{{ URL::asset('img/'.$historial->usuario->avatar) }}" width="50" height="52" />
              </div>
              <div class="chat-content">
                <!-- In meta area, first include "name" and then "time" -->
                <div class="chat-meta">
                @if($historial->usuario_id == $queja_r->usuario_id)
               <h5> <strong>{{{$historial->usuario->nombre}}}</strong></h5>
               <span class="pull-right">{{{$historial->created_at}}}</span>
                </div>               
                
                @else
                {{{$historial->created_at}}} 
               <span class="pull-right"> 
               <h5><strong>{{{$historial->usuario->nombre}}}</strong></span> </h5>
                </div> 
                @endif
                
                <h4>{{{$historial->observaciones}}}</h4>
                @if (count($historial->foto) > 0)
                      <a href="{{ URL::asset('img/upload/queja_seguimiento_file/'.$historial->foto) }}" class="prettyPhoto[pp_gal]">
     <span<i class="fa fa-paperclip"></i> Ver Imágen{{--<img src="{{ URL::asset('img/upload/queja_seguimiento_file/'.$historial->foto) }}" width="80%" height="80%" />--}} </a>
      
      @endif              
               <div class="clearfix"></div>
              </div>
            </li> 
          </ul>          
          @empty         

      <div class="span alert-warning alert-dismissible" role="alert" align="center">
      <H3> No hay Seguimiento a esta queja</H3> 
      </div>
    
 @endforelse                                                              
                      
                    </ul>
                    <!-- contenido chat -->

                  </div>

                  @if($queja_r->cerrada == 1)
          <a href= "{{ action('QuejaControlador@getIndex') }}" class="btn btn-primary" ><i class="fa fa-reply-all"></i>Atras</a>
          <div class="span alert-danger   alert-dismissible" role="alert" align="center">
          
      <h2><strong> Queja cerrada</strong></h2> 
    </div>

          @else
                  <!-- Widget footer -->
                  
                  <div class="widget-foot">
           {{ Form::open(array('action' => 'QuejaControlador@postSeguimiento', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'historial','files' => true)) }}        
          
          <div class="input-group">
            <input type="text" class="form-control" required placeholder="Escribe Observaciones de la queja" size="35" id="observaciones" name="observaciones" value= "">                    
            <br>
            <input type="hidden" name="queja_id" value="{{$queja_r->id}}">
            <input type="hidden" name="usuario_id" value="{{ Auth::user()->id}}"> 
          
          <span class="input-group-btn">
           
             <button type="submit" class="btn btn-sm btn-info" id="btn_send" ><i class="fa fa-check"></i> Enviar</button> 
            <button type="submit" class="btn btn-sm btn-success" id = "btn_si" title="Cerrar"><i class="fa fa-thumbs-o-up"></i></button> 
            <button type="submit" class="btn btn-sm btn-danger"id = "btn_no" title="No aplica"><i class="fa fa-thumbs-o-down" ></i></button>             
            <a href= "{{ action('QuejaControlador@getIndex') }}" class="btn btn-default btn-sm" title="Atrás"><i class="fa fa-reply-all"></i></a>
            <input type="hidden"  id="oculto" name="oculto">

     </span>   
     


      

                  </div>
                  <br>
                  {{ Form::file('foto') }}
                  {{ Form::close() }}
      @endif
                </div>


              </div> 
            </div>


           <!-- end chat widget --> 
@stop