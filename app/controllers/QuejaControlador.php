<?php 
	class QuejaControlador extends ModuloControlador{
		public $department;

		function __construct(){
		$this->data["module"] = 'Quejas';
		$this->data["icon"] ='bullhorn';
		$this->department = camel_case(Auth::user()->departamento->nombre);
		}

		public function getIndex(){
			$dataModule["quejas"] = Queja::select(DB::raw('queja.*,count(queja_seguimiento.queja_id) as numero_mensajes')) 
										->leftJoin('queja_seguimiento', 'queja.id', '=', 'queja_seguimiento.queja_id')																					
										->groupBy('id')
										->orderBy('created_at', 'desc')
										->get();

			$dataModule["rubros"]= Rubro::all();

 			return View::make($this->department.".main", $this->data)->nest('child', 'administracion.queja', $dataModule);


		}

		public function getTotal(){
			$count_quejas = Queja::where('cerrada',0)->count();
			return Response::json(array('total' => $count_quejas));
		}

		public function getAll() {
			return Queja::with('rubro')->where('cerrada', 0)->orderby('created_at', 'desc')->take(3)->get();			
		}

		public function postCrearQueja() {
			// Se llama a la función de guardarDatos en el modelo Queja y le pasamos los datos del formulario
			$respuesta = Queja::guardarDatos(Input::all());
			// Dependiendo de la respuesta del modelo retornamos los mensajes de error con los datos 
			// viejos del formulario o un mensaje de éxito de la operación.

			if ($respuesta['error'] == true) { // <-- redirecciono a la pantalla queja/nuevo-registro
				return Redirect::to('queja')->withErrors($respuesta['mensaje'])->withInput();
			} else {
				return Redirect::to('queja')->with('mensaje', $respuesta['mensaje']);
			}
		}

		public function getNoaplica($id){

					$queja = Queja::find($id);
					$queja->aplica = "1";
					$queja->cerrada = "1";
					$queja->save();
					return Redirect::to('queja')->with('status', 'no_aplica');

				}
		public function getCerrar($id){

					$queja = Queja::find($id);
					$queja->aplica = "0";
					$queja->cerrada = "1";
					$queja->save();
					return Redirect::to('queja')->with('status', 'cerrada');

				}
				 public function postStore()
				 {
				 	# code...
				 }
			

				 public function getRecupera($id){
					$data["module"] = 'Quejas';
					$data["queja_r"] = Queja::with('QuejaSeguimiento')->find($id);					
						
			return View::make($this->department.".main", $this->data)
				->nest('child', 'formularios.queja_detalle', $data);

				}

			public function postSeguimiento(){

				//validar formulario
			$rules = array(
					'observaciones' => 'required|max:200'
					
				);

				$messages = array(
						'required'=>'Favor de capturar observaciones antes de cerrar, aplicar o no aplicar queja',
						'max' => 'El campo :attribute no puede tener mas de 50 caracteres'
					);

			$validator = Validator::make(Input::all(), $rules, $messages);
				if ($validator->fails())
				 { 
						
						return Redirect::back()->withInput()->withErrors($validator);						
				}
			
				//al pasar la validacion se procede a guardar campos


			$queja_id = Input::get('queja_id');	
					
			if (Input::get('oculto') == 3) //no aplica
				{	
					$queja = Queja::find($queja_id);				
					$queja->aplica = "1";
					$queja->cerrada = "1";
					$queja->save();
				}
			elseif (Input::get('oculto') == 2) { //cerrar queja aplicada
					$queja = Queja::find($queja_id);					
					$queja->cerrada = "1";
					$queja->save();										

				}		
			$historial = new QuejaSeguimiento;
					
					$file = Input::file('foto');
					$historial->queja_id = Input::get('queja_id');
					$historial->usuario_id = Input::get('usuario_id');
					$historial->observaciones = Input::get('observaciones');
					
					if(Input::hasFile('foto')) { //checa si trae archivo para poder guardar
					$historial->foto = Input::file('foto')->getClientOriginalName();//nombre original de la foto								
					$file->move("img/upload/queja_seguimiento_file",$file->getClientOriginalName());
						}
					
					$historial->save();

					$seguimiento_r = QuejaSeguimiento::select('departamento.nombre as departamento', 'usuario.nombre as usuario', 'rubro.descripcion as rubro','queja_seguimiento.observaciones as seguimiento','queja.id as queja_id', 'queja.descripcion as queja') 
									->leftJoin('queja', 'queja_seguimiento.queja_id','=', 'queja.id')
									->leftJoin('rubro', 'queja.rubro_id','=','rubro.id')
									->leftJoin('usuario', 'queja_seguimiento.usuario_id','=','usuario.id')
									->leftJoin('departamento', 'rubro.departamento_id','=','departamento.id')
									->where('queja_seguimiento.id','=',$historial->id)	
									->first();

					//enviar mail de confirmacion
					Mail::send('emails.new_seguimiento_queja', array('descripcion'=>Input::get('observaciones'),
											 'departamento'=>$seguimiento_r->departamento,
											 'usuario'=>$seguimiento_r->usuario,
											 'rubro'=>$seguimiento_r->rubro,
											 'seguimiento'=>$seguimiento_r->seguimiento,
											 'queja'=>$seguimiento_r->queja,
											 'queja_id'=>$seguimiento_r->queja_id
																					), function($message) {
			    /*$message->to('elnazavalderrama@gmail.com')->subject('Notificacion de nueva queja');*/
			   $message->to('notificaciones@parquefuneralguadalupe.com.mx')->subject('Nuevo seguimiento de queja');
			});

					//fin mail confirmación	



					return Redirect::to('queja/recupera/'.$queja_id);
}
public function postNoaplica_d($id){					

			$queja = Queja::find($id);
					$queja->aplica = "1";
					$queja->cerrada = "1";
					$queja->save();
					return Redirect::to('queja')->with('status', 'no_aplica');
					}

	public function PostCerrar()
	{
			$queja = Queja::find($id);
					$queja->aplica = "0";
					$queja->cerrada = "1";
					$queja->save();
					return Redirect::to('queja')->with('status', 'cerrada');
	}

	public function postAgregar()	
	{
		
		$nueva_queja = new Queja;
		$file = Input::file("foto");
		$nueva_queja->rubro_id = Input::get('rubro_id');
		$nueva_queja ->usuario_id = Input::get('usuario_id');
		$nueva_queja->descripcion = Input::get('descripcion');
		$nueva_queja->gravedad = Input::get('gravedad');
		if(Input::hasFile('foto')) {
		$nueva_queja->foto = Input::file("foto")->getClientOriginalName();//nombre original de la foto
		$file->move("img/upload/queja_file",$file->getClientOriginalName());	}
		$nueva_queja->save();		
		
		$departamento = Rubro::select('departamento.nombre', 'rubro.descripcion')
		->leftJoin('departamento', 'rubro.departamento_id','=','departamento.id')
		->where('rubro.id', '=',Input::get('rubro_id'))->first();		
		
		
		Mail::send('emails.new_queja', array('descripcion'=>Input::get('descripcion'),
											 'departamento'=>$departamento->nombre,
											 'rubro'=>$departamento->descripcion,
											 'queja_id'=>$nueva_queja->id
																					), function($message) {
			   /*$message->to('elnazavalderrama@gmail.com')->subject('Notificacion de nueva queja');*/
			   $message->to('notificaciones@parquefuneralguadalupe.com.mx')->subject('Notificacion de nueva queja');
			});

		return Redirect::to('queja')->with('status', 'nueva');
	}			

}
