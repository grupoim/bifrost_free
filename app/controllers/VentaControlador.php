<?php 
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
	}
 ?>