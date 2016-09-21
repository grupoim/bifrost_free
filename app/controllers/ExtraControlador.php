<?php 
	class ExtraControlador extends ModuloControlador{
		public $data = array();
		public $department;

		function __construct(){
			$this->data["module"] = "Extra";

			$this->data["icon"] = "cart-plus";
			$this->department = Auth::user()->departamento->nombre;
		}
		

		public function getIndex(){	
			/*$data["sectores"] = Sector::all(); 			
 			$data["recintos"]= Recinto::all();

			return View::make($this->department.".main", $this->data)->nest('child','operaciones.lotesfunerarios', $data);*/
        }
        public function getCreate(){
			$modal['title'] = 'Nuevo Extra cargo';
			$modal['button_cancel'] = 'Cancelar';
			$modal['button_ok'] = 'Agregar Extra';
			$data['modal'] = $modal;
			return View::make('formularios.extra', $data);
		}

		public function postStore(){
			return Response::json(array(
				"success" => false, 
				"messages" => array("El campo de Nombre es requerido", "El campo de apellido es requerido")
			));
		}

        public function getAll(){
        	$extras = VistaExtra::select('id', 'nombre', 'precio_extra', 'porcentaje_comision', DB::raw('CONCAT(nombre, " ","$", (round(precio_extra * 1.16))) AS nombre_display'))->get();
			return Response::Json($extras);
        }
	}
 ?>