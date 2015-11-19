<?php 
	class RecubrimientoControlador extends ModuloControlador{
		public $moduleName = "Recubrimientos";
		public function getIndex(){
			$data["module"] = $this->moduleName;
 			return View::make("sistemas.main", $data);
		}
	}
 ?>