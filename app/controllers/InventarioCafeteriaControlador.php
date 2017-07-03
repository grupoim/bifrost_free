<?php

class InventarioCafeteriaControlador extends \BaseController {

	public $data = array();
		public $department;
		function __construct(){
			$this->data["module"] = "Control de inventario ";			
			$this->data["icon"] = "cart-plus";			
			$this->department = Auth::user()->departamento->nombre;
		}	
			
	public function getIndex()
		{
		$dataModule["status"] = Session::pull('status');
		$dataModule["inventarios"] = Inventario::select('inventario.id as inventario_id','producto.id as producto_id','inventario.almacen_id','almacen.nombre as almacen','unidad_medida.nombre as unidad','inventario.existencia','inventario.descripcion'
			,'producto.nombre as producto','producto.codigo','producto.activo','producto.combo')							
									->leftJoin('almacen', 'almacen.id', '=', 'inventario.almacen_id')
									->leftJoin('unidad_medida', 'unidad_medida.id', '=', 'inventario.unidad_medida_id')
									->leftJoin('producto', 'producto.id', '=', 'inventario.producto_id')
									->get();
		$dataModule["usuarios"] = Usuario::select(DB::raw("CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) as usuario"),'usuario.id')
									->where('activo',1)
									->leftJoin('persona', 'persona.id', '=', 'usuario.persona_id')->get();
		$dataModule["acciones"] = Accion::all();
		$dataModule['proveedores'] = Proveedor::select('proveedor.nombre','proveedor.id')->leftjoin('departamento', 'departamento.id', '=', 'proveedor.departamento_id')
													->where('proveedor.activo',1)->get();
		return View::make($this->department.".main", $this->data)->nest('child', $this->department.'.inventario', $dataModule);
		

	}

public function getMovimientos(){
	
	$dataModule["movimientos"] = Movimiento::select('usuario.nombre as usuario_id','accion.nombre as accion_id','movimiento.fecha','movimiento.created_at'
		,'movimiento.cantidad','movimiento.inventario_id','inventario.producto_id','producto.nombre as producto','persona.nombres as pnombre','persona.apellido_paterno as p_paterno','persona.apellido_materno as p_materno')
							->leftJoin('usuario','usuario.id','=','movimiento.usuario_id')
							->leftJoin('persona','persona.id','=','usuario.persona_id')
							->leftJoin('accion','accion.id','=','movimiento.accion_id')
							->leftJoin('inventario','inventario.id','=','movimiento.inventario_id')
							->leftJoin('producto','producto.id','=','inventario.producto_id')
							->get();


		return View::make($this->department.".main", $this->data)->nest('child', $this->department.'.movimiento', $dataModule);
			
	
}

