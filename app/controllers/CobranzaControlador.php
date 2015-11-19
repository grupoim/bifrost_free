<?php 
class CobranzaControlador extends ModuloControlador{
	
	function __construct(){
		$this->data["module"] = "Cobranza";
		$this->data["icon"] = "money";
		$this->department = Auth::user()->departamento->nombre;
	}

	public function postMensajero(){
		$id = Input::get('recibo_id');
		$recibo = Recibo::find($id);
		$evento = new Evento();

		$client_id = '830870432482-po6o126nspi5d3iukgkn7ni6m0qpg5mq.apps.googleusercontent.com';
		$email_address = '830870432482-po6o126nspi5d3iukgkn7ni6m0qpg5mq@developer.gserviceaccount.com';
		$key_file_location = app_path('key/Bifrost-7c8d70841343.p12');

		$client = new Google_Client();
		$client->setApplicationName('Bifrost');
		$key = file_get_contents($key_file_location);

		$scopes = implode(' ', array(Google_Service_Calendar::CALENDAR));
		$cred = new Google_Auth_AssertionCredentials(
			$email_address,
			array($scopes),
			$key
			);
		$client->setAssertionCredentials($cred);
		if($client->getAuth()->isAccessTokenExpired()){
			$client->getAuth()->refreshTokenWithAssertion($cred);
		}

		$service = new Google_Service_Calendar($client);

		$event = new Google_Service_Calendar_Event(
			array(
				'summary' => 'Cobranza Programada',
				'location' => 'Domicilio del cliente',
				'description' => Input::get('detalles'),
				'start' => array(
					'date' => Input::get('fecha')
					),
				'end' => array(
					'date' => Input::get('fecha')
					)
				)
			);

		$createdEvent = $service->events->insert('hivbe3rp5ta2vm4tuq3qfqu4u8@group.calendar.google.com', $event);
		
		$evento->recibo_id = $id;
		$evento->evento = $createdEvent->getId();
		$recibo->mensajero = 1;
		$evento->save();
		$recibo->save();
		return Response::json(array('status', 'ok'));
	}

	public function getNoMensajero($id){

		$client_id = '830870432482-po6o126nspi5d3iukgkn7ni6m0qpg5mq.apps.googleusercontent.com';
		$email_address = '830870432482-po6o126nspi5d3iukgkn7ni6m0qpg5mq@developer.gserviceaccount.com';
		$key_file_location = app_path('key/Bifrost-7c8d70841343.p12');

		$client = new Google_Client();
		$client->setApplicationName('Bifrost');
		$key = file_get_contents($key_file_location);

		$scopes = implode(' ', array(Google_Service_Calendar::CALENDAR));
		$cred = new Google_Auth_AssertionCredentials(
			$email_address,
			array($scopes),
			$key
			);
		$client->setAssertionCredentials($cred);
		if($client->getAuth()->isAccessTokenExpired()){
			$client->getAuth()->refreshTokenWithAssertion($cred);
		}

		$evento = Evento::where('recibo_id', '=', $id)->firstOrFail();

		$service = new Google_Service_Calendar($client);
		$service->events->delete('hivbe3rp5ta2vm4tuq3qfqu4u8@group.calendar.google.com', $evento->evento);
		
		$evento->delete();

		$recibo = Recibo::find($id);
		$recibo->mensajero = 0;
		$recibo->save();

		return Redirect::back();
	}

	public function getIndex(){
		$dataModule["recibos"] = DB::table('recibo')
		->select(DB::raw("recibo.id, venta.folio_solicitud, CONCAT(persona.nombres, ' ', persona.apellido_paterno, ' ', persona.apellido_materno) AS cliente, recibo.id, recibo.venta_id, recibo.fecha_limite, recibo.monto, sum(COALESCE(pago.monto, 0)) as pagos, recibo.mensajero, recibo.created_at"))
		->leftJoin('pago', 'recibo.id', '=', 'pago.recibo_id')
		->leftJoin('venta', 'recibo.venta_id', '=', 'venta.id')
		->leftJoin('cliente', 'venta.cliente_id', '=', 'cliente.id')
		->leftJoin('persona', 'persona.id', '=', 'cliente.persona_id')
		->whereRaw('pago.cancelado IS NULL')
		->orWhere('pago.cancelado', '=', '0')
		->where('recibo.cancelado', '=', '0')
		->groupBy('recibo.id', 'pago.cancelado')
		->get();
		return View::make($this->department.".main", $this->data)->nest('child', $this->department.'.cobranza', $dataModule);
	}


	public function getEstadisticosmes(){			
		setlocale(LC_TIME, 'spanish');

		$mes=strftime("%B",mktime(0, 0, 0, date('m'), 1, 2000)); 

		/****** mensual *************/
		$monto_recibos_cobranza = Recibo::where( DB::raw('YEAR(fecha_limite)'), '=', date('Y') )
		->where( DB::raw('MONTH(fecha_limite)'), '=', date('m') )										
		->where('cancelado',0)
		->sum('monto');

		$monto_recibos_pagados = Recibo::where( DB::raw('YEAR(fecha_limite)'), '=', date('Y') )
		->where( DB::raw('MONTH(fecha_limite)'), '=', date('m') )									     
		->where('cancelado',0)
		->where('pagado',1)
		->sum('monto');

		$monto_recibos_pendientes_cobrar = $monto_recibos_cobranza - $monto_recibos_pagados;

		if ($monto_recibos_cobranza > 0)
			$porcentaje = ($monto_recibos_pagados *100)/$monto_recibos_cobranza;
		else 
			$porcentaje = 0;		

		return 
		Response::json(
			array(

				"esperado" => number_format($monto_recibos_cobranza, 2,".", ","),
				"cobrado" =>  number_format($monto_recibos_pagados, 2,".", ","),
				"pendiente" =>number_format($monto_recibos_pendientes_cobrar, 2,".", ","),
				"porcentaje" => number_format($porcentaje,2),
				"nombre" => Str::title($mes) 				  
				));
	}

	public function getEstadisticosdia(){			

		setlocale(LC_ALL, 'spanish');			
		$dia = strftime("%A");


		/*********diario **********/
		$monto_recibos_cobranza = Recibo::where( DB::raw('YEAR(fecha_limite)'), '=', date('Y') )
		->where( DB::raw('MONTH(fecha_limite)'), '=', date('m') )
		->where( DB::raw('DAY(fecha_limite)'), '=', date('d') )											
		->where('cancelado',0)
		->sum('monto');

		$monto_recibos_pagados = Recibo::where( DB::raw('YEAR(fecha_limite)'), '=', date('Y') )
		->where( DB::raw('MONTH(fecha_limite)'), '=', date('m') )
		->where( DB::raw('DAY(fecha_limite)'), '=', date('d') )											
		->where('cancelado',0)
		->where('pagado',1)
		->sum('monto');

		$monto_recibos_pendientes_cobrar = $monto_recibos_cobranza - $monto_recibos_pagados;
		if ($monto_recibos_cobranza > 0)
			$porcentaje = ($monto_recibos_pagados *100)/$monto_recibos_cobranza;
		else 
			$porcentaje = 0;

		return 
		Response::json(
			array(

				"esperado" => number_format($monto_recibos_cobranza, 2,".", ","),
				"cobrado" =>  number_format($monto_recibos_pagados, 2,".", ","),
				"pendiente" =>number_format($monto_recibos_pendientes_cobrar, 2,".", ","),
				"porcentaje" => number_format($porcentaje,2),
				"nombre" => Str::title($dia)
				));
	}
}
