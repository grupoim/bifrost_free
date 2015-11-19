<?php 
	class AlmacenControlador extends ModuloControlador{
		public $moduleName = "Almacen";
		public function getIndex(){
			$data["module"] = $this->moduleName;
 			return View::make("sistemas.panel", $data);
		}

		public function getNuevo(){
			return View::make('form');
		}

		public function postGuardar(){
			echo Input::get('nombre');
		}
	}
 ?>