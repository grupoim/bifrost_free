<?php 
	class ProductoControlador extends ModuloControlador{
	public $data = array();
		public $department;

		function __construct(){
			$this->data["module"] = "Captura de nuevos productos";			
			$this->data["icon"] = "cart-plus";			
			$this->department = Auth::user()->departamento->nombre;
		}	

			

		public function getIndex(){				
			
			
			$dataModule['construcciones'] = Construccion::groupby('descripcion')->orderby('descripcion')->get();
			
			$dataModule['mantenimientos'] = VistaPreciosMantenimiento::all();

			$dataModule["config_gral"] = ConfiguracionGeneral::where('activo',1)->firstorfail();
			
			$dataModule['paquetes'] = Paquete::groupby('paquete_id')->get();

			$dataModule['productos_combo'] = Producto::where('combo',1)->get();

			$dataModule['productos'] = Producto::with('precio')->get();

			$dataModule['precio_paquete'] = Producto::select('producto.id', 'precio.monto')
													->leftjoin('precio', 'producto.id', '=', 'precio.producto_id')
													->where('precio.activo', 1)
													->get();

			$dataModule['departamentos']= Departamento::all();

			$dataModule['contenido_paquete'] = Paquete::select('paquete.id','paquete.paquete_id','paquete.producto_id as item_id','producto.nombre as nombre_paquete','px.nombre as item')
														->leftjoin('producto','paquete.paquete_id','=','producto.id' )							
														->leftjoin('producto as px', 'paquete.producto_id', '=', 'px.id')	
														->get();		
			
			return View::make($this->department.".main", $this->data)->nest('child','sistemas.main_productos',$dataModule);
			
        }

        public function getConstrucciones(){
        	$construcciones = Construccion::groupby('descripcion')->orderby('descripcion')->get();
        	return Response::Json($construcciones);
        }

        public function getLote(){				     	

			$dataModule['recintos'] = Recinto::orderby('sector_id')->get();
			return View::make($this->department.".main", $this->data)->nest('child','sistemas.lote_funerario_nicho_add',$dataModule);
        }
         
        public function getSectoresall(){
				$sectores = Sector::all();
				return Response::Json($sectores);
		}

		public function getSectoresnicho(){
				$sectores_nicho = Sector::select('sector.id as sector_id','recinto.id as recinto_id', DB::raw('CONCAT("Nicho ",sector.nombre, " ", "Recinto ", recinto.nombre) AS product_name'))
				->join('recinto', 'sector.id', '=', 'recinto.sector_id')->get();

				return Response::Json($sectores_nicho);
		}

		public function postMantenimiento(){		

//validar formulario mtto
			$rules = array(
					
					'monto_6m'=>'required',
					'monto_12m'=>'required',
										
				);

				$messages = array(
						'required'=>'El campo :attribute es obligatorio'
						
						
					);

			$validator = Validator::make(Input::all(), $rules, $messages);
				if ($validator->fails())
				 { 
						
						
				return Redirect::back()->withInput()->withErrors($validator)->with('registro', 'modificando')->with('tab', 'tab1');						
				
			}
$mtto3 = Input::get('monto_3m');
$mtto6 = Input::get('monto_6m');
$mtto12 = Input::get('monto_12m');
$departamento = 2;
$construcciones =  DB::table('construccion')->where('descripcion', Input::get('construccion'))->first();



if ($mtto3) {
	
	$product_name3 = 'Mantenimiento trimestral '.Input::get('construccion');
	$repetido = Producto::where('nombre','=', $product_name3)->count();
	if ($repetido>0) {
	return Redirect::back()->withInput()->with('status','mtto_repetido')->with('tab', 'tab2')->with('registro', 'edit_tab2');
	}
	/////////////////////////////prodcucto/////////////////////
			$producto = new Producto;
			$producto->departamento_id = $departamento; //es un producto del departamento de ventas
			$producto->nombre = $product_name3;
			$producto->porcentaje_comision = 0;
			$producto->porcentaje_minimo_comisionable = 0;
			$producto->save();

/////////////////////////////precio/////////////////////

			$precio = new Precio;

			$precio->producto_id = $producto->id;
			$precio->monto = $mtto3;
			$precio->save();

			$mtto = new Mantenimiento;

			$mtto->producto_id = $producto->id;
			$mtto->construccion_id = $construcciones->id;
			$mtto->meses = 3;
			$mtto->save();
	

}
if ($mtto6) {
	
	$product_name6 = 'Mantenimiento Semestral '.Input::get('construccion');
	$repetido = Producto::where('nombre','=', $product_name6)->count();
	if ($repetido>0) {
	return Redirect::back()->withInput()->with('status','mtto_repetido')->with('tab', 'tab2')->with('registro', 'edit_tab2');
	}
	/////////////////////////////prodcucto/////////////////////
			$producto = new Producto;
			$producto->departamento_id = $departamento; //es un producto del departamento de ventas
			$producto->nombre = $product_name6;
			$producto->porcentaje_comision = 0;
			$producto->porcentaje_minimo_comisionable = 0;
			$producto->save();

/////////////////////////////precio/////////////////////

			$precio = new Precio;

			$precio->producto_id = $producto->id;
			$precio->monto = $mtto6;
			$precio->save();

			$mtto = new Mantenimiento;

			$mtto->producto_id = $producto->id;
			$mtto->construccion_id = $construcciones->id;
			$mtto->meses = 6;
			$mtto->save();
	

}
if ($mtto12) {
	
	$product_name12 = 'Mantenimiento Anual '.Input::get('construccion');
	$repetido = Producto::where('nombre','=', $product_name12)->count();
	if ($repetido>0) {
	return Redirect::back()->withInput()->with('status','mtto_repetido')->with('tab', 'tab2')->with('registro', 'edit_tab2');
	}
	/////////////////////////////prodcucto/////////////////////
			$producto = new Producto;
			$producto->departamento_id = $departamento; //es un producto del departamento de ventas
			$producto->nombre = $product_name12;
			$producto->porcentaje_comision = 0;
			$producto->porcentaje_minimo_comisionable = 0;
			$producto->save();

/////////////////////////////precio/////////////////////

			$precio = new Precio;

			$precio->producto_id = $producto->id;
			$precio->monto = $mtto12;
			$precio->save();


			$mtto = new Mantenimiento;

			$mtto->producto_id = $producto->id;
			$mtto->construccion_id = $construcciones->id;
			$mtto->meses = 12;
			$mtto->save();



} 
			return Redirect::back()->with('status', 'mtto_created')->with('tab', 'tab2')->with('registro', 'edit_tab2');
						


		} 

		public function postMttaumento(){

		}


public function postTerreno(){	
//validar formulario Terreno
			$rules = array(
					'sector' => 'required',
					'gavetas' => 'required|numeric',															
					'osarios' => 'numeric',
					'monto'=>'required|numeric',
					'porcentaje_comision'=>'required|numeric',
					'porcentaje_minimo_comisionable'=>'required|numeric',
					'construccion_medidas'=>'required',					
					
				);

				$messages = array(
						'required'=>'El campo :attribute es obligatorio',						
						'numeric'=>'Capture solo números'
						
					);

			$validator = Validator::make(Input::all(), $rules, $messages);
				if ($validator->fails())
				 { 
						
						
				return Redirect::back()->withInput()->withErrors($validator)->with('registro', 'modificando')->with('tab', 'tab1');						
				
			}
			
			$departamento = "5";
			

			$product_name = Str::title(Input::get('sector'))." Fila ".Input::get('fila')." Lote ".Input::get('lote'); 
			

			if (Input::get('construccion_medidas')=='Capilla') {
					$nombre_construccion =Input::get('construccion');
				}
			else {$nombre_construccion =Input::get('construccion')." ".Input::get('construccion_medidas');}

			
			//valida terrenos repetidos
			$repetido = Producto::where('nombre','=', $product_name)->count();
			if ($repetido>0) {
								return Redirect::back()->withInput()->with('status','terreno_repetido');

							} 
			//fin validacion de terreno

			//pasa validacion terreno
			
			if (Input::get('construccion_medidas')=='Sencilla') {
					$largo = "2.5";
					$ancho = "1";
				}
			elseif (Input::get('construccion_medidas')=='Doble') {
					$largo = "2.5";
					$ancho = "1.75";
				}
			elseif (Input::get('construccion_medidas')=='Triple') {
					$largo = "2.5";
					$ancho = "3";
				}

			elseif (Input::get('construccion_medidas')=='Sextuple') {
					$largo = "5";
					$ancho = "3";
				}
			elseif (Input::get('construccion_medidas')=='Capilla') {
					$largo = "0";
					$ancho = "0";
				}	
			
//alta en tablas correspondientes al terreno
		$producto = new Producto;
			$producto->departamento_id = $departamento; //es un producto del departamento de ventas
			$producto->nombre = $product_name;
			$producto->porcentaje_comision = Input::get('porcentaje_comision');			
			$producto->porcentaje_minimo_comisionable = Input::get('porcentaje_minimo_comisionable');
			$producto->save();
		
		$precio = new Precio;
			$precio->producto_id = $producto->id;
			$precio->monto = Input::get('monto');
			$precio->save();

		$lote = new Lote;
			$lote->producto_id = $producto->id;
			$lote->save();

		$construccion = new Construccion;
			$construccion->producto_id = $producto->id;
			$construccion->descripcion = $nombre_construccion;
			$construccion->save();
		
		$terreno = new Terreno;
			$terreno->lote_id = $lote->id;
			$terreno->sector_id = Input::get('sector_id');
			$terreno->construccion_id = $construccion->id;
			$terreno->largo = $largo;
			$terreno->ancho = $ancho;
			$terreno->fila = Input::get('fila');
			$terreno->lote = Input::get('lote');
			$terreno->save();

		
		$cap_gavetas = Input::get('gavetas');

		if ($cap_gavetas){
		$gavetas = new Capacidad;
		$gavetas->construccion_id = $construccion->id;
		$gavetas->concepto_capacidad_id = 1;
		$gavetas->cantidad = Input::get('gavetas');		
		$gavetas->save();
		}

		$cap_osarios = Input::get('osarios');
		if ($cap_osarios){
		$osarios = new Capacidad;
		$osarios->construccion_id = $construccion->id;
		$osarios->concepto_capacidad_id = 2;
		$osarios->cantidad = Input::get('osarios');
		$osarios->save(); 
		}
		
			
			return Redirect::back()->with('status', 'terreno_created')->with('tab', 'tab1')->with('registro', 'edit_tab1');
} //fin post terreno

public function postNicho(){
//validar formulario nicho
			$rules = array(
					'recinto_nombre' => 'required',
					'fila_n'=>'required',
					'columna'=>'required',					
					'monto'=>'required|numeric',
					'porcentaje_comision'=>'required|numeric',
					'porcentaje_minimo_comisionable'=>'required|numeric',					
				);

				$messages = array(
						'required'=>'El campo :attribute es obligatorio',						
						'numeric'=>'Capture solo números'
						
					);

			$validator = Validator::make(Input::all(), $rules, $messages);
				if ($validator->fails())
				 { 
						
						
				return Redirect::back()->withInput()->withErrors($validator)->with('registro', 'edit_tab1')->with('tab', 'tab1');						
				
			}
				
			$departamento = "5";	
			$product_name = Str::title(Input::get('recinto_nombre'))." Fila ".Input::get('fila_n')." Columna ".Input::get('columna');	 
			$nombre_construccion = Input::get('construccion');
			
			//que no haya nichos repetidos con el mismo nombre
			$repetido = Producto::where('nombre','=', $product_name)->count();
				if ($repetido>0) {
					return Redirect::back()->withInput()->with('status','nicho_repetido');

				}
			//pasa validacion nicho


		$producto = new Producto;
			$producto->departamento_id = $departamento; //es un producto del departamento de ventas
			$producto->nombre = $product_name;
			$producto->porcentaje_comision = Input::get('porcentaje_comision');
			$producto->porcentaje_minimo_comisionable = Input::get('porcentaje_minimo_comisionable');
			$producto->save();

		$precio = new Precio;

			$precio->producto_id = $producto->id;
			$precio->monto = Input::get('monto');
			$precio->save();

		$lote = new Lote;
			$lote->producto_id = $producto->id;
			$lote->save();	

		$nicho = new Nicho;
			$nicho->lote_id = $lote->id;
			$nicho->recinto_id = Input::get('recinto_id');
			$nicho->fila = Input::get('fila_n');
			$nicho->columna = Input::get('columna');
			$nicho->save();
		return Redirect::back()->with('status', 'nicho_created')->with('tab', 'tab1')->with('registro', 'edit_tab1');


}//fin post nicho

public function postCombo(){
	
	
	$combo = new Producto;
	$combo->nombre = Input::get('nombre_producto');
	$combo->departamento_id = Input::get('departamento_id');
	$combo->porcentaje_comision = Input::get('porcentaje_comision');
	$combo->porcentaje_minimo_comisionable = Input::get('porcentaje_minimo_comisionable');
	$combo->save();

	$precio = new Precio;
	$precio->producto_id = $combo->id;
	$precio->monto = Input::get('monto');
	$precio->save();

	$productos = Input::get('producto');
	foreach ($productos as $p) {
		$paquete = new Paquete();
		$paquete->paquete_id = $combo->id;
		$paquete->producto_id = $p;
		$paquete->descuento = 0;
		$paquete->descripcion = '';
		$paquete->save();

	}

	return Redirect::back()->with('status', 'paquete_created')->with('tab', 'tab3')->with('registro', 'edit_tab3');
		
	}


public function postProductocombo(){

	$producto_combo = new Producto;

	$producto_combo->nombre = Input::get('nombre_producto_c');
	$producto_combo->departamento_id = Input::get('departamento_id_producto');
	$producto_combo->servicio = Input::get('tipo_producto');
	$producto_combo->porcentaje_comision = Input::get('porcentaje_comision_producto');
	$producto_combo->porcentaje_minimo_comisionable = Input::get('porcentaje_minimo_comisionable_producto');
	$producto_combo->combo = 1;

	$producto_combo->save();

	$precio_producto = new Precio;
	$precio_producto->producto_id = $producto_combo->id;
	$precio_producto->monto = Input::get('monto_producto');


return Redirect::back()->with('status', 'producto_created')->with('tab', 'tab3')->with('registro', 'edit_tab3');


}

} // fin controlador----------------
