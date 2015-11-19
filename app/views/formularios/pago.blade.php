@extends('modal')
@section('modal-content')
{{ Form::open(array('action' => 'CobranzaControlador@getIndex', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'pago')) }}
<div class="form-group">
	<label class="col-lg-3 control-label">Ellije una opción</label>
	<div class="col-lg-9">
		<div class="radio">
			<label>
				<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
				Pago para ponerse al corriente <strong>$ 34,000.00</strong>
			</label>
		</div>
		<div class="radio">
			<label>
				<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
				Pagar el total del adeudo <strong>$105,000.00</strong>
			</label>
		</div>
		<div class="radio">
			<label>
				<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
				Pagar una cantidad diferente
			</label>
		</div>
	</div>
</div>
<div class="form-group">
	<label for="cantidad" class="col-md-3 control-label">Monto</label>
	<div class="col-md-6">
		<input type="number" id="loteBuscarLote" name="cantidad" placeholder="Indique la cantidad" autocomplete="off" class="form-control">
	</div>
</div>
{{ Form::close() }}
@overwrite