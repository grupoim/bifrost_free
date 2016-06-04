<?php 
class ComisionControlador extends ModuloControlador{


	function __construct(){
		$this->data["module"] = "Comisiones";
		$this->data["icon"] = "money";
		$this->department = Auth::user()->departamento->nombre;
	}

	public function getIndex(){
		$total = Comision::where('cancelada', '0')->where('pagada', 0)->sum('total');
		$dataModule["comisiones"] = VistaComision::all();
		/*$dataModule["comisiones"] = Comision::with('asesor.persona', 'venta.cliente.persona','venta.ventaproducto.producto')->where('cancelada', 0)->where('pagada', 0)->get();*/
		$dataModule["total"] = number_format($total, 2, ".", ",");
		

		return View::make($this->department.".main", $this->data)->nest('child', $this->department.'.comision' , $dataModule);
	}
	public function getAll(){
		$comisiones = VistaComision::all();
		return Response::Json($comisiones);
	}

	public function getArchivo(){


   Excel::load('public/archivo.xlsx', function($archivo)
  {
   $resultados = $archivo->get();
 
   foreach($resultados as $resultado => $valor)
   {
  	$comision =  VistaComision::find($valor->pkc); 

  	
  	echo $comision['id'].'<br>';
  
   }
  })->first();
		
	
	}
}