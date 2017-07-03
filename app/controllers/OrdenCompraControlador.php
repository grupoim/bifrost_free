<?php

class OrdenCompraControlador extends \BaseController {


	public $data = array();
		public $department;
		function __construct(){
			$this->data["module"] = "Control de inventario";			
			$this->data["icon"] = "cart-plus";			
			$this->department = Auth::user()->departamento->nombre;
		}



		public function postOrden(){

		if (Input::get('usuario_id') == 0 || Input::get('proveedor_id') == 0 ) {

				return Redirect::back()->with('status', 'movimiento_error');

		}elseif (DB::table('apertura_orden')->where('activo',1)->orderBy('id', 'desc')->first()) {
				
				$last_id = AperturaOrden::where('activo',1)->orderBy('id', 'desc')->first();
			$apertura_orden = new AperturaOrden;
			$apertura_orden->fecha = Input::get('fecha');
			$apertura_orden->usuario_id = Input::get('usuario_id');
			$apertura_orden->proveedor_id = Input::get('proveedor_id');			
			$apertura_orden->save();
			return Redirect::action('OrdenCompraControlador@getOrden', $apertura_orden->id);
			
			$apertura_orden_editar = AperturaOrden::find($last_id->id);
			$apertura_orden_editar->cancelar = 1;
			$apertura_orden_editar->activo = 0;
			$apertura_orden_editar->save();	
			}else {


			$apertura_orden = new AperturaOrden;
			$apertura_orden->fecha = Input::get('fecha');
			$apertura_orden->usuario_id = Input::get('usuario_id');
			$apertura_orden->proveedor_id = Input::get('proveedor_id');
			$apertura_orden->save();


			return Redirect::action('OrdenCompraControlador@getOrden', $apertura_orden->id);
		}
	}

public function getOrden($id){
$dataModule["status"] = Session::pull('status');
$proveedor = AperturaOrden::where('apertura_orden.id',$id)->firstorFail();
$proveedor_id = $proveedor->proveedor_id;	

	if (DB::table('producto_proveedor')->where('producto_proveedor.proveedor_id',$proveedor_id)->where('producto.activo',1)->leftjoin('producto','producto.id','=','producto_proveedor.producto_id')->get()) {
		
			$dataModule["productos"] = ProductoProveedor::select('producto.nombre as producto','producto.id as producto_id','producto.codigo','proveedor.nombre as proveedor','proveedor.id as proveedor_id',
			'inventario.existencia','almacen.nombre as almacen', 'producto.combo','inventario.id as inventario')->where('producto.activo',1)
											->where('almacen.nombre','=','Stock')
											->where('producto_proveedor.proveedor_id',$proveedor_id)																		
											->leftjoin('producto','producto.id','=','producto_proveedor.producto_id')
											->leftjoin('proveedor','proveedor.id','=','producto_proveedor.proveedor_id')
											->leftjoin('departamento', 'departamento.id', '=', 'producto.departamento_id')
											->leftjoin('inventario','inventario.producto_id','=','producto.id')
											->leftjoin('almacen','almacen.id','=','inventario.almacen_id')									
											->get();
		$dataModule["apertura"] = $id;
		$dataModule["cantidades"] = Orden::select('inventario.id as inventario','orden.cantidad')->where('apertura_orden_id',$id)->leftjoin('inventario','inventario.id','=','orden.inventario_id')->get();
		$dataModule["cerrar"] = AperturaOrden::where('id',$id)->firstorFail();
		return View::make($this->department.".main", $this->data)->nest('child', $this->department.'.orden', $dataModule);
	}else{


 return Redirect::back()->with('status', 'proveedor_error');
}

}
//
public function postOrdena(){

	if (DB::table('apertura_orden')->where('apertura_orden.id','=',Input::get('apertura_id'))->where('activo',0)->get()) {
		
	return Redirect::back()->with('status', 'orden_vacia');
	
	}elseif(DB::table('orden')->where('inventario_id','=',Input::get('inventario'))->where('apertura_orden_id','=',Input::get('apertura_id'))->get()) {

	$id = Orden::where('inventario_id','=',Input::get('inventario'))->where('apertura_orden_id','=',Input::get('apertura_id'))->firstorFail();		
	$orden = Orden::find($id->id);
	$orden->cantidad = Input::get('cantidad');
	$orden->src = $id->src;
	$orden->save();
	return Redirect::back();

	}else{

		$codigobarras = Producto::where('inventario.id','=', Input::get('inventario'))->leftjoin('inventario','inventario.producto_id','=','producto.id')->firstorFail();

	$array = Input::get('src');
	$codigos = $codigobarras->codigo;

	$orden = new Orden;
	$orden->cantidad = Input::get('cantidad');
	$orden->inventario_id = Input::get('inventario');
	$orden->apertura_orden_id = Input::get('apertura_id');
	$orden->src = $array[$codigos];
	$orden->save();
	return Redirect::back();
 
}
}


// genera pdf de orden de compra
public function getPedido($id)
{
		
$proveedor = AperturaOrden::where('apertura_orden.id',$id)->firstorFail();
$proveedor_id = $proveedor->proveedor_id;


		$producto_proveedor = ProductoProveedor::select('producto.nombre as producto','proveedor.nombre as proveedor','proveedor.id as proveedor_id','orden.cantidad as cantidad_orden','apertura_orden.activo as activo_orden'
			,'orden.apertura_orden_id as orden_folio','apertura_orden.fecha')
											->where('orden.apertura_orden_id',$id)
											->where('producto_proveedor.proveedor_id',$proveedor_id)																
											->leftjoin('producto','producto.id','=','producto_proveedor.producto_id')
											->leftjoin('proveedor','proveedor.id','=','producto_proveedor.proveedor_id')
											->leftjoin('inventario','inventario.producto_id','=','producto.id')
											->leftjoin('orden','orden.inventario_id','=','inventario.id')
											->leftjoin('apertura_orden','apertura_orden.id','=','orden.apertura_orden_id')								
											->firstorFail();

		$producto = ProductoProveedor::select('producto.nombre as producto','proveedor.nombre as proveedor','proveedor.id as proveedor_id','orden.cantidad as cantidad_orden','apertura_orden.activo as activo_orden'
			,'orden.apertura_orden_id as orden_folio','apertura_orden.fecha','producto.codigo','orden.src')
											->where('orden.apertura_orden_id',$id)
											->where('producto_proveedor.proveedor_id',$proveedor_id)																
											->leftjoin('producto','producto.id','=','producto_proveedor.producto_id')
											->leftjoin('proveedor','proveedor.id','=','producto_proveedor.proveedor_id')
											->leftjoin('inventario','inventario.producto_id','=','producto.id')
											->leftjoin('orden','orden.inventario_id','=','inventario.id')
											->leftjoin('apertura_orden','apertura_orden.id','=','orden.apertura_orden_id')											
											->get();

		$usuario = AperturaOrden::select('persona.nombres as pnombre','persona.apellido_paterno as p_paterno','persona.apellido_materno as p_materno')
							->where('apertura_orden.id',$id)
							->leftjoin('usuario','usuario.id','=','apertura_orden.usuario_id')
							->leftJoin('persona','persona.id','=','usuario.persona_id')
							->firstorFail();

  	$data['producto_proveedores'] = $producto_proveedor;
  	$data['productos'] = $producto;
  	$data['usuario'] = $usuario;


    	$pdf = DOPDF::loadView('formularios.orden_compra_pdf',$data)->setPaper('letter');
      	$dom_pdf = $pdf->getDomPDF();
		$pdf->output();
		$canvas = $dom_pdf ->get_canvas();
		$canvas->page_text(700, 600, " {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
      return $pdf->stream();


}
public function getCerrar($id){

if (DB::table('orden')->where('apertura_orden_id',$id)->get()) {
	
	$apertura_orden = AperturaOrden::find($id);
	$apertura_orden->activo = 0;
	$apertura_orden->save();
	return Redirect::back();
}else{

return Redirect::back()->with('status', 'orden_cerrar');

}


}
public function getCancelar($id){

	$apertura_orden = AperturaOrden::find($id);
	$apertura_orden->cancelar = 1;
	$apertura_orden->activo = 0;
	$apertura_orden->save();
	return Redirect::action('InventarioCafeteriaControlador@getIndex');

}

public function getDenegar($id){

	$apertura_orden = AperturaOrden::find($id);
	$apertura_orden->cancelar = 1;
	$apertura_orden->activo = 0;
	$apertura_orden->save();
	return Redirect::back();

}

//ordenes realizadas 

public function getOrdenes(){

	$dataModule["ordenes"] = Orden::select('orden.cantidad as cantidad_orden','apertura_orden.fecha','apertura_orden.activo as activo_orden','apertura_orden.cancelar as cancelado'
		,'persona.nombres as pnombre','persona.apellido_paterno as p_paterno','persona.apellido_materno as p_materno','proveedor.nombre as proveedor','producto.nombre as producto','orden.apertura_orden_id as orden','apertura_orden.created_at','apertura_orden.aprobado as aprobado_orden')
										->leftJoin('inventario','inventario.id','=','orden.inventario_id')
										->leftjoin('producto','producto.id','=','inventario.producto_id')
										->leftjoin('apertura_orden','apertura_orden.id','=','orden.apertura_orden_id')
										->leftjoin('proveedor','proveedor.id','=','apertura_orden.proveedor_id')
										->leftjoin('usuario','usuario.id','=','apertura_orden.usuario_id')
										->leftJoin('persona','persona.id','=','usuario.persona_id')
										->groupBy('orden.apertura_orden_id')
										->get();
		return View::make($this->department.".main", $this->data)->nest('child', $this->department.'.orden_realizada', $dataModule);
}
// se surte el inventario mediante la orden de compra
public function getSurtir($id){

	
	$ordenes = Orden::where('orden.apertura_orden_id',$id)->get();
foreach ($ordenes as $orden) {

	$inventario = inventario::where('inventario.id',$orden->inventario_id)->firstorFail();
	$inventario = Inventario::find($orden->inventario_id);
	$inventario->id = $orden->inventario_id;
	$inventario->existencia = $orden->cantidad + $inventario->existencia;
	$inventario->save();

	$apertura_orden = AperturaOrden::find($id);
	$apertura_orden->id = $id;
	$apertura_orden->aprobado = 1;
	$apertura_orden->save();

$apertura_orden_registros = AperturaOrden::where('apertura_orden.id',$id)->firstorFail();
	$movimiento = new Movimiento;
	$movimiento->usuario_id = $apertura_orden_registros->usuario_id;
	$movimiento->accion_id = 2;
	$movimiento->inventario_id = $orden->inventario_id;
	$movimiento->fecha = $apertura_orden_registros->fecha;
	$movimiento->cantidad = $orden->cantidad;
	$movimiento->save();


}
return Redirect::action('InventarioCafeteriaControlador@getIndex');
}

}
