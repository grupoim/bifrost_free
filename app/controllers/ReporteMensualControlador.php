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


$month2 = Carbon::now();
$month2 = $month2->subMonths(2);
$month2 = $month2->format('m');


$month3 = Carbon::now();
$month3 = $month3->subMonths(3);
$month3 = $month3->format('m');


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
$categories_cartera = ProductoGrafica::where('activo',1)->where('cartera', 1)->get(); // Dato modificado
$categories_sueldos = ProductoGrafica::where('activo',1)->where('sueldo_impuesto',1)->get(); //graficas de gastos
$categories_gadmon = ProductoGrafica::where('activo',1)->where('gasto_admon',1)->get(); //graficas de gastos
$categories_goperacion = ProductoGrafica::where('activo',1)->where('gasto_operacion',1)->get(); //graficas de gastos
$categories_corp = ProductoGrafica::where('activo',1)->where('cargo_corporativo',1)->get(); // grafica de cargos corporativo
$categories_mtto_cap = ProductoGrafica::where('activo',1)->where('gasto_mtto_capilla',1)->get(); // grafica de gastos de mantenimiento capilla
$categories_const_cap = ProductoGrafica::where('activo',1)->where('gasto_constr_capilla',1)->get(); // grafica de gastos de contruccion capilla


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
		//consultas pedro						
//consulta extras individuales
$extra = GraficaVentaProducto::select('producto_grafica.nombre','totales_grafica.monto','totales_grafica.year','totales_grafica.month')->where('producto_grafica.extra',1)
									->where('month',$month)->where('year',$year)
									->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
									->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')
									->get();
//suma de extras totales por mes
$extra_total = GraficaVentaProducto::select(DB::raw('sum(totales_grafica.monto) as total'))->where('producto_grafica.extra',1)
									->where('month',$month)->where('year',$year)
									->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
									->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')
									->get();
//consulta cartera clientes ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////MODIFICADO
$cartera = GraficaVentaProducto::select('producto_grafica.nombre','totales_grafica.monto','totales_grafica.year','totales_grafica.month')
									->where('producto_grafica.cartera',1)
									->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
									->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')
									->get();
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//suma de cartera cliente por mes
$cartera_total = GraficaVentaProducto::select(DB::raw('sum(totales_grafica.monto) as total'))
									->where('producto_grafica.cartera',1)
									->where('month',$month)->where('year',$year)
									->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
									->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')
									->get();




/////////////////////////////////////////////////////////////////////////////////////////////////////
//Consulta grafica distribucion captura mantenimiento
$serie_distribucion = GraficaCapturaVendedor::select('totales_grafica.monto','vista_asesor_promotor.asesor','tipo_mantenimiento_captura.nombre as tipo')
										->where('month',$month)->where('year',$year)
										->leftJoin('totales_grafica', 'grafica_captura_vendedor.totales_grafica_id', '=', 'totales_grafica.id')
								        ->leftJoin('vista_asesor_promotor', 'grafica_captura_vendedor.asesor_id', '=', 'vista_asesor_promotor.asesor_id')
								        ->leftJoin('tipo_mantenimiento_captura','grafica_captura_vendedor.tipo_mantenimiento_captura_id','=','tipo_mantenimiento_captura.id')
								        ->groupby('grafica_captura_vendedor.asesor_id','tipo_mantenimiento_captura.nombre')->orderBy('grafica_captura_vendedor.totales_grafica_id','asc')
								        ->get();
$asesores = VistaAsesorPromotor::select('vista_asesor_promotor.asesor')->groupby('asesor')->orderBy('grafica_captura_vendedor.totales_grafica_id','asc')
								->where('month',$month)->where('year',$year)
								->leftJoin('grafica_captura_vendedor','vista_asesor_promotor.asesor_id','=','grafica_captura_vendedor.asesor_id')
								->leftJoin('totales_grafica','grafica_captura_vendedor.totales_grafica_id','=','totales_grafica.id')->get();
$tipos = TipoMantenimientoCaptura::orderBy('id','des')->get();					
//Termina grafica distribucion captura mantenimiento
								//termino consultas pedro


//empiezan consultas para graficas de gastos
$gastos = GraficaVentaProducto::select('producto_grafica.id','producto_grafica.nombre','totales_grafica.monto as total', 'totales_grafica.month', 'totales_grafica.year')
								->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
								->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')
								->get();
//gastos totales sueldos
								//estas consultas quise hacerlas como la otra hacer la sentencia en blade pero cuando utlizo la operacion sum no me deja
$total_sueldos = GraficaVentaProducto::select(DB::raw('sum(totales_grafica.monto) as total'),'producto_grafica.id','producto_grafica.nombre','totales_grafica.month', 'totales_grafica.year')
								->where('sueldo_impuesto',1)->where('year',$year)
								->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
								->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')
								->groupBy('month')
								->get();
//gastos totales administracion
$total_admon = GraficaVentaProducto::select(DB::raw('sum(totales_grafica.monto) as total'),'producto_grafica.id','producto_grafica.nombre','totales_grafica.month', 'totales_grafica.year')
								->where('gasto_admon',1)->where('year',$year)
								->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
								->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')
								->groupBy('month')
								->get();
//gastos totales operacion
$total_operacion = GraficaVentaProducto::select(DB::raw('sum(totales_grafica.monto) as total'),'producto_grafica.id','producto_grafica.nombre','totales_grafica.month', 'totales_grafica.year')
								->where('gasto_operacion',1)->where('year',$year)
								->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
								->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')
								->groupBy('month')
								->get();
