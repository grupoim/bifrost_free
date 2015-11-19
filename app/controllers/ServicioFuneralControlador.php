<?php 
	class ServicioFuneralControlador extends ModuloControlador{
		public $moduleName = "Servicio Funeral";
		public function getIndex(){
			$data["module"] = $this->moduleName;
 			return View::make("sistemas.main", $data);
		}
	}
 ?>