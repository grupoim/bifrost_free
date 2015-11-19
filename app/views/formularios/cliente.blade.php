@section('scripts')
<script>
	$.ajax("http://localhost:8000/colonia/all")
	.success(function(data){
		$('#ubicacion').typeahead({
			source: data,
			display: 'ubicacion',
			itemSelected: function(item){
				$('#colonia_id').val(item);
			}
		});
	});
</script>
@stop


@section('module')
<div class="row">
	<div class="col-md-12">
		{{ Form::open(array('action' => $edit ? array('ClienteControlador@postUpdate', $persona->id) : 'ClienteControlador@postStore', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form')) }}
		<div class="form-group">
			<label for="nombres" class="col-md-2 control-label">Nombre completo *</label>
			<div class="col-md-6">
				@if($edit)
				<div class="input-group">
					<input type="text" value="{{{ $persona->nombres or '' }}}" class="form-control" name="nombres" id="nombres" placeholder="Nombres" autocomplete="off">
					<input type="hidden" value="{{{ $persona->id }}}" name="persona_id">
					<span class="input-group-btn">
						<a class="btn btn-primary" href="{{ action('ClienteControlador@getCreate') }}"><i class="fa fa-user-plus"></i></a>
					</span>
				</div>
				@else
					<input type="text" value="{{{ $persona->nombres or '' }}}" class="form-control buscapersonas" name="nombres" id="nombres" placeholder="Nombres" autocomplete="off">
				@endif
			</div>
		</div>
		<div class="form-group">
			<label for="apellido_paterno" class="col-md-2 control-label sr-only">Apellido Paterno *</label>
			<div class="col-md-6">
				<input type="text" value="{{{ $persona->apellido_paterno or ''}}}" name="apellido_paterno" id="apellido_paterno" class="form-control" placeholder="Apellido Paterno">
			</div>
		</div>
		<div class="form-group">
			<label for="apellido_materno" class="col-md-2 control-label sr-only">Apellido Materno *</label>
			<div class="col-md-6">
				<input type="text" value="{{{ $persona->apellido_materno or ''}}}" name="apellido_materno" id="apellido_materno" class="form-control" placeholder="Apellido Materno">
			</div>
		</div>
		<div class="form-group">
			<label for="sexo" class="col-md-2 control-label">Sexo </label>
			<div class="col-md-5">
				<div class="radio">
					<label>
						<input type="radio" name="sexo" id="sexo_masculino" 
						@if($edit && $cliente) 
							@if($cliente->sexo == 'M') checked @endif
						@endif value="M">Masculino
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" name="sexo" id="sexo_femenino" 
						@if($edit && $cliente) 
							@if($cliente->sexo == 'F') checked @endif
						@endif value="F">Femenino
					</label>
				</div>
				<input type="hidden" value="{{{ $cliente->id or '' }}}" name="cliente_id">
			</div>
		</div>
		<div class="form-group">
			<label for="estado_civil" class="col-md-2 control-label">Estado civil</label>
			<div class="col-md-4">
				<select name="estado_civil" id="estado_civil" class="form-control">
					@foreach($civil_status as $status)
					<option value="{{{ $status->id }}}" @if($edit && $cliente && $cliente->estado_civil_id == $status->id) selected @endif >{{{ $status->descripcion }}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="fecha_nacimiento" class="col-md-2 control-label">Fecha de nacimiento</label>
			<div class="col-md-4">
				<div id="datetimepicker1" class="input-append input-group dtpicker">
					<input data-format="yyyy-MM-dd" value="{{{ $cliente->fecha_nacimiento or '' }}}" type="text" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control">
					<span class="input-group-addon add-on">
						<i data-time-icon="fa fa-times" data-date-icon="fa fa-calendar"></i>
					</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Email *</label>
			<div class="col-md-4">
				<input type="email" value="{{{ $cliente->email or '' }}}" name="email" id="email" class="form-control" placeholder="ejemplo@dominio.com">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Teléfono *</label>
			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon">Celular</span>
					<input type="text" class="form-control" name="celular" id="celular" placeholder="Incluir lada" aria-describedby="basic-addon2">
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label sr-only">Teléfono </label>
			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon">Casa</span>
					<input type="text" class="form-control" id="telefono_casa" name="telefono_casa" placeholder="Incluir Lada" aria-describedby="basic-addon2">
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="calle" class="col-md-2 control-label">Domicilio</label>
			<div class="col-md-6">
				<input type="text" value="{{{ $cliente->calle or '' }}}" name="calle" id="calle" class="form-control" placeholder="Calle">
			</div>
		</div>

		<div class="form-group">
			<label for="numero_exterior" class="col-md-2 control-label sr-only">Ubicación</label>
			<div class="col-md-6">
				@if($edit && $persona->cliente)
				<input type="text" value="{{{ $cliente->colonia->nombre or ''}}} C.P. {{{ $cliente->colonia->codigo_postal or ''}}}, {{{ $cliente->colonia->municipio->nombre or ''}}}" class="form-control" name="ubicacion" id="ubicacion" autocomplete="off" placeholder="Colonia ó Código postal" aria-describedby="basic-addon2">
				@else
					<input type="text" class="form-control" name="ubicacion" id="ubicacion" autocomplete="off" placeholder="Colonia ó Código postal" aria-describedby="basic-addon2">
				@endif
				<input type="hidden" id="colonia_id" name="colonia_id" value="{{{ $cliente->colonia->id or '' }}}">
			</div>
		</div>
		<div class="form-group">
			<label for="numero_exterior" class="col-md-2 control-label sr-only">Número exterior</label>
			<div class="col-md-2">
				<input type="text" value="{{{ $cliente->numero_exterior or ''}}}" class="form-control" name="numero_exterior" id="numero_exterior" placeholder="Número exterior" aria-describedby="basic-addon2">
			</div>
		</div>
		<div class="form-group">
			<label for="numero_exterior" class="col-md-2 control-label sr-only">Número interior</label>
			<div class="col-md-2">
				<input type="text" value="{{{ $cliente->numero_interior or '' }}}" class="form-control" name="numero_interior" name="numero_interior" placeholder="Número interior" aria-describedby="basic-addon2">
			</div>
		</div>
		<div class="form-group">
			<label for="referencias" class="col-md-2 control-label">Referencias</label>
			<div class="col-md-6">
				<textarea name="referencias" name="referencias" id="referencias" class="form-control" rows="2" placeholder="Indicaciones para llegar al domicilio">{{{ $cliente->referencias or '' }}}</textarea>
			</div>
		</div> 
		<div class="clearfix"></div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-2">
				<a href="{{ action('CotizacionControlador@getIndex') }}" class="btn btn-danger">Cancelar</a>
				<input type="submit" class="btn btn-primary" value="{{{ $edit ? 'Cotizar' : 'Guardar' }}}">
			</div>
		</div>
		{{ Form::close() }}
	</div>
</div>
@stop