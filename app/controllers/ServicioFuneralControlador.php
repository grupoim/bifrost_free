<?php 
	class ServicioFuneralControlador extends ModuloControlador{
		public $data = array();
		public $department;

		function __construct(){
			$this->data["module"] = "Servicios Funerales";

			$this->data["icon"] = "hospital";
			$this->department = Auth::user()->departamento->nombre;
		}
		

		public function getIndex(){	
			$data["sectores"] = Sector::all(); 			
 			$data["recintos"]= Recinto::all();
 			$data["parentezcos"]= Parentezco::all();
 			$data["tipo_telefonos"] = TipoTelefono::all();
 			$data["servicios"] = VentaProducto::select('persona.id as persona_id','persona.nombres as pnombre','persona.apellido_paterno as p_paterno','persona.apellido_materno as p_materno'
 				,'producto.nombre as producto','venta.folio_solicitud')->where('producto.departamento_id',5)->where('producto.servicio',1)->where('producto.activo',1)
 				 ->leftjoin('producto','venta_producto.producto_id','=','producto.id')
 				 ->leftjoin('venta','venta_producto.venta_id','=','venta.id')
 				 ->leftjoin('cliente','venta.cliente_id','=','cliente.id')
 				 ->leftjoin('persona','cliente.persona_id','=','persona.id')->get();

			return View::make($this->department.".main", $this->data)->nest('child','capilla.servicio_funeral', $data);
        }

        public function postInhumado(){

        	$causa_defuncion = new CausaDefuncion;
        	$causa_defuncion->descripcion = Input::get('descripcion');
        	$causa_defuncion->infecciosa = Input::get('infecciosa');
        	$causa_defuncion->save();

        	$inhumado = new Inhumado;
        	$inhumado->persona_id = Input::get('persona_id');
        	$inhumado->fecha_deceso = Input::get('fecha_deceso');
        	$inhumado->fecha_nacimiento = Input::get('fecha_nacimiento');
        	$inhumado->edad = Input::get('edad');
        	$inhumado->peso = Input::get('peso');
        	$inhumado->estatura = Input::get('estatura');
        	$inhumado->causa_defuncion_id = $causa_defuncion->id;
        	$inhumado->save();

        	$persona = new Persona;
        	$persona->nombres = Input::get('nombres');
        	$persona->apellido_paterno = Input::get('apellido_paterno');
        	$persona->apellido_materno = Input::get('apellido_materno');
        	$persona->save();

        	$testigo_de_inhumado = new TestigoDeInhumado;
        	$testigo_de_inhumado->persona_id = Input::get('persona_id');
        	$testigo_de_inhumado->parentezco_id = Input::get('parentezco_id');
        	$testigo_de_inhumado->inhumado_id = $inhumado->id;
        	$testigo_de_inhumado->save();

        	$contacto_testigo_rescate = new ContactoTestigoRescate;
        	$contacto_testigo_rescate->testigo_de_inhumado_id = $testigo_de_inhumado->id;
        	$contacto_testigo_rescate->tipo_telefono_id = Input::get('tipo_telefono_id');
        	$contacto_testigo_rescate->telefono = Input::get('telefono');
        	$contacto_testigo_rescate->codigo_pais = Input::get('codigo_pais');
        	$contacto_testigo_rescate->seguimiento_rescate = 1;
        	$contacto_testigo_rescate->save();



        }

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
	}
 ?>