//gastos totales mantenimiento de capilla
$total_mtto_cap = GraficaVentaProducto::select(DB::raw('sum(totales_grafica.monto) as total'),'producto_grafica.id','producto_grafica.nombre','totales_grafica.month', 'totales_grafica.year')
								->where('gasto_mtto_capilla',1)->where('year',$year)
								->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
								->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')
								->groupBy('month')
								->get();
//gastos totales contruccion capilla
$total_cont_cap = GraficaVentaProducto::select(DB::raw('sum(totales_grafica.monto) as total'),'producto_grafica.id','producto_grafica.nombre','totales_grafica.month', 'totales_grafica.year')
								->where('gasto_constr_capilla',1)->where('year',$year)
								->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
								->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')
								->groupBy('month')
								->get();
//gastos totales cargos corporativos
$total_corp = GraficaVentaProducto::select(DB::raw('sum(totales_grafica.monto) as total'),'producto_grafica.id','producto_grafica.nombre','totales_grafica.month', 'totales_grafica.year')
								->where('cargo_corporativo',1)->where('year',$year)
								->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')
								->leftJoin('producto_grafica', 'grafica_venta_producto.producto_grafica_id', '=', 'producto_grafica.id')
								->groupBy('month')
								->get();

//terminan consultas de graficas de gastos
switch ($month) {
	case 1:
		$mes_string = 'Enero';# code...
		break;
	case 2:
		$mes_string = 'Febrero';# code...
		break;
		case 3:
		$mes_string = 'Marzo';# code...
		break;
		case 4:
		$mes_string = 'Abril';# code...     
		break;
		case 5:
		$mes_string = 'Mayo';# code...
		break;
		case 6:
		$mes_string = 'Junio';# code...
		break;
		case 7:
		$mes_string = 'Julio';# code...
		break;
		case 8:
		$mes_string = 'Agosto';# code...
		break;
		case 9:
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
switch ($month2) {
	case 1:
		$mes_string2 = 'Enero';# code...
		break;
	case 2:
		$mes_string2 = 'Febrero';# code...
		break;
		case 3:
		$mes_string2 = 'Marzo';# code...
		break;
		case 4:
		$mes_string2 = 'Abril';# code...     
		break;
		case 5:
		$mes_string2 = 'Mayo';# code...
		break;
		case 6:
		$mes_string2 = 'Junio';# code...
		break;
		case 7:
		$mes_string2 = 'Julio';# code...
		break;
		case 8:
		$mes_string2 = 'Agosto';# code...
		break;
		case 9:
		$mes_string2 = 'Septiembre';# code...
		break;
		case 10:
		$mes_string2 = 'Octubre';# code...
		break;
		case 11:
		$mes_string2 = 'Noviembre';# code...
		break;
		case 12:
		$mes_string2 = 'Diciembre';# code...
		break;
	default:
		# code...
		break;
}
switch ($month3) {
	case 1:
		$mes_string3 = 'Enero';# code...
		break;
	case 2:
		$mes_string3 = 'Febrero';# code...
		break;
		case 3:
		$mes_string3 = 'Marzo';# code...
		break;
		case 4:
		$mes_string3 = 'Abril';# code...     
		break;
		case 5:
		$mes_string3 = 'Mayo';# code...
		break;
		case 6:
		$mes_string3 = 'Junio';# code...
		break;
		case 7:
		$mes_string3 = 'Julio';# code...
		break;
		case 8:
		$mes_string3 = 'Agosto';# code...
		break;
		case 9:
		$mes_string3 = 'Septiembre';# code...
		break;
		case 10:
		$mes_string3 = 'Octubre';# code...
		break;
		case 11:
		$mes_string3 = 'Noviembre';# code...
		break;
		case 12:
		$mes_string3 = 'Diciembre';# code...
		break;
	default:
		# code...
		break;
}
		//////////////////////////////////////////////////////////////
							$fechas = array(
								'year' => $year,
								'year1' => $year1,
								'year2' => $year2,
								'year3' => $year3,
								'month' => $month,
								'month2' => $month2,
								'month3' => $month3,
								'mes' => $mes_string,
								'mes2' => $mes_string2,
								'mes3' => $mes_string3,
								 );
							//arreglo para los totales de cada apartado de gastos
							$totales = array(
								'sueldo_impuesto' => $total_sueldos,
								'gasto_admon' => $total_admon,
								'gasto_operacion' => $total_operacion,
								'gasto_mtto_capilla' => $total_mtto_cap,
								'gasto_constr_capilla' => $total_cont_cap,
								'gasto_corp' => $total_corp,
								 );

///////////////////////////////////////////////////////////////////////MODIFICADO
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

//ventas total mes febrero

				$serie_total = array(
								"data" =>  $totalmes,
								);

// fin ventas total mes febrero
//grafica vendedores
			$serie_vendedores = array(
								"data" =>$vendedores, 
							
						);
					



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
			$dataModule["serie_total"] = $serie_total;
			$dataModule["serie_vendedores"] = $serie_vendedores;
			$dataModule["serie_promotoria"] = $promotoria;
			$dataModule["acumulado"] = $acumulado;						
			$dataModule["categories"] = $categories;
			$dataModule["categories_cartera"] = $categories_cartera; //nuevo añadir 
			$dataModule["datos"] = $datos;
			$dataModule["vendedores"] = $vendedores;
			$dataModule["promotor"] = $promotor;
			$dataModule["serie_extra"] = $extra;
			$dataModule["serie_extra_total"] = $extra_total;
			$dataModule["serie_cartera"] = $cartera;
			$dataModule["serie_cartera_total"] = $cartera_total;
			$dataModule["serie_distribucion"] = $serie_distribucion;
			$dataModule["asesores"] = $asesores;
			$dataModule["tipos"] = $tipos;
			$dataModule["fechas"] = $fechas; //nuevo añadir
			$dataModule["gastos"] = $gastos;//gastos general
			$dataModule["totales"] = $totales; // gastos suma general
			$dataModule["categories_sueldos"] = $categories_sueldos; //categorias de gastos de nomina
			$dataModule["categories_gadmon"] = $categories_gadmon; //categorias de gastos de admon
			$dataModule["categories_goperacion"] = $categories_goperacion; //categorias de gastos de operaciones
			$dataModule["categories_corp"] = $categories_corp; //categorias de corporativo
			$dataModule["categories_mtto_cap"] = $categories_mtto_cap; //categorias de mtto capilla
			$dataModule["categories_const_cap"] = $categories_const_cap; //categorias de const capilla
		return View::make($this->department.".main", $this->data)->nest('child', $this->department.'.reportemensual' , $dataModule);
	}
