<?php 
	class ContratacionControlador extends ModuloControlador{
		public $moduleName = "Contratación";
		public function getIndex(){
			$data["module"] = $this->moduleName;
 			return View::make("sistemas.main", $data);
		}
	}
 ?>