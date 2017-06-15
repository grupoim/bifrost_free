<?php 
use Carbon\Carbon;
class CotizacionControlador extends ModuloControlador{
	
	function __construct(){
		$this->data["module"] = "Cotización";
		$this->data["icon"] = "shopping-cart";
		$this->department = Auth::user()->departamento->nombre;
	}


	public function getIndex(){
		$dataModule["cotizaciones"] = Venta::with('cliente.persona')->where('cotizacion', 1)->get();
		$dataModule['formas_pago'] = FormaPago::all();
		$dataModule['db'] = ConfiguracionGeneral::where('empresa_id', 1)->where('activo', 1)->firstorFail();		
		return View::make($this->department.".main", $this->data)->nest('child', $this->department.'.cotizacion', $dataModule);
	}

	public function getAllcotizacion(){
		$cotizaciones = Venta::with('cliente.persona')->where('cotizacion', 1)->get();
		
		return  $cotizaciones;
	}

	public function getTotal(){
		$count_cotizaciones = Venta::where('cotizacion', 1)->count();
		return Response::json(array('total' => $count_cotizaciones));
	}

	public function getAll(){
		return DB::table('venta')->leftJoin('cliente', 'venta.cliente_id', '=', 'cliente.id')
		->leftJoin('persona', 'cliente.persona_id', '=', 'persona.id')
		->select('venta.fecha', DB::raw("CONCAT(persona.nombres, ' ', persona.apellido_paterno, ' ', persona.apellido_materno) as nombre"))
		->where('cotizacion', 1)
		->take(3)->get();
	}
	
	public function postStore(){
		
		if(Input::has('porcentaje_especial')){

			$porcentaje_vendedor = Input::get('porcentaje_especial');
		}else{
			
			$start = new Carbon('first day of this month');
		$finish = new Carbon('last day of this month');

		$inicio =  $start->format('Y-m-d');
		$fin = $finish->format('Y-m-d');

			$porcentaje_comision = ComisionEsquemaVendedor::leftJoin('esquema_comision', 'comision_esquema_vendedor.esquema_comision_id', '=', 'esquema_comision.id')
		->where('asesor_id', Input::get('asesor_id'))
		->where('comision_esquema_vendedor.fecha_inicio','>=', $inicio)
		->where('comision_esquema_vendedor.fecha_fin', '<=', $fin)->firstOrFail();

		$porcentaje_vendedor = $porcentaje_comision->porcentaje;
		}

		
		$venta = new Venta();
		$venta->id = Input::get('venta_id');
		$venta->cliente_id = Input::get('cliente_id');
		$venta->folio_solicitud = Input::get('folio_solicitud');
		$venta->descuento = Input::get('descuento');
		$venta->asesor_id = Input::get('asesor_id');
		$venta->fecha = Carbon::now();
		$venta->comentarios = Input::get('comentarios');
		
		$cart = Session::pull('productos', array());
		$products = array();
		$total = 0;
		$total_comision = 0;
		foreach($cart as $item){

			$servicio = VistaServicioFuneral::find($item['producto_id']);
			if (count($servicio) > 0) {
				$serv = VistaServicioFuneral::find($item['producto_id']);
				$total_comision = ($serv->monto_comisionable * $item['cantidad'] )* ($porcentaje_vendedor / 100) ;
			}
			else
			{
				$total_comision += (($item['precio'] * $item['cantidad'] ) - (Input::get('descuento')/1.16)) * ($porcentaje_vendedor / 100);
			}
			$venta_producto = new VentaProducto();
			$venta_producto->venta_id = Input::get('venta_id');
			$venta_producto->producto_id = $item['producto_id'];
			$venta_producto->cantidad = $item['cantidad'];
			$venta_producto->precio_unitario = $item['precio'];
			$venta_producto->iva = 16;
			$venta_producto->total = ($item['precio'] * $item['cantidad']) * 1.16; 
			$total += $venta_producto->total;
			
			array_push($products, $venta_producto);
		}

		$venta->total = $total - $venta->descuento;

		$plan_pago = PlanPago::find(Input::get('plan_pago'));
		$plan_pago_venta = new PlanPagoVenta();
		$plan_pago_venta->venta_id = Input::get('venta_id');
		$plan_pago_venta->plan_pago_id = $plan_pago->id;
		$plan_pago_venta->fecha_aplicado = Carbon::now();
		$plan_pago_venta->pago_regular = round(($venta->total - ($venta->total * $plan_pago->porcentaje_anticipo / 100)) / $plan_pago->numero_pagos,3);

		$venta->save();
		$venta->ventaproducto()->saveMany($products);
		$venta->planpagoventa()->save($plan_pago_venta);
		
		if(!Input::has('directa') && $total_comision > 0){
			$comision = new Comision();
			$comision->id = Input::get('venta_id');
			$comision->asesor_id = Input::get('asesor_id');
			$comision->total = round($total_comision,2);
			$comision->total_comisionable = round($total_comision,2);
			$comision->numero_pagos = $plan_pago->numero_comisiones;
			$comision->porcentaje = $porcentaje_vendedor;
			$venta->comision()->save($comision);
		}
		return Redirect::action('CotizacionControlador@getIndex');
	}

