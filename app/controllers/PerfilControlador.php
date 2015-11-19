<?php 
	class PerfilControlador extends ModuloControlador{
		public $data = array();
		public $department;

		function __construct(){
			$this->data["module"] = "Control de usuarios";			
			$this->data["icon"] = "cart-plus";			
			$this->department = Auth::user()->departamento->nombre;
		}		

		public function getIndex(){	
			$dataModule['status'] = Session::pull('status');
			$dataModule['user'] = Usuario::find( Auth::user()->id);
			//sistemas
			if (Auth::user()->departamento_id == 1  and Auth::user()->jefe == 1) {	
		$dataModule['rol'] = Session::pull('rol', 'sistemas');			
		$dataModule['usuarios'] = Usuario::all();

	}
		//jefe de departamento	
	if (Auth::user()->departamento_id <> 1 and Auth::user()->jefe == 1 ) {
		$dataModule['usuarios'] = Usuario::where('departamento_id', '=', Auth::user()->departamento->id)->get();
		$dataModule['rol'] = Session::pull('rol', 'jefe');
	}
	//usuario estándar

	if (Auth::user()->jefe <> 1) {
		$dataModule['usuarios'] = Usuario::where('id', '=', Auth::user()->id)->get();
		$dataModule['rol'] = Session::pull('rol', 'user');		
	}

		return View::make($this->department.".main", $this->data)->nest('child','sistemas.perfil_usuario', $dataModule);
        }

 

 public function getRecupera($id){

        	$dataModule['status'] = Session::pull('status','edit');
        	$dataModule['user'] = Usuario::find( Auth::user()->id);
        	//sistemas
	if (Auth::user()->departamento_id == 1  and Auth::user()->jefe == 1) {				
		$dataModule['usuarios'] = Usuario::all();
		$dataModule['rol'] = Session::pull('rol', 'sistemas');
	}
		//jefe de departamento	
	if (Auth::user()->departamento_id <> 1 and Auth::user()->jefe == 1 ) {
		$dataModule['usuarios'] = Usuario::where('departamento_id', '=', Auth::user()->departamento->id)->get();
		$dataModule['rol'] = Session::pull('rol', 'jefe');
	}
	//usuario estándar

	if (Auth::user()->jefe <> 1) {
		$dataModule['usuarios'] = Usuario::where('id', '=', Auth::user()->id)->get();
		$dataModule['rol'] = Session::pull('rol', 'user');
	}
        	$dataModule['usuario_r'] = Usuario::find($id);
        	return View::make($this->department.".main", $this->data)->nest('child','sistemas.perfil_usuario', $dataModule);

        }

        public function postEditar(){
        	
        	$name_persona_edit = Persona::find(Input::get('persona_id'));
        	if (Input::has('nombres')){
        			if ($name_persona_edit->nombres <> Input::get('nombres') ) {
        				$name_persona_edit->nombres = Input::get('nombres');
        				$name_persona_edit->save();
        			}

        	}

        	$appat_persona_edit = Persona::find(Input::get('persona_id'));
        	if (Input::has('apellido_paterno')){
        			if ($appat_persona_edit->apellido_paterno <> Input::get('apellido_paterno') ) {
        				$appat_persona_edit->apellido_paterno = Input::get('apellido_paterno');
        				$appat_persona_edit->save();
        			}

        	}

        	$apmat_persona_edit = Persona::find(Input::get('persona_id'));
        	if (Input::has('apellido_materno')){
        			if ($apmat_persona_edit->apellido_materno <> Input::get('apellido_materno') ) {
        				$apmat_persona_edit->nombres = Input::get('apellido_materno');
        				$apmat_persona_edit->save();
        			}

        	}


        	$usuario_edit = Usuario::find(Input::get('usuario_id'));

        	if (Input::has('nombre')){
        		$usuario_edit->nombre = Input::get('nombre');
        		$usuario_edit->save();
        	}


        	if (Input::has('pass')){
        		$pass = Hash::make(Input::get('pass'));
        		$usuario_edit->contrasenia = $pass;
        		$usuario_edit->save();
        	}

        	if(Input::hasFile('foto')) { //checa si trae archivo para poder guardar
					$usuario_edit = Usuario::find(Input::get('usuario_id'));
					$file = Input::file("foto");					

					$usuario_edit->avatar = Input::file('foto')->getClientOriginalName();//nombre original de la foto								
					$file->move("public/img/upload/usuarios",$file->getClientOriginalName());
					$usuario_edit->save();
						}
        	return Redirect::to('perfil-usuario/recupera/'.Input::get('usuario_id'));


        }

        public function getNuevo(){
        	
        	$dataModule['status'] = Session::pull('status','nuevo');
			$dataModule['usuarios'] = Usuario::all();
			$dataModule['user'] = Usuario::find( Auth::user()->id);
			$dataModule['departamentos'] = Departamento::all();
			$dataModule['rol'] = Session::pull('rol', 'sistemas');

			return View::make($this->department.".main", $this->data)->nest('child','sistemas.perfil_usuario', $dataModule);


        }

        public function postAdd(){
        	
        	$persona = new Persona;
        	$persona->nombres = Input::get('nombres');
        	$persona->apellido_paterno = Input::get('apellido_paterno');
        	$persona->apellido_materno = Input::get('apellido_materno');
        	$persona->save();

        	$user = new Usuario;
        	$user->persona_id = $persona->id;
        	$user->nombre = Input::get('nombre');
        	$user->contrasenia = Hash::make(Input::get('pass'));
        	$user->departamento_id = Input::get('departamento_id');
        	$user->rol_id = Input::get('rol_id');
        	$user->jefe = Input::get('jefe');

        	if(Input::hasFile('foto')) { //checa si trae archivo para poder guardar
					
					$file = Input::file("foto");					

					$user->avatar = Input::file('foto')->getClientOriginalName();//nombre original de la foto								
					$file->move("public/img/upload/usuarios",$file->getClientOriginalName());					
						}
			$user->save();

        	return Redirect::to('perfil-usuario/recupera/'.$user->id);


        }


	}