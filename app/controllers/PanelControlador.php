<?php 
use Carbon\Carbon;
	class PanelControlador extends ModuloControlador{
		public $data = array();
		public $products = ['Lotes Funerarios', 'Construcciones', 'Servicio Funeral', 'Trámites', 'Mantenimiento', 'Inhumación', 'Exhumación', 'Extras']; 
		public $department;
		
		function __construct(){
			$this->data["module"] = "Panel de Control";
			$this->data["icon"] = "home";
			$this->department = Auth::user()->departamento->nombre;
		}
		public function index(){
			
			


/*

$month = Carbon::now();
$month = $month->subMonths(1);
$month = $month->format('m');




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

$categories = ProductoGrafica::where('activo',1)->get();


$datos = VentaProductoGrafica::select('venta_producto_grafica.monto')->where('month', $month)->where('year',$year)->get();

$datos_s1 = VentaProductoGrafica::select('venta_producto_grafica.monto')->where('month', $month)->where('year',$year1)->get();

$datos_s2 = VentaProductoGrafica::select('venta_producto_grafica.monto')->where('month', $month)->where('year',$year2)->get();

$datos_s3 = VentaProductoGrafica::select('venta_producto_grafica.monto')->where('month', $month)->where('year',$year3)->get();			

									
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



			*/ $panel = PanelFactory::build($this->department);			
			$months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre','Octubre', 'Noviembre', 'Diciembre'];
			$this->data["products"] = $this->products;
			$this->data["currentMonth"] = $months[date('n') - 1];
			$this->data["graphs"] = $panel->get();						
			/*$this->data["year"] = $year;
			$this->data["mes"] = $mes_string;
			$this->data["serie"] = $serie;
			$this->data["serie1"] = $serie1;
			$this->data["serie2"] = $serie2;
			$this->data["serie3"] = $serie3;
			$this->data["categories"] = $categories;
			

*/

			return View::make($this->department.".main", $this->data);
		}
	}