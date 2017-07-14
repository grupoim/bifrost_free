<?php 
	class ServicioFuneralControlador extends ModuloControlador{
		public $data = array();
		public $department;

		function __construct(){
			$this->data["module"] = "Servicios Funerales";

			$this->data["icon"] = "hospital-o";
			$this->department = Auth::user()->departamento->nombre;
		}
		

		public function getIndex(){	
		$dataModule["status"] = Session::pull('status');
		$dataModule["servicios"] = VistaServicioFuneralCapilla::select('vista_servicio_funeral_capilla.*','venta_servicio_funeral.prevision','venta_servicio_funeral.servicio_realizado',
			'venta_servicio_funeral.prevision', 'venta_servicio_funeral.venta_producto_id as venta_producto_id','venta_servicio_funeral.cremacion',
		'contrato.folio','contrato.id as contrato_id','contrato.impresiones')
		->leftJoin('venta_servicio_funeral','vista_servicio_funeral_capilla.venta_producto_id', '=', 'venta_servicio_funeral.venta_producto_id')
		->leftJoin('contrato', 'venta_servicio_funeral.contrato_id', '=', 'contrato.id')
		->get();
		$dataModule['db'] = ConfiguracionGeneral::where('empresa_id', 1)->where('activo', 1)->firstorFail();	
		$dataModule["tipo_telefonos"] = TipoTelefono::all();	
		return View::make($this->department.".main", $this->data)->nest('child', $this->department.'.serviciocapilla', $dataModule);}
       
        public function getCreate(){
			$modal['title'] = 'Nuevo Servicio';
			$modal['button_cancel'] = 'Cancelar';
			$modal['button_ok'] = 'Agregar Servicio';
			$data['modal'] = $modal;
			return View::make('formularios.servicio', $data);
		}

		public function postStore(){
			return Response::json(array(
				"success" => false, 
				"messages" => array("El campo de Nombre es requerido", "El campo de apellido es requerido")
			));
		}

        public function getAll(){
        	$servicios = VistaServicioFuneral::select('id', 'nombre', 'precio_servicio', 'monto_comisionable', 'porcentaje_comision', DB::raw('CONCAT(nombre, " ","$", (round(precio_servicio * 1.16))) AS nombre_display'))->get();
			return Response::Json($servicios);
        }

        public function postRescatista(){

        	$persona = new Persona;
        	$persona->nombres = Input::get('nombres');
        	$persona->apellido_paterno = Input::get('apellido_paterno');
        	$persona->apellido_materno = Input::get('apellido_materno');
        	$persona->save();

        	$rescatista = new Rescatista;
        	$rescatista->persona_id = $persona->id;
        	$rescatista->save();

        	$contacto_rescatista = new ContactoRescatista;
        	$contacto_rescatista->telefono = Input::get('telefono');
        	$contacto_rescatista->codigo_pais = Input::get('codigo_pais');
        	$contacto_rescatista->rescatista_id = $rescatista->id;
        	$contacto_rescatista->tipo_telefono_id = Input::get('tipo_telefono_id');
        	$contacto_rescatista->save();
			
			return  Redirect::back()->with('status', 'registro_rescatista');

        }
	}
 ?>