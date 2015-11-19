<table cellpadding="0" cellspacing="0" border="0"  width="100%" id="data-table" class="solsoTable {{ isset($refresh) ? 'solsoRefresh' : ''; }}">
								<thead>
									<tr>
										{{--<th>Folio</th>--}}
										<th>Cliente</th>
										<th>Ubicación</th>
										<th>Fecha Inicio</th>
										<th>Fecha Fin</th>										
										{{-- <th>Detalle</th> --}}
										{{--<th>Telefono(s)</th>--}}
										{{--<th>Inhumados</th>--}}										
										<th>Plan</th>
										{{--<th>Total</th>--}}
										<th>Estatus</th>
										<th>Opciones</th>
									</tr>
								</thead>
								<tbody>
								@forelse($detalle_mantenimientos as $mtto)<tr>
									
									{{--<td>{{{$mtto->folio_solicitud}}}</td>--}}
									<td>{{{$mtto->cliente}}}</td>
									<td>{{{$mtto->ubicacion}}}</td>									
									<td>{{{ date('d/m/y', strtotime($mtto->fecha_inicio)) }}}</td>
									<td>{{{ date('d/m/y', strtotime($mtto->fecha_fin)) }}}</td>								
									{{-- <td>{{{$mtto->producto}}}</td> --}}									
									{{--<td>@forelse($telefono_casas as $casa) 
												@if($mtto->cliente_id == $casa->cliente_id) 
													<p><i class="fa fa-fax"></i> {{{$casa->telefono}}}</p>
												@endif 
											@empty 
										@endforelse

										@forelse($telefono_celulares as $cel)
											@if($mtto->cliente_id == $cel->cliente_id)
												
												<p><i class="fa fa-phone"></i>  {{{$cel->telefono}}}</p>
											@endif
										@empty
										@endforelse
									</td> --}}
									{{--<td>@forelse($inhumados_r as $inhumado) 
												@if($mtto->ubicacion == $inhumado->ubicacion) 
													<p><i class="fa fa-plus"></i> {{{$inhumado->inhumado}}}</p>
												@endif 
											@empty 
										@endforelse
									</td> --}}

									<td>{{{$mtto->construccion_mtto_contrato}}} 
								 	@if($mtto->meses_contratados == 3)
										        Trimestral 
										 @elseif($mtto->meses_contratados == 6)								        
										        Semestral 
										 @elseif($mtto->meses_contratados == 12)
										        Anual 
									 @endif
									 ${{{$mtto->total}}}
									</td>
									{{--<td>${{{$mtto->total}}}</td>--}}
									<td> 
									@if($mtto->estatus == 'vencido')<span class="label label-danger">@endif 
									@if ($mtto->estatus == 'por vencer')<span class="label label-warning">@endif
									@if($mtto->estatus == 'vigente')<span class="label label-success">@endif	
									{{{Str::title($mtto->estatus)}}}</span></td>
									<td>
									{{--@if ($mtto->estatus == 'por vencer' or $mtto->estatus == 'vencido' )--}}
									
									<a class="btn btn-xs btn-default "  href= "{{action('MantenimientoControlador@getRenovacion', $mtto->id)}}" >
									<i class="fa fa-refresh"></i> Renovar
									</a>
									
									{{--@endif --}}
									<button type="button" class="btn btn-xs btn-default solsoShowModal" title=" Inhumados:@forelse($inhumados_r as $inhumado) 
												@if($mtto->ubicacion == $inhumado->ubicacion) 
													 {{{$inhumado->inhumado}}}
												@endif 
											@empty 
										@endforelse"  data-toggle="modal" data-target="#solsoCrudModal" href= "{{action('MantenimientoControlador@getShow', $mtto->id)}}" data-modal-title=" Detalles del mantenimiento">
									<i class="fa fa-search"></i> Detalles
									</button>
									<button type="button" class="btn btn-xs btn-default solsoShowModal" data-toggle="modal" data-target="#solsoCrudModal" data-href="{{ URL::to('mantenimiento/'. $mtto->id.'/edit') }}" data-modal-title=" Detalles del mantenimiento">
									<i class="fa fa-user-plus"></i> Nuevo
									</button>
									</td>									
								</tr>@empty
									@endforelse
								</tbody>
								<tfoot>
									
								</tfoot>
							</table>