	public function postLote(){
		if(!Session::has('cotizacion.productos')){
			Session::put('cotizacion.productos', array());
		}
		$lote = TerrenoDisponible::where('lote_id', '=', Input::get('lote_id'))->firstOrFail();
		$producto["id"] = $lote->producto_id;
		$producto["cantidad"] = 1;
		$producto["descripcion"] = $lote->tipo;
		$producto["precio"] = $lote->monto;
		$producto["porcentaje_comision"] = $lote->procentaje_comision;

		Session::push('cotizacion.productos', $producto);
		return Redirect::action('CotizacionControlador@getCreate');
	}

public function postServicio(){
		if(!Session::has('cotizacion.productos')){
			Session::put('cotizacion.productos', array());
		}
		$servicio = VistaServicioFuneral::find(Input::get('producto_servicio_id'))->get;
		$producto["id"] = $servicio->id;
		$producto["cantidad"] = 1;
		$producto["descripcion"] = $servicio->nombre;
		$producto["precio"] = $servicio->precio_servicio * 1.16;
		$producto["porcentaje_comision"] = $servicio->porcentaje_comision;

		Session::push('cotizacion.productos', $producto);
		return Redirect::action('CotizacionControlador@getCreate');
	}

	public function postConstruccion(){
		if(!Session::has('cotizacion.productos')){
			Session::put('cotizacion.productos', array());
		}
		$servicio = VistaServicioFuneral::find(Input::get('producto_servicio_id'))->get;
		$producto["id"] = $servicio->id;
		$producto["cantidad"] = Input::get('cantidad');
		$producto["descripcion"] = $servicio->nombre;
		$producto["precio"] = $servicio->precio_servicio * 1.16;
		$producto["porcentaje_comision"] = $servicio->porcentaje_comision;

		Session::push('cotizacion.productos', $producto);
		return Redirect::action('CotizacionControlador@getCreate');
	}
	public function getAutorizar($id){
		$cotizacion = Venta::find($id);
		$cotizacion->autorizado = 1;
		$cotizacion->save();
		return Redirect::back();
	}