	public function getPersonas(){	
	$usuarios =DB::table('usuario')->select(DB::raw("CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) as usuario"),'usuario.id')
									->where('activo',1)
									->leftJoin('persona', 'persona.id', '=', 'usuario.persona_id')->get();
	return Response::Json($usuarios);
	}
	public function getProveedor(){	
	$proveedores =DB::table('proveedor')->select('proveedor.nombre','proveedor.id')->leftjoin('departamento', 'departamento.id', '=', 'proveedor.departamento_id')
													->where('proveedor.activo',1)->get();
	return Response::Json($proveedores);

	}


public function getBaja($id){

			
			$producto = Producto::find($id);
			$producto->activo = 0;
			$producto->save();
			return Redirect::back()->with('status', 'producto_baja');
}

public function getAlta($id){

			
			$producto = Producto::find($id);
			$producto->activo = 1;
			$producto->save();
			return Redirect::back()->with('status', 'producto_alta');
}

//movimientos

public function postMovimiento(){

if (Input::get('usuario_id') == 0) {
return Redirect::back()->with('status', 'movimiento_error');

}else{ 

	switch (Input::get('accion_id')) {
		case '1':
	$existencia_validacion = Inventario::where('id',Input::get('lista'))->firstOrFail();
if ($existencia_validacion->existencia < Input::get('cantidad')) {


return Redirect::back()->with('status', 'existencia_error');

	 }elseif (DB::table('movimiento')->where('inventario_id','=',Input::get('lista'))->get()) {

			$movimiento = new Movimiento;
			$movimiento->usuario_id = Input::get('usuario_id');
			$movimiento->accion_id = Input::get('accion_id');
			$movimiento->inventario_id = Input::get('lista');
			$movimiento->fecha = Input::get('fecha');
			$movimiento->cantidad = Input::get('cantidad');
			$movimiento->save();

			$id= Inventario::where('id','=',Input::get('lista'))->firstOrFail();
			$producto = $id->producto_id;
			$stock = Inventario::where('producto_id','=',$producto)->where('almacen_id',2)->firstOrFail();
			$inventario = Inventario::find($stock->id);
			$inventario->id = $stock->id;
			$inventario->existencia = $stock->existencia + Input::get('cantidad');
			$inventario->save();

			
			$inventarioPV =  Inventario::find($id->id);
			$inventarioPV->id = $id->id;
			$inventarioPV->existencia = $id->existencia - Input::get('cantidad');
			$inventarioPV->descripcion = ' ';
			$inventarioPV->producto_id =$id->producto_id;
			$inventarioPV->save();

		 return Redirect::back()->with('status', 'movimiento');
	
	}else{

	
			
			$movimiento = new Movimiento;
			$movimiento->usuario_id = Input::get('usuario_id');
			$movimiento->accion_id = Input::get('accion_id');
			$movimiento->inventario_id = Input::get('lista');
			$movimiento->fecha = Input::get('fecha');
			$movimiento->cantidad = Input::get('cantidad');
			$movimiento->save();

			$id= Inventario::where('id','=',Input::get('lista'))->firstOrFail();
			$inventario = Inventario::find($id->id);
			$inventario->id = $id->id;
			$inventario->existencia = $id->existencia - Input::get('cantidad');
			$inventario->save();
			
			$inventarioPV = new Inventario;
			$inventarioPV->almacen_id = 2;
			$inventarioPV->unidad_medida_id = $id->unidad_medida_id;
			$inventarioPV->existencia = Input::get('cantidad');
			$inventarioPV->descripcion = ' ';
			$inventarioPV->producto_id = $id->producto_id;
			$inventarioPV->save();

 return Redirect::back()->with('status', 'movimiento');

}

			break;
		case '2':

			$movimiento = new Movimiento;
			$movimiento->usuario_id = Input::get('usuario_id');
			$movimiento->accion_id = Input::get('accion_id');
			$movimiento->inventario_id = Input::get('lista');
			$movimiento->fecha = Input::get('fecha');
			$movimiento->cantidad = Input::get('cantidad');
			$movimiento->save();

			$id= Inventario::where('id','=',Input::get('lista'))->firstOrFail();		
			$inventarioPV =  Inventario::find($id->id);
			$inventarioPV->id = $id->id;
			$inventarioPV->existencia = $id->existencia + Input::get('cantidad');
			$inventarioPV->descripcion = ' ';
			$inventarioPV->producto_id =$id->producto_id;
			$inventarioPV->save();

			return Redirect::back()->with('status', 'movimiento_surtir');

			break;
		case '3':
			
			$movimiento = new Movimiento;
			$movimiento->usuario_id = Input::get('usuario_id');
			$movimiento->accion_id = Input::get('accion_id');
			$movimiento->inventario_id = Input::get('lista');
			$movimiento->fecha = Input::get('fecha');
			$movimiento->cantidad = Input::get('cantidad');
			$movimiento->save();

return Redirect::back()->with('status', 'movimiento');
			break;		
		default:
		return Redirect::back()->with('status', 'movimiento_error');
			break;
	}
}

}


public function postEdit(){

		$id = Inventario::where('id','=', Input::get('edit'))->firstOrFail();

		$producto_cafeteria = Producto::find($id->producto_id);
		$producto_cafeteria->id = $id->producto_id;
		$producto_cafeteria->nombre = Input::get('nombre');		        
		$producto_cafeteria->save();

		$inventario = Inventario::find($id->id);
		$inventario->id = $id->id;
		$inventario->descripcion = Input::get('descripcion');
		$inventario->save();

		return Redirect::back()->with('status', 'producto_editado');

}


}
