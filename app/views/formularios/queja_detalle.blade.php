@section('scripts')
<script type="text/javascript">
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
  $(".msg_error").fadeTo(500, 0).slideUp(500, function(){
    $(this).remove();
  });
}, 4000);
</script>
@stop
@section('module')
<div class="row">
 <!-- inicio queja -->
 <div class="col-md-8">  
        @if($queja_r->cerrada == 1)
            <div class="alert alert-danger">
                La queja se encuentra cerrada.
            </div>
        @endif
  <div class="widget">
    <!-- Widget title -->
    <div class="widget-head">
      {{{$queja_r->rubro->departamento->nombre}}}
      <div class="pull-right"> 
            <a href= "{{ action('QuejaControlador@getIndex') }}" class="btn btn-primary btn-sm" title="Volver">
                <i class="fa fa-reply"></i> Volver
            </a>                 
      </div>  
      <div class="clearfix"></div>
    </div>
    <div class="widget-content">
      <div class="padd">
        <p>Categoría: <strong>{{{$queja_r->rubro->descripcion}}}</strong> 
        <span class="pull-right">
          @if (count($queja_r->foto) > 0)
          
            <a href="{{ URL::asset('img/upload/queja_file/'.$queja_r->foto) }}" class="prettyPhoto[pp_gal]">
              <i class="fa fa-image"></i> Imagen adjunta
            </a> 
          
          @endif
          </span>
        </p>
        <hr />
        <p class="lead alert">
          {{{$queja_r->descripcion}}}
        </p>
      </div>
    </div>
    <div class="widget-foot"> 
      <div> Registrada por <strong>{{{$queja_r->usuario->persona->nombres}}} {{{$queja_r->usuario->persona->apellido_paterno}}}</strong> el día {{{ $queja_r->created_at->format('d/m/Y \\a \\l\\a\\s h:i A') }}}</div>
    </div>
  </div>
</div>
</div>

@if($errors->has('observaciones')) 
<div class="row">
  <div class="col-md-8">
  <div align="center" class="alert alert-danger msg_error">{{$errors->first('observaciones')}}</div> 
  </div>
</div>
@endif      
<div class="row">
  <div class="col-md-8">
  @if(count($queja_r->QuejaSeguimiento) > 0 or $queja_r->cerrada == 0)
    <div class="widget">
      <!-- Widget title -->
      <div class="widget-head">
        <strong> Seguimiento</strong>
        <div class="widget-icons pull-right">                  
        </div>  
        <div class="clearfix"></div>
      </div>
      <!-- End head -->
      <!-- Start content -->
      <div class="widget-content">
        <div class="padd">
          <ul class="chats">
            @foreach($queja_r->QuejaSeguimiento as $historial)  
            <!-- -->
                @if($historial->usuario_id == $queja_r->usuario_id)
                    <li class="by-me">
                        <!-- Use the class "pull-left" in avatar -->
                        <div class="avatar pull-left">
                          <img src="{{ URL::asset('img/upload/usuarios/'.$historial->usuario->avatar) }}" alt="" width="52" height="52"  />
                        </div>

                        <div class="chat-content">
                          <!-- In meta area, first include "name" and then "time" -->
                          <div class="chat-meta"><strong>{{{$historial->usuario->departamento->nombre}}}: {{{$historial->usuario->persona->nombres}}}</strong> <span class="pull-right"> El {{{ $historial->created_at->format('d/m/Y \\a \\l\\a\\s h:i A') }}}</span></div>
                          <p class="lead">{{{$historial->observaciones}}}</p>
                          @if (count($historial->foto) > 0)
                            <a href="{{ URL::asset('img/upload/queja_seguimiento_file/'.$historial->foto) }}" class="prettyPhoto[pp_gal]">
                                <span>
                                    <i class="fa fa-paperclip"></i> Ver Imagen
                                <span>
                            </a>
                            @endif
                          <div class="clearfix"></div>
                        </div>
                      </li> 
                @else
                        <li class="by-other">
                        <!-- Use the class "pull-right" in avatar -->
                        <div class="avatar pull-right">
                          <img src="{{ URL::asset('img/upload/usuarios/'.$historial->usuario->avatar) }}" alt="" width="52" height="52" />
                        </div>

                        <div class="chat-content">
                          <!-- In the chat meta, first include "time" then "name" -->
                          <div class="chat-meta">El {{{ $historial->created_at->format('d/m/Y \\a \\l\\a\\s h:i A') }}} <span class="pull-right"> <strong>{{{$historial->usuario->departamento->nombre}}}: {{{$historial->usuario->persona->nombres}}}</strong> </span></div>
                          <p class="lead">{{{$historial->observaciones}}}</p>
                          @if (count($historial->foto) > 0)
                            <a href="{{ URL::asset('img/upload/queja_seguimiento_file/'.$historial->foto) }}" class="prettyPhoto[pp_gal]">
                                <span>
                                    <i class="fa fa-paperclip"></i> Ver Imagen
                                <span>
                            </a>
                            @endif
                          <div class="clearfix"></div>
                        </div>
                      </li>
                @endif
            @endforeach
          </ul>
            </div>
        </div>
        <!-- End content -->
        <!-- Widget footer -->
        <div class="widget-foot">
            @if($queja_r->cerrada != 1)
            {{ Form::open(array('action' => 'QuejaControlador@postSeguimiento', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'historial','files' => true)) }} 
                <input type="hidden" name="queja_id" value="{{$queja_r->id}}">
                <input type="hidden" name="usuario_id" value="{{ Auth::user()->id}}"> 
                <input type="hidden"  id="oculto" name="oculto">       
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Tus observaciones" size="35" id="observaciones" name="observaciones" value= "">                    
                    <span class="input-group-btn">
                        <span class="btn btn-info btn-file">
                            <i class="fa fa-photo"></i> <input type="file" name="foto">
                        </span>  
                        
                         @if(Auth::user()->id <> $queja_r->usuario_id and Auth::user()->jefe == 1 )
                        <button type="submit" class="btn btn-success" id = "btn_si" title="Cerrar">
                            <i class="fa fa-thumbs-o-up"></i>
                        </button> 
                        <button type="submit" class="btn btn-danger"id = "btn_no" title="No aplica">
                            <i class="fa fa-thumbs-o-down" ></i>
                        </button> 

                        @endif
                        <button type="submit" class="btn btn-primary" id="btn_send" >
                            <i class="fa fa-check"></i> Enviar
                        </button>           
                        <!---->
                    </span> 
                </div>
                <span class="feedback"></span>  
            {{ Form::close() }}
            @endif
        </div> <!-- End Footer -- >
     </div> <!-- End Widget -->
     @else
        <div class="alert alert-warning">
                Ésta queja no tiene seguimiento.
        </div>
     @endif
 </div> <!-- End col -->
</div> <!-- End row -->
@stop