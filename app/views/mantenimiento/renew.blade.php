
<!--
/** 
  * === FORM UPDATE ===
  * add solsoForm in form class
*/
-->	
{{ Form::open(array('url' => 'mantenimiento/' . Request::segment(2), 'role' => 'form', 'method' => 'PUT', 'class' => 'solsoForm form-horizontal' )) }}
	
<!-- <div class="col-md-12">
	 <h4>Contratante: {{ $mtto_r->cliente }}</h4>
	<hr>
	
	<table data-height="299" data-card-view="true" data-response-handler="responseHandler">
	<tbody>
	<tr>
		<th>Ubicación</th>
		<th>Mantenimiento contratado</th>
	</tr>	
		<tr>
			
			<td class="col-md-3"><strong> {{ $mtto_r->ubicacion }} </strong></td>		
			<td class="col-md-6">{{ $mtto_r->producto}}</td>
		</tr>
		
		
	</tbody>
	</table>
</div>

<div class="form-group">
	<label for="sector" class="col-md-3 control-label">Asunto de la queja </label>
	<div class="col-md-6">
			<select class="form-control" name="rubro_id" id="rubro_id" >                                
            
             	@foreach($tipos_mantenimientos as $mtto)

				
            		<option value=""> {{{$mtto->nombre}}} Precio: ${{{$mtto->monto}}}.00</option>
             	

            	 @endforeach 
       
         </select> <br>   
		
	</div>
</div>
<div class="form-group">
	<label for="queja" class="col-md-3 control-label">Queja </label>
	<div class="col-md-6">
		<textarea id="descripcion" name="descripcion" focus placeholder="Escriba su queja"  class="form-control" required></textarea>
		<input type="hidden" name="usuario_id" value="{{ Auth::user()->id}}">
	<h1>Suma de valores</h1>
    <div>Valor 1: <input type="text" id="valor1" onkeyup="sumar();"></div>
    <div>Valor 2: <input type="text" id="valor2" onkeyup="sumar();"></div>
    <div>Valor 3: <input type="text" id="valor3" onkeyup="sumar();"></div>
    <div>Valor 4: <input type="text" id="valor4" onkeyup="sumar();"></div>
    <div>Total: <input type="text" id="total" disabled value="0">	
	</div>	 
	         	
</div> -->
 
<!--
<div class="form-group">
	<label for="queja" class="col-md-3 control-label">Queja </label>
	<div class="col-md-9">
		<textarea id="descripcion" name="descripcion" focus placeholder="Escriba su queja"  class="form-control" required></textarea>
		<input type="hidden" name="usuario_id" value="{{ Auth::user()->id}}">
		
	</div>
