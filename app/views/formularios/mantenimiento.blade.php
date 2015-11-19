@extends('modal')
@section('modal-content')
{{ Form::open(array('action' => 'CotizacionControlador@postAgregarProducto', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'producto')) }}
<div class="form-group">
	<label for="sector" class="col-md-3 control-label">Buscar</label>
	<div class="col-md-9">
		<input type="text" id="mantenimientoBuscarTitular" name="lote" placeholder="Buscar Titular o Inhumado" autocomplete="off" class="form-control">
		<input type="hidden" id="mantenimientoProductoId" name="producto_id">
		<input type="hidden" name="cantidad" value="1">
	</div>
</div>
<div class="form-group">
<label class="col-lg-3 control-label">Elija una opción</label>
	<div class="col-lg-9">
		<div class="radio">
			<label>
				<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
				<strong>Mantenimiento Doble</strong>
			</label>
			<p>El cliente es <span class="label label-info">TITULAR</span> de Colinas Sur Fila 4, Lote 45.</p>
		</div>
		<div class="radio">
			<label>
				<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
				<strong>Mantenimiento a Capilla</strong>
			</label>
			<p>El cliente se encuentra <span class="label label-info">INHUMADO</span> en Estrellas Norte Fila 3, Lote 24.</p>
		</div>
	</div>
</div>
{{ Form::close() }}
@overwrite