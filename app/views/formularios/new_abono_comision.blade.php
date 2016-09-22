@extends('modal')
@section('modal-content')
{{ Form::open(array('action' => 'ComisionControlador@postAddabono', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'addAbo')) }}
<div class="form-group">
	<label for="sector" class="col-md-3 control-label">Venta </label>
	<div class="col-md-9">
			<select data-placeholder="Elije una Venta activa..." class="form-control" name="comision_id" id="ventas" class="form-control ventas chosen-select" required = "true" >                                
            		<option> </option>
             	@foreach($comisiones_activas as $comision)

				
            		<option value="{{$comision->id}}"> Id: {{{$comision->id}}} {{{$comision->cliente}}} Folio: {{{$comision->folio_solicitud}}} </option>
             	

            	 @endforeach 
       
         </select> <br>     
		
	</div>
</div>
<div class="form-group">
	<label for="sector" class="col-md-3 control-label">Vendedor </label>
	<div class="col-md-9">
			<select  data-placeholder="Elije un vendedor..." class="form-control" name="asesor_id" id="asesor_id" class="form-control asesor_id chosen-select"  required>                                
            
             	<option> </option>
             	@foreach($asesores as $asesor)

				
            		<option value="{{$asesor->asesor_id}}"> {{{$asesor->asesor}}} </option>
             	

            	 @endforeach 
       
         </select> <br>
     
		
		<input type="hidden" id="periodo_comision_id" name="periodo_comision_id" value="{{{$periodo_comision->id}}}">
		<input type="hidden" name="usuario_id" value="{{ Auth::user()->id}}">
		
	</div>
</div>

<div class="form-group">
	<label for="sector" class="col-md-3 control-label">Monto </label>
	<div class="col-md-9">
	        
      	<input type="number" step="any"class="form-control" placeholder="$0.0" name="monto" required>     
		
	</div>
</div>
{{ Form::close() }}
@overwrite