	public function getBloquear($id){
		$cotizacion = Venta::find($id);
		$cotizacion->autorizado = 0;
		$cotizacion->save();
		return Redirect::back();
	}

	
	public function getAbonar($id){

		$venta =  Venta::leftJoin('plan_pago_venta', 'venta.id', '=', 'plan_pago_venta.venta_id')
		->leftJoin('plan_pago', 'plan_pago_venta.plan_pago_id', '=', 'plan_pago.id')
		->where('venta.id', $id)
		->where('cotizacion',1)->firstorFail();
		
		$last_receipt = Recibo::select('recibo.*', DB::raw('MAX(recibo.id) AS max'))->where('venta_id', $id)->where('pagado',1)->first();
		
		$total_pagado = Pago::select('pago.recibo_id as recibo_id',DB::raw('SUM(pago.monto) as abono'))
			->leftJoin('recibo','pago.recibo_id', '=', 'recibo.id')
			->where('pago.cancelado',0)
			->where('recibo.venta_id', $id )			
			->groupby('recibo.venta_id')->first();

		if ($total_pagado != null) {
			$pagado = $total_pagado->abono;
		 }	else{
		 	$pagado = 0;
		 }


		$venta_total = $venta->total;
		$porcentaje_anticipo = $venta->porcentaje_anticipo;
		$mensualidad = $venta->pago_regular;
		$numero_mensualidades = $venta->numero_pagos;
		$enganche_monto = ($venta_total * $porcentaje_anticipo)/100;

		if ($porcentaje_anticipo > 0) {
			$consecutivo = 0;
			$primer_pago = $enganche_monto;
			$leyenda = 'Enganche';
			$enganche = 1;
		}else{
			$consecutivo = 1;
			$primer_pago = $mensualidad;
			$leyenda = 'Mensualidad';
			$enganche = 0;
		} 
		$saldo_primer_pago = $primer_pago - $pagado;
		$saldo_total = $venta->total - $pagado;

		if ($pagado >= $primer_pago) {
			$cotizacion = 0;
			$autorizado = 1;
		}else{
			$cotizacion = 1;
			$autorizado = 0;
		}
		$numero_mensualidades = $venta->numero_pagos;

		return array(
			'mensualidad' => $venta->pago_regular,
			'numero_mensualidades' => $numero_mensualidades,
			'primer_pago' => $primer_pago,
			'consecutivo' => $consecutivo,
			'leyenda' => $leyenda,
			'venta_id' => $venta->venta_id,
			'saldo_primer_pago'=> $saldo_primer_pago,
			'cotizacion' => $cotizacion,
			'autorizado' => $autorizado,
			'pagado' => $pagado,
			'enganche' => $enganche,
			'enganche_monto' => $enganche_monto,
			'porcentaje_anticipo' => $venta->porcentaje_anticipo,
			'saldo_total' => $saldo_total,
			'last_receipt' => $last_receipt,
			 );


	}

