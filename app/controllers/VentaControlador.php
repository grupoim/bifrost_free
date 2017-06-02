<?php 
	use Carbon\Carbon;
	class VentaControlador extends ModuloControlador{

		function __construct(){
		$this->data["module"] = "Seguimiento de ventas";
		$this->data["icon"] = "shopping-cart";
		$this->department = Auth::user()->departamento->nombre;
	}
		
		public function getIndex(){

		
		$dataModule["cotizaciones"] = Venta::with('cliente.persona')
		->leftJoin('plan_pago_venta', 'venta.id', '=', 'plan_pago_venta.venta_id')
		->leftJoin('plan_pago', 'plan_pago_venta.plan_pago_id', '=', 'plan_pago.id')
		->where('cotizacion',0)->get();
		
		$dataModule['db'] = ConfiguracionGeneral::where('empresa_id', 1)->where('activo', 1)->firstorFail();		
		return View::make($this->department.".main", $this->data)->nest('child', $this->department.'.ventas', $dataModule);
	
			
		}

		public function getEstadisticos(){			

		setlocale(LC_TIME, 'spanish');  
 		$mes=strftime("%B",mktime(0, 0, 0, date('m'), 1, 2000));
 		$anio = date('Y');
		
		$pagos = Pago:: where( DB::raw('YEAR(created_at)'), '=', date('Y'))
						->where( DB::raw('MONTH(created_at)'), '=', date('m'))
						->where('cancelado',0)
						->sum('monto');

		$ventas = Venta::where( DB::raw('YEAR(fecha)'), '=', date('Y') )		
						->where( DB::raw('MONTH(fecha)'), '=', date('m') )		
						->where('cancelada',0)
						->where('cotizacion',0)						
						->where('autorizado',1)
						->groupby(DB::raw('YEAR(fecha)'),DB::raw('MONTH(fecha)'))
						->orderby('fecha')
						->sum('total');						

		return Response::json(
							array(
								"ventas"=>  number_format($ventas, 0,".", ","),
								"ingresos" =>  number_format($pagos, 0,".", ","),
								"mes" => Str::title($mes).' de '.$anio

								));
	}

	public function getRecibos($id){
			
			$recibos = Recibo::where('venta_id', '=', $id)->get();
			
			$total_pagado = Pago::select('pago.recibo_id as recibo_id',DB::raw('SUM(pago.monto) as abono'))
			->leftJoin('recibo','pago.recibo_id', '=', 'recibo.id')
			->where('pago.cancelado',0)
			->where('recibo.venta_id', $id )			
			->groupby('recibo.venta_id')->first();

			$venta = Venta::leftJoin('vista_clientes', 'venta.cliente_id', '=', 'vista_clientes.id')
						->leftJoin('plan_pago_venta', 'venta.id', '=', 'plan_pago_venta.venta_id')
						->leftJoin('plan_pago', 'plan_pago_venta.plan_pago_id', '=', 'plan_pago.id')
						->where('venta.id',$id)->firstorFail();

			
			$saldo_venta = $venta->total - $total_pagado->abono;
			
			if ($recibos != null) {
				$dataModule["recibos"] = $recibos;
			}
			else{
				$dataModule["recibos"] = 0;
			}
			$dataModule['formas_pago'] = FormaPago::all();
			
			$dataModule['total_pagado'] = $total_pagado;
			$dataModule["saldo_venta"] = $saldo_venta;
			$dataModule["venta"] = $venta;
			$dataModule["abono_recibo"] = Recibo::select('recibo.id as recibo_id',DB::raw('SUM(pago.monto) as abono'))
										->leftJoin('pago','recibo.id', '=', 'pago.recibo_id')
										->where('recibo.venta_id', $id)
										->where('pago.cancelado',0)
										->groupby('recibo.id')->get();

			$dataModule['db'] = ConfiguracionGeneral::where('empresa_id', 1)->where('activo', 1)->firstorFail();		
			return View::make($this->department.".main", $this->data)->nest('child', $this->department.'.ventasrecibos', $dataModule);
	


	}

	public function getAbonar($id,$recibo_id){

		$recibo = Recibo::find($recibo_id);

		$venta =  Venta::with('cliente.persona')
		->leftJoin('plan_pago_venta', 'venta.id', '=', 'plan_pago_venta.venta_id')
		->leftJoin('plan_pago', 'plan_pago_venta.plan_pago_id', '=', 'plan_pago.id')
		->where('venta.id', $id)
		->where('cotizacion',0)->firstorFail();


		$pagado = Recibo::select('recibo.id as recibo_id',DB::raw('SUM(pago.monto) as abono'))
										->leftJoin('pago','recibo.id', '=', 'pago.recibo_id')
										->where('recibo.venta_id', $id)
										->where('pago.cancelado',0)
										->where('recibo.id',$recibo_id)->first();

		/*Pago::select('pago.recibo_id as recibo_id',DB::raw('SUM(pago.monto) as abono'))
			->leftJoin('recibo','pago.recibo_id', '=', 'recibo.id')
			->where('recibo.venta_id', $id)
			->where('pago.cancelado',0)
			->where('pago.recibo_id',$recibo_id)
			->groupby('recibo.id')->get();
		*/
		

		if ($pagado != null) {
			$abonado_recibo = $pagado->abono;
		 }	else{
		 	$abonado_recibo = 0;
		 }



		$total_pagado = Pago::select('pago.recibo_id as recibo_id',DB::raw('SUM(pago.monto) as abono'))
			->leftJoin('recibo','pago.recibo_id', '=', 'recibo.id')
			->where('pago.cancelado',0)
			->where('recibo.venta_id', $id )			
			->groupby('recibo.venta_id')->first();
		
		if ($total_pagado != null) {
			$abonado_venta = $total_pagado->abono;
		 }	else{
		 	$abonado_venta = 0;
		 }



		$saldo = $venta->total- $abonado_venta;

		$por_pagar = $recibo->monto - $abonado_recibo;
	
	$consecutivo = Recibo::select('recibo.*', DB::raw('max(consecutivo) as maximo'))->where('venta_id', $id)->get();
	return  array(
			'total_recibo' => $recibo->monto,
			'pagado'=>$abonado_recibo,
			'por_pagar'=>$por_pagar,
			'total_pagado'=> $abonado_venta,
			'saldo' => $saldo,
			'venta_total'=>$venta->total,
			'recibo_id'=>$recibo_id,
			'venta_id'=>$id,
			'consecutivo'=>$consecutivo,
		);
	}

	public function getTest($id){
		
			
		$venta =  Venta::with('cliente.persona')
		->leftJoin('plan_pago_venta', 'venta.id', '=', 'plan_pago_venta.venta_id')
		->leftJoin('plan_pago', 'plan_pago_venta.plan_pago_id', '=', 'plan_pago.id')
		->where('venta.id', $id)
		->where('cotizacion','=',1)->firstorFail();

		$total_pagado = Pago::select('pago.recibo_id as recibo_id',DB::raw('SUM(pago.monto) as abono'))
			->leftJoin('recibo','pago.recibo_id', '=', 'recibo.id')
			->where('pago.cancelado',0)
			->where('recibo.venta_id', $id )			
			->groupby('recibo.venta_id')->first();
		
		$consecutivo = Recibo::select('recibo.*', DB::raw('ifnull(max(consecutivo),0) as maximo'))->where('venta_id', $id)->firstorFail();
		
		$venta_total = $venta->total;
		$consecutive = $consecutivo->maximo;
		$porcentaje_anticipo = $venta->porcentaje_anticipo;
		$mensualidad = $venta->pago_regular;
		$numero_mensualidades = $venta->numero_pagos;
		$step_meses = $venta->periodo;
		$enganche = ($venta_total * $porcentaje_anticipo)/100;

		if ($total_pagado != null) {
			$pagado = $total_pagado->abono;
		 }	else{
		 	$pagado = 0;
		 }
		
		if ($consecutivo->maximo == 0 ) {
			$hoy = carbon::now();
			$last_fecha_limite = $hoy->format('Y-m-d');/*->addMonth()->format('Y-m-d');$hoy->format('Y-m-d');*/
		}
		else{
		$last_fecha_limite = $consecutivo->fecha_limite;
			
		}
	
		if ($porcentaje_anticipo > 0) {
			$consecutivo = 0;
			$primer_pago = $enganche;
			$leyenda = 'Enganche';
		}else{
			$consecutivo = 1;
			$primer_pago = $mensualidad;
			$leyenda = 'Mensualidad';
		} 
		$saldo_primer_pago = $primer_pago - $pagado;


		return array(
			'max' => $consecutive, 
			'last_date' => $last_fecha_limite,
			'pagado' => $pagado,
			/*'venta' => $venta,*/
			'enganche' => $enganche,
			'mensualidad'=>$mensualidad,
			'porcentaje_anticipo' => $porcentaje_anticipo,
			'numero_mensualidades' =>$numero_mensualidades,
			'saldo_primer_pago' => $saldo_primer_pago,
			'step_meses' => $step_meses,
			);

	}
	public function postPago(){

		$optionpago = Input::get('optionpago');
		$saldo_recibo = Input::get('saldo_recibo');
		$saldo_venta = Input::get('saldo_venta');
		$monto_diferente = Input::get('monto');
		$forma_pago_id = Input::get('forma_pago_id');
		$venta_id = Input::get('venta_id');
		$recibo_id = Input::get('recibo_id');
		
		$venta = Venta::leftJoin('plan_pago_venta', 'venta.id', '=', 'plan_pago_venta.venta_id')
		->leftJoin('plan_pago','plan_pago_venta.plan_pago_id', '=', 'plan_pago.id')
		->where('venta.id', $venta_id)
		->first();
		
		$recibo = Recibo::find($recibo_id);		
		$venta_total = $venta->total;
		$consecutivo = $recibo->consecutivo + 1;
		$porcentaje_anticipo = $venta->porcentaje_anticipo;
		$mensualidad = $venta->pago_regular;
		$numero_mensualidades = $venta->numero_pagos;
		$enganche = ($venta_total * $porcentaje_anticipo)/100;
		$step_meses = $venta->periodo;
		$last_fecha_limite = Carbon::parse($recibo->fecha_limite);
		$new_fecha_limite = $last_fecha_limite->addMonths($step_meses);

		switch ($optionpago) {
			case '1':
				
				//checa cuanto se debe de ese recibo
			$pagado = Recibo::select('recibo.id as recibo_id','recibo.consecutivo',DB::raw('SUM(pago.monto) as abono'))
										->leftJoin('pago','recibo.id', '=', 'pago.recibo_id')
										->where('recibo.venta_id', $venta_id)
										->where('pago.cancelado',0)
										->where('recibo.id',$recibo->id)->firstOrFail();

			$saldo_recibo_c = $recibo->monto - $pagado->abono;

			$abono = $saldo_recibo;

				$pago = new Pago;
				$pago->recibo_id = $recibo_id;
				$pago->forma_pago_id = $forma_pago_id;
				$pago->monto = $abono;
				$pago->usuario_id = Auth::user()->id;
				$pago->save();
			
			
//si el numero de mensualidades es menor que el consecutivo activo, se genera otro recibo
			if ($numero_mensualidades >= $recibo->consecutivo+1 and $saldo_venta > 0 ) {
		$recibo = new Recibo;
		 $recibo->consecutivo = $consecutivo;
		 $recibo->venta_id = $venta_id;
		 $recibo->fecha_limite = $new_fecha_limite;
		 $recibo->monto = $mensualidad;
		 $recibo->save();
			}

		$pagado = Recibo::select('recibo.id as recibo_id',DB::raw('SUM(pago.monto) as abono'))
										->leftJoin('pago','recibo.id', '=', 'pago.recibo_id')
										->where('recibo.venta_id', $venta_id)
										->where('pago.cancelado',0)
										->where('recibo.id',$recibo_id)
										->groupby('recibo.id')->first();
		if ($pagado != null) {
			$abonado_recibo = $pagado->abono;
		 }	else{
		 	$abonado_recibo = 0;
		 }

		$recibo_update = Recibo::find($recibo_id);

		if ($recibo_update->monto == $abonado_recibo) {
			$recibo_update->pagado = 1;
			$recibo_update->save();
		}

				break;
			//se paga el total de la venta
			case '2':
			
			//abona el saldo al recibo
			$pago_recibo = new Pago();
			$pago_recibo->recibo_id = $recibo_id;
			$pago_recibo->forma_pago_id = $forma_pago_id;
			$pago_recibo->monto = $saldo_recibo;
			$pago_recibo->usuario_id = Auth::user()->id;
			$pago_recibo->save();

			$recibo = Recibo::find($recibo_id);
			$recibo->pagado = 1;
			$recibo->save();


			$resto_abono = $saldo_venta - $saldo_recibo;

			// con lo que queda se completan las siguientes mensualidades
			//verifico cuantas mensualidades me cubre el resto del abono y genero los pagos y los recibos
			$pagos = $resto_abono/$mensualidad;

				
			$deadDate = explode('-', $recibo->fecha_limite);
			$beginPlan = Carbon::createFromDate($deadDate[0], $deadDate[1], $deadDate[2], null);


			$consecutivo = $recibo->consecutivo + 1;
			for ($i=0; $i < $pagos ; $i++) { 
			
				$recibo_sub = Recibo::find($recibo_id);

			$subsecuente_recibo = new Recibo();
			$subsecuente_recibo->consecutivo = $consecutivo;
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
			
			$consecutivo++;
			
			

			}# code...


			return Redirect::back();


				break;
			
			default:
		$abono = $monto_diferente;
		$pago = new Pago;
		$pago->recibo_id = $recibo_id;
		$pago->forma_pago_id = $forma_pago_id;
		$pago->monto = $abono;
		$pago->usuario_id = Auth::user()->id;
		$pago->save();
	
		
		break;
		}
return Redirect::back();
		

	}

	public function getAll(){
		$ventas = Venta::where('pagada',0)->where('cotizacion',0)->where('asesor_id', 84)->get();
		return $ventas;
	}


	}
 ?>