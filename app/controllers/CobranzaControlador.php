<?php 
class CobranzaControlador extends ModuloControlador{
	public $moduleName = "Cobranza";
	public function getIndex(){
		$data["module"] = $this->moduleName;
		return View::make("sistemas.main", $data);
	}

	
	public function getEstadisticosmes(){			
		setlocale(LC_TIME, 'spanish');
		 
 		$mes=strftime("%B",mktime(0, 0, 0, date('m'), 1, 2000)); 
		
		/****** mensual *************/
		$monto_recibos_cobranza = Recibo::where( DB::raw('YEAR(fecha_limite)'), '=', date('Y') )
										->where( DB::raw('MONTH(fecha_limite)'), '=', date('m') )										
										->where('cancelado',0)
										->sum('monto');

		$monto_recibos_pagados = Recibo::where( DB::raw('YEAR(fecha_limite)'), '=', date('Y') )
										 ->where( DB::raw('MONTH(fecha_limite)'), '=', date('m') )									     
									     ->where('cancelado',0)
									     ->where('pagado',1)
									     ->sum('monto');

		$monto_recibos_pendientes_cobrar = $monto_recibos_cobranza - $monto_recibos_pagados;

		if ($monto_recibos_cobranza > 0)
			$porcentaje = ($monto_recibos_pagados *100)/$monto_recibos_cobranza;
		else 
			$porcentaje = 0;		
		
		return 
		Response::json(
						array(
										
							"esperado" => number_format($monto_recibos_cobranza, 2,".", ","),
							"cobrado" =>  number_format($monto_recibos_pagados, 2,".", ","),
							"pendiente" =>number_format($monto_recibos_pendientes_cobrar, 2,".", ","),
							"porcentaje" => number_format($porcentaje,2),
							"nombre" => Str::title($mes) 				  
						));
	}

	public function getEstadisticosdia(){			

		setlocale(LC_ALL, 'spanish');			
		$dia = strftime("%A");


			/*********diario **********/
			$monto_recibos_cobranza = Recibo::where( DB::raw('YEAR(fecha_limite)'), '=', date('Y') )
											->where( DB::raw('MONTH(fecha_limite)'), '=', date('m') )
											->where( DB::raw('DAY(fecha_limite)'), '=', date('d') )											
											->where('cancelado',0)
											->sum('monto');

			$monto_recibos_pagados = Recibo::where( DB::raw('YEAR(fecha_limite)'), '=', date('Y') )
											->where( DB::raw('MONTH(fecha_limite)'), '=', date('m') )
											->where( DB::raw('DAY(fecha_limite)'), '=', date('d') )											
											->where('cancelado',0)
											->where('pagado',1)
											->sum('monto');
											
			$monto_recibos_pendientes_cobrar = $monto_recibos_cobranza - $monto_recibos_pagados;
			if ($monto_recibos_cobranza > 0)
				$porcentaje = ($monto_recibos_pagados *100)/$monto_recibos_cobranza;
			else 
				$porcentaje = 0;
			 
			return 
			Response::json(
						array(
											
							"esperado" => number_format($monto_recibos_cobranza, 2,".", ","),
							"cobrado" =>  number_format($monto_recibos_pagados, 2,".", ","),
							"pendiente" =>number_format($monto_recibos_pendientes_cobrar, 2,".", ","),
							"porcentaje" => number_format($porcentaje,2),
							"nombre" => Str::title($dia)
						));
		}
	}