	public function postAbonar(){

		$optionpago = Input::get('optionpago');
		$venta_id = Input::get('venta_id');
		$total_primer_pago = Input::get('total_primer_pago');
		$saldo_primer_pago = Input::get('saldo_primer_pago');
		$mensualidad = input::get('mensualidad');
		$consecutivo = Input::get('consecutivo');		
		$forma_pago_id = Input::get('forma_pago_id');
		$enganche = input::get('enganche');
		$pagado = input::get('pagado');	
		$numero_mensualidades = input::get('numero_mensualidades');
		$saldo_total = input::get('saldo_total');
		$hoy = carbon::now();

		$venta = Venta::leftJoin('plan_pago_venta', 'venta.id', '=', 'plan_pago_venta.venta_id')
		->leftJoin('plan_pago','plan_pago_venta.plan_pago_id', '=', 'plan_pago.id')
		->where('venta.id', $venta_id)
		->first();
		
	
		
		$step_meses = $venta->periodo;
		$fecha_limite = $hoy->format('Y-m-d');
		//verifica si ya hay pagos, si no hay, primero crea el recibo		

	switch ($optionpago) {
		case '1':
			//verifica si ya hay pagos, si no hay, primero crea el recibo y lo abonas
		$abono = input::get('abono');
		if ($pagado == 0 and $saldo_primer_pago > 0) {

			$recibo = new Recibo();
			$recibo->consecutivo = $consecutivo;
			$recibo->venta_id = $venta_id;
			$recibo->fecha_limite = $fecha_limite;
			$recibo->pagado = 1;
			$recibo->monto = $total_primer_pago;
			$recibo->save();		
			
			
		}else{

			$recibo = Recibo::where('consecutivo', $consecutivo)->firstOrFail();

		}
		//Se registra el pago al primer recibo
			$pago = new Pago();
			$pago->recibo_id = $recibo->id;
			$pago->monto =  $abono;
			$pago->forma_pago_id = $forma_pago_id;			
			$pago->usuario_id = Auth::user()->id;
			$pago->save();

		
			//se checa cuanto lleva abonado ese recibo
		$pagado_r = Recibo::select('recibo.id as recibo_id','recibo.consecutivo',DB::raw('SUM(pago.monto) as abono'))
										->leftJoin('pago','recibo.id', '=', 'pago.recibo_id')
										->where('recibo.venta_id', $venta_id)
										->where('pago.cancelado',0)
										->where('recibo.id',$recibo->id)->firstOrFail();
		//si el monto total del recibo es igual a lo pagado, se actualiza el estatus a pagado y se genera el 
		//siguiente recibo
		$update_recibo = Recibo::find($pagado_r->recibo_id);
			
		
		$total_pago_venta = Pago::select('pago.*', DB::raw('sum(pago.monto) as total_pago'))
		->leftJoin('recibo','pago.recibo_id', '=', 'recibo.id')
		->where('recibo.venta_id', $venta_id)->where('pago.cancelado',0)->where('recibo.cancelado',0)->first();
		
		if ($update_recibo->monto == $pagado_r->abono) {


			$resto_total = $venta->total - $total_pago_venta->total_pago;
			if ($resto_total > 0) {
			//genera el siguiente recibo si aún hay adeudos

			$last_fecha_limite = Carbon::parse($update_recibo->fecha_limite);
			$new_fecha_limite = $last_fecha_limite->addMonths($step_meses);
			
			$next_recibo  = new Recibo();
			$next_recibo->consecutivo = $update_recibo->consecutivo + 1;
			$next_recibo->venta_id = $venta_id;
			$next_recibo->fecha_limite = $new_fecha_limite;
			$next_recibo->monto = $mensualidad;
			$next_recibo->save();	# code...
			}
			
		//actualiza la venta, deja de ser cotización al pagarse el total del anticipo
			$update_recibo->pagado = 1;
			$update_recibo->save();

			$venta_update = Venta::find($venta_id);
			$venta_update->cotizacion = 0;
			$venta_update->save();
		
	}




			return Redirect::action('VentaControlador@getRecibos',$venta_id);
			break;

		case '2':

			$abono = input::get('monto');			

			//-----revisa si es el primer pago

			if ($pagado == 0) {
			
				//genera el primer recibo con el monto del primer pago
				$recibo = new Recibo();
				$recibo->consecutivo = $consecutivo;
				$recibo->venta_id = $venta_id;
				$recibo->fecha_limite = $fecha_limite;				
				$recibo->monto = $total_primer_pago;
				$recibo->save();

				//revisa el monto del abono

				if ($abono < $total_primer_pago) {
					//Se registra el pago al primer recibo
					$pago_anticipo = new Pago();
					$pago_anticipo->recibo_id = $recibo->id;
					$pago_anticipo->monto =  $abono;
					$pago_anticipo->forma_pago_id = $forma_pago_id;			
					$pago_anticipo->usuario_id = Auth::user()->id;
					$pago_anticipo->save();

				return Redirect::back();

					
				}
				//el abono es mayor al primer pago, se paga el primer pago se actualiza el anticipo y la venta y con el resto se checan cuantas menusalidades se cubren
				else{

					
					$pago_anticipo = new Pago();
					$pago_anticipo->recibo_id = $recibo->id;
					$pago_anticipo->monto =  $total_primer_pago;
					$pago_anticipo->forma_pago_id = $forma_pago_id;			
					$pago_anticipo->usuario_id = Auth::user()->id;
					$pago_anticipo->save();


					//paga anticipo
					$recibo_anticipo = Recibo::find($recibo->id);
					$recibo_anticipo->pagado = 1;
					$recibo_anticipo->save();

					//venta actualiza, deja de ser cotizacion
					$venta_update = Venta::find($venta_id);
					$venta_update->cotizacion = 0;
					$venta_update->save();
					// con lo que queda se completan las siguientes mensualidades
					//verifico cuantas mensualidades me cubre el resto del abono y genero los pagos y los recibos
					
					$resto_abono = $abono - $total_primer_pago;
										
					$pagos = $resto_abono/$mensualidad;
					$pagos_completos = intval($pagos);
					$pago_parcial = $pagos - $pagos_completos;
	
					$monto_recibos_completos = $pagos_completos * $mensualidad;
					$monto_resto = $resto_abono - $monto_recibos_completos;	
					
					$total_pago_venta = Pago::select('pago.*', DB::raw('sum(pago.monto) as total_pago'))
					->leftJoin('recibo','pago.recibo_id', '=', 'recibo.id')
					->where('recibo.venta_id', $venta_id)->where('pago.cancelado',0)->where('recibo.cancelado',0)->first();
					
					$resto_total = $venta->total - $total_pago_venta->total_pago;
					$deadDate = explode('-', $recibo->fecha_limite);
					$beginPlan = Carbon::createFromDate($deadDate[0], $deadDate[1], $deadDate[2], null);
					$consecutivo_new = $recibo->consecutivo + 1;

					
						//si cubre mas de un pago completo se generan los completos mas el parcial
					if ($pagos_completos >= 1 && $pago_parcial > 0 ) {
							$subsecuente_r = $pagos_completos - 1;


								for ($i=0; $i < $pagos_completos; $i++) { 
						
						$subsecuente_recibo = new Recibo();
						$subsecuente_recibo->consecutivo = $consecutivo_new;
						$subsecuente_recibo->venta_id = $venta_id;
						$subsecuente_recibo->fecha_limite = $beginPlan->addMonths($step_meses);
						$subsecuente_recibo->monto = $mensualidad;
						$subsecuente_recibo->pagado = 1;
						$subsecuente_recibo->save();

						
						$pago_subsecuente = new Pago();
						$pago_subsecuente->recibo_id = $subsecuente_recibo->id;
						$pago_subsecuente->forma_pago_id = $forma_pago_id;
						$pago_subsecuente->monto = $mensualidad;
						$pago_subsecuente->usuario_id = Auth::user()->id;
						$pago_subsecuente->save();
						
						$consecutivo_new++;


					}

					//genera el parcial
					if ($pago_parcial > 0 and $pagos_completos > 0) {
		$step = $pagos_completos + 1;
	}else
	{
		$step = $pagos_completos;
	}

	
		if ($resto_total > 0) {
		$first = Recibo::find($recibo->id);
			$first_fecha = Carbon::parse($first->fecha_limite);
			
		$last_fecha = $first_fecha->addMonths($step);
		$ult_consecutivo = $first->consecutivo + $step;	

		$pago_venta = Pago::select('pago.*', DB::raw('sum(pago.monto) as total_pago'))
				->leftJoin('recibo','pago.recibo_id', '=', 'recibo.id')
				->where('recibo.venta_id', $venta_id)->where('pago.cancelado',0)->where('recibo.cancelado',0)
				->first();
				
				$saldo_venta =  $venta->total - $pago_venta->total_pago;
				
				$ch_last = Recibo::select('recibo.*', DB::raw('MAX(id) as max'))->where('cancelado')->first();
				$ch_last_date = Carbon::parse($ch_last->fecha_limite);

	if($numero_mensualidades <= $ch_last->consecutivo and  $saldo_venta > 1)
	{
	
	$recibo_parcial = new Recibo();
			$recibo_parcial->consecutivo = $ult_consecutivo;
			$recibo_parcial->venta_id = $venta_id;
			$recibo_parcial->fecha_limite = $last_fecha;
			$recibo_parcial->monto = $mensualidad;
			$recibo_parcial->save();
	
	if ($pago_parcial > 0) {
	
			$pago = new Pago();
			$pago->recibo_id  = $recibo_parcial->id;
			$pago->forma_pago_id = $forma_pago_id;
			$pago->usuario_id = Auth::user()->id;
			$pago->monto = $monto_resto;
			$pago->save();

		}
		}
		}


					}else{

					$first = Recibo::find($recibo->id);
			$first_fecha = Carbon::parse($first->fecha_limite);
			$step = $pagos_completos + 1;
		$last_fecha = $first_fecha->addMonths($step);
		$ult_consecutivo = $first->consecutivo + $step;
			
			$recibo_parcial = new Recibo();
			$recibo_parcial->consecutivo = $ult_consecutivo;
			$recibo_parcial->venta_id = $venta_id;
			$recibo_parcial->fecha_limite = $last_fecha;
			$recibo_parcial->monto = $mensualidad;
			$recibo_parcial->save();
			$pago = new Pago();
			$pago->recibo_id  = $recibo_parcial->id;
			$pago->forma_pago_id = $forma_pago_id;
			$pago->usuario_id = Auth::user()->id;
			$pago->monto = $monto_resto;
			$pago->save();
					}
					
					
					
					
				
return Redirect::action('VentaControlador@getRecibos',$venta_id);




				}


			
			}//fin primer pago
			//no es el primer pago
			elseif($pagado > 0){
				$recibo = Recibo::where('consecutivo', $consecutivo)->first();

				//se checa cuanto lleva abonado ese recibo
		$pagado_r = Recibo::select('recibo.id as recibo_id','recibo.consecutivo',DB::raw('SUM(pago.monto) as abono'))
										->leftJoin('pago','recibo.id', '=', 'pago.recibo_id')
										->where('recibo.venta_id', $venta_id)
										->where('pago.cancelado',0)
										->where('recibo.id',$recibo->id)->firstOrFail();

			//si el monto del abono es menor al resto del recibo, se paga todo el abono, 
			$resto_recibo = $recibo->monto - $pagado_r->abono;
			 if ($abono < $resto_recibo ) {
			 	$pago = new Pago();
			 	$pago->recibo_id = $recibo->id;
			 	$pago->forma_pago_id = $forma_pago_id;
			 	$pago->monto = $abono;
			 	$pago->usuario_id = Auth::user()->id;
			 	$pago->save();

			 //revisa cuanto se ha pagado de ese recibo

			$pagado_recibo = Recibo::select('recibo.id as recibo_id','recibo.consecutivo',DB::raw('SUM(pago.monto) as abono'))
										->leftJoin('pago','recibo.id', '=', 'pago.recibo_id')
										->where('recibo.venta_id', $venta_id)
										->where('pago.cancelado',0)
										->where('recibo.id',$recibo->id)->firstOrFail();
			 //si el monto del recibo es igual al recibo se actualiza a pagado, se verifica si hay adeudos y se genera el siguiente recibo 

				if ($pagado_recibo->abono >= $recibo->monto) {
					
					$venta_update = Venta::find($venta_id);
					$recibo_update = Recibo::find($recibo->id);

					
					$recibo_update->pagado = 1;
					$recibo_update->save();

					$venta_update->cotizacion = 0;
					$venta_update->save();


				$pago_venta = Pago::select('pago.*', DB::raw('sum(pago.monto) as total_pago'))
				->leftJoin('recibo','pago.recibo_id', '=', 'recibo.id')
				->where('recibo.venta_id', $venta_id)->where('pago.cancelado',0)->where('recibo.cancelado',0)
				->first();
					

					if ($pago_venta->total_pago < $venta->total) {
						
						$last_fecha_limite = Carbon::parse($recibo->fecha_limite);
						$new_fecha_limite = $last_fecha_limite->addMonth();

						$new_recibo = new Recibo();
						$new_recibo->consecutivo = $recibo->consecutivo + 1;
						$new_recibo->venta_id = $venta_id;
						$new_recibo->fecha_limite = $new_fecha_limite;
						$new_recibo->monto = $mensualidad;
						$new_recibo->save();
						return Redirect::back();
					}

				}

				

				}else{
					//paga el resto del recibo y genera n numero de recibos que se cubran con el resto del abono

					$pago = new Pago();
					$pago->recibo_id = $recibo->id;
					$pago->forma_pago_id = $forma_pago_id;
					$pago->monto = $resto_recibo;
					$pago->usuario_id = Auth::user()->id;
					$pago->save();


					$venta_update = Venta::find($venta_id);
					$recibo_update = Recibo::find($recibo->id);

					
					$recibo_update->pagado = 1;
					$recibo_update->save();

					$venta_update->cotizacion = 0;
					$venta_update->save();

					$resto_abono = $abono - $resto_recibo;

					$pagos = $resto_abono/$mensualidad;
					$pagos_completos = intval($pagos);
					$pago_parcial = $pagos - $pagos_completos;
	
					$monto_recibos_completos = $pagos_completos * $mensualidad;
					$monto_resto = $resto_abono - $monto_recibos_completos;	
					
					$total_pago_venta = Pago::select('pago.*', DB::raw('sum(pago.monto) as total_pago'))
					->leftJoin('recibo','pago.recibo_id', '=', 'recibo.id')
					->where('recibo.venta_id', $venta_id)->where('pago.cancelado',0)->where('recibo.cancelado',0)->first();
					
					$resto_total = $venta->total - $total_pago_venta->total_pago;
					$deadDate = explode('-', $recibo->fecha_limite);
					$beginPlan = Carbon::createFromDate($deadDate[0], $deadDate[1], $deadDate[2], null);
					$consecutivo_new = $recibo->consecutivo + 1;

					//si cubre mas de un pago completo se generan los completos mas el parcial
					if ($pagos_completos >= 1 && $pago_parcial > 0 ) {
							$subsecuente_r = $pagos_completos - 1;


								for ($i=0; $i < $pagos_completos; $i++) { 
						
						$subsecuente_recibo = new Recibo();
						$subsecuente_recibo->consecutivo = $consecutivo_new;
						$subsecuente_recibo->venta_id = $venta_id;
						$subsecuente_recibo->fecha_limite = $beginPlan->addMonths($step_meses);
						$subsecuente_recibo->monto = $mensualidad;
						$subsecuente_recibo->pagado = 1;
						$subsecuente_recibo->save();

						
						$pago_subsecuente = new Pago();
						$pago_subsecuente->recibo_id = $subsecuente_recibo->id;
						$pago_subsecuente->forma_pago_id = $forma_pago_id;
						$pago_subsecuente->monto = $mensualidad;
						$pago_subsecuente->usuario_id = Auth::user()->id;
						$pago_subsecuente->save();
						
						$consecutivo_new++;


					}

					//genera el parcial
					if ($pago_parcial > 0 and $pagos_completos > 0) {
		$step = $pagos_completos + 1;
	}else
	{
		$step = $pagos_completos;
	}


		if ($resto_total > 0) {
			$first = Recibo::find($recibo->id);
			$first_fecha = Carbon::parse($first->fecha_limite);
			
		$last_fecha = $first_fecha->addMonths($step);
		$ult_consecutivo = $first->consecutivo + $step;

		$pago_venta = Pago::select('pago.*', DB::raw('sum(pago.monto) as total_pago'))
				->leftJoin('recibo','pago.recibo_id', '=', 'recibo.id')
				->where('recibo.venta_id', $venta_id)->where('pago.cancelado',0)->where('recibo.cancelado',0)
				->first();
				
				$saldo_venta =  $venta->total - $pago_venta->total_pago;
				
				$ch_last = Recibo::select('recibo.*', DB::raw('MAX(id) as max'))->where('cancelado')->first();
				$ch_last_date = Carbon::parse($ch_last->fecha_limite);

	if($numero_mensualidades <= $ch_last->consecutivo and  $saldo_venta > 1)
	{
	
	$recibo_parcial = new Recibo();
			$recibo_parcial->consecutivo = $ult_consecutivo;
			$recibo_parcial->venta_id = $venta_id;
			$recibo_parcial->fecha_limite = $last_fecha;
			$recibo_parcial->monto = $mensualidad;
			$recibo_parcial->save();
	
	if ($pago_parcial > 0) {
	
			$pago = new Pago();
			$pago->recibo_id  = $recibo_parcial->id;
			$pago->forma_pago_id = $forma_pago_id;
			$pago->usuario_id = Auth::user()->id;
			$pago->monto = $monto_resto;
			$pago->save();

		}
		}
		}


					}


				}

			



return Redirect::action('VentaControlador@getRecibos',$venta_id);

			}//----fin no es el primer pago



























			
			break;
		
		default:
			$abono = input::get('monto');
			break;
	}
		
	

		$venta_up = Venta::find($venta_id);

		if ($venta_up->cotizacion == 0) {
		return Redirect::action('VentaControlador@getRecibos',$venta_id);
		}else{
			return Redirect::back();
		}
		
	}
		

