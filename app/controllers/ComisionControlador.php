<?php 
class ComisionControlador extends ModuloControlador{

	function __construct(){
		$this->data["module"] = "Comisiones";
		$this->data["icon"] = "money";
		$this->department = Auth::user()->departamento->nombre;
	}

	function getIndex(){
		$total = Comision::where('cancelada', '0')->where('pagada', 0)->sum('total');
		$dataModule["comisiones"] = Comision::with('asesor.persona', 'venta.cliente.persona')->where('cancelada', 0)->where('pagada', 0)->get();
		$dataModule["total"] = number_format($total, 2, ".", ",");
		return View::make($this->department.".main", $this->data)->nest('child', $this->department.'.comision' , $dataModule);
	}
}