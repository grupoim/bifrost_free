<?php 
	class LoteFunerarioControlador extends ModuloControlador{

		public $data = array();
		public $department;

		function __construct(){
			$this->data["module"] = "Lotes Funerarios";

			$this->data["icon"] = "map-marker";
			$this->department = Auth::user()->departamento->nombre;
		}
		

		public function getIndex(){	
			$data["sectores"] = Sector::all(); 			
 			$data["recintos"]= Recinto::all();

			return View::make($this->department.".main", $this->data)->nest('child','operaciones.lotesfunerarios', $data);
        }

		public function getRecupera($id){			
			
			$dataModule['valor_stock']= VistaTerrenosDisponibles::where('sector_id', '=', $id)->sum('monto');			
			$dataModule['sector_r']= VistaTerrenosDisponibles::where('sector_id', '=', $id)->get();
			$dataModule['nicho_r']=	VistaTerrenosDisponibles::where('sector_id', '=', $id)->where('tipo', '=', `Nicho`)->count();	
			$dataModule['recinto_r'] = Recinto::find($id);
			$dataModule["sector"] = Sector::find($id);
			$dataModule['icon'] = 'pencil';
			

			return View::make($this->department.".main", $this->data)->nest('child','operaciones.terrenos', $dataModule);

			}

			public function getRecuperarecinto($id){		
			$dataModule['recinto_r'] = Recinto::find($id);
			$dataModule['nichos_r'] = VistaTerrenosDisponibles::where('recinto_id', '=', $id)->get();			
			$dataModule['icon'] = 'pencil';
			return View::make($this->department.".main", $this->data)->nest('child','operaciones.nichos', $dataModule);

			}

		
		
		public function getCreate(){
			$modal['title'] = 'Nuevo Lote funerario';
			$modal['button_cancel'] = 'Cancelar';
			$modal['button_ok'] = 'Agregar lote';
			$data['modal'] = $modal;
			return View::make('formularios.lote', $data);
		}

		public function postStore(){
			return Response::json(array(
				"success" => false, 
				"messages" => array("El campo de Nombre es requerido", "El campo de apellido es requerido")
			));
		}

		public function getAll() {			 

			$lote_disponible = VistaTerrenosDisponibles::select('lote_id', 'producto_id', 'tipo', DB::raw('CONCAT(sector, " ", "Fila", " ", fila, " ", "Lote", " ", columna) AS ubicacion'),'recinto', 'monto', 'porcentaje_comision')->get();
			return Response::Json($lote_disponible);
		}

		public function getSectoresall(){
				$sectores = Sector::all();
				return Response::Json($sectores);

		}
			

	}