	public function getContratar($id){
		
		$cotizacion = Venta::with('planpagoventa')->find($id); 

		$recibos_generados = Recibo::where('venta_id', $cotizacion->id)->where('cancelado',0)->count();
		
		if ($recibos_generados != 0) {
			$ultimo_recibo_venta = Recibo::select(DB::raw( 'IFNULL(MAX(recibo.consecutivo),0) AS last_consecutive'))->where('venta_id', $cotizacion->id)->get();
			$last_consecutive = $ultimo_recibo_venta->last_consecutive;

		}else{
			$last_consecutive = 0;
		}

		//se genera el primer recibo de ventas
		$recibo = new Recibo();
		$recibo->fecha_limite = Carbon::now();
		$recibo->consecutivo = $last_consecutive + 1;
		
		$plan_pago = PlanPago::find($cotizacion->planpagoventa[0]->plan_pago_id);
		
		if ($plan_pago->porcentaje_anticipo == 0) {
		$recibo->monto = $cotizacion->planpagoventa[0]->pago_regular;	# code...
		}else{

		$recibo->monto = ($cotizacion->total * $plan_pago->porcentaje_anticipo) / 100;
		}
		$cotizacion->cotizacion = 0;
		
		$cotizacion->recibo()->save($recibo);
		
		$cotizacion->save();
		/*echo DNS1D::getBarcodeHTML("4445645656", "EAN13");*/
		/*echo $ultimo_recibo_venta;*/
		return Redirect::action('CotizacionControlador@getIndex');
	}

