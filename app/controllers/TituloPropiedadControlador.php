<?php 
	class TituloPropiedadControlador extends ModuloControlador{
		public $moduleName = "Titulo de Propiedad";
		public function getIndex(){
			$data["module"] = $this->moduleName;
 			return View::make("sistemas.main", $data);
		}
	}
 ?>