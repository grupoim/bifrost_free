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

			$recibo = Recibo::select('recibo.*', DB::raw('max(id) as maximo'))->where('cancelado',0)->where('pagado',0)->where('venta_id', $id)->firstorFail();
			/////////

			$pagado = Recibo::select('recibo.id as recibo_id',DB::raw('SUM(pago.monto) as abono'))
										->leftJoin('pago','recibo.id', '=', 'pago.recibo_id')
										->where('recibo.venta_id', $id)
										->where('pago.cancelado',0)
										->where('recibo.id',$recibo->id)->first();

			$total_pagado = Pago::select('pago.recibo_id as recibo_id',DB::raw('SUM(pago.monto) as abono'))
			->leftJoin('recibo','pago.recibo_id', '=', 'recibo.id')
			->where('pago.cancelado',0)
			->where('recibo.venta_id', $id )			
			->groupby('recibo.venta_id')->first();

			$venta = Venta::leftJoin('vista_clientes', 'venta.cliente_id', '=', 'vista_clientes.id')
						->leftJoin('plan_pago_venta', 'venta.id', '=', 'plan_pago_venta.venta_id')
						->leftJoin('plan_pago', 'plan_pago_venta.plan_pago_id', '=', 'plan_pago.id')
						->where('venta.id',$id)->firstorFail();
		

		if ($pagado != null) {
			$abonado_recibo = $pagado->abono;
		 }	else{
		 	$abonado_recibo = 0;
		 }
		$por_pagar = $recibo->monto - $abonado_recibo;

		$hoy = carbon::now(); 
		$date_recibo = Carbon::parse($recibo->fecha_limite);
			
         

           $h_y = $hoy->year;
           $h_m = $hoy->month;
           $h_d = $hoy->day;

           $d_y = $date_recibo->year;
           $d_m = $date_recibo->month;
           $d_d = $date_recibo->day;

          $today = Carbon::create($h_y, $h_m, $h_d);
          $d_recibo = Carbon::create($d_y, $d_m, $d_d);
  			
  		 $dias_atraso =  $d_recibo->diffInDays($today,false);
  		 $meses_atraso = $d_recibo->diffInMonths($today,false);

  		 $parcialidad = $por_pagar;
		 $numero_mensualidades = $venta->numero_pagos;
  		 
  		 $max_pendientes = $numero_mensualidades - $recibo->consecutivo;

  		 if ($parcialidad > 0 and $max_pendientes > $meses_atraso) {
				$pagos_completos = $meses_atraso;
				$resto = $parcialidad;
			}else{
				$pagos_completos = $max_pendientes;
				$resto = 0;
			}


			$abono_pendiente = ($recibo->monto * $pagos_completos ) + $parcialidad;
			////////
			



			

			
			$saldo_venta = $venta->total - $total_pagado->abono;
			
			if ($recibos != null) {
				$dataModule["recibos"] = $recibos;
			}
			else{
				$dataModule["recibos"] = 0;
			}
			$dataModule['formas_pago'] = FormaPago::all();
			
			$dataModule['abono_pendiente'] = $abono_pendiente;
			$dataModule['dias_atraso'] = $dias_atraso;
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

		$hoy = carbon::now(); 
		$date_recibo = Carbon::parse($recibo->fecha_limite);
			
         

           $h_y = $hoy->year;
           $h_m = $hoy->month;
           $h_d = $hoy->day;

           $d_y = $date_recibo->year;
           $d_m = $date_recibo->month;
           $d_d = $date_recibo->day;

          $today = Carbon::create($h_y, $h_m, $h_d);
          $d_recibo = Carbon::create($d_y, $d_m, $d_d);
  			
  		 $dias_atraso =  $d_recibo->diffInDays($today,false);
  		 $meses_atraso = $d_recibo->diffInMonths($today,false);

  		 $parcialidad = $por_pagar;

  		 $numero_mensualidades = $venta->numero_pagos;
  		 
  		 $max_pendientes = $numero_mensualidades - $recibo->consecutivo;

  		 if ($parcialidad > 0 and $max_pendientes > $meses_atraso) {
				$pagos_completos = $meses_atraso;
				$resto = $parcialidad;
			}else{
				$pagos_completos = $max_pendientes;
				$resto = 0;
			}

			$abono_pendiente = ($recibo->monto * $pagos_completos ) + $parcialidad;
	
		$consecutivo = Recibo::select('recibo.*', DB::raw('max(consecutivo) as maximo'))->where('venta_id', $id)->get();
	return  array(
		
			'abono_pendiente' => $abono_pendiente,			
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
		$abono_pendiente = Input::get('abono_pendiente');
		
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
			
			case '3':
				$abono = input::get('monto');			

			//no es el primer pago
		

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
					
					$recibo_update = Recibo::find($recibo->id);

					
					$recibo_update->pagado = 1;
					$recibo_update->save();					


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


					$recibo_update = Recibo::find($recibo->id);

					
					$recibo_update->pagado = 1;
					$recibo_update->save();

					
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
			
$total_pago_venta = Pago::select('pago.*', DB::raw('sum(pago.monto) as total_pago'))
					->leftJoin('recibo','pago.recibo_id', '=', 'recibo.id')
					->where('recibo.venta_id', $venta_id)->where('pago.cancelado',0)->where('recibo.cancelado',0)->first();
					
					$resto_total = $venta->total - $total_pago_venta->total_pago;
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

return Redirect::action('VentaControlador@getRecibos',$venta_id);

			


























			
			break;


			case '4':
				
				//paga el saldo del ultimo recibo
			$abono = $abono_pendiente;
			

			$pago = new Pago();
			$pago->recibo_id = $recibo_id;
			$pago->forma_pago_id = $forma_pago_id;
			$pago->monto = $saldo_recibo;
			$pago->usuario_id =  Auth::user()->id;
			$pago->save();

			// se sacan n numero de recibos COMPLETOS con el resto del recibo y se genera el último
			

			////////////////////////
			$recibo_update = Recibo::find($recibo->id);

					
					$recibo_update->pagado = 1;
					$recibo_update->save();

					
					$resto_abono = $abono - $saldo_recibo;

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

					//genera el parcial ultimo
					
		$step = $pagos_completos + 1;
	
			
$total_pago_venta = Pago::select('pago.*', DB::raw('sum(pago.monto) as total_pago'))
					->leftJoin('recibo','pago.recibo_id', '=', 'recibo.id')
					->where('recibo.venta_id', $venta_id)->where('pago.cancelado',0)->where('recibo.cancelado',0)->first();
					
					$resto_total = $venta->total - $total_pago_venta->total_pago;
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

	
	
	$recibo_parcial = new Recibo();
			$recibo_parcial->consecutivo = $ult_consecutivo;
			$recibo_parcial->venta_id = $venta_id;
			$recibo_parcial->fecha_limite = $last_fecha;
			$recibo_parcial->monto = $mensualidad;
			$recibo_parcial->save();
	
	
		


				}
			///////////////////////


				break;

			default:
		$abono = 5;
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