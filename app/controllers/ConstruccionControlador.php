<?php 
	class ConstruccionControlador extends ModuloControlador{
		public $data = array();
		public $department;

		function __construct(){
			$this->data["module"] = "Construccion";

			$this->data["icon"] = "hospital";
			$this->department = Auth::user()->departamento->nombre;
		}
		

		public function getIndex(){	
			/*$data["sectores"] = Sector::all(); 			
 			$data["recintos"]= Recinto::all();

			return View::make($this->department.".main", $this->data)->nest('child','operaciones.lotesfunerarios', $data);*/
        }
        public function getCreate(){
			$modal['title'] = 'Nueva construccion';
			$modal['button_cancel'] = 'Cancelar';
			$modal['button_ok'] = 'Agregar Construccion';
			$data['modal'] = $modal;
			return View::make('formularios.construccion', $data);
		}

		public function postStore(){
			return Response::json(array(
				"success" => false, 
				"messages" => array("El campo de Nombre es requerido", "El campo de apellido es requerido")
			));
		}

        public function getAll(){
        	$construcciones = VistaProductoConstruccion::select('id', 'nombre', 'precio_construccion', 'porcentaje_comision', DB::raw('CONCAT(nombre, " ","$", (round(precio_construccion * 1.16))) AS nombre_display'))->get();
			return Response::Json($construcciones);
        }
	}
 ?>