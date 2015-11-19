<?php 
	class CesionDerechoControlador extends ModuloControlador{
		public $moduleName = "Cesión de Derecho";
		public function getIndex(){
			$data["module"] = $this->moduleName;
 			return View::make("sistemas.main", $data);
		}
	}
 ?>