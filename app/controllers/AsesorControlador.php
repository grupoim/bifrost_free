<?php 
	class AsesorControlador extends ModuloControlador{
		public $moduleName = "Promotores y Asesores";
		public $moduleIcon= 'users';
		

		public function getIndex(){
			//return Hash::make('00400169');	

			$dataModule["asesores"] = VistaAsesorPromotor::all();
			$dataModule["promotores"] = VistaPromotores::all();	
			$data["module"] = $this->moduleName;
 			$data["icon"]= $this->moduleIcon;	
 			return View::make(Auth::user()->departamento->nombre.".main", $data)->nest('child', 'sistemas.asesor', $dataModule);
			
			

//			$data_array = VistaAsesorPromotor::all();
//			$data_array = DB::table('asesor_promotor')->get();
//			$data_asesor = Asesor::where('activo', 1)->orderby('persona_id')->get();

			$data["module"] = $this->moduleName;
 			return View::make("sistemas.asesor", $data)->with('datos_array', $data_array);
		}

		public function postCrearRegistro() {
			// Se llama a la función de guardarDatos en el modelo Queja y le pasamos los datos del formulario
			$respuesta = Persona::guardarDatos(Input::all());
			// Dependiendo de la respuesta del modelo retornamos los mensajes de error con los datos 
			// viejos del formulario o un mensaje de éxito de la operación.

			if ($respuesta['error'] == true) { // <-- redirecciono a la pantalla queja/nuevo-registro
				return Redirect::to('queja')->withErrors($respuesta['mensaje'])->withInput();
			} else {
				return Redirect::to('asesor')->with('mensaje', $respuesta['mensaje']);
			}			
		}
		public function getAll() {			 
			
			$asesor = Asesor::select('asesor.id as id_asesor', DB::raw("CONCAT(persona.nombres, ' ', persona.apellido_paterno, ' ', persona.apellido_materno) as Asesor"))
			->leftjoin('persona', 'asesor.persona_id','=','persona.id')->get();
			return Response::Json($asesor);
		}

	}