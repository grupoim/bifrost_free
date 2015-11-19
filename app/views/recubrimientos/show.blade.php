 <div class="matter">
        <div class="container">

          <div class="row">

        

            <div class="col-md-9">

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
                                @forelse($facturas as $factura)
                                <p>{{{$factura->entrada}}} láminas de <strong>{{{$factura->material}}} {{{$factura->color}}}</strong> </p>
                                <p>
                                ${{{number_format($factura->total_factura, 2, '.', ',')}}}</p>
                                
                                @empty
                                @endforelse
								<hr />
                Total : <strong>${{{number_format($suma, 2, '.', ',')}}}</strong>
								
															{{--
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
                                
                             --}}
                               
                             </div>
                  </div>
                </div>

              </div> 

            </div>

          </div>         

        </div>
		  </div>