<div class="form-group">
                                  <label class="col-lg-2 control-label">Periodo</label>
                                  <div class="col-lg-8">
                                    <label class="radio-inline">
                                            <input type="radio" name="periodo" id="inlineRadio1" value="Sencilla" checked="true" title="Sencilla">Trimestre
                                          </label>
                                    </div>

                                    
		</div>
		<div class="form-group col-lg-2"> 
		<label for="name">Name</label>
			<input type="text" name="id" class="form-control required" autocomplete="off" value="{{ isset($inputs['id']) ? $inputs['id'] : $mtto->id }}">
			
			<?php echo $errors->first('id', '<p class="error">:messages</p>');?>
		</div>
	<div class="form-group col-lg-2">
		@foreach($tipos_mantenimientos as $mtto)
			<ul>
				<li> {{{$mtto->nombre}}} Precio: ${{{$mtto->monto}}}.00</li>
			</ul>
		@endforeach

		<!--
		/** 
		  * === BUTTON SAVE ===
		  * add solsoSave in button class
		  * place data-message-title, data-message-error, data-message-success in button code
		  * data-message-title 		= this text will appear as title text in notifications(alerts) window
		  * data-message-error		= this text will appear as error message in notifications(alerts) window
		  * data-message-success	= this text will appear as success message in notifications(alerts) window
		*/
		-->	 <!--	
		<button type="button" class="btn btn-success btn-lg solsoSave" data-message-title="Renovación de mantenimiento" data-message-error="No se puede guardar campos vacíos" data-message-success="Mantenimiento en  {{{$mtto_r->ubicacion}}}  renovado con éxito">
			<i class="fa fa-save"></i> Save
		</button>
	</div>
                                </div>

                               -->

                               <!-- Matter -->

	    <div class="matter">
        <div class="container">

          <div class="row">

            <div class="col-md-5">

              <!-- Widget -->
              <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                  <div class="pull-left">Support</div>
                  <div class="widget-icons pull-right">                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <!-- Widget content -->
                  <div class="padd">
                    <div class="support-faq">
                                <h5>Type to Filter:</h5>
                                <!-- Below line creates form -->
                                {{{Str::words($mtto_r->descripcion, 2, $end='')}}}
                                <div id="form_filter"></div>
                                <hr />
                                <div class="clearfix"></div>
                                <select class="form-control mtto_types chosen-select" name="rubro_id" id="mtto_meses" >                                
            					@if(count($tipos_mantenimientos) > 0)	
				             	@foreach($tipos_mantenimientos as $mtto)

				            		<option @if($mtto->producto_id == $mtto_r->producto_id) selected @endif> {{{$mtto->nombre}}} Precio: ${{{$mtto->monto}}}.00 </option>
				             	 @endforeach
				             	 @else
				             	 @foreach($tipos_mantenimientos_sin_filtro as $mtto)

				            		<option @if($mtto->producto_id == $mtto_r->producto_id) selected @endif> {{{$mtto->nombre}}} Precio: ${{{$mtto->monto}}}.00 </option>
				             	 @endforeach
				             	 @endif 
               					 </select> <br>
                                  <!-- Lists -->
                                  <ol id="slist">
                                      <!-- List #1 -->
                                      <li>
                                         <!-- Title. Link title is used for filteration. -->
                                         <a href="#">Sed eu leo orci condimentum grvid metus</a>
                                         <!-- Para -->
                                         <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestibulum libero, ut vestibulum tellus magna nec enim. Nunc dapibus varius interdum. Phasellus at lorem ut lectus fermentum convallis. Sed diam nisi, pulvinar vitae molestie hendrerit, venenatis eget mauris. Integer porta erat ac eros porta ultrices. Proin porttitor eros a ante molestie gravida commodo dui adipiscing.</p>
                                      </li>
                                      <!-- List #2 and so on.... -->
                                      <li>
                                         <a href="#">Fusce imperdiet risus eget viverr</a>
                                         <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestibulum libero, ut vestibulum tellus magna nec enim. Nunc dapibus varius interdum. Phasellus at lorem ut lectus fermentum convallis. Sed diam nisi, pulvinar vitae molestie hendrerit, venenatis eget mauris. Integer porta erat ac eros porta ultrices. Proin porttitor eros a ante molestie gravida commodo dui adipiscing.</p>
                                      </li>
                                      <li>
                                         <a href="#">Dimmi vestibulum libero ut vestibulum</a>
                                         <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestibulum libero, ut vestibulum tellus magna nec enim. Nunc dapibus varius interdum. Phasellus at lorem ut lectus fermentum convallis. Sed diam nisi, pulvinar vitae molestie hendrerit, venenatis eget mauris. Integer porta erat ac eros porta ultrices. Proin porttitor eros a ante molestie gravida commodo dui adipiscing.</p>
                                      </li>
                                      <li>
                                         <a href="#">Aeros a ante molestie gravida commodo</a>
                                         <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestibulum libero, ut vestibulum tellus magna nec enim. Nunc dapibus varius interdum. Phasellus at lorem ut lectus fermentum convallis. Sed diam nisi, pulvinar vitae molestie hendrerit, venenatis eget mauris. Integer porta erat ac eros porta ultrices. Proin porttitor eros a ante molestie gravida commodo dui adipiscing.</p>
                                      </li>
                                      <li>
                                         <a href="#">Integer porta erat ac eros porta</a>
                                         <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestibulum libero, ut vestibulum tellus magna nec enim. Nunc dapibus varius interdum. Phasellus at lorem ut lectus fermentum convallis. Sed diam nisi, pulvinar vitae molestie hendrerit, venenatis eget mauris. Integer porta erat ac eros porta ultrices. Proin porttitor eros a ante molestie gravida commodo dui adipiscing.</p>
                                      </li>
                                      <li>
                                         <a href="#">Molestie gravida commodo dui adipiscing</a>
                                         <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestibulum libero, ut vestibulum tellus magna nec enim. Nunc dapibus varius interdum. Phasellus at lorem ut lectus fermentum convallis. Sed diam nisi, pulvinar vitae molestie hendrerit, venenatis eget mauris. Integer porta erat ac eros porta ultrices. Proin porttitor eros a ante molestie gravida commodo dui adipiscing.</p>
                                      </li>                                    
                                 </ol>
                             </div>
                  </div>
                  <!-- Widget footer -->
                  <div class="widget-foot">
                    <p>Vivamus diam diam, fermentum sed dapibus eget, consectetur adipiscing elit.</p>
                  </div>
                </div>

              </div> 

            </div>

            <div class="col-md-4">

              <!-- Widget -->
              <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                  <div class="pull-left">Datos Generales</div>
                  <div class="widget-icons pull-right">
                   
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <!-- Widget content -->
                  <div class="padd">
                                               <!-- Contact box -->
                             <div class="support-contact">
                                <!-- Phone, email and address with font awesome icon -->
                                <p>Ubicación: <strong>{{{$mtto_r->ubicacion}}}</strong> </p>
                                <p>Tipo de terreno: <strong>{{{$mtto_r->descripcion}}} </strong>
                                <p> Mtto. contratado: <strong>{{{$mtto_r->producto}}}</strong>.</p>
								<hr />
								
								@if($mtto_r->verifica == 0)
								<div class="alert alert-danger">
								 <i class="fa fa-times"></i>  El manteniemiento contratado <strong>NO</strong> corresponde al tipo de propiedad, favor revisar.
								 </div>
								<hr />
								@else
								<div class="alert alert-success">
								  <i class="fa fa-check-square-o"></i> El manteniemiento contratado corresponde correctamente con el tipo de propiedad.
								 </div>
								<hr />
								@endif								
                                <p><i class="fa fa-user"></i>&nbsp; Contratante actual:<strong> {{{$mtto_r->cliente}}}</strong></p>
                                <hr />
                                @if($telefono_casa)<p><i class="fa fa-phone"></i>&nbsp; Casa<strong>:</strong> {{{$telefono_casa->telefono}}} </p> @endif
                                @if($telefono_celular)<p><i class="fa fa-mobile"></i>&nbsp; Celular<strong>:</strong> {{{$telefono_celular->telefono}}} </p> @endif
                                @if(count($telefono_casa)== 0 and count($telefono_celular) == 0) 
                                <div class="alert alert-warning">
								   <i class="fa fa-warning"> </i> Favor de capturar almenos un numero telefónico
								 </div>

                                @endif
                                <hr />
                                @forelse($clientes as $cliente)
								@if($cliente->id == $mtto_r->cliente_id)
                                <p><i class="fa fa-home"></i>&nbsp; Domicilio<strong>:</strong> Calle {{{$cliente->calle}}} @if($cliente->numero_exterior <> '')No. {{{$cliente->numero_exterior}}} @endif @if($cliente->numero_interior <> '') Int. {{{$cliente->numero_interior}}} @endif
									{{{$cliente->referencias}}} Colonia {{{$cliente->colonia}}} C.P. {{{$cliente->codigo_postal}}}, {{{$cliente->municipio}}}
									{{{$cliente->estado}}}
                                </p>
								<hr />
								@endif
                                @empty
                                @endforelse
                                
                                <!-- Button -->
                                <a href="contact.html" class="btn btn-danger btn-sm">Contact Us</a> &nbsp; <a href="faq.html" class="btn btn-info btn-sm">Check out FAQ</a>
                             </div>
                  </div>
                </div>

              </div> 

            </div>

          </div>         

        </div>
		  </div>
	
{{ Form::close() }}	

