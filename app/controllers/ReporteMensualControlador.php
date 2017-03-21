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
$categories = ProductoGrafica::where('activo',1)->where('categoria', 1)->get();


$datos = GraficaVentaProducto::select('totales_grafica.monto')->where('month', $month)->where('year',$year)->where('categoria',1)
								->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
								->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')	
								->get();

$datos_s1 = GraficaVentaProducto::select('totales_grafica.monto')->where('month', $month)->where('year',$year1)
								->where('categoria',1)
								->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
								->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')
								->get();

$datos_s2 = GraficaVentaProducto::select('totales_grafica.monto')->where('month', $month)->where('year',$year2)
								->where('categoria',1)
								->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
								->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')
								->get();

$datos_s3 = GraficaVentaProducto::select('totales_grafica.monto')->where('month', $month)->where('year',$year3)
								->where('categoria',1)
								->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
								->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')
								->get();			


$acumulado = GraficaVentaProducto::select('producto_grafica.nombre', DB::raw('sum(totales_grafica.monto) as total'), 'totales_grafica.month', 'totales_grafica.year')->groupby('month')->where('year',$year)
								->where('categoria',1)
								->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
								->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')
								->get();
$acumulado_apilada = GraficaVentaProducto::select('producto_grafica.id','producto_grafica.nombre','totales_grafica.monto as total', 'totales_grafica.month', 'totales_grafica.year')->where('year',$year)
								->where('categoria',1)
								->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
								->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')
								->get();

$acumulado1 = GraficaVentaProducto::select(DB::raw('sum(totales_grafica.monto) as total'), 'totales_grafica.month')->where('year',$year1)->groupby('month')->where('categoria',1)
								->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
								->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')
								->get();
$acumulado2 = GraficaVentaProducto::select(DB::raw('sum(totales_grafica.monto) as total'), 'totales_grafica.month')->where('year',$year2)->groupby('month')->where('categoria',1)
								->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
								->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')
								->get();
$acumulado3 = GraficaVentaProducto::select(DB::raw('sum(totales_grafica.monto) as total'), 'totales_grafica.month')->where('year',$year3)->groupby('month')->where('categoria',1)
								->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
								->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')
								->get();


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


							$serie = array(
								"name"=>  $year,
								"data" =>  $datos,
								);

							$serie1 = array(
								"name"=>  $year1,
								"data" =>  $datos_s1,
								);
							$serie2 = array(
								"name"=>  $year2,
								"data" =>  $datos_s2,
								);

							$serie3 = array(
								"name"=>  $year3,
								"data" =>  $datos_s3,
								);
//fin graficas comparativas por producto


//ventas acumuladas	
							
				$serie_acumulado = array(
								"name"=>  $year,
								"data" =>  $acumulado,
								);

				$serie_acumulado1 = array(
								"name"=>  $year1,
								"data" =>  $acumulado1,
								);
				$serie_acumulado2 = array(
								"name"=>  $year2,
								"data" =>  $acumulado2,
								);

				$serie_acumulado3 = array(
								"name"=>  $year3,
								"data" =>  $acumulado3,
								);

//fin ventas acumuladas


			$dataModule["year"] = $year;
			$dataModule["mes"] = $mes_string;			
			$dataModule["serie"] = $serie;
			$dataModule["serie1"] = $serie1;
			$dataModule["serie2"] = $serie2;
			$dataModule["serie3"] = $serie3;
			$dataModule["serie_acumulado"] = $serie_acumulado;
			$dataModule["acumulado_apilada"] = $acumulado_apilada;
			$dataModule["serie_acumulado1"] = $serie_acumulado1;
			$dataModule["serie_acumulado2"] = $serie_acumulado2;
			$dataModule["serie_acumulado3"] = $serie_acumulado3;
			$dataModule["acumulado"] = $acumulado;						
			$dataModule["categories"] = $categories;
			$dataModule["datos"] = $datos;


		return View::make($this->department.".main", $this->data)->nest('child', $this->department.'.reportemensual' , $dataModule);
	}

	

}
