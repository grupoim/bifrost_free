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
		$dataModule["servicios"] = VistaServicioFuneralCapilla::select('vista_servicio_funeral_capilla.*','venta_servicio_funeral.prevision','venta_servicio_funeral.servicio_realizado',
			'venta_servicio_funeral.prevision', 'venta_servicio_funeral.venta_producto_id as venta_producto_id','venta_servicio_funeral.cremacion',
		'contrato.folio','contrato.id as contrato_id','contrato.impresiones')
		->leftJoin('venta_servicio_funeral','vista_servicio_funeral_capilla.venta_producto_id', '=', 'venta_servicio_funeral.venta_producto_id')
		->leftJoin('contrato', 'venta_servicio_funeral.contrato_id', '=', 'contrato.id')
		->get();
		$dataModule['db'] = ConfiguracionGeneral::where('empresa_id', 1)->where('activo', 1)->firstorFail();	

		return View::make($this->department.".main", $this->data)->nest('child', $this->department.'.serviciocapilla', $dataModule);}
////////////////////////////////////////////////////////////////////////////////////////////////////////////
		public function getRegistroservicio()
		{
		$dataModule["parentezcos"] = Parentezco::where('activo',1)->get();
		$dataModule["tipo_telefonos"] = TipoTelefono::all();
		$dataModule["rescatistas"] = Rescatista::select('rescatista.id as rescatista_id', DB::raw("CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) as rescatista"))
									->where('rescatista.activo',1)
									->leftJoin('persona','rescatista.persona_id','=','persona.id')->get();
		
	   return View::make($this->department.".main", $this->data)->nest('child', 'capilla.registroservicio', $dataModule);	
			}	


		public function getRescatista()
		{			$dataModule["status"] = Session::pull('status');
					$dataModule["tipo_telefonos"] = TipoTelefono::all();	
		            $dataModule["rescatistas"] = Rescatista::select('rescatista.id as rescatista_id','contacto_rescatista.telefono' 
		            	,'tipo_telefono.descripcion','rescatista.activo',DB::raw("CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) as rescatista"))
									->leftJoin('persona','rescatista.persona_id','=','persona.id')
									->leftJoin('contacto_rescatista','rescatista.id','=','contacto_rescatista.rescatista_id')
									->leftJoin('tipo_telefono','contacto_rescatista.tipo_telefono_id','=','tipo_telefono.id')->get();
		
	               return View::make($this->department.".main", $this->data)->nest('child', 'capilla.rescatista', $dataModule);	
			}


		public function getBaja($id)
		{
		
		  $rescatista = Rescatista::find($id);
		  $rescatista->activo = 0;
		  $rescatista->save();
		return  Redirect::back()->with('status', 'baja_rescatista');

		}

		public function getAlta($id)
		{
		
		  $rescatista = Rescatista::find($id);
		  $rescatista->activo = 1;
		  $rescatista->save();
		return  Redirect::back()->with('status', 'alta_rescatista');

		}
	    public function getRecupera($id)
		{
		$dataModule["tipo_telefonos"] = TipoTelefono::all();	
		            $dataModule["rescatistas"] = Rescatista::select('rescatista.id as rescatista_id','contacto_rescatista.telefono' 
		            	,'tipo_telefono.descripcion','rescatista.activo',DB::raw("CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) as rescatista"))
									->leftJoin('persona','rescatista.persona_id','=','persona.id')
									->leftJoin('contacto_rescatista','rescatista.id','=','contacto_rescatista.rescatista_id')
									->leftJoin('tipo_telefono','contacto_rescatista.tipo_telefono_id','=','tipo_telefono.id')->get();
		 $dataModule["status"] = Session::pull('status','edit');
		 $dataModule["rescatista_edit"] = Rescatista::select('rescatista.id as rescatista_id','contacto_rescatista.telefono' 
		            	,'tipo_telefono.descripcion','tipo_telefono.id as tipo_telefono_id','rescatista.activo', 'persona.nombres', 'persona.apellido_paterno','persona.apellido_materno')
									->where('rescatista.id',$id)
									->leftJoin('persona','rescatista.persona_id','=','persona.id')
									->leftJoin('contacto_rescatista','rescatista.id','=','contacto_rescatista.rescatista_id')
									->leftJoin('tipo_telefono','contacto_rescatista.tipo_telefono_id','=','tipo_telefono.id')->first();
	     return View::make($this->department.".main", $this->data)->nest('child', 'capilla.rescatista', $dataModule);

		}

		public function postEditar()
		{

			$nombre = trim(Str::title(Input::get('nombres')));
			$ap_pat = trim(Str::title(Input::get('apellido_paterno')));
			$ap_mat = trim(Str::title(Input::get('apellido_materno')));		
        	
        	$rescatista = Rescatista::select('rescatista.id as rescatista_id','contacto_rescatista.telefono','persona.id as persona_id' 
		            	,'tipo_telefono.descripcion','tipo_telefono.id as tipo_telefono_id','contacto_rescatista.id as contacto_rescatista_id','rescatista.activo', 'persona.nombres', 'persona.apellido_paterno','persona.apellido_materno')
									->where('rescatista.id',Input::get('rescatista_id'))
									->leftJoin('persona','rescatista.persona_id','=','persona.id')
									->leftJoin('contacto_rescatista','rescatista.id','=','contacto_rescatista.rescatista_id')
									->leftJoin('tipo_telefono','contacto_rescatista.tipo_telefono_id','=','tipo_telefono.id')->first();

        	$persona = Persona::find($rescatista->persona_id);
        	$persona->nombres = $nombre;
        	$persona->apellido_paterno = $ap_pat;
        	$persona->apellido_materno = $ap_mat;
        	$persona->save();

        	$contacto_rescatista = ContactoRescatista::find($rescatista->contacto_rescatista_id);
        	$contacto_rescatista->telefono = Input::get('telefono');
        	$contacto_rescatista->codigo_pais = Input::get('codigo_pais');
        	$contacto_rescatista->rescatista_id = Input::get('rescatista_id');
        	$contacto_rescatista->tipo_telefono_id = Input::get('tipo_telefono_id');
        	$contacto_rescatista->save();
			
			return  Redirect::to('servicio-funeral/rescatista')->with('status', 'editado');
			
		}

      /////////////////////////////////////////////////////////////////////////////////////////////////////////// 
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
        	
        	if (DB::table('rescatista')->select('persona.nombres','persona.apellido_paterno','persona.apellido_materno')
        		->where('nombres','=',Input::get('nombres'))
        		->where('apellido_paterno','=',Input::get('apellido_paterno'))
        		->where('apellido_materno','=',Input::get('apellido_materno'))
        		->where('rescatista.activo',1)->leftJoin('persona','rescatista.persona_id','=','persona.id')->get()) {

        	return  Redirect::back()->with('status', 'registro_validacion');
        	}else{
			
			$nombre = trim(Str::title(Input::get('nombres')));
			$ap_pat = trim(Str::title(Input::get('apellido_paterno')));
			$ap_mat = trim(Str::title(Input::get('apellido_materno')));		
        	
        	$persona = new Persona;
        	$persona->nombres = $nombre;
        	$persona->apellido_paterno = $ap_pat;
        	$persona->apellido_materno = $ap_mat;
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
	}
 ?>