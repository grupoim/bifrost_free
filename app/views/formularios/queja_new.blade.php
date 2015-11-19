@extends('modal')
@section('modal-content')
{{ Form::open(array('action' => 'QuejaControlador@postAgregar', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'new_queja')) }}
<div class="form-group">
	<label for="sector" class="col-md-3 control-label">Buscar lote </label>
	<div class="col-md-9">
			<select class="form-control" name="puesto_id" id="puesto_id" >                                
            
             	@foreach($rubros as $rubro)

				
            		<option value="{{$rubro->id}}"> {{{$rubro->descripcion}}}</option>
             	

            	 @endforeach 
       
         </select> <br>
     
		<input type="text" id="descripcion" name="descripcion" placeholder="Escriba su queja"  class="form-control">
		<input type="hidden" id="lote_producto_id" name="producto_id">
		<input type="hidden" name="usuario_id" value="{{ Auth::user()->id}}">
		
	</div>
</div>
{{ Form::close() }}
@overwrite