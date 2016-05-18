@extends('modal')
@section('modal-content')
{{ Form::open(array('action' => 'CotizacionControlador@postAgregarProducto', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'servicio')) }}
<div class="form-group">
	<label for="sector" class="col-md-3 control-label">Servicio </label>
	<div class="col-md-9">
		<input type="text" id="servicioBuscarServicio" name="servicio" placeholder="Buscar Servicio, Precio" autocomplete="off" class="form-control">
		<input type="hidden" id="servicioProductoId" name="producto_id">
		<input type="hidden" name="cantidad" value="1">
	</div>
</div>
{{ Form::close() }}
@overwrite