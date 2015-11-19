<?php 
	class PerfilControlador extends ModuloControlador{
		public $data = array();
		public $department;

		function __construct(){
			$this->data["module"] = "Captura de nuevos productos";			
			$this->data["icon"] = "cart-plus";			
			$this->department = Auth::user()->departamento->nombre;
		}		

		public function getIndex(){				
			
			return View::make($this->department.".main", $this->data)->nest('child','sistemas.perfil_usuario');
        }

	}