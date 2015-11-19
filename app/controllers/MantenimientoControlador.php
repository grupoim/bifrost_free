<?php 
use Carbon\Carbon;
	class MantenimientoControlador extends ModuloControlador{
		public $data = array();
		public $department;

		function __construct(){
			$this->data["module"] = "Mantenimiento";			
			$this->data["icon"] = "leaf";			
			$this->department = Auth::user()->departamento->nombre;
		}		

		public function getIndex(){	

			$dataModule["status"] = Session::pull('status','inicial');
			$dataModule['cesped'] = cesped::sum('cantidad');
			$dataModule["detalle_mantenimientos"] = VistaDetalleMantenimiento::where('venta_mantenimiento_activo',1)->get();
			$dataModule["nuevos"] = VentaMantenimiento::where('nuevo','=',1)->count();
			$dataModule["renovados"] = VentaMantenimiento::where('nuevo','=',0)->count();
			$dataModule["telefono_casas"] = Telefono::where('tipo_telefono_id', '=', 2)->get();
			$dataModule["telefono_celulares"] = Telefono::where('tipo_telefono_id', '=', 1)->get();
			$dataModule["inhumados_r"] = VistaInhumadosMtto::all();
			$dataModule["clientes"] = VistaDetalleMantenimiento::leftjoin('vista_clientes', 'vista_detalle_mantenimiento.cliente_id', '=', 'vista_clientes.id' )->get();
			
			return View::make($this->department.".main", $this->data)->nest('child','mantenimiento.mantenimiento', $dataModule);
        }

               
       public function getEdit($id)
	{
		$mtto_detalle = VistaDetalleMantenimiento::find($id);
		$telefono_celular = Telefono::where('tipo_telefono_id', '=', 1)->where('cliente_id', '=', $mtto_detalle->cliente_id)->first();
		$telefono_casa = Telefono::where('tipo_telefono_id', '=', 2)->where('cliente_id', '=', $mtto_detalle->cliente_id)->first();
		$tipos_mantenimientos = Mantenimiento::select('producto.id as producto_id', 'producto.nombre', 'precio.monto', 'meses', 'construccion.descripcion')
		->leftjoin('producto', 'mantenimiento.producto_id', '=', 'producto.id')
		->leftjoin('precio', 'producto.id', '=', 'precio.producto_id')
		->leftjoin('construccion', 'mantenimiento.construccion_id', '=', 'construccion.id')
		->where('precio.activo',1)
		->where('construccion.id', '=', $mtto_detalle->construccion_id)
		->get();
		
		$tipos_mantenimientos_sin_filtro = Mantenimiento::select('producto.id as producto_id', 'producto.nombre', 'precio.monto', 'meses', 'construccion.descripcion')
		->leftjoin('producto', 'mantenimiento.producto_id', '=', 'producto.id')
		->leftjoin('precio', 'producto.id', '=', 'precio.producto_id')
		->leftjoin('construccion', 'mantenimiento.construccion_id', '=', 'construccion.id')
		->where('precio.activo',1)
		->where('construccion.descripcion', 'like', '%'.Str::words($mtto_detalle->descripcion, 2, $end='').'%')
		->get();
		$clientes = VistaDetalleMantenimiento::leftjoin('vista_clientes', 'vista_detalle_mantenimiento.cliente_id', '=', 'vista_clientes.id' )->get();

		$data = array(
			'mtto' 	=> VentaMantenimiento::find($id),			
			'mtto_r' => $mtto_detalle,
			'clientes' => $clientes,
			'tipos_mantenimientos' => $tipos_mantenimientos,
			'tipos_mantenimientos_sin_filtro' => $tipos_mantenimientos_sin_filtro,
			'telefono_casa' => $telefono_casa,
			'telefono_celular' => $telefono_celular
		);
		
		return View::make('mantenimiento.renew', $data);
	}

        //Abre vista que contiene cuerpo de ventana modal show
        public function getShow($id)
	{
		$mtto_detalle = VistaDetalleMantenimiento::find($id);
		$telefono_celular = Telefono::where('tipo_telefono_id', '=', 1)->where('cliente_id', '=', $mtto_detalle->cliente_id)->first();
		$telefono_casa = Telefono::where('tipo_telefono_id', '=', 2)->where('cliente_id', '=', $mtto_detalle->cliente_id)->first();
		$tipos_mantenimientos = Mantenimiento::select('producto.id as producto_id', 'producto.nombre', 'precio.monto', 'meses', 'construccion.descripcion')
		->leftjoin('producto', 'mantenimiento.producto_id', '=', 'producto.id')
		->leftjoin('precio', 'producto.id', '=', 'precio.producto_id')
		->leftjoin('construccion', 'mantenimiento.construccion_id', '=', 'construccion.id')
		->where('precio.activo',1)
		->where('construccion.id', '=', $mtto_detalle->construccion_id)
		->get();
		
		$tipos_mantenimientos_sin_filtro = Mantenimiento::select('producto.id as producto_id', 'producto.nombre', 'precio.monto', 'meses', 'construccion.descripcion')
		->leftjoin('producto', 'mantenimiento.producto_id', '=', 'producto.id')
		->leftjoin('precio', 'producto.id', '=', 'precio.producto_id')
		->leftjoin('construccion', 'mantenimiento.construccion_id', '=', 'construccion.id')
		->where('precio.activo',1)
		->where('construccion.descripcion', 'like', '%'.Str::words($mtto_detalle->descripcion, 2, $end='').'%')
		->get();
		$clientes = VistaDetalleMantenimiento::leftjoin('vista_clientes', 'vista_detalle_mantenimiento.cliente_id', '=', 'vista_clientes.id' )->where('vista_clientes.id',$mtto_detalle->cliente_id)->groupby('vista_clientes.id')->get();

		$data = array(
			'mtto' 	=> VentaMantenimiento::find($id),			
			'mtto_r' => $mtto_detalle,
			'clientes' => $clientes,
			'tipos_mantenimientos' => $tipos_mantenimientos,
			'tipos_mantenimientos_sin_filtro' => $tipos_mantenimientos_sin_filtro,
			'telefono_casa' => $telefono_casa,
			'telefono_celular' => $telefono_celular
		);
		
		return View::make('mantenimiento.show', $data);
	}


        /* === C.R.U.D. === */
	public function store()
	{
		$rules = array(
			'id'     	=> 'required',
			
		);	
		
		$validator = Validator::make(Input::all(), $rules);	
		
		if ($validator->passes())
		{
			//pasó validacion y guarda
		}
		else
		{
			//mensajes de error si faltan dartos
			if( Request::ajax() ) 
			{
				$data = array(
					'errors' 	=> $validator->errors(),
					'inputs'	=> Input::all()
				);
				//regresa a la vista de crear
				return View::make('clients.create', $data);
			}

			return 0;	
		}	
		
		$data = array(
			'clients' 	=> Client::orderBy('id', 'desc')->get(),
			'refresh'	=> true
		);
		
		return View::make('clients.table', $data);
	}
	
public function update($id)
	{
		$rules = array(
			'id'     	=> 'required',
			
		);	
		
		$validator = Validator::make(Input::all(), $rules);		
		
		if ($validator->passes())
		{	
			$update	= VentaMantenimiento::find($id);
			$update->nuevo = 0;
			$update->save();
		}
		else
		{
			if( Request::ajax() ) 
			{
				$data = array(
					'mtto' 	=> VentaMantenimiento::find($id),
					'inputs'	=> Input::all(),
					'errors' 	=> $validator->errors()
				);
				
				return View::make('mantenimiento.renew', $data);
			}
			
			return 0;
		}		
		
		$data = array(
			'cesped' => cesped::sum('cantidad'),
			'nuevos' => VentaMantenimiento::where('nuevo','=',1)->count(),
			'renovados'=> VentaMantenimiento::where('nuevo','=',0)->count(),
			'telefono_celulares' => Telefono::where('tipo_telefono_id', '=', 1)->get(),
			'telefono_casas' => Telefono::where('tipo_telefono_id', '=', 2)->get(),
			'inhumados_r' => VistaInhumadosMtto::all(),
			'detalle_mantenimientos'=> VistaDetalleMantenimiento::get(),
			'refresh'	=> true
		);

		return View::make('mantenimiento.table', $data);
	}

	public function postDelete($id)
	{
		$delete = VentaMantenimiento::find($id);
		$delete->delete();
		
		$data = array(
			'clients' 	=> VentaMantenimiento::find($id),
			'refresh'	=> true
		);

		return View::make('mantenimiento.mantenimiento', $data);
	}
	/* === END C.R.U.D. === */



	public function getRenovacion($id)
	{
					$mtto_detalle = VistaDetalleMantenimiento::find($id);
					$dataModule["vendedores"] = VistaAsesorPromotor::where('activo',1)->get();
					$dataModule["status"] = Session::pull('status');
					$dataModule["config_gral"] = ConfiguracionGeneral::where('activo',1)->firstorfail();
					$dataModule['cesped'] = cesped::sum('cantidad');
					$dataModule["mtto_r"] = $mtto_detalle;
					$dataModule["nuevos"] = VentaMantenimiento::where('nuevo','=',1)->count();
					$dataModule["renovados"] = VentaMantenimiento::where('nuevo','=',0)->count();
					$dataModule["telefono_casa"] = Telefono::where('tipo_telefono_id', '=', 2)->where('cliente_id', '=', $mtto_detalle->cliente_id)->first();
					$dataModule["telefono_celular"] =  Telefono::where('tipo_telefono_id', '=', 1)->where('cliente_id', '=', $mtto_detalle->cliente_id)->first();
					$dataModule["inhumados_r"] = VistaInhumadosMtto::all();
					$dataModule["clientes"] = VistaDetalleMantenimiento::leftjoin('vista_clientes', 'vista_detalle_mantenimiento.cliente_id', '=', 'vista_clientes.id' )->groupby('vista_clientes.id')->get();
					$dataModule['tipos_mantenimientos'] =  Mantenimiento::select('producto.id as producto_id', 'producto.nombre', 'precio.monto', 'meses', 'construccion.descripcion')
																		->leftjoin('producto', 'mantenimiento.producto_id', '=', 'producto.id')
																		->leftjoin('precio', 'producto.id', '=', 'precio.producto_id')
																		->leftjoin('construccion', 'mantenimiento.construccion_id', '=', 'construccion.id')
																		->where('precio.activo',1)
																		->where('construccion.id', '=', $mtto_detalle->construccion_id)
																		->get();
					$dataModule["tipos_mantenimientos_sin_filtro"] = Mantenimiento::select('producto.id as producto_id', 'producto.nombre', 'precio.monto', 'meses', 'construccion.descripcion')
																		->leftjoin('producto', 'mantenimiento.producto_id', '=', 'producto.id')
																		->leftjoin('precio', 'producto.id', '=', 'precio.producto_id')
																		->leftjoin('construccion', 'mantenimiento.construccion_id', '=', 'construccion.id')
																		->where('precio.activo',1)
																		->where('construccion.descripcion', 'like', '%'.Str::words($mtto_detalle->descripcion, 2, $end='').'%')
																		->get();
					return View::make($this->department.".main", $this->data)->nest('child','mantenimiento.renovacion', $dataModule);

	}

	public function postRenovacionCliente($cliente_id)	
	{



	}

	public function postRenovacionCasaNuevo()	
	{
		$telefono = new Telefono();
		$telefono->cliente_id = Input::get('cliente_id');
		$telefono->tipo_telefono_id = 2;
		$telefono->telefono = Input::get('tel_casa_new');
		$telefono->codigo_pais = 52;
		$telefono->save();
		
		return Redirect::back();

	}
	public function postEditTelCasa()	
	{
		$telefono = Telefono::find(Input::get('id'));
		$telefono->telefono = Input::get('tel_casa_edit');
		$telefono->save();
		
		return Redirect::back();

	}
	public function postEditTelCel()	
	{
		$celular = Telefono::find(Input::get('id'));
		$celular->telefono = Input::get('tel_cel_edit');
		$celular->save();
		
		return Redirect::back();

	}

	public function postRenovacion(){

		$precio = Precio::where('producto_id',Input::get('producto_id'))->where('activo',1)->firstorfail();
		
		$mtto_detalle = VistaDetalleMantenimiento::find(Input::get('id'));
		
		$mtto_catalogo = Mantenimiento::where('producto_id',Input::get('producto_id'))->firstorfail();//para obtener los meses a sumar en el mantenimiento renovado
		
		$vencimiento_actual = $mtto_detalle->fecha_fin;
		
		$vencimiento_actual_carbon = Carbon::parse($vencimiento_actual);		
		
//validar formulario
			$rules = array(
					
					'forma_pago' => 'required'
				);
			if(Input::get('valor_efectivo') == 1 and Input::has('efectivo'))
					{ $rules['efectivo'] = 'required|numeric|integer';}	
			if(Input::get('valor_credito') == 1 and Input::has('credito'))
					{ $rules['credito'] = 'required|numeric|integer';}	
					if(Input::get('valor_debito') == 1 and Input::has('debito'))
					{ $rules['debito'] = 'required|numeric|integer';}			

				$messages = array(
						'required'=>'Capture :attribute',
						'numeric'=>'solo números',
						'integer'=>'solo se aceptan valores enteros',
						
					);

			$validator = Validator::make(Input::all(), $rules, $messages);
				if ($validator->fails())
				 { 
						
						return Redirect::back()->withInput()->withErrors($validator);
				}
		
		//mantenimiento vencido toma la fecha de hoy
		if($mtto_detalle->vencido == 1 and $mtto_detalle->venta_mantenimiento_activo == 1)
			{
				$inicio_renovacion_carbon = Carbon::now()->toDateString();
				$vencimiento_renovacion_carbon = Carbon::parse($inicio_renovacion_carbon)->addMonths($mtto_catalogo->meses)->toDateString();
			}
			elseif($mtto_detalle->vencido == 0 and $mtto_detalle->venta_mantenimiento_activo == 1 ){
				 $inicio_renovacion_carbon = $vencimiento_actual_carbon->addDays(1)->toDateString();
				 $vencimiento_renovacion_carbon = Carbon::parse($inicio_renovacion_carbon)->addMonths($mtto_catalogo->meses)->toDateString();
			}
			
	  /*"precio"." ".$precio->monto*1.16." "."vencimiento actual "." ".$vencimiento_actual." ". "vencimiento contratado "." ". $vencimiento_renovacion_carbon ." "."meses"." ".$mtto_catalogo->meses." "."inicio del nuevo mantenimiento "." ". $inicio_renovacion_carbon;*/
		
		//registrar venta
		$venta = new Venta;	

		$venta->cliente_id = Input::get('cliente_id');		
		$venta->folio_solicitud = Input::get('folio_solicitud');
		$venta->total = $precio->monto * Input::get('iva');

		if (Input::get('comentarios'))
			{
				$venta->comentarios = Input::get('comentarios');
			}
		$venta->save();

		//registrar detalle de venta
		$venta_producto = new VentaProducto;
		
		$venta_producto->venta_id = $venta->id;
		$venta_producto->producto_id = Input::get('producto_id');
		$venta_producto->cantidad = 1;
		$venta_producto->total = $precio->monto * Input::get('iva');
		$venta_producto->precio_unitario = $precio->monto;
		$venta_producto->iva = (Input::get('iva') - 1 )*100 ;
		$venta_producto->save();

		//registra venta de mantenimiento		
		$venta_mantenimiento = new VentaMantenimiento;
		$venta_mantenimiento->venta_producto_id = $venta_producto->id;
		$venta_mantenimiento->empleado_id = 4;
		$venta_mantenimiento->lote_id = Input::get('lote_id');
		$venta_mantenimiento->fecha_inicio = $inicio_renovacion_carbon;
		$venta_mantenimiento->fecha_fin = $vencimiento_renovacion_carbon;
		$venta_mantenimiento->nuevo = 0;
		$venta_mantenimiento->activo = 1;
		$venta_mantenimiento->save();

		//genera recibo
		$recibo = new Recibo;
		$recibo->venta_id = $venta->id;
		$recibo->fecha_limite = $inicio_renovacion_carbon;
		$recibo->monto = $venta_producto->total;
		$recibo->cancelado = 0;
		$recibo->pagado = 1;
		$recibo->mensajero = 0;
		$recibo->save();
		
		
		//registra pago(s)
		if (Input::has('efectivo'))
				{
				    $efectivo = Input::get('efectivo');
				    $pago_efectivo = new Pago;
				    $pago_efectivo->recibo_id = $recibo->id;
				    $pago_efectivo->forma_pago_id = 1;
				    $pago_efectivo->monto = $efectivo;
				    $pago_efectivo->usuario_id = Auth::user()->id;
				    $pago_efectivo->save();
				}

			if (Input::has('credito'))
				{
				    $efectivo = Input::get('credito');
				    
				    $pago_efectivo = new Pago;
				    $pago_efectivo->recibo_id = $recibo->id;
				    $pago_efectivo->forma_pago_id = 2;
				    $pago_efectivo->monto = $efectivo;
				    $pago_efectivo->usuario_id = Auth::user()->id;
				    $pago_efectivo->save();
				}
		if (Input::has('debito'))
			{
			    $efectivo = Input::get('debito');
			    
				    $pago_efectivo = new Pago;
				    $pago_efectivo->recibo_id = $recibo->id;
				    $pago_efectivo->forma_pago_id = 5;
				    $pago_efectivo->monto = $efectivo;
				    $pago_efectivo->usuario_id = Auth::user()->id;
				    $pago_efectivo->save();
			}

		//actualiza registro anterior de venta de mantenimiento ya que dejará de ser "nuevo"		
		$venta_mantenimiento_actualiza = VentaMantenimiento::find($mtto_detalle->id);
		$venta_mantenimiento_actualiza->nuevo = 0;
		$venta_mantenimiento_actualiza->activo = 0;
		$venta_mantenimiento_actualiza->save();

		//actualiza el ultimo consecutivo de folios de mantenimiento en tabla de configuracion general		
		$config_gral = ConfiguracionGeneral::find(Input::get('config_gral_id'));
		$config_gral->folio_mtto = Input::get('folio_solicitud');
		$config_gral->save();
		
return Redirect::to('mantenimiento');
		
	}
	
			
    }
 ?>		