public function getIngresos(){


	$dataModule["vendedores"] = VistaAsesorPromotor::all();	
	$dataModule["productos"] = ProductoGrafica::where('categoria',1)->where('activo',1)->get();
	$dataModule["tipos_propiedad"] = ProductoGrafica::where('mantenimiento',1)->where('activo',1)->get();
	$dataModule["carteras"] = ProductoGrafica::where('cartera',1)->where('activo',1)->get();
	$dataModule["extras"] = ProductoGrafica::where('extra',1)->where('activo',1)->get();
	$dataModule["mantenimientos"] = TipoMantenimientoCaptura::all();
	$dataModule["periodos"] = PeriodoMantenimiento::all();
	$dataModule['v_vendedores'] = GraficaVendedores::select('totales_grafica.id as total_id','totales_grafica.month','totales_grafica.year','totales_grafica.monto','vista_asesor_promotor.asesor')
													  ->leftJoin('vista_asesor_promotor','grafica_vendedores.asesor_id','=','vista_asesor_promotor.asesor_id')
													  ->leftJoin('totales_grafica','grafica_vendedores.totales_grafica_id','=','totales_grafica.id')->get();
	$dataModule['capturas'] = GraficaCapturaVendedor::select('totales_grafica.id as total_id','totales_grafica.month','totales_grafica.year','totales_grafica.monto','vista_asesor_promotor.asesor','tipo_mantenimiento_captura.nombre as tipo')
													  ->leftJoin('vista_asesor_promotor','grafica_captura_vendedor.asesor_id','=','vista_asesor_promotor.asesor_id')
													  ->leftJoin('totales_grafica','grafica_captura_vendedor.totales_grafica_id','=','totales_grafica.id')
													  ->leftJoin('tipo_mantenimiento_captura','grafica_captura_vendedor.tipo_mantenimiento_captura_id','=','tipo_mantenimiento_captura.id')
													  ->get();
	$dataModule['product'] = GraficaVentaProducto::select('totales_grafica.id as total_id','totales_grafica.month','totales_grafica.year','totales_grafica.monto','producto_grafica.nombre as producto','producto_grafica.categoria','producto_grafica.cartera','producto_grafica.extra')
													  ->leftJoin('producto_grafica','grafica_venta_producto.producto_grafica_id','=','producto_grafica.id')
													  ->leftJoin('totales_grafica','grafica_venta_producto.totales_grafica_id','=','totales_grafica.id')
													  ->get();
	$dataModule['propiedades'] = TipoPropiedadPeriodoMantenimiento::select('totales_grafica.id as total_id','totales_grafica.month','totales_grafica.year','totales_grafica.monto','producto_grafica.nombre as producto','periodo_mantenimiento.nombre as periodo')
													  ->leftJoin('producto_grafica','tipo_propiedad_periodo_mantenimiento.producto_grafica_id','=','producto_grafica.id')
													  ->leftJoin('totales_grafica','tipo_propiedad_periodo_mantenimiento.totales_grafica_id','=','totales_grafica.id')
													  ->leftJoin('periodo_mantenimiento','tipo_propiedad_periodo_mantenimiento.periodo_mantenimiento_id','=','periodo_mantenimiento.id')
													  ->get();
	return View::make($this->department.".main", $this->data)->nest('child','administracion.main_ingresos', $dataModule);
 		

		}

	public function getVendedores() {			 
	
	$vendedores = VistaAsesorPromotor::all();
	return Response::Json($vendedores);
		}
	public function getCarteras() {			 
	
	$carteras = ProductoGrafica::where('cartera',1)->where('activo',1)->get();
	return Response::Json($carteras);
		}
	public function getProductos() {			 
	
	$productos = ProductoGrafica::where('categoria',1)->where('activo',1)->get();
	return Response::Json($productos);
		}
	public function getExtras() {			 
	
	$extras = ProductoGrafica::where('extra',1)->where('activo',1)->get();
	return Response::Json($extras);
		}
	public function getSueldos() {			 
	
	$sueldo_impuesto = ProductoGrafica::where('sueldo_impuesto',1)->where('activo',1)->get();
	return Response::Json($sueldo_impuesto);
		}
	public function getAdmon() {			 
	
	$gasto_admon = ProductoGrafica::where('gasto_admon',1)->where('activo',1)->get();
	return Response::Json($gasto_admon);
		}
	public function getOperacion() {			 
	
	$gasto_operacion = ProductoGrafica::where('gasto_operacion',1)->where('activo',1)->get();
	return Response::Json($gasto_operacion);
		}
	public function getMttoCapilla() {			 
	
	$gasto_mtto_capilla = ProductoGrafica::where('gasto_mtto_capilla',1)->where('activo',1)->get();
	return Response::Json($gasto_mtto_capilla);
		}
	public function getContCapilla() {			 
	
	$gasto_cont_capilla = ProductoGrafica::where('gasto_constr_capilla',1)->where('activo',1)->get();
	return Response::Json($gasto_cont_capilla);
		}
	public function getCorp() {			 
	
	$gasto_corp = ProductoGrafica::where('cargo_corporativo',1)->where('activo',1)->get();
	return Response::Json($gasto_corp);
		}
	public function getTiposPropiedad() {			 
	
	$tipos_propiedad = ProductoGrafica::where('mantenimiento',1)->where('activo',1)->get();
	return Response::Json($tipos_propiedad);
		}

