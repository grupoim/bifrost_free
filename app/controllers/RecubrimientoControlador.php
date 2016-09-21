<?php 
	class RecubrimientoControlador extends ModuloControlador{
		public $moduleName = "Recubrimientos";
		public function getIndex(){
			$data["module"] = $this->moduleName;
 			return View::make("sistemas.main", $data);
		}
		public function postStore(){
			return Response::json(array(
				"success" => false, 
				"messages" => array("El campo de Nombre es requerido", "El campo de apellido es requerido")
			));
		}

        public function getAll(){
        	$productos_recubrimientos = VistaRecubrimiento::select('id', 'nombre', 'precio_recubrimiento', 'porcentaje_comision', DB::raw('CONCAT(nombre, " ","$", (round(precio_recubrimiento * 1.16))) AS nombre_display'))->get();
			return Response::Json($productos_recubrimientos);
        }
	}
 ?>