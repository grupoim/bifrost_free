<?php 
use Carbon\Carbon;
	class PersonalOperativoControlador extends ModuloControlador{
		public $moduleName = "Personal Operativo";
		public $moduleIcon= 'users';	

		
		public function getIndex(){
			
			$dataModule["empleados"] = VistaEmpleado::all();

			$data["module"] = $this->moduleName;								
 			$data["icon"]= $this->moduleIcon;		
 			return View::make(Auth::user()
 				->departamento
 				->nombre.".main", $data)
 				->nest('child', 'operaciones.personaloperativo', $dataModule);
					
		}

		public function getLista(){
			$dataModule["empleados"] = VistaEmpleado::where('activo',1)->get();						
			$dataModule["listas"] = Lista::all();
			$data["module"] = $this->moduleName;								
 			$data["icon"]= $this->moduleIcon;		
 			return View::make(Auth::user()
 				->departamento
 				->nombre.".main", $data)
 				->nest('child', 'operaciones.lista', $dataModule);

		}

		public function getCierraperiodo($lista_id){
			if ((Auth::user()->departamento->id == 4) or (Auth::user()->departamento->id == 1 )) {
			$lista = Lista::find($lista_id);
			$lista->activa = 0;
			$lista->save();

			return Redirect::to('personal-operativo/lista');
		}

		}
		
		public function getAbreperiodo($lista_id){
			if ((Auth::user()->departamento->id == 4) or (Auth::user()->departamento->id == 1 )) {
			$lista = Lista::find($lista_id);
			$lista->activa = 1;
			$lista->save();
			return Redirect::to('personal-operativo/asistencia/'.$lista_id);

		}

		}

		public function getAsistencia($lista_id){
			$dataModule["asistencias"] = VistaListaAsistencia::where('lista_id',$lista_id)->get();
			$dataModule["lista"] = Lista::find($lista_id);		
			$data["module"] = $this->moduleName;								
 			$data["icon"]= $this->moduleIcon;		
 			return View::make(Auth::user()
 				->departamento
 				->nombre.".main", $data)
 				->nest('child', 'operaciones.asistencia', $dataModule);

		}
	

		public function postAsis(){
			
			if (Input::has('lunes')){
				$lunes = 1;
			}
			else{
				$lunes = 0;
			}
			if (Input::has('martes')){
				$martes = 1;
			}
			else{
				$martes = 0;
			}
			if (Input::has('miercoles')){
				$miercoles = 1;
			}
			else{
				$miercoles = 0;
			}
			if (Input::has('jueves')){
				$jueves = 1;
			}
			else{
				$jueves = 0;
			}
			if (Input::has('viernes')){
				$viernes = 1;
			}
			else{
				$viernes = 0;
			}
			if (Input::has('sabado')){
				$sabado = 1;
			}
			else{
				$sabado = 0;
			}

			if (Input::has('domingo')){
				$domingo = 1;
			}
			else{
				$domingo = 0;
			}

			$asistencia = Asistencia::find(Input::get('asistencia_id'));
			$asistencia->empleado_id = Input::get('empleado_id');
			$asistencia->sa = $sabado;
			$asistencia->do = $domingo;
			$asistencia->lu = $lunes;
			$asistencia->ma = $martes;
			$asistencia->mi = $miercoles;
			$asistencia->ju = $jueves;
			$asistencia->vi = $viernes;
			if(Input::has('observaciones')){
				$asistencia->observaciones = Input::get('observaciones');
			}
			$asistencia->save();

 			return Redirect::back();

		}
	

		public function getAgregar(){

				$data["module"] = $this->moduleName.'/ Agregar empleado';
				$data["empleados"] = VistaEmpleado::all();				
				$data["puestos"]=Puesto::all();								
 				$data["icon"]= 'user-plus';
 				$data["puestos"] = Puesto::all(); 				
 				$data["agregar"]= true;					
				return View::make(Auth::user()
 				->departamento
 				->nombre.".main", $data)
 				->nest('child','formularios.personaloperativo', $data);
		}

		public function getAgregarperiodo(){

				$data["module"] = $this->moduleName.'/ Agregar Periodo';
				$data["empleados"] = VistaEmpleado::all();				
				$data["puestos"]=Puesto::all();								
 				$data["icon"]= 'user-plus';
 				$data["puestos"] = Puesto::all(); 				
 				$data["agregar"]= true;					
				return View::make(Auth::user()
 				->departamento
 				->nombre.".main", $data)
 				->nest('child','formularios.periodo', $data);
		}
	
			public function getRecupera($id){			
		
			$data["module"] = $this->moduleName.'/ Editar empleado';
			$data["empleado_r"] = VistaEmpleado::find($id);
			$data["puestos"]= Puesto::all();
			$data["icon"]= 'pencil';			
			$data["agregar"]= false;
			return View::make(Auth::user()
 				->departamento
 				->nombre.".main", $data)
 				->nest('child','formularios.personaloperativo', $data);
			}	

		
		public function postInsertar(){

			//validar formulario
			$rules = array(
					'nombres' => 'required|max:50',
					'apellido_paterno' => 'required|max:50',
					'apellido_materno'=> 'required|max:50',
					'fecha_ingreso' => 'required'
					
				);

				$messages = array(
						'required'=>'Campo Obligatorio.',
						'max' => 'El campo :attribute no puede tener mas de 50 caracteres'
					);

			$validator = Validator::make(Input::all(), $rules, $messages);
				if ($validator->fails())
				 { 
						
						return Redirect::back()->withInput()->withErrors($validator);						
				}
			
				//al pasar la validacion se procede a guardar campos			

			$persona = new Persona;

			$persona->nombres = Input::get('nombres');
			$persona->apellido_paterno = Input::get('apellido_paterno');
			$persona->apellido_materno = Input::get('apellido_materno');			
			$persona->save();

			$empleado = new Empleado;
			$empleado->persona_id= $persona->id; //insertar el valor del id de la persona anteriormente insertada
			$empleado->puesto_id = Input::get('puesto_id');
			$empleado->fecha_ingreso = Input::get('fecha_ingreso');

			$empleado->save();
			//redirigir al listado de personal operativo
			return Redirect::to('personal-operativo')->with('status', 'ok_create');
			
		}	
			
		
		public function postEditar($id) {
			//validar formulario
			$rules = array(
					'nombres' => 'required|max:50',
					'apellido_paterno' => 'required|max:50',
					'apellido_materno'=> 'required|max:50'				
					
				);	

			$messages = array(
						'required'=>'El campo :attribute es Obligatorio.',
						'max' => 'El campo :attribute no puede tener mas de 50 caracteres'
					);


			$validator = Validator::make(Input::all(), $rules, $messages);
				if ($validator->fails())
				 {		 		

						return Redirect::back()->withInput()->withErrors($validator);
				}
				//al pasar la validacion se procede a guardar campos	
  		 
  		 	$empleado = Empleado::find($id);
  		 	$empleado->puesto_id = Input::get('puesto_id');
			$empleado->fecha_ingreso = Input::get('fecha_ingreso');
			$empleado->save();
   			
  		 	$persona = Persona::find($empleado->persona_id);

			$persona->nombres = Input::get('nombres');
			$persona->apellido_paterno = Input::get('apellido_paterno');
			$persona->apellido_materno = Input::get('apellido_materno');
			$persona->sexo = Input::get('sexo');
			$persona->save();

   			return Redirect::to('personal-operativo')->with('status', 'ok_update')->with('status', 'ok_update');
			}

			
			public function getBaja($id){

					$empleado = Empleado::find($id);
					$empleado->activo = "0";
					$empleado->save();
					return Redirect::to('personal-operativo')->with('status', 'ok_cancel');

				}

				public function getBajalista($empleado_id){

					$empleado = Empleado::find($empleado_id);
					$empleado->activo = "0";
					$empleado->save();
					return Redirect::back();

				}
						public function getActivar($id){

					$empleado = Empleado::find($id);
					$empleado->activo = "1";
					$empleado->save();
					return Redirect::to('personal-operativo')->with('status', 'ok_activar');

				}	
				
				public function postCrealista(){
					$fecha_fin = Input::get('fecha');
					$fecha_fin_carbon = Carbon::parse($fecha_fin);
					$fecha_inicio_carbon = $fecha_fin_carbon->subDays(Input::get('tipo_lista'))->toDateString();
					
					$lista = new Lista;
					$lista->fecha_inicio = $fecha_inicio_carbon;
					$lista->fecha_fin = $fecha_fin;
					$lista->save();

					$trabajadores_activos = VistaEmpleado::where('activo',1)->count();
					$trabajadores = VistaEmpleado::where('activo',1)->get();
		

					foreach($trabajadores as $trabajador){
					$asistencia = new Asistencia;
					$asistencia->lista_id = $lista->id;
					$asistencia->empleado_id = $trabajador->id;
					$asistencia->save();
					}					

					
					return Redirect::to('personal-operativo/asistencia/'.$lista->id);


				}

				
	}
 
		

 ?>