<?php 
	class PersonalOperativoControlador extends ModuloControlador{
		public $moduleName = "Personal Operativo";
		public $moduleIcon= 'users';	

		
		public function getIndex(){
			
			$dataModule["empleados"] = VistaEmpleado::all();
			$dataModule["puestos"]=Puesto::all();			
			$data["module"] = $this->moduleName;								
 			$data["icon"]= $this->moduleIcon;		
 			return View::make(Auth::user()
 				->departamento
 				->nombre.".main", $data)
 				->nest('child', 'operaciones.personaloperativo', $dataModule);
					
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
						public function getActivar($id){

					$empleado = Empleado::find($id);
					$empleado->activo = "1";
					$empleado->save();
					return Redirect::to('personal-operativo')->with('status', 'ok_activar');

				}	
				
	}
 
		

 ?>