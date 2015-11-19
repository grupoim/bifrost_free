@extends('modal')
@section('modal-content')
{{ Form::open(array('action' => 'CotizacionControlador@postAgregarProducto', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'producto')) }}
<div class="form-group">
	<label for="sector" class="col-md-3 control-label">Buscar lote </label>
	<div class="col-md-9">
		<input type="text" id="loteBuscarLote" name="lote" placeholder="Buscar Sector, fila o lote" autocomplete="off" class="form-control">
		<input type="hidden" id="loteProductoId" name="producto_id">
		<input type="hidden" name="cantidad" value="1">
	</div>
</div>
{{ Form::close() }}
@overwrite