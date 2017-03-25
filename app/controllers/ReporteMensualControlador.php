<?php
use Carbon\Carbon;
class ReporteMensualControlador extends \ModuloControlador {

	public function __construct(){
		$this->data["module"] = "Reporte Mensual";
		$this->data["icon"] = "bar-chart";
		$this->department = Auth::user()->departamento->nombre;
	}

	public function getIndex(){

		

$month = Carbon::now();
$month = $month->subMonths(1);
$month = $month->format('m');





$year = Carbon::now();
$year = $year->format('Y');


$year1 = Carbon::now();
$year1 = $year1->subYears(1);
$year1 = $year1->format('Y');

$year2 = Carbon::now();
$year2 = $year2->subYears(2);
$year2 = $year2->format('Y');

$year3 = Carbon::now();
$year3 = $year3->subYears(3);
$year3 = $year3->format('Y');

//graficas comparativas por producto
$categories = ProductoGrafica::where('activo',1)->where('categoria', 1)->orderBy('id', 'desc')->get();

$periodo_mtto = PeriodoMantenimiento::where('activo',1)->get();
$categories_mtto = ProductoGrafica::where('activo',1)->where('mantenimiento','=',1 )->get();



$serie = GraficaVentaProducto::select('producto_grafica.id','producto_grafica.nombre','totales_grafica.monto', 'totales_grafica.month', 'totales_grafica.year')->where('categoria',1)->where('year','>=', $year3)
								->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
								->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')	
								->orderBy('producto_grafica.nombre','desc')->get();


$acumulado = GraficaVentaProducto::select(DB::raw('sum(totales_grafica.monto) as total'), 'totales_grafica.month', 'totales_grafica.year')->groupby('year','month')
								->where('categoria',1)
								->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
								->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')
								->get();


$mtto_totales = TipoPropiedadPeriodoMantenimiento::select('producto_grafica.id','producto_grafica.nombre as producto', 'periodo_mantenimiento.nombre as periodo','periodo_mantenimiento.id as periodo_id', 'totales_grafica.month','totales_grafica.year', 'totales_grafica.monto' )
								->leftJoin('periodo_mantenimiento', 'tipo_propiedad_periodo_mantenimiento.periodo_mantenimiento_id', '=', 'periodo_mantenimiento.id')
								->leftJoin('producto_grafica', 'tipo_propiedad_periodo_mantenimiento.producto_grafica_id', '=', 'producto_grafica.id')
								->leftJoin('totales_grafica', 'tipo_propiedad_periodo_mantenimiento.totales_grafica_id', '=', 'totales_grafica.id')->get();

$mtto = TipoPropiedadPeriodoMantenimiento::select(DB::raw('sum(totales_grafica.monto) as total','totales_grafica.month' ))
								->leftJoin('periodo_mantenimiento', 'tipo_propiedad_periodo_mantenimiento.periodo_mantenimiento_id', '=', 'periodo_mantenimiento.id')
								->leftJoin('producto_grafica', 'tipo_propiedad_periodo_mantenimiento.producto_grafica_id', '=', 'producto_grafica.id')
								->leftJoin('totales_grafica', 'tipo_propiedad_periodo_mantenimiento.totales_grafica_id', '=', 'totales_grafica.id')->groupby('month')->where('year',$year)->get();

//venta total mes ? 2017
$totalmes = GraficaVentaProducto::select(DB::raw('sum(totales_grafica.monto) as total'))->where('month',$month)->where('year','>=',$year3)->groupBy('year')
								->where('categoria',1)
								->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
								->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')
								->get();
//consulta venta vendedores
$vendedores = GraficaVendedores::select('totales_grafica.monto','vista_asesor_promotor.asesor')->where('month',$month)->where('year',$year)
								->where('totales',1)
								->leftJoin('totales_grafica', 'grafica_vendedores.totales_grafica_id', '=', 'totales_grafica.id')
								->leftJoin('vista_asesor_promotor', 'grafica_vendedores.asesor_id', '=', 'vista_asesor_promotor.asesor_id')
								->get();
//consulta de promotoria
$promotoria = GraficaVendedores::select(DB::raw('sum(totales_grafica.monto) as total'),'vista_asesor_promotor.promotor')->where('year',$year)
							  	->where('totales',1)
								->leftJoin('totales_grafica', 'grafica_vendedores.totales_grafica_id', '=', 'totales_grafica.id')
								->leftJoin('vista_asesor_promotor','grafica_vendedores.asesor_id','=','vista_asesor_promotor.asesor_id')
								->groupby('month')->groupby('promotor')
								->get();		
//consulta sacar promotores
$promotor = VistaAsesorPromotor::where('activo',1)->where('totales',1)->groupby('promotor')
								->leftJoin('grafica_vendedores','vista_asesor_promotor.asesor_id','=','grafica_vendedores.asesor_id')->get();

//grafica vendedores
			$serie_vendedores = array(
								"data" =>$vendedores, 
							
								);
//fin grafica vendedores



switch ($month) {
	case 01:
		$mes_string = 'Enero';# code...
		break;
	case 02:
		$mes_string = 'Febrero';# code...
		break;
		case 03:
		$mes_string = 'Marzo';# code...
		break;
		case 04:
		$mes_string = 'Abril';# code...
		break;
		case 05:
		$mes_string = 'Mayo';# code...
		break;
		case 06:
		$mes_string = 'Junio';# code...
		break;
		case 07:
		$mes_string = 'Julio';# code...
		break;
		case 08:
		$mes_string = 'Agosto';# code...
		break;
		case 09:
		$mes_string = 'Septiembre';# code...
		break;
		case 10:
		$mes_string = 'Octubre';# code...
		break;
		case 11:
		$mes_string = 'Noviembre';# code...
		break;
		case 12:
		$mes_string = 'Diciembre';# code...
		break;
	default:
		# code...
		break;
}



							
							$fechas = array(
								'year' => $year,
								'year1' => $year1,
								'year2' => $year2,
								'year3' => $year3,
								'month' => $month,
								'mes' => $mes_string,
								 );

							
							
//fin graficas comparativas por producto


			$dataModule["year"] = $year;
			$dataModule["month"] = $month;
			$dataModule["fechas"] = $fechas;
			$dataModule["mes"] = $mes_string;			
			$dataModule["serie"] = $serie;			
			$dataModule["acumulado"] = $acumulado;														
			$dataModule["categories"] = $categories;
			$dataModule["mtto_totales"] = $mtto_totales;
			$dataModule["categories_mtto"] = $categories_mtto;
			$dataModule["periodo_mtto"] = $periodo_mtto;
			$dataModule["mtto"] = $mtto;
			$dataModule["serie_vendedores"] = $serie_vendedores;
			$dataModule["serie_promotoria"] = $promotoria;
			$dataModule["vendedores"] = $vendedores;
			$dataModule["promotor"] = $promotor;
			


		return View::make($this->department.".main", $this->data)->nest('child', $this->department.'.reportemensual' , $dataModule);
	}

	

}
