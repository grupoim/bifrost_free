
@section('module')
<div class="row">
	<div class="col-md-12">
		{{ Form::open(array('action' => 'MantenimientoControlador@postRenovar', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'capture')) }}
		<div class="col-md-12 col-md-offset-1">
			<input type="hidden" name="cliente_id" value="{{{ $mtto_r->venta_mantenimiento_id }}}">
			{{{$status}}}
			<h3>{{{ $mtto_r->cliente }}} </h3>
			<h4> Ubicación:<strong>{{{$mtto_r->ubicacion}}} </strong></h4>
			
		</div>
		<div class="clearfix"></div>
		<br>
		
		<div class="form-group">
			<label for="asesor" class="col-md-2 control-label">Asesor</label>
			<div class="col-md-6">
				<div class="input-group">
					<input type="text" id="asesor" class="form-control" autocomplete="off" placeholder="Buscar por nombre">
					<input type="hidden" name="asesor_id" id="asesor_id">
					<span class="input-group-addon">
						<input name="directa" id="directa" type="checkbox" aria-label="Venta directa"> Venta directa
					</span>
				</div>
			</div>
		</div>
		<div class="form-group">
                                  <label class="col-lg-2 control-label">Periodo</label>
                                  <div class="col-lg-8">
                                  <div class="input-group">                   

                                <select class="form-control" name="rubro_id">
									
									<optgroup label= "{{{$mtto_r->descripcion}}}" >
									@foreach($meses as $mes)									
									<option value="{{{$mes->producto_id}}}">{{{$mes->meses}}}</option>
									@endforeach
									</optgroup>
									</select>

					        </div>
                                          

                                    </div>
                                </div>
		
		{{ Form::close() }}
	</div>
</div>

@stop