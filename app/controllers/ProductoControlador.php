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
			
			return View::make($this->department.".main", $this->data)->nest('child','sistemas.main_productos');
        }

        public function getLote(){				     	

			$dataModule['recintos'] = Recinto::orderby('sector_id')->get();
			return View::make($this->department.".main", $this->data)->nest('child','sistemas.lote_funerario',$dataModule);
        }
         
        public function getSectoresall(){
				$sectores = Sector::all();
				return Response::Json($sectores);
		}

		public function getSectoresnicho(){
				$sectores_nicho = Sector::select('sector.id as sector_id', DB::raw('CONCAT("sector.nombre, recinto.nombre, fila, columna) AS producto_nombre'))
				->join('recinto', 'sector.id', '=', 'recinto.sector_id')->get();
				/*, 'tipo', DB::raw('CONCAT(sector, " ", "Fila", " ", fila, " ", "Lote", " ", columna) AS ubicacion'),'recinto', 'monto', 'porcentaje_comision'
				select sector.id as sector_id, sector.nombre as sector_nombre, recinto.id as recinto_id, recinto.nombre as recinto_nombre from sector
join recinto on sector.id = recinto.sector_id */
				return Response::Json($sectores_nicho);
		}

		public function postNuevoterreno(){
			
			if (Input::get('tipo_producto')=='terreno') {
				
			$product_name = Str::title(Input::get('sector'))." Fila ".Input::get('fila')." Lote ".Input::get('lote');	 
			
			}
			
			elseif (Input::get('tipo_producto')=='nicho')
			 {
				$product_name = "Nicho ".Str::title(Input::get('sector'))."Recinto ".Input::get('recinto')." Fila ".Input::get('fila')." Lote ".Input::get('lote');	 
			}

			$producto = new Producto;
			$producto->departamento_id = "5"; //es un producto del departamento de ventas
			$producto->nombre = $product_name;
			$producto->porcentaje_comision = Input::get('porcentaje_comision');
			$producto->save();

			$lote = new Lote;

			$lote->producto_id = $producto->id;
			$lote->save();

			$construccion = new Construccion;

			$construccion->producto_id = $producto->id;
			$construccion->descripcion = Input::get('construccion');
			$construccion->save();

			if (Input::get('tipo_producto')=='terreno')
			 {
			$terreno = new Terreno;

			$terreno->lote_id = $lote->id;
			$terreno->sector_id = Input::get('sector_id');
			$terreno->construccion_id = $construccion->id;
			$terreno->largo = Input::get('largo');
			$terreno->ancho = Input::get('ancho');
			$terreno->fila = Input::get('fila');
			$terreno->lote = Input::get('lote');
			$terreno->save();
			}

			$precio = new Precio;

			$precio->producto_id = $producto->id;
			$precio->monto = Input::get('monto');
			$precio->save();
			
			if (Input::get('tipo_producto')=='nicho') {
				
			$nicho = new Nicho;

			$nicho->lote_id = $lote->id;
			$nicho->recinto_id = Input::get('recinto_id');
			$nicho->fila = Input::get('fila');
			$nicho->columna = Input::get('lote');
			$nicho->save();

			
			}

			return Redirect::back();
		}
		
		public function getTest(){

			$fila_inicio = 8;
			$lote_inicio = 4;

			$fila_fin = 9;
			$lote_fin = 10;

			for ($i=$fila_inicio; $i <= $fila_fin ; $i++) { 
			for ($i2=$lote_inicio; $i2 <= $lote_fin ; $i2++)		
			{
				echo "fila ".$i." "."lote ".$i2."<p>";
			}
		}

		}
	}