	public function getVaciacart(){


		Session::forget('cotizacion.productos');
		return Redirect::back();
	}
	

	 public function getVaciaitem($key){
	 	//$data = Session::get('productos'); 	

	 	Session::forget('productos.'.$key);

	 	return Redirect::back();

	 	

	 }

	  public function getItem(){
	 	//$data = Session::get('productos'); 	

	 	$data = Session::get('productos');

	 	return $data;

	 	

	 }

	public function getCreate($id)
	{
		$data["productoz"] = Producto::select('producto.id as id', 'producto.nombre as name', 'precio.monto as cost')->leftJoin('precio', 'producto.id', '=', 'precio.producto_id')->where('precio.activo', 1)->get();
		$data["plans"] = PlanPago::all();
		$data["productos"] = Session::get('productos', array());
		$data['db'] = ConfiguracionGeneral::where('empresa_id', 1)->where('activo', 1)->firstorFail();
		$total = 0;
		foreach($data["productos"] as $key => $producto){
			$total += $producto["subtotal"];			
		}
		$data["total"] = $total;
		$data["persona"]  = Persona::with('cliente', 'cliente.colonia', 'cliente.colonia.municipio')->find($id);
		//$persona = Persona::with('cliente', 'cliente.colonia', 'cliente.colonia.municipio')->find($id);
		$data["coupons"] = Cupon::where('cliente_id', $data["persona"]->cliente->id)->get();
		return View::make($this->department.".main", $this->data)->nest('child', 'formularios.cotizacion', $data);
	}

	public function postAgregarProducto(){	
			$producto = Producto::find(Input::get('producto_id'));			
			$cantidad = Input::get('cantidad');			

			$precio = precio::where('producto_id', $producto->id)->where('activo',1)->first();
 
			$productos = Session::pull('productos', array());
			array_push($productos, array('producto_id'=> $producto->id,
										'precio' => $precio->monto,
										'subtotal'=> $cantidad * $precio->monto, 
										'descripcion' =>$producto->nombre,
										'cantidad' => $cantidad,
										'porcentaje_comision' => $producto->porcentaje_comision));
 

				Session::put('productos',$productos);
			
		{

		return Response::json($productos);
	}
	}
}
