<?php 
use Carbon\Carbon;
	class InventarioRecubControlador extends ModuloControlador{
		public $department;

		function __construct(){
		$this->data["module"] = '	Inventario de material de recubrimiento';
		$this->data["icon"] ='inbox';
		$this->department = camel_case(Auth::user()->departamento->nombre);
		}

		public function getIndex(){
			$dataModule["status"] = Session::pull('status','nuevo');
			$dataModule["boom"] = Session::pull('boom');
			$dataModule["factura_error"] = Session::pull('factura_error');			
			$dataModule["proveedores"]= Proveedor::where('activo',1)->get();
			$dataModule["material_colores"]= VistaMaterialColor::get();
			$dataModule["altas"]= VistaFactura::orderBy('fecha_alta','ASC')->get();
			$dataModule["hoy"] = Carbon::now();
 			return View::make($this->department.".main", $this->data)->nest('child', 'recubrimientos.material_alta', $dataModule);


		}

		public function getColores(){
			$dataModule["colores"] = VistaMaterialColor::leftjoin('material_color', 'vista_material_color.id', '=', 'material_color.id')->get();
 			return View::make($this->department.".main", $this->data)->nest('child', 'recubrimientos.colores', $dataModule);
		}

		public function getBajacolor($id){
			$material_color = MaterialColor::find($id);
			$material_color->activo = 0;
			$material_color->save();
			return Redirect::back();

		}

		public function postEditacolor($id){
			

			$material_color = MaterialColor::find($id);
			
			$color = Color::where('id',$material_color->color_id)->firstorfail();
			$color->nombre = Input::get('nombre_color');
			$color->save();

			$material = MaterialColor::where('id',$material_color->id)->firstorfail();
			$material_color->material_id = Input::get('material_id');
			$material->save();
			

			return Redirect::action('InventarioRecubControlador@getColores');

		}

		public function getAltacolor($id){
			$material_color = MaterialColor::find($id);
			$material_color->activo = 1;
			$material_color->save();
			return Redirect::back();

		}

		public function getRecuperaColor($id){
			$dataModule["material_color_r"] = MaterialColor::select('material.id as material_id',
																	'material.nombre as material',
																	'color.id as color_id',
																 	'color.nombre as color',
																 	'material_color.id as material_color_id',
																 	'material_color.activo'
																 	)
															->leftjoin('color', 'material_color.color_id', '=', 'color.id')
															->leftjoin('material', 'material_color.material_id', '=', 'material_id')															
															->where('material_color.id', $id)->firstorfail();
 			$dataModule["colores"] = Color::all();
 			$dataModule["materiales"] = Material::all();

 			return  View::make($this->department.".main", $this->data)->nest('child', 'recubrimientos.color_edit', $dataModule);

		}

		public function getAgregarcolor(){
 			
 			$dataModule["materiales"] = Material::all();

 			return View::make($this->department.".main", $this->data)->nest('child', 'recubrimientos.color_new', $dataModule);

		}

		public function postAgregacolor(){

			$color = new Color;
			$color->nombre = Input::get('nombre_color');
			$color->save();

			$material_color = new MaterialColor;
			$material_color->color_id =  $color->id;
			$material_color->material_id = Input::get('material_id');
			$material_color->save();
			return Redirect::action('InventarioRecubControlador@getColores');
			
		}


		public function getBaja(){
			$dataModule["status"] = Session::pull('status','nuevo');
			$dataModule["venta_error"] = Session::pull('venta_error');			
			$dataModule["radio_selected"] = Session::pull('radio_selected');
			$dataModule["material_error"] = Session::pull('material_error');
			$dataModule["add"] = Session::pull('add');
			$dataModule["inventarios"]= VistaInventarioRecubrimiento::where('activo',1)->orderBy('material_color', 'desc')->get();			
			$dataModule["piezas"]= PiezaMarmoleria::where('activo',1)->get();
			$dataModule["ventas"]= VentaMaterial::all();
			$dataModule["ventas_detalle"]= VistaDetalleVentaMaterial::all();
			$dataModule["reposiciones"] = VistaReposiciones::all();
			$dataModule["stocks"] = VistaStock::all();
			$dataModule["hoy"] = Carbon::now();			
 			return View::make($this->department.".main", $this->data)->nest('child', 'recubrimientos.material_baja', $dataModule);


		}
		public function getReportes(){
			
			$primera = new Carbon('first day of this month');
			$final = new Carbon('last day of this month');

			$primera = $primera->format('Y-m-d');
			$final = $final->format('Y-m-d');

			$dataModule["status"] = Session::pull('status','nuevo');
			$dataModule["inventarios"]= VistaInventarioRecubGeneral::orderBy('material_color', 'desc')->get();			
			$dataModule["costo_inventario"]= VistaInventarioRecubrimiento::sum('precio_stock');
			$dataModule["costo_reposicion"] = VistaInventarioRecubGeneral::sum('perdida_reposicion');
			$dataModule["costo_produccion"] = VistaInventarioRecubGeneral::sum('costo_produccion');
			$dataModule["costo_venta"] =  MaterialBaja::leftjoin('venta_material_baja', 'material_baja.id', '=', 'venta_material_baja.material_baja_id' )
											->whereRaw("material_baja.fecha between "."'".$primera."'"." and "."'".$final."'")
											->sum('precio_pieza'); /*VistaInventarioRecubGeneral::sum('ventas');*/
			$dataModule["costo_stock"] = VistaInventarioRecubGeneral::sum('stock');
			$dataModule["piezas"]= PiezaMarmoleria::all();
			$dataModule["ventas"]= VentaMaterial::all();
			$dataModule["ventas_detalle"]= VistaDetalleVentaMaterial::all();
			$dataModule["estadisticos_laminas"] = VistaEstadisticosLamina::all();
			$dataModule["color_grafica"] = ConfiguracionGeneral::firstorfail();
 			$dataModule["estadisticos_colores"] = VistaEstadisticoColorMaterial::all();
 			$dataModule["cortes"] = VistaMaterialBaja::all();
 			return View::make($this->department.".main", $this->data)->nest('child', 'recubrimientos.material_reportes', $dataModule);

		}

		public function getLamina($inventario_recubrimientos_id){
			
			$data["ventas"] = VistaDetalleVentaMaterial::where('inventario_recubrimientos_id','=', $inventario_recubrimientos_id)->get();
			$dataModule["status"] = Session::pull('status','nuevo');
			$dataModule["inventario"]= VistaInventarioRecubGeneral::where('inventario_recubrimientos_id', $inventario_recubrimientos_id)->orderBy('material_color', 'desc')->firstorfail();			
			$dataModule["pag"]= VistaInventarioRecubGeneral::paginate(15);
			$dataModule["piezas"]= PiezaMarmoleria::all();			
			$dataModule["reposiciones"]= VistaReposiciones::where('inventario_recubrimientos_id', $inventario_recubrimientos_id)->get();
			$dataModule["stock"]= VistaStock::where('inventario_recubrimientos_id', $inventario_recubrimientos_id)->get();
			$dataModule["totales"]= VistaVentasTotalesLamina::where('inventario_recubrimientos_id', $inventario_recubrimientos_id)->get();
			$dataModule["ventas_detalle"]= VistaDetalleVentaMaterial::where('inventario_recubrimientos_id', $inventario_recubrimientos_id)->get();
			$dataModule["hoy"] = Carbon::now();
			return View::make($this->department.".main", $this->data)->nest('child', 'recubrimientos.material_reporte_lamina', $dataModule);			

		}


		public function getBoom(){
			
				DB::table('stock')->delete();
				DB::table('reposicion')->delete();
				DB::table('venta_material_baja')->delete();
				DB::table('venta_material')->delete();				
				DB::table('material_baja')->delete();
				DB::table('inventario_recubrimientos')->delete();
				DB::table('lamina_alta')->delete();
				 
				 $inicia_stock = "ALTER TABLE stock AUTO_INCREMENT = 1;" ;
				 $inicia_reposicion = "ALTER TABLE reposicion AUTO_INCREMENT = 1;";
				 $inicia_venta_material_baja = "ALTER TABLE venta_material_baja AUTO_INCREMENT = 1;" ;
				 $inicia_venta_material = "ALTER TABLE venta_material AUTO_INCREMENT = 1;" ;
				 $inicia_material_baja = "ALTER TABLE material_baja AUTO_INCREMENT = 1;"; 
				 $inicia_inventario_recubrimientos = "ALTER TABLE inventario_recubrimientos AUTO_INCREMENT = 1;" ;
				 $inicia_lamina_alta = "ALTER TABLE lamina_alta AUTO_INCREMENT = 1;" ;
				  

	        	DB::unprepared($inicia_stock);
	        	DB::unprepared($inicia_reposicion);
	        	DB::unprepared($inicia_venta_material_baja);
	        	DB::unprepared($inicia_venta_material);
	        	DB::unprepared($inicia_material_baja);
	        	DB::unprepared($inicia_inventario_recubrimientos);
	        	DB::unprepared($inicia_lamina_alta);
			return Redirect::back()->with('boom','apocalipsis');

		}

		public function postAlta() {
						
		//valida que no se quiera añadir a una factura capturada ayer 
			$factura_captura = Input::get('folio_factura');

			$factura_r = VistaFactura::where('folio_factura', '=', $factura_captura)->first();

					if($factura_r){
					if($factura_r->factura_abierta == 0) {
						$factura_error = Session::pull('factura_error','error');
						return Redirect::back()->with('factura_error', 'error');}
						/*return $factura_r->factura_abierta;*/
			}

		//validar formulario
			$rules = array(
					
					'folio_factura' => 'required',
					'fecha'=>'required',
					'material_color_id'=> 'required',
					'cantidad'=> 'numeric|integer|digits_between:1,10',
					'largo' => 'required|numeric',
					'alto'=> 'required|numeric',
					'precio_total' =>'required|numeric',

				);
			
				$messages = array(
						'required'=>'Capture :attribute',
						'numeric'=>'solo números',
						'integer'=>'solo se aceptan valores enteros',
						
					);

			$validator = Validator::make(Input::all(), $rules, $messages);
				if ($validator->fails())
				 { 
						
						return Redirect::back()->withInput()->withErrors($validator);
				}
		//fin validar formulario

		for ($i= 0; $i < Input::get('cantidad'); $i++) { 
			$lamina = new LaminaAlta;

			$area_total = number_format(Input::get('largo') * Input::get('alto'), 2, '.', '');
			$precio_total = Input::get('precio_total');
			$lamina->folio_factura = Input::get('folio_factura');
			$lamina->folio_lamina = 0000;
			$lamina->area_total = $area_total;
			$lamina->precio_total = $precio_total;
			$lamina->lamina_completa = Input::get('lamina_completa');
			$lamina->proveedor_id = Input::get('proveedor_id') ;
			$lamina->material_color_id = Input::get('material_color_id');
			$lamina->largo = Input::get('largo');
			$lamina->alto = Input::get('alto');
			$lamina->fecha = Input::get('fecha');
			$lamina->save();
			
			
			//para renombrar los consecutivos de lamina a minimo 4 caracteres
			if (Input::get('proveedor_id')>= 10 or $lamina->id >= 10) {
				$proveedor_nombre = "0".Input::get('proveedor_id'); 
				$lamina_nombre = $lamina->id;
			}else{
				$proveedor_nombre = "0".Input::get('proveedor_id'); 
				$lamina_nombre = "0".$lamina->id;

			}
			//asigna folio a lamina
			$update_lamina = LaminaAlta::Find($lamina->id);
			$update_lamina->folio_lamina = $proveedor_nombre.$lamina_nombre;
			$update_lamina->save();

			$inventario = new InventarioRecubrimientos;
			$inventario->lamina_alta_id = $lamina->id;
			$inventario->area_stock = $area_total;
			$inventario->precio_stock = $precio_total;
			$inventario->updated_at = Input::get('hoy');
			$inventario->save();

		}
			return Redirect::back();
		}

				public function postBaja() {

						//valida el tipo de corte, si es pieza entera o corte especial



					switch (Input::get('tipo_corte')) {
						case '1': //pieza entera
							
								
								//checa si el tipo de corte es con medida estandar o medida especial
								switch (Input::get('proporcion_corte')) {
										//corte estandar
										case '1':
										//verifica si los input traen valores si no, se brinca a las validaciones segun el tipo de baja
										if (Input::get('pieza_marmoleria_id') and Input::get('material_disponible') ) {
										//saca el area de venta con la pieza añadida al folio
										$area_venta_r = PiezaMarmoleria::find(Input::get('pieza_marmoleria_id'));
										$area_venta = $area_venta_r->area_requerida;
										//costo del material usado 
										$inventario = VistaInventarioRecubrimiento::find(Input::get('material_disponible'));
										$costo_material = ($inventario->precio_inicial * $area_venta )/ $inventario->area_total;
										$pieza_marmoleria_id = Input::get('pieza_marmoleria_id');
										$medida_estandar = 1;
								
								}
											break;

										case '2':
										//verifica si los input traen valores si no, se brinca a las validaciones segun el tipo de baja
										if (Input::get('pieza_marmoleria_id_p') and Input::get('material_disponible') ) {
										//saca el area de venta con la pieza añadida al folio
										$area_venta_r = PiezaMarmoleria::find(Input::get('pieza_marmoleria_id_p'));
										$area_venta = Input::get('area_uso_p');
										//costo del material usado 
										$inventario = VistaInventarioRecubrimiento::find(Input::get('material_disponible'));
										$costo_material = ($inventario->precio_inicial * $area_venta )/ $inventario->area_total;
										$pieza_marmoleria_id = Input::get('pieza_marmoleria_id_p');
										$medida_estandar = 0;
										}
										break;
										
										default:{

										}
											# code...
											break;
									
								}

								
							break;
						case '2': //corte especial
								//verifica si los imput traen valores si no, se brinca a las validaciones segun el tipo de baja
								if (Input::get('material_disponible')) {
								//obtiene el id del corte especial
									$pieza_marmoleria = PiezaMarmoleria::where('nombre', '=', 'Corte especial')->firstorfail();
								//saca el area de venta con la pieza añadida al folio
												
								$area_venta = number_format(Input::get('largo') * Input::get('alto'), 2, '.', '');
								//costo del material usado 
								$inventario = VistaInventarioRecubrimiento::find(Input::get('material_disponible'));
								$costo_material = ($inventario->precio_inicial * $area_venta)/ $inventario->area_total;
								$pieza_marmoleria_id = $pieza_marmoleria->id;
								$medida_estandar = 0;
									# code...
								//validar formulario para corte especial
								$rules = array(
										
										'largo' => 'required|numeric|digits_between:.06,10',
										'alto'=> 'required|numeric|digits_between:.06,10',
										'justificacion_de_corte'=>'required'

									);
								
									$messages = array(
											'required'=>'Capture :attribute',
											'numeric'=>'solo números',
											'integer'=>'solo se aceptan valores enteros',
											
										);

								$validator = Validator::make(Input::all(), $rules, $messages);
									if ($validator->fails())
									 { 
											
											return Redirect::back()->withInput()->withErrors($validator);
									}
							//fin validar formulario

								}	
						break;
						default:{

						}
							# code...
							break;
					}

					//checa si hay material suficiente

					if ($area_venta > $inventario->area_stock ) {
						return Redirect::back()->with('material_error', 'error');
					}



			//determina el tipo de baja
			switch (Input::get('tipo_baja')) {
				case '1':

				//valida que no se quiera añadir a una factura capturada ayer o el folio sea igual al de una venta de stock 
			$folio_venta = Input::get('folio_venta');

			$venta_r = VentaMaterial::where('folio', '=', $folio_venta)->first();

					if($venta_r){
					if(date_format($venta_r->created_at, 'Y-m-d') < date('Y-m-d') or substr($folio_venta, 0, 2) == "S-") 
					{
						$factura_error = Session::pull('venta_error','error');
						return Redirect::back()->with('venta_error', 'error');
					}
						/*return $factura_r->factura_abierta;*/
			}

		//validar formulario
				//validar formulario

			$rules = array(
					
					'folio_venta' => 'required',
					'fecha'=>'required',
					'precio_venta' => 'required|numeric',
					'material_disponible'=> 'required',																				

				);
			
				$messages = array(
						'required'=>'Capture :attribute',
						'numeric'=>'solo números',
						'integer'=>'solo se aceptan valores enteros',
						
					);

			$validator = Validator::make(Input::all(), $rules, $messages);
				if ($validator->fails())
				 { 
						
						return Redirect::back()->withInput()->withErrors($validator)->with('radio_selected', '1')->with('add', 'true');
				}
		//fin validar formulario
				

				//genera baja
				$lamina_baja = new MaterialBaja;

				$lamina_baja->fecha = Input::get('fecha');
				$lamina_baja->pieza_marmoleria_id = $pieza_marmoleria_id;
				$lamina_baja->area_venta = $area_venta;
				$lamina_baja->inventario_recubrimientos_id = Input::get('material_disponible');			
				$lamina_baja->costo_material_usado = $costo_material;
				if(Input::get('tipo_corte') == 2){
					$lamina_baja->observaciones = Input::get('largo').' de largo por '.Input::get('alto'). ' m. de alto';
					$lamina_baja->pieza_completa = 0;
					$medida_estandar = 0;
				}
				$lamina_baja->medida_estandar = $medida_estandar;
				$lamina_baja->save();
				//determina si la venta existe, 
				$count_venta_material  = VentaMaterial::where('folio', '=', Input::get('folio_venta'))->count();
				
				// si existe la venta actualiza el total sumando el precio de la nueva lamina_baja
				if ($count_venta_material > 0) {
					$venta_material = VentaMaterial::where('folio', '=', Input::get('folio_venta'))->firstorfail();
					$venta_material->total_venta = $venta_material->total_venta + Input::get('precio_venta');
					$venta_material->save();
				}
				//si no exite la venta, crea una nueva
				else{ 
				
				$venta_material = new VentaMaterial;
				$venta_material->folio = Input::get('folio_venta');
				$venta_material->total_venta = Input::get('precio_venta');
				$venta_material->save();
			}
				//crea el registro del detalle de la baja
				$venta_material_baja = new VentaMaterialBaja;
				$venta_material_baja->venta_material_id = $venta_material->id;
				$venta_material_baja->material_baja_id = $lamina_baja->id;
				$venta_material_baja->precio_pieza = Input::get('precio_venta');
				$venta_material_baja->save();

				//actualiza inventario en la linea #84 ya lo tengo
					$inventario->area_stock = $inventario->area_stock - $area_venta;
					$inventario->updated_at = Input::get('hoy');
					$inventario->precio_stock = $inventario->precio_stock - $costo_material;
					$inventario->area_usada = $inventario->area_usada + $area_venta;			
					//desactiva el inventario de la lamina al llegar al menos de .06, no es suficiente material para crear un liston
					if ($inventario->area_stock  < .06) {
						$inventario->activo = 0;
						# code...
					}
					$inventario->save();
					
					break;
				case '2': 
					# Reposicion

				//validar formulario
				//validar formulario
			
			$rules = array(
					
					
					'fecha'=>'required',
					'motivo_de_reposicion' => 'required',
					'material_disponible'=> 'required',																				

				);
			
				$messages = array(
						'required'=>'Capture :attribute',
						'numeric'=>'solo números',
						'integer'=>'solo se aceptan valores enteros',
						
					);

			$validator = Validator::make(Input::all(), $rules, $messages);
				if ($validator->fails())
				 { 
						
						return Redirect::back()->withInput()->withErrors($validator);
				}
		//fin validar formulario

							//genera baja
					$lamina_baja = new MaterialBaja;

					$lamina_baja->fecha = Input::get('fecha');
					$lamina_baja->pieza_marmoleria_id = $pieza_marmoleria_id; 
					$lamina_baja->area_venta = $area_venta ;
					$lamina_baja->inventario_recubrimientos_id = Input::get('material_disponible');			
					$lamina_baja->costo_material_usado = $costo_material;
					if(Input::get('tipo_corte') == 2){
					$lamina_baja->observaciones = Input::get('largo').' de largo por '.Input::get('alto'). ' m. de alto';
					$lamina_baja->pieza_completa = 0;
					$medida_estandar = 0;
				} 
					$lamina_baja->medida_estandar = $medida_estandar;
					$lamina_baja->save();

					//Genera detalles de reposicion
					$reposicion = new Reposicion;
					$reposicion->motivos = Input::get('motivo_de_reposicion');
					$reposicion->captura_usuario_id =  Auth::user()->id;
					$reposicion->material_baja_id = $lamina_baja->id;
					$reposicion->precio_reposicion = Input::get('precio_venta'); 
					$reposicion->save();

					$lamina_baja_update = MaterialBaja::find($lamina_baja->id);
					$lamina_baja_update->venta = 0;	
					$lamina_baja_update->reposicion = 1;

					$lamina_baja_update->save();

					//actualiza inventario en la linea #84 ya lo tengo
					$inventario->area_stock = $inventario->area_stock - $area_venta;
					$inventario->precio_stock = $inventario->precio_stock - $costo_material; 
					$inventario->area_usada = $inventario->area_usada + $area_venta;
					$inventario->updated_at = Input::get('hoy');
					//desactiva el inventario de la lamina al llegar al menos de .06, no es suficiente material para crear un liston
					if ($inventario->area_stock  < .06) {
						$inventario->activo = 0;
						# code...
					}
					$inventario->save();

					break;
					case '3': 
					# stock

					//validar formulario
			
			$rules = array(
					
					
					'fecha'=>'required',					
					'material_disponible'=> 'required',																				

				);
			
				$messages = array(
						'required'=>'Capture :attribute',
						
					);

			$validator = Validator::make(Input::all(), $rules, $messages);
				if ($validator->fails())
				 { 
						
						return Redirect::back()->withInput()->withErrors($validator);
				}
		//fin validar formulario

					/////////////////
					for ($i= 0; $i < Input::get('cantidad'); $i++) { 
				//genera baja
					$lamina_baja = new MaterialBaja;

					$lamina_baja->fecha = Input::get('fecha');
					$lamina_baja->pieza_marmoleria_id = $pieza_marmoleria_id; 
					$lamina_baja->area_venta = $area_venta ;
					$lamina_baja->inventario_recubrimientos_id = Input::get('material_disponible');			
					$lamina_baja->costo_material_usado = $costo_material;
					if(Input::get('tipo_corte') == 2){
					$lamina_baja->observaciones = Input::get('largo').'m. de largo por '.Input::get('alto'). ' m. de alto '.Input::get('justificacion_de_corte') ;
					$lamina_baja->pieza_completa = 0;
					$lamina_baja->medida_estandar = 0;
				} 
					$lamina_baja->medida_estandar = $medida_estandar;
					$lamina_baja->save();

					$lamina_baja_update = MaterialBaja::find($lamina_baja->id);
					$lamina_baja_update->venta = 0;
					$lamina_baja_update->stock = 1;
					$lamina_baja_update->save();

					//Crea nuevo registro de stock
					$stock = new Stock;
					$stock->precio_venta = Input::get('precio_venta'); 
					$stock->material_baja_id = $lamina_baja->id;						
					$stock->save();
					//actualiza inventario en la linea #84 ya lo tengo
					$inventario->area_stock = $inventario->area_stock - $area_venta;
					$inventario->precio_stock = $inventario->precio_stock - $costo_material; 
					$inventario->area_usada = $inventario->area_usada + $area_venta;
					$inventario->updated_at = Input::get('hoy');
					$medida_estandar = 0;			
					//desactiva el inventario de la lamina al llegar al menos de .06, no es suficiente material para crear un liston
					if ($inventario->area_stock  < .06) {
						$inventario->activo = 0;
						# code...
					}
					$inventario->save();
		}

					
					break;
				
				default:
					# code...r;
					break;
			} // fin switch

			

		
			return Redirect::back();
		}

				

				 public function getRecupera($folio_factura){								
					$dataModule["status"] = 'add';
					$dataModule["factura_error"] = Session::pull('factura_error');
					$dataModule["boom"] = Session::pull('boom');
					$dataModule["proveedores"]= Proveedor::where('activo',1)->get();
					$dataModule["material_colores"] = VistaMaterialColor::get();
					$dataModule["altas"]= VistaFactura::all();					
					$dataModule["alta_r"] = VistaFactura::where('folio_factura', '=', $folio_factura)->firstorfail();
					$dataModule["hoy"] = Carbon::now();
				return View::make($this->department.".main", $this->data)->nest('child', 'recubrimientos.material_alta', $dataModule);

				}

				public function getRecuperaventa($folio){								
					
					$dataModule["status"] = 'add';
					$dataModule["venta_error"] = Session::pull('venta_error');							
					$dataModule["inventarios"]= VistaInventarioRecubrimiento::where('activo',1)->orderBy('material_color', 'desc')->get();			
					$dataModule["piezas"]= PiezaMarmoleria::where('activo',1)->get();
					$dataModule["material_error"] = Session::pull('material_error');
					$dataModule["ventas"]= VentaMaterial::all();
					$dataModule["venta_r"]= VentaMaterial::where('folio', '=', $folio)->firstorfail();
					$dataModule["ventas_detalle"]= VistaDetalleVentaMaterial::all();
					$dataModule["reposiciones"] = VistaReposiciones::all();
					$dataModule["stocks"] = VistaStock::all();
					$dataModule["hoy"] = Carbon::now();
				return View::make($this->department.".main", $this->data)->nest('child', 'recubrimientos.material_baja', $dataModule);

				}

				 //Abre vista que contiene cuerpo de ventana modal show
        public function getShow($folio_factura)
	{
		$facturas = VistaDetalleFactura::where('folio_factura', '=', $folio_factura)->get();
		
		$suma = DB::table('vista_detalle_factura')->where('folio_factura', '=', $folio_factura)->sum('total_factura');
		$data = array(
			'facturas'=> $facturas,
			'suma' => $suma						
		);
		
		return View::make('recubrimientos.show', $data);
	}


	public function getVentastock($id){
		$stock_r = VistaStock::find($id);

		//actualiza el stock
		$update_stock = Stock::find($id);
		$update_stock->activo = 0;
		$update_stock->save();

		//actualiza tipo de baja
		$update_material_baja = MaterialBaja::find($stock_r->material_baja_id);
		$update_material_baja->venta = 1;
		$update_material_baja->stock = 0;
		$update_material_baja->save();

		//registra la venta en tabla venta_material
		$venta_material = new VentaMaterial;
		$venta_material->folio = $stock_r->folio;
		$venta_material->total_venta = $stock_r->precio_venta;
		$venta_material->venta_normal = 0;
		$venta_material->save();

		//guarda en venta_material_baja
		$venta_material_baja = new VentaMaterialBaja;
		$venta_material_baja->venta_material_id = $venta_material->id;
		$venta_material_baja->material_baja_id = $stock_r->material_baja_id;
		$venta_material_baja->precio_pieza = $stock_r->precio_venta;
		$venta_material_baja->save();


		return Redirect::back();

	}


	public function getVentareposicion($id){
		$stock_r = VistaStock::find($id);

		//actualiza el stock
		$update_stock = Stock::find($id);
		$update_stock->activo = 0;
		$update_stock->save();

		//actualiza tipo de baja
		$update_material_baja = MaterialBaja::find($stock_r->material_baja_id);
		$update_material_baja->reposicion = 1;
		$update_material_baja->stock = 0;
		$update_material_baja->save();

		//registra la venta en tabla reposicion
		$reposicion = new Reposicion;
		$reposicion->motivos = 'Pieza de stock '. $stock_r->folio;
		$reposicion->material_baja_id = $stock_r->material_baja_id;
		$reposicion->captura_usuario_id = Auth::user()->id;
		$reposicion->precio_reposicion = $stock_r->precio_venta;
		$reposicion->save();

		return Redirect::back();

	}				

}