// comienza el de ingresos
public function postVendedores(){

if (Input::get('month') == 0 || Input::get('vendedor_id') == 0) {
	return Redirect::back()->with('status','vacio')->with('tab', 'tab1');
}else{
		if (DB::table('grafica_vendedores')->select('grafica_vendedores.asesor_id','totales_grafica.year','totales_grafica.month','totales_grafica.monto')
			->where('grafica_vendedores.asesor_id','=',Input::get('vendedor_id'))
			->where('year','=',Input::get('years'))
			->where('month','=',Input::get('month'))
			->where('monto','=',Input::get('Monto'))
			->leftJoin('totales_grafica', 'grafica_vendedores.totales_grafica_id', '=', 'totales_grafica.id')->get())
				 { 
		return Redirect::back()->with('status','validar')->with('tab', 'tab1');
										
				}else{
				
		 $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = Input::get('Monto');
        $totales_grafica->save();

       	$grafica_vendedores = new GraficaVendedores;
		$grafica_vendedores->asesor_id = Input::get('vendedor_id');
		$grafica_vendedores->totales_grafica_id = $totales_grafica->id;
		$grafica_vendedores->save();
		 
		 

				}
		return Redirect::back()->with('status','created')->with('tab', 'tab1');

}
}
public function postCategoria(){
if (Input::get('month') == 0 || Input::get('categoria') == 0) {
	return Redirect::back()->with('status','vacio')->with('tab', 'tab2')->with('registro', 'edit_tab2');
}else{
		if (DB::table('grafica_venta_producto')->select('grafica_venta_producto.producto_grafica_id','totales_grafica.year','totales_grafica.month','totales_grafica.monto')
			->where('grafica_venta_producto.producto_grafica_id','=',Input::get('categoria'))
			->where('year','=',Input::get('years'))->where('month','=',Input::get('month'))
			->where('monto','=',Input::get('Monto'))
			->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')->get())
				 { 
		return Redirect::back()->with('status','validar')->with('tab', 'tab2')->with('registro', 'edit_tab2');
										
				}else{		
 		
        $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = Input::get('Monto');
        $totales_grafica->save();

       	$grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = Input::get('categoria');
		$grafica_venta_producto->save();
		 
	}
		return Redirect::back()->with('status','created')->with('tab', 'tab2')->with('registro', 'edit_tab2');
}

}
public function postDCMantenimiento(){
if (Input::get('month') == 0 || Input::get('vendedor_id') == 0 || Input::get('mantenimiento_id') == 0) {
	return Redirect::back()->with('status','vacio')->with('tab', 'tab3')->with('registro', 'edit_tab3');
}else{
		if (DB::table('grafica_captura_vendedor')->select('grafica_captura_vendedor.asesor_id','totales_grafica.year','totales_grafica.month','totales_grafica.monto','grafica_captura_vendedor.tipo_mantenimiento_captura_id')
			->where('grafica_captura_vendedor.asesor_id','=',Input::get('vendedor_id'))
			->where('grafica_captura_vendedor.tipo_mantenimiento_captura_id','=',Input::get('mantenimiento_id'))
			->where('year','=',Input::get('years'))->where('month','=',Input::get('month'))
			->where('monto','=',Input::get('Monto'))
			->leftJoin('totales_grafica', 'grafica_captura_vendedor.totales_grafica_id', '=', 'totales_grafica.id')->get())
				 { 
		return Redirect::back()->with('status','validar')->with('tab', 'tab3')->with('registro', 'edit_tab3');
										
				}else{

       $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = Input::get('Monto');
        $totales_grafica->save();	
 		
        $grafica_captura_vendedor = new GraficaCapturaVendedor;
        $grafica_captura_vendedor->tipo_mantenimiento_captura_id = Input::get('mantenimiento_id');
        $grafica_captura_vendedor->totales_grafica_id = $totales_grafica->id;
        $grafica_captura_vendedor->asesor_id = Input::get('vendedor_id');
        $grafica_captura_vendedor->save();
		
	}
	return Redirect::back()->with('status','created')->with('tab', 'tab3')->with('registro', 'edit_tab3');
}

}
public function postPmantenimiento(){
if (Input::get('month') == 0 || Input::get('periodo_id') == 0 || Input::get('producto') == 0  ) {
	return Redirect::back()->with('status','vacio')->with('tab', 'tab4')->with('registro', 'edit_tab4');
}else{
		
		if (DB::table('tipo_propiedad_periodo_mantenimiento')->select('tipo_propiedad_periodo_mantenimiento.producto_grafica_id','totales_grafica.year','totales_grafica.month','totales_grafica.monto','tipo_propiedad_periodo_mantenimiento.periodo_mantenimiento_id')
			->where('tipo_propiedad_periodo_mantenimiento.producto_grafica_id','=',Input::get('producto'))
			->where('tipo_propiedad_periodo_mantenimiento.periodo_mantenimiento_id','=',Input::get('periodo_id'))
			->where('year','=',Input::get('years'))
			->where('month','=',Input::get('month'))
			->where('monto','=',Input::get('Monto'))
			->leftJoin('totales_grafica', 'tipo_propiedad_periodo_mantenimiento.totales_grafica_id', '=', 'totales_grafica.id')->get())
						 { 
		return Redirect::back()->with('status','validar')->with('tab', 'tab4')->with('registro', 'edit_tab4');
										
				}else{

       $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = Input::get('Monto');
        $totales_grafica->save();	
 		
        $tipo_propiedad_periodo_mantenimiento = new TipoPropiedadPeriodoMantenimiento;
        $tipo_propiedad_periodo_mantenimiento->periodo_mantenimiento_id = Input::get('periodo_id');
        $tipo_propiedad_periodo_mantenimiento->producto_grafica_id = Input::get('producto');
        $tipo_propiedad_periodo_mantenimiento->totales_grafica_id = $totales_grafica->id;
        $tipo_propiedad_periodo_mantenimiento->save();
		 
		} 
		return Redirect::back()->with('status','created')->with('tab', 'tab4')->with('registro', 'edit_tab4');
}

}
public function postCartera(){

if (Input::get('month') == 0 || Input::get('cartera_id') == 0 ) {
	return Redirect::back()->with('status','vacio')->with('tab', 'tab5')->with('registro', 'edit_tab5');
}else{
		
		if (DB::table('grafica_venta_producto')->select('grafica_venta_producto.producto_grafica_id','totales_grafica.year','totales_grafica.month','totales_grafica.monto')
			->where('grafica_venta_producto.producto_grafica_id','=',Input::get('cartera_id'))
			->where('year','=',Input::get('years'))->where('month','=',Input::get('month'))
			->where('monto','=',Input::get('Monto'))
			->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')->get())
				 { 
		return Redirect::back()->with('status','validar')->with('tab', 'tab5')->with('registro', 'edit_tab5');
										
				}else{		
 		
        $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = Input::get('Monto');
        $totales_grafica->save();

       	$grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = Input::get('cartera_id');
		$grafica_venta_producto->save();
	 
	}
	return Redirect::back()->with('status','created')->with('tab', 'tab5')->with('registro', 'edit_tab5');
}

}
public function postExtra(){
	if (Input::get('month') == 0 || Input::get('extra') == false) {
	return Redirect::back()->with('status','vacio')->with('tab', 'tab6')->with('registro', 'edit_tab6');
}else{

		if (DB::table('producto_grafica')->select('nombre')->where('nombre','=',Input::get('extra'))->where('extra',1)->where('activo',1)->get()) {
			$extras= ProductoGrafica::where('nombre','=',Input::get('extra'))->where('extra',1)->where('activo',1)->firstOrFail();

			if (DB::table('grafica_venta_producto')->select('producto_grafica_id','totales_grafica.year','totales_grafica.month','totales_grafica.monto')
			->where('producto_grafica_id',$extras->id)
			->where('year','=',Input::get('years'))->where('month','=',Input::get('month'))
			->where('monto','=',Input::get('Monto'))
			->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')->get())
				 { 
					return Redirect::back()->with('status','validar')->with('tab', 'tab6')->with('registro', 'edit_tab6');
										
				}else{		
 	//insercion para ventas producto		
        $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = Input::get('Monto');
        $totales_grafica->save();

       	$grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = $extras->id;
		$grafica_venta_producto->save();
		}
		return Redirect::back()->with('status','extra')->with('tab', 'tab6')->with('registro', 'edit_tab6');

		}else{
	
 	//insercion para ventas producto		
        $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = Input::get('Monto');
        $totales_grafica->save();

		$producto_grafica = new ProductoGrafica;
		$producto_grafica->nombre = Input::get('extra');
		$producto_grafica->activo = 1;
		$producto_grafica->departamento_id = 7;
		$producto_grafica->extra = 1;
		$producto_grafica->cartera = 0;
		$producto_grafica->mantenimiento = 0;
		$producto_grafica->categoria = 0;
		$producto_grafica->save();

       	$grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = $producto_grafica->id;
		$grafica_venta_producto->save();


		}
		return Redirect::back()->with('status','created')->with('tab', 'tab6')->with('registro', 'edit_tab6');
		}
}
public function postEdit(){


	$id = TotalesGrafica::where('id','=',Input::get('id'))->firstOrFail();
	$totales_grafica = TotalesGrafica::find($id->id);
	$totales_grafica->monto = Input::get('monto_edit');
	$totales_grafica->save();
	return Redirect::back()->with('status','edit');

	

}	

public function getEgresos(){

	$dataModule["gastos"] = ProductoGrafica::where('activo',1)->get();
	$dataModule['product'] = GraficaVentaProducto::select('totales_grafica.id as total_id','totales_grafica.month','totales_grafica.year','totales_grafica.monto','producto_grafica.nombre as producto','producto_grafica.sueldo_impuesto','producto_grafica.gasto_admon','producto_grafica.gasto_operacion','producto_grafica.gasto_mtto_capilla','producto_grafica.gasto_constr_capilla','producto_grafica.cargo_corporativo')
													  ->leftJoin('producto_grafica','grafica_venta_producto.producto_grafica_id','=','producto_grafica.id')
													  ->leftJoin('totales_grafica','grafica_venta_producto.totales_grafica_id','=','totales_grafica.id')
													  ->get();
		return View::make($this->department.".main", $this->data)->nest('child','administracion.main_egresos', $dataModule);
 		
}
//empiezas registros de gastos
public function postSueldo(){

	if (Input::get('month') == 0) {
	return Redirect::back()->with('status','vacio')->with('tab', 'tab1');
}elseif(Input::get('insercion') == 1){


		if (DB::table('producto_grafica')->select('nombre')->where('nombre','=',Input::get('sueldo_impuesto'))->where('sueldo_impuesto',1)->where('activo',1)->get()) {
			$sueldos= ProductoGrafica::where('nombre','=',Input::get('sueldo_impuesto'))->where('sueldo_impuesto',1)->where('activo',1)->firstOrFail();

			if (DB::table('grafica_venta_producto')->select('producto_grafica_id','totales_grafica.year','totales_grafica.month','totales_grafica.monto')
			->where('producto_grafica_id',$sueldos->id)
			->where('year','=',Input::get('years'))->where('month','=',Input::get('month'))
			->where('monto','=',Input::get('Monto'))
			->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')->get())
				 { 
					return Redirect::back()->with('status','validar')->with('tab', 'tab1');
										
				}else{		
 	//insercion para tablas ventas producto		
        $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = Input::get('Monto');
        $totales_grafica->save();

       	$grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = $sueldos->id;
		$grafica_venta_producto->save();
		}
		return Redirect::back()->with('status','extra')->with('tab', 'tab1');

		}else{
	
 	//insercion para tablas ventas producto		
        $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = Input::get('Monto');
        $totales_grafica->save();

		$producto_grafica = new ProductoGrafica;
		$producto_grafica->nombre = Input::get('sueldo_impuesto');
		$producto_grafica->activo = 1;
		$producto_grafica->departamento_id = 6;
		$producto_grafica->sueldo_impuesto = 1;
		$producto_grafica->egresos = 1;
		$producto_grafica->save();

       	$grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = $producto_grafica->id;
		$grafica_venta_producto->save();


		}
		return Redirect::back()->with('status','created')->with('tab', 'tab1');
		}else{

		$array = Input::get('gastos');
		$sueldos = ProductoGrafica::where('sueldo_impuesto',1)->where('activo',1)->get();
		foreach($sueldos as $sueldo){
	    $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = $array[$sueldo->id];
        $totales_grafica->save();

        $grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = $sueldo->id;
		$grafica_venta_producto->save();
		}
		return Redirect::back()->with('status','created')->with('tab', 'tab1');
	
}
}
public function postGadmon(){

if (Input::get('month') == 0 ) {
	return Redirect::back()->with('status','vacio')->with('tab', 'tab2')->with('registro', 'edit_tab2');
}elseif(Input::get('insercion2') == 1){

		if (DB::table('producto_grafica')->select('nombre')->where('nombre','=',Input::get('gasto_admon'))->where('gasto_admon',1)->where('activo',1)->get()) {
			$admon= ProductoGrafica::where('nombre','=',Input::get('gasto_admon'))->where('gasto_admon',1)->where('activo',1)->firstOrFail();

			if (DB::table('grafica_venta_producto')->select('producto_grafica_id','totales_grafica.year','totales_grafica.month','totales_grafica.monto')
			->where('producto_grafica_id',$admon->id)
			->where('year','=',Input::get('years'))->where('month','=',Input::get('month'))
			->where('monto','=',Input::get('Monto'))
			->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')->get())
				 { 
					return Redirect::back()->with('status','validar')->with('tab', 'tab2')->with('registro', 'edit_tab2');
										
				}else{		
 	//insercion para tablas ventas producto		
        $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = Input::get('Monto');
        $totales_grafica->save();

       	$grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = $admon->id;
		$grafica_venta_producto->save();
		}
		return Redirect::back()->with('status','extra')->with('tab', 'tab2')->with('registro', 'edit_tab2');

		}else{
	
 	//insercion para tablas  ventas producto		
        $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = Input::get('Monto');
        $totales_grafica->save();

		$producto_grafica = new ProductoGrafica;
		$producto_grafica->nombre = Input::get('gasto_admon');
		$producto_grafica->activo = 1;
		$producto_grafica->departamento_id = 6;
		$producto_grafica->gasto_admon = 1;
		$producto_grafica->egresos = 1;
		$producto_grafica->save();

       	$grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = $producto_grafica->id;
		$grafica_venta_producto->save();


		}
		return Redirect::back()->with('status','created')->with('tab', 'tab2')->with('registro', 'edit_tab2');
		}else{
		$array = Input::get('gastos');
		$gastos = ProductoGrafica::where('gasto_admon',1)->where('activo',1)->get();
		foreach($gastos as $gasto){
	    $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = $array[$gasto->id];
        $totales_grafica->save();

        $grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = $gasto->id;
		$grafica_venta_producto->save();
		}
		return Redirect::back()->with('status','created')->with('tab', 'tab2')->with('registro', 'edit_tab2');
	
}

}
public function postGoperacion(){

	if (Input::get('month') == 0 ) {
	return Redirect::back()->with('status','vacio')->with('tab', 'tab3')->with('registro', 'edit_tab3');
}elseif(Input::get('insercion3') == 1){

		if (DB::table('producto_grafica')->select('nombre')->where('nombre','=',Input::get('gasto_operacion'))->where('gasto_operacion',1)->where('activo',1)->get()) {
			$operacion= ProductoGrafica::where('nombre','=',Input::get('gasto_operacion'))->where('gasto_operacion',1)->where('activo',1)->firstOrFail();

			if (DB::table('grafica_venta_producto')->select('producto_grafica_id','totales_grafica.year','totales_grafica.month','totales_grafica.monto')
			->where('producto_grafica_id',$operacion->id)
			->where('year','=',Input::get('years'))->where('month','=',Input::get('month'))
			->where('monto','=',Input::get('Monto'))
			->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')->get())
				 { 
					return Redirect::back()->with('status','validar')->with('tab', 'tab3')->with('registro', 'edit_tab3');
										
				}else{		
 	//insercion para tablas ventas producto		
        $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = Input::get('Monto');
        $totales_grafica->save();

       	$grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = $operacion->id;
		$grafica_venta_producto->save();
		}
		return Redirect::back()->with('status','extra')->with('tab', 'tab3')->with('registro', 'edit_tab3');

		}else{
	
 	//insercion para tablas ventas producto		
        $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = Input::get('Monto');
        $totales_grafica->save();

		$producto_grafica = new ProductoGrafica;
		$producto_grafica->nombre = Input::get('gasto_operacion');
		$producto_grafica->activo = 1;
		$producto_grafica->departamento_id = 6;
		$producto_grafica->gasto_operacion = 1;
		$producto_grafica->egresos = 1;
		$producto_grafica->save();

       	$grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = $producto_grafica->id;
		$grafica_venta_producto->save();


		}
		return Redirect::back()->with('status','created')->with('tab', 'tab3')->with('registro', 'edit_tab3');
		}else{
		$array = Input::get('gastos');
		$gastos = ProductoGrafica::where('gasto_operacion',1)->where('activo',1)->get();
		foreach($gastos as $gasto){
	    $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = $array[$gasto->id];
        $totales_grafica->save();

        $grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = $gasto->id;
		$grafica_venta_producto->save();
		}
		return Redirect::back()->with('status','created')->with('tab', 'tab3')->with('registro', 'edit_tab3');
	
}
}
public function postGMcapilla(){

	if (Input::get('month') == 0 ) {
	return Redirect::back()->with('status','vacio')->with('tab', 'tab4')->with('registro', 'edit_tab4');
}elseif(Input::get('insercion4') == 1){

		if (DB::table('producto_grafica')->select('nombre')->where('nombre','=',Input::get('gasto_mtto_capilla'))->where('gasto_mtto_capilla',1)->where('activo',1)->get()) {
			$mtto= ProductoGrafica::where('nombre','=',Input::get('gasto_mtto_capilla'))->where('gasto_mtto_capilla',1)->where('activo',1)->firstOrFail();

			if (DB::table('grafica_venta_producto')->select('producto_grafica_id','totales_grafica.year','totales_grafica.month','totales_grafica.monto')
			->where('producto_grafica_id',$mtto->id)
			->where('year','=',Input::get('years'))->where('month','=',Input::get('month'))
			->where('monto','=',Input::get('Monto'))
			->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')->get())
				 { 
					return Redirect::back()->with('status','validar')->with('tab', 'tab4')->with('registro', 'edit_tab4');
										
				}else{		
 	//insercion para tabla ventas producto		
        $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = Input::get('Monto');
        $totales_grafica->save();

       	$grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = $mtto->id;
		$grafica_venta_producto->save();
		}
		return Redirect::back()->with('status','extra')->with('tab', 'tab4')->with('registro', 'edit_tab4');

		}else{
	
 	//insercion para tabla ventas producto		
        $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = Input::get('Monto');
        $totales_grafica->save();

		$producto_grafica = new ProductoGrafica;
		$producto_grafica->nombre = Input::get('gasto_mtto_capilla');
		$producto_grafica->activo = 1;
		$producto_grafica->departamento_id = 6;
		$producto_grafica->gasto_mtto_capilla = 1;
		$producto_grafica->egresos = 1;
		$producto_grafica->save();

       	$grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = $producto_grafica->id;
		$grafica_venta_producto->save();


		}
		return Redirect::back()->with('status','created')->with('tab', 'tab4')->with('registro', 'edit_tab4');
		}else{
		$array = Input::get('gastos');
		$gastos = ProductoGrafica::where('gasto_mtto_capilla',1)->where('activo',1)->get();
		foreach($gastos as $gasto){
	    $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = $array[$gasto->id];
        $totales_grafica->save();

        $grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = $gasto->id;
		$grafica_venta_producto->save();
		}
		return Redirect::back()->with('status','created')->with('tab', 'tab4')->with('registro', 'edit_tab4');
	

}
}
public function postGConstrcapilla(){
if (Input::get('month') == 0) {
	return Redirect::back()->with('status','vacio')->with('tab', 'tab5')->with('registro', 'edit_tab5');
}elseif(Input::get('insercion5') == 1){

		if (DB::table('producto_grafica')->select('nombre')->where('nombre','=',Input::get('gasto_cont_capilla'))->where('gasto_constr_capilla',1)->where('activo',1)->get()) {
			$construccion= ProductoGrafica::where('nombre','=',Input::get('gasto_cont_capilla'))->where('gasto_constr_capilla',1)->where('activo',1)->firstOrFail();

			if (DB::table('grafica_venta_producto')->select('producto_grafica_id','totales_grafica.year','totales_grafica.month','totales_grafica.monto')
			->where('producto_grafica_id',$construccion->id)
			->where('year','=',Input::get('years'))->where('month','=',Input::get('month'))
			->where('monto','=',Input::get('Monto'))
			->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')->get())
				 { 
					return Redirect::back()->with('status','validar')->with('tab', 'tab5')->with('registro', 'edit_tab5');
										
				}else{		
 	//insercion para ventas producto		
        $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = Input::get('Monto');
        $totales_grafica->save();

       	$grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = $construccion->id;
		$grafica_venta_producto->save();
		}
		return Redirect::back()->with('status','extra')->with('tab', 'tab5')->with('registro', 'edit_tab5');

		}else{
	
 	//insercion para ventas producto		
        $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = Input::get('Monto');
        $totales_grafica->save();

		$producto_grafica = new ProductoGrafica;
		$producto_grafica->nombre = Input::get('gasto_cont_capilla');
		$producto_grafica->activo = 1;
		$producto_grafica->departamento_id = 6;
		$producto_grafica->gasto_constr_capilla = 1;
		$producto_grafica->egresos = 1;
		$producto_grafica->save();

       	$grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = $producto_grafica->id;
		$grafica_venta_producto->save();


		}
		return Redirect::back()->with('status','created')->with('tab', 'tab5')->with('registro', 'edit_tab5');
		}else{
		$array = Input::get('gastos');
		$gastos = ProductoGrafica::where('gasto_constr_capilla',1)->where('activo',1)->get();
		foreach($gastos as $gasto){
	    $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = $array[$gasto->id];
        $totales_grafica->save();

        $grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = $gasto->id;
		$grafica_venta_producto->save();
		}
		return Redirect::back()->with('status','created')->with('tab', 'tab5')->with('registro', 'edit_tab5');
	

		}

}
public function postGcorporativo(){
if (Input::get('month') == 0 ) {
	return Redirect::back()->with('status','vacio')->with('tab', 'tab6')->with('registro', 'edit_tab6');
}elseif(Input::get('insercion6') == 1){

		if (DB::table('producto_grafica')->select('nombre')->where('nombre','=',Input::get('gasto_corp'))->where('cargo_corporativo',1)->where('activo',1)->get()) {
			$corp= ProductoGrafica::where('nombre','=',Input::get('gasto_corp'))->where('cargo_corporativo',1)->where('activo',1)->firstOrFail();

			if (DB::table('grafica_venta_producto')->select('producto_grafica_id','totales_grafica.year','totales_grafica.month','totales_grafica.monto')
			->where('producto_grafica_id',$corp->id)
			->where('year','=',Input::get('years'))->where('month','=',Input::get('month'))
			->where('monto','=',Input::get('Monto'))
			->leftJoin('totales_grafica', 'grafica_venta_producto.totales_grafica_id', '=', 'totales_grafica.id')->get())
				 { 
					return Redirect::back()->with('status','validar')->with('tab', 'tab6')->with('registro', 'edit_tab6');
										
				}else{		
 	//insercion para ventas producto		
        $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = Input::get('Monto');
        $totales_grafica->save();

       	$grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = $corp->id;
		$grafica_venta_producto->save();
		}
		return Redirect::back()->with('status','extra')->with('tab', 'tab6')->with('registro', 'edit_tab6');

		}else{
	
 	//insercion para ventas producto		
        $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = Input::get('Monto');
        $totales_grafica->save();

		$producto_grafica = new ProductoGrafica;
		$producto_grafica->nombre = Input::get('gasto_corp');
		$producto_grafica->activo = 1;
		$producto_grafica->departamento_id = 6;
		$producto_grafica->cargo_corporativo = 1;
		$producto_grafica->egresos = 1;
		$producto_grafica->save();

       	$grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = $producto_grafica->id;
		$grafica_venta_producto->save();


		}
		return Redirect::back()->with('status','created')->with('tab', 'tab6')->with('registro', 'edit_tab6');
		}else{
		$array = Input::get('gastos');
		$gastos = ProductoGrafica::where('cargo_corporativo',1)->where('activo',1)->get();
		foreach($gastos as $gasto){
	    $totales_grafica = new TotalesGrafica;
        $totales_grafica->year =  Input::get('years');
        $totales_grafica->month = Input::get('month');
        $totales_grafica->monto = $array[$gasto->id];
        $totales_grafica->save();

        $grafica_venta_producto = new GraficaVentaProducto;
       	$grafica_venta_producto->totales_grafica_id = $totales_grafica->id;
		$grafica_venta_producto->producto_grafica_id = $gasto->id;
		$grafica_venta_producto->save();
		}
		return Redirect::back()->with('status','created')->with('tab', 'tab6')->with('registro', 'edit_tab6');
	


		}
}
}

