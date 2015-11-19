<?php 
class CotizacionControlador extends ModuloControlador{
	
	function __construct(){
		$this->data["module"] = "Cotización";
		$this->data["icon"] = "shopping-cart";
		$this->department = Auth::user()->departamento->nombre;
	}


	public function getIndex(){
		$dataModule["cotizaciones"] = Venta::with('cliente.persona')->where('cotizacion', 1)->get();
		return View::make($this->department.".main", $this->data)->nest('child', 'ventas.cotizacion', $dataModule);
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
		$venta = new Venta();
		$venta->cliente_id = Input::get('cliente_id');
		$venta->folio_solicitud = Input::get('folio');
		$venta->descuento = Input::get('descuento');
		$venta->fecha = Carbon\Carbon::now();
		$venta->comentarios = Input::get('comentarios');
		
		$cart = Session::pull('productos', array());
		$products = array();
		$total = 0;
		$total_comision = 0;
		foreach($cart as $item){
			$venta_producto = new VentaProducto();
			$venta_producto->producto_id = $item['producto_id'];
			$venta_producto->cantidad = $item['cantidad'];
			$venta_producto->precio_unitario = $item['precio'];
			$venta_producto->iva = 16;
			$venta_producto->total = ($item['precio'] * $item['cantidad']) * (100 + 16) / 100; 
			$total += $venta_producto->total;
			$total_comision += ($item['precio'] * ($item['porcentaje_comision']) / 100);
			array_push($products, $venta_producto);
		}

		$venta->total = $total - $venta->descuento;

		$plan_pago = PlanPago::find(Input::get('plan_pago'));
		$plan_pago_venta = new PlanPagoVenta();
		$plan_pago_venta->plan_pago_id = $plan_pago->id;
		$plan_pago_venta->fecha_aplicado = Carbon\Carbon::now();
		$plan_pago_venta->pago_regular = ($total - ($total * $plan_pago->porcentaje_anticipo / 100)) / $plan_pago->numero_pagos;

		$venta->save();
		$venta->ventaproducto()->saveMany($products);
		$venta->planpagoventa()->save($plan_pago_venta);
		if(!Input::has('directa')){
			$comision = new Comision();
			$comision->asesor_id = Input::get('asesor_id');
			$comision->total = $total_comision;
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

	public function getContratar($id){
		$cotizacion = Venta::with('planpagoventa')->find($id);

		$recibo = new Recibo();
		$recibo->fecha_limite = Carbon\Carbon::now();
		$plan_pago = PlanPago::find($cotizacion->planpagoventa[0]->plan_pago_id);
		$recibo->monto = ($cotizacion->total * $plan_pago->porcentaje_anticipo) / 100;
		$cotizacion->cotizacion = 0;
		$cotizacion->recibo()->save($recibo);
		$cotizacion->save();
		return Redirect::action('CotizacionControlador@getIndex');
	}

	public function getCreate($id)
	{
		$data["plans"] = PlanPago::all();
		$data["productos"] = Session::get('productos', array());
		$total = 0;
		foreach($data["productos"] as $producto){
			$total += $producto["subtotal"];
		}
		$data["total"] = $total;
		$data["persona"]  = Persona::with('cliente', 'cliente.colonia', 'cliente.colonia.municipio')->find($id);
		$data["coupons"] = Cupon::where('cliente_id', $id)->get();
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
