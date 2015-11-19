<?php 
	class ExhumacionControlador extends ModuloControlador{
		public $moduleName = "Exhumación";
		public function getIndex(){
			$data["module"] = $this->moduleName;
 			return View::make("sistemas.main", $data);
		}
	}
 ?>