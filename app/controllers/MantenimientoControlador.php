<?php 
	class MantenimientoControlador extends ModuloControlador{
		public $data = array();
		public $department;

		function __construct(){
			$this->data["module"] = "Mantenimiento";			
			$this->data["icon"] = "leaf";
			$this->data["concept1"] = "Vencidos";
			$this->data["concept2"] = "Activos";
			$this->data["concept3"] = "Plantar";
			$fecha_actual= date("Y-m-d");
			$this->data["count1"] = VentaMantenimiento::where('fecha_fin', '<', $fecha_actual )->count(); /* propiedades con mantenimiento vencido*/
			$this->data["count2"] = Mantenimiento::count(); /*propiedades con mantenimiento activo*/
			$this->data["count3"] = cesped::count(); /* propiedades por plantar */
			$this->data["cesped"] = cesped::sum('cantidad'); /* cesped requerido para plantacion */

			
			$this->department = Auth::user()->departamento->nombre;
		}		

		public function getIndex(){	
			$dataModule["mantenimientos"] = VentaMantenimiento::get();
			
			
			return View::make($this->department.".main", $this->data)->nest('child','mantenimiento.mantenimiento', $dataModule);
        }
    }
 ?>