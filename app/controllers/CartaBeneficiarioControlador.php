<?php 
	class CartaBeneficiarioControlador extends ModuloControlador{
		public $moduleName = "Carta de Beneficiario";
		public function getIndex(){
			$data["module"] = $this->moduleName;
 			return View::make("sistemas.main", $data);
		}
	}
 ?>