<?php 
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
			$panel = PanelFactory::build($this->department);
			$months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre','Octubre', 'Noviembre', 'Diciembre'];
			$this->data["products"] = $this->products;
			$this->data["currentMonth"] = $months[date('n') - 1];
			$this->data["graphs"] = $panel->get();
			return View::make($this->department.".main", $this->data);
		}
	}