<?php
class ClienteControlador extends \ModuloControlador {

	public function __construct(){
		$this->data["module"] = "Cotización";
		$this->data["icon"] = "shopping-cart";
		$this->department = Auth::user()->departamento->nombre;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		Session::forget('productos');
		$this->data["module"] = "Datos del Cliente";
		$data["phones"] = TipoTelefono::all();
		$data["plans"] = PlanPago::all();
		$data["civil_status"] = EstadoCivil::all();
		$data["edit"] = false;
		return View::make($this->department.".main", $this->data)->nest('child', 'formularios.cliente', $data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		$persona = new Persona();
		$persona->nombres = Input::get('nombres');
		$persona->apellido_paterno = Input::get('apellido_paterno');
		$persona->apellido_materno = Input::get('apellido_materno');
		$persona->save();

		$cliente = new Cliente();
		$cliente->sexo = Input::get('sexo');
		$cliente->estado_civil_id = Input::get('estado_civil');
		$cliente->email = Input::get('email');
		$cliente->fecha_nacimiento = Input::get('fecha_nacimiento');
		$cliente->calle = Input::get('calle');
		$cliente->colonia_id = Input::get('colonia_id');
		$cliente->numero_exterior = Input::get('numero_exterior');
		$cliente->numero_interior = Input::get('numero_interior');
		$cliente->referencias = Input::get('referencias');
		$persona->cliente()->save($cliente);

		return Redirect::action('CotizacionControlador@getCreate', $persona->id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$this->data["module"] = "Datos del Cliente";
		$data["phones"] = TipoTelefono::all();
		$data["plans"] = PlanPago::all();
		$data["civil_status"] = EstadoCivil::all();
		$persona = Persona::with('cliente', 'cliente.colonia')->find($id);
		$data['persona'] = $persona;
		$data["cliente"] = $persona->cliente;
		$data["edit"] = true;
		return View::make($this->department.".main", $this->data)->nest('child', 'formularios.cliente', $data);

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate()
	{
		$persona = Persona::find(Input::get('persona_id'));
		$persona->nombres = Input::get('nombres');
		$persona->apellido_paterno = Input::get('apellido_paterno');
		$persona->apellido_materno = Input::get('apellido_materno');
		$persona->save();
		
		if(Input::has('cliente_id')){
			$cliente = Cliente::find(Input::get('cliente_id'));
		}else{
			$cliente = new Cliente();
		}

		$cliente->sexo = Input::get('sexo');
		$cliente->estado_civil_id = Input::get('estado_civil');
		$cliente->email = Input::get('email');
		$cliente->fecha_nacimiento = Input::get('fecha_nacimiento');
		$cliente->calle = Input::get('calle');
		$cliente->colonia_id = Input::get('colonia_id');
		$cliente->numero_exterior = Input::get('numero_exterior');
		$cliente->numero_interior = Input::get('numero_interior');
		$cliente->referencias = Input::get('referencias');
		$persona->cliente()->save($cliente);
		
		return Redirect::action('CotizacionControlador@getCreate', $persona->id);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	public function getAll() {			 

			$cliente = VistaClientes::select('id', (DB::raw("CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) as nombre")))->get();
			return Response::Json($cliente);
		}


}
