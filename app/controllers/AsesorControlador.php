<?php 
	class AsesorControlador extends ModuloControlador{
		public $department;

		function __construct(){
		$this->data["module"] = 'Promotores y Asesores';
		$this->data["icon"] ='users';
		$this->department = Auth::user()->departamento->nombre;
		}

		public function getIndex(){
			
			$dataModule["status"] = Session::pull('status');
			$dataModule["edit"] = false;
			$dataModule["vendedores"] = VistaAsesorPromotor::all();

			$dataModule["promotores"] = VistaPromotores::all();			
							
 			return View::make($this->department.".main", $this->data)->nest('child', 'sistemas.asesor', $dataModule);


		}
		public function getPromotorias() {			 
					
					$promotorias = VistaPromotores::all();
					return Response::Json($promotorias);
				}

		public function postNuevovendedor() {
			
			//Quitar espacios en nombres poner en mayuscula solo la primer letra
			$nombre = trim(Str::title(Input::get('nombres')));
			$ap_pat = trim(Str::title(Input::get('apellido_paterno')));
			$ap_mat = trim(Str::title(Input::get('apellido_materno')));

			if(Input::has('fecha_ingreso'))
					{
						$ingreso = Input::get('fecha_ingreso');
					}
				else
				 		$ingreso = date("Y-m-d");
			 

			$persona = new Persona;
			$persona->nombres = $nombre;
			$persona->apellido_paterno = $ap_pat;
			$persona->apellido_materno = $ap_mat;
			$persona->save();

			$asesor = new Asesor;
			$asesor->persona_id = $persona->id;
			$asesor->fecha_ingreso = $ingreso;
			$asesor->save();

			if(Input::get('telefono')){
			$telefono_asesor = new TelefonoAsesor;
			$telefono_asesor->telefono = Input::get('telefono');
			$telefono_asesor->asesor_id = $asesor->id;
			$telefono_asesor->tipo_telefono_id = 2;
			$telefono_asesor->save();
			}

			if(Input::get('celular')){
			$celular_asesor = new TelefonoAsesor;
			$celular_asesor->telefono = Input::get('celular');
			$celular_asesor->asesor_id = $asesor->id;
			$celular_asesor->tipo_telefono_id = 1;
			$celular_asesor->save();
			}
			
			switch(Input::get('promotor_id')){
				default:
					//vendedor pertenece a promotoria
					$promotoria = new Promotor;
					$promotoria->promotor_id = Input::get('promotor_id');
					$promotoria->asesor_id = $asesor->id;
					$promotoria->save();
					break;
				case "ind":
					//vendedor no tiene promotoria
					break;
				case "new":
					//vendedor promotor
					$promotoria = new Promotor;
					$promotoria->promotor_id = $asesor->id;
					$promotoria->asesor_id = $asesor->id;
					$promotoria->save();
					break;
				
			}			
			return Redirect::back()->with('status','created')->with('edit', 'false');
			/*$nombre = trim(Str::title(Input::get('nombres')));
			return $nombre;*/


						
		}

		public function getBaja($id_asesor){
			$asesor = Asesor::find($id_asesor);
  		 	$asesor->activo = 0;			
			$asesor->save();

			return Redirect::back()->with('status','baja');

		}
		public function getAlta($id_asesor){
			$asesor = Asesor::find($id_asesor);
  		 	$asesor->activo = 1;			
			$asesor->save();

			return Redirect::back()->with('status','alta');


		}

		public function getRecupera($asesor_id){
		
			$dataModule["vendedores"] = VistaAsesorPromotor::all();

			$dataModule["promotores"] = VistaPromotores::all();
			$dataModule["status"] = Session::pull('status','edit');
			$dataModule['asesor_r']  = VistaAsesorPromotor::join('persona', 'vista_asesor_promotor.persona_id', '=','persona.id')
												->where('vista_asesor_promotor.asesor_id', '=', $asesor_id)
												->first();
			$dataModule["telefono"] = TelefonoAsesor::where('tipo_telefono_id','=','2')
														->where('asesor_id', '=',$asesor_id)->first();
			$dataModule["celular"] = TelefonoAsesor::where('tipo_telefono_id','=','1')
														->where('asesor_id', '=',$asesor_id)->first();
		
			return View::make($this->department.".main", $this->data)->nest('child', 'sistemas.asesor',$dataModule);

		}
		public function postEditar(){			
			//Quitar espacios en nombres poner en mayuscula solo la primer letra
			$nombre = trim(Str::title(Input::get('nombres')));
			$ap_pat = trim(Str::title(Input::get('apellido_paterno')));
			$ap_mat = trim(Str::title(Input::get('apellido_materno')));

			if(Input::has('fecha_ingreso'))
					{
						$ingreso = Input::get('fecha_ingreso');
					}
				else
				 		$ingreso = date("Y-m-d");

			$asesor = Asesor::find(Input::get('asesor_id'));
			$asesor->fecha_ingreso = $ingreso;
			$asesor->save();
			
			$persona = Persona::find($asesor->persona_id);
			$persona->nombres = $nombre;
			$persona->apellido_paterno = $ap_pat;
			$persona->apellido_materno = $ap_mat;
			$persona->save();

			if(Input::has('telefono') and Input::has('id_telefono')){

			$telefono_asesor = TelefonoAsesor::where('asesor_id', '=', Input::get('asesor_id'))->where('tipo_telefono_id','=',2)->first();
			$telefono_recup = Input::get('telefono');
			
			if($telefono_asesor){
			if($telefono_asesor <> $telefono_recup ){

			$telefono_edit = TelefonoAsesor::find(Input::get('id_telefono'));
			$telefono_edit->telefono = Input::get('telefono');
			$telefono_edit->save();
			}

		}else 			
			$telefono_asesor = new TelefonoAsesor;
			$telefono_asesor->telefono = Input::get('telefono');
			$telefono_asesor->asesor_id = Input::get('asesor_id');
			$telefono_asesor->tipo_telefono_id = 2;
			$telefono_asesor->save();		
		}
	

	if(Input::has('celular') and Input::has('id_telefono_c')){

			$celular_asesor = TelefonoAsesor::where('asesor_id', '=', Input::get('asesor_id'))->where('tipo_telefono_id','=',1)->first();
			$celular_recup = Input::get('celular');
			
			if($celular_asesor){
			if($celular_asesor <> $celular_recup ){

			$celular_edit = TelefonoAsesor::find(Input::get('id_telefono_c'));
			$celular_edit->telefono = Input::get('celular');
			$celular_edit->save();
			}

		}else 			
			$celular_asesor = new TelefonoAsesor;
			$celular_asesor->telefono = Input::get('celular');
			$celular_asesor->asesor_id = Input::get('asesor_id');
			$celular_asesor->tipo_telefono_id = 1;
			$celular_asesor->save();		
		}


		
				
		
		switch(Input::get('promotor_id')){
				
						default:

						$existe_promo = Promotor::where('asesor_id','=',Input::get('asesor_id'))->first();
						
						//vendedor EXISTENTE cambio de promotoria Existente	
						if($existe_promo){
							$promo = Promotor::find($existe_promo->id);
							$promo->promotor_id = Input::get('promotor_id');
							$promo->save();
						}
						else{
						//vendedor INDEPENDIENTE asignar NUEVA promotoria existente					
							$promotoria = new Promotor;
							$promotoria->promotor_id = Input::get('promotor_id');
							$promotoria->asesor_id = $asesor->id;
							$promotoria->save();
						}
						

						break;
					
				case "ind":
					$existe_promo = Promotor::where('asesor_id','=',Input::get('asesor_id'))->first();
					//vendedor sale de promotoria
					if($existe_promo){
							$promo = Promotor::find($existe_promo->id);
							$promo->delete();
						}
					
					

					break;
				case "new":
					//vendedor promotor
					$promotoria = new Promotor;
					$promotoria->promotor_id = $asesor->id;
					$promotoria->asesor_id = $asesor->id;
					$promotoria->save();
					break;
				
			}
		
		
			return Redirect::back();
		}
		public function getAll() {			 
			
			$asesor = Asesor::select('asesor.id as id_asesor', DB::raw("CONCAT(persona.nombres, ' ', persona.apellido_paterno, ' ', persona.apellido_materno) as Asesor"))
			->leftjoin('persona', 'asesor.persona_id','=','persona.id')->get();
			return Response::Json($asesor);
		}

		
		

	}