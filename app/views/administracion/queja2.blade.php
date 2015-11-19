@section('module')
<div class="row">
	<!-- Chats widget -->
	@foreach($quejas as $queja)
	<div class="col-md-3">
		<!-- Widget -->
		<div class="widget">
			<!-- Widget title -->
			<div class="widget-head">
				<div class="pull-left">{{{ $queja->rubro->departamento->nombre }}} / {{{ $queja->rubro->descripcion}}}</div>
				<div class="widget-icons pull-right">
					<!--<a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> -->
					<a href="#" class="wclose"><i class="fa fa-close"></i></a>
				</div>  
				<div class="clearfix"></div>
			</div>
			<div class="widget-content">
				<!-- Widget content -->
				<!-- Below class "scroll-chat" will add nice scroll bar. It uses Slim Scroll jQuery plugin. Check custom.js for the code -->
				<div class="padd scroll-chat">
					<ul class="chats">
						<!-- Chat by us. Use the class "by-me". -->
						<li class="by-other">
							<!-- Use the class "pull-left" in avatar -->
							<div class="avatar pull-right">
								<img src="img/user.jpg" alt=""/>
							</div>
							<div class="chat-content">
								<!-- In meta area, first include "name" and then "time" -->
								<div class="chat-meta">{{ Auth::user()->persona->nombres }} <span class="pull-right">{{{ $queja->created_at }}}</span></div>
								{{{ $queja->descripcion }}}
								<div class="clearfix"></div>
							</div>
						</li>                                                          
					</ul>
				</div>
				<!-- Widget footer -->
				<div class="widget-foot">
					<div class="btn-group pull-right">
						<button class="btn btn-success">Atendida</button>
						<button class="btn btn-default">Responder</button>
					</div>
					<div class="clearfix"></div>
					<!--<div class="input-group">
						<input type="text" class="form-control">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">Enviar</button>
						</span>
					</div>-->
				</div>
			</div>
		</div> 
	</div>
	@endforeach
</div>

	<a href="#myModal" class="btn btn-info" data-toggle="modal"> Nueva Queja </a>

	@if (Session::get('mensaje'))
		<div class="alert alert-success"> {{{ Session::get('mensaje') }}}</div>
	@endif

	<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
            	<div class="modal-header">
                	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    	<h4 class="modal-title">Registrar una Queja</h4>
                </div>
                <div class="modal-body"> <!-- en action mando a llamar el Controlador@function (anteponiendo el post) -->
               		{{ Form::open(array('action' => 'QuejaControlador@postCrearQueja', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'formaqueja')) }}
						<!-- Rubros -->
                        <div class="form-group">
                        	<label class="col-lg-2 control-label"> Rubro: </label>
                            <div class="col-lg-9">
                            	<select class="form-control" id="rubro_id" name="rubro_id"> <!-- el componente tiene que tener el mismo nombre que en el modelo -->
                            		@foreach ($rubros_mtto as $rubro)
										<option value="{{{ $rubro->id }}}"> {{{ $rubro->descripcion }}} </option>
                            		@endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Descripcion -->
                        <div class="form-group">
                            <label class="col-lg-2 control-label"> Descripción: </label>
                            <div class="col-lg-9">
                                <textarea class="form-control" id="textoDescripcion" name="descripcion" rows="7" placeholder="Descripción de la Queja"></textarea>
                            </div>
                        </div> 
                	{{ Form::close() }} 
                </div>
                <div class="modal-footer">
                	<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
                </div>
            </div>
		</div>
	</div>

	<script src="{{ URL::asset('js/jquery.js') }}"> </script> <!-- jQuery -->	

	<script>
		$(document).on("ready",function() {  /* Cuando la pagina este totalmente cargada */
			$("#guardar").on("click", function() { /* Al boton guardar le asigno el evento onClick */
				$("#formaqueja").submit();
			});
		});
	</script> 

@stop

