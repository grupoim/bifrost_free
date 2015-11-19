<?php 
	class MaterialControlador extends ModuloControlador{
		public $moduleName = "Materiales";
		public function getIndex(){
			$data["module"] = $this->moduleName;
 			return View::make("sistemas.main", $data);
		}
	}
 ?>