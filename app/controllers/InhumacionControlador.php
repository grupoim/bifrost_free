<?php 
	class InhumacionControlador extends ModuloControlador{		
		public $data = array();
		public $department;

		function __construct(){
			$this->data["module"] = "Inhumacion";			
			$this->data["icon"] = "bed";
			$this->data["tipo"] = "Servicios Pendientes";
			$this->department = Auth::user()->departamento->nombre;
		}		

		public function getIndex(){	
			$dataModule['vendedores'] = VistaAsesorPromotor::where('activo', '=', 1)->orderby('asesor')->get();
        	$dataModule['contratos'] = Contrato::all();
        	$dataModule['funerarias'] = Funeraria::all();

			
			return View::make($this->department.".main", $this->data)->nest('child','operaciones.inhumacion',$dataModule);
        }

        public function genNueva(){
        	$dataModule['vendedores'] = VistaAsesorPromotor::all();
        	$dataModule['contratos'] = Contrato::all();
        	$dataModule['funerarias'] = Funerarias::all();


        	return View::make($this->department.".main", $this->data)->nest('child','operaciones.inhumacion',$dataModule);

        }

        public function getServicios(){
        	return 7;
        }
	}
 ?>