<?php 
use Carbon\Carbon;
class ComisionControlador extends ModuloControlador{


	function __construct(){
		$this->data["module"] = "Comisiones";
		$this->data["icon"] = "money";
		$this->department = Auth::user()->departamento->nombre;
	}

	
	public function detalle($id)
	{
		
		return VistaComision::with('vistaabonocomisionperiodo')->find($id);

		
	}
	
	
	public function postWarning()
	{
		
		$comision = VistaComision::find(Input::get('venta_id'));
		

		if (Input::get('estatus') == "add") {

			$new_warning = new ComisionAdvertencia;
			$new_warning->motivos = Input::get('motivos');
			$new_warning->comision_id = $comision->id;
			$new_warning->activo = 1;
			$new_warning->save();

		}else{

			$warning_update = ComisionAdvertencia::find(Input::get('advertencia_id'));
			$warning_update->motivos = Input::get('motivos');
			$warning_update->activo = 0;
			$warning_update->save();
			
		}
		return Redirect::action('ComisionControlador@getIndex');

	}

	public function postAnticipo()
	{
		
		if(Input::get('anticipo_motivos'))
		{
			$motivos = Input::get('anticipo_motivos');	
		}	else{
			$motivos = "Pago en efectivo";
		}

		$comision = VistaComision::find(Input::get('venta_id'));
		

		

			$new_anticipo = new AnticipoComision;
			
			$new_anticipo->motivos = $motivos;
			$new_anticipo->comision_id = $comision->id;
			$new_anticipo->monto = input::get('anticipo_monto');
			$new_anticipo->fecha = Input::get('anticipo_fecha');
			$new_anticipo->folio = input::get('anticipo_folio');
			$new_anticipo->save();


		
		return Redirect::action('ComisionControlador@getPdfanticipo',$new_anticipo->id);

	}


	public function postEditcomision()
		{
		$comision = VistaComision::find(Input::get('venta_id'));
		$precio_producto = Precio::where('producto_id','=',Input::get('producto_id'))->firstorFail();
			//si el porentaje es igual al anterior, no hacer nada

		$comision_update = Comision::find($comision->id);

		if ($comision->porcentaje <> Input::get('porcentaje')) {
			//determina si el producto es de tipo servicio funeral para sacar el monto comisionable de ese producto
		
		$servicio = VistaServicioFuneral::find($comision->producto_id);
			if (count($servicio) > 0) {
				
				$serv = VistaServicioFuneral::where($servicio->producto_id);
				$total_comision = ($serv->monto_comisionable ) * (Input::get('porcentaje') / 100) ;
			}
			else
			{
				$total_comision = ($precio_producto->monto) * (Input::get('porcentaje') / 100);
			}
			$comision_update->porcentaje = Input::get('porcentaje');
			$comision_update->total = $total_comision;
			$comision_update->total_comisionable = $total_comision;

			if (($total_comision - $comision->pagado)<= 0) {
			 $comision_update->pagada  = 1;
			}
			}

		if ($comision->observaciones <> Input::get('observaciones_comision')) {
			# code...
			$comision_update->observaciones = Input::get('observaciones_comision');
		}
				
		$comision_update->save();
		return Redirect::back();
	}
	public function getPeriodos()

	{
		$dataModule['periodos'] = PeriodoComision::select('periodo_comision.id','periodo_comision.folio','periodo_comision.fecha_inicio', 'periodo_comision.fecha_fin',
		DB::raw('sum(abono_comision.monto)as total') )
		->leftJoin('abono_comision', 'periodo_comision.id','=', 'abono_comision.periodo_comision_id')
		->groupBy('abono_comision.periodo_comision_id')
		->orderBy('folio')->get();

		return View::make($this->department.".main", $this->data)->nest('child', 'administracion.periodos_comision', $dataModule);
	}

	public function getAnticipos()

	{
		$dataModule['anticipos'] = AnticipoComision::select('vista_comision.id', 'folio_solicitud',
			'producto', 'cliente', 'vista_comision.vendedor','vista_comision.total', 'anticipo_comision.monto as anticipo', 
			'anticipo_comision.created_at', 'anticipo_comision.fecha as fecha_venta', 'motivos', 
			'anticipo_comision.folio as folio_comision','anticipo_comision.id as anticipo_id')
		->leftJoin('vista_comision', 'anticipo_comision.comision_id', '=', 'vista_comision.id')		
		->get();

		return View::make($this->department.".main", $this->data)->nest('child', 'administracion.anticipos_comision', $dataModule);
	}


	public function getIndex(){

		$start = new Carbon('first day of this month');
		$finish = new Carbon('last day of this month');
		$year = new Carbon();

		$inicio =  $start->format('Y-m-d');
		$fin = $finish->format('Y-m-d');
		$dataModule['year'] = $year->format('Y');
		
		setlocale(LC_TIME, 'spanish');

		$dataModule['mes']= Str::title(strftime("%B",mktime(0, 0, 0, date('m'), 1, 2000)));
		$dataModule['db'] = ConfiguracionGeneral::where('empresa_id', 1)->where('activo', 1)->firstorFail();
		
		$fecha_fin = $finish->format('d-M-Y');
		$dataModule['fecha_fin'] = $fecha_fin;

		$dataModule['esquemas'] = EsquemaComision::where('activo',1)->get();

		$dataModule['promotorias'] = VistaAsesorPromotor::where('promotor','<>', 'Gerencia')->groupBy('vista_asesor_promotor.promotor')->get();

		

		$dataModule['porcentajes_comision'] = VistaAsesorPromotor::leftJoin('comision_esquema_vendedor', 'vista_asesor_promotor.asesor_id', '=', 'comision_esquema_vendedor.asesor_id')
										  	->leftJoin('esquema_comision', 'comision_esquema_vendedor.esquema_comision_id', '=', 'esquema_comision.id')
										   	->where('comision_esquema_vendedor.fecha_inicio','>=', $inicio)
										   	->where('comision_esquema_vendedor.fecha_fin', '<=', $fin)
										  	->groupBy('vista_asesor_promotor.promotor')->get();


		$total = VistaComision::where('cancelada', '0')->where('pagada',0)->sum('por_pagar');
		

		$date = Carbon::now();
		$endDate = $date->subYear();

		$dataModule["comisiones"] = VistaComision::where('cancelada', '0')->/*orderBy('vista_comision.id','desc')->*/get();

		$dataModule['ultimo_periodo_comision']= PeriodoComision::orderBy('id', 'desc')->first();



		/*$dataModule["abonos"] = AbonoComision::leftJoin('periodo_comision', 'abono_comision.periodo_comision_id', '=', 'periodo_comision.id')->get();*/
		/*->where('periodo_comision.fecha_inicio', '>', $endDate)	*/
		
		/*$dataModule["comisiones"] = Comision::with('asesor.persona', 'venta.cliente.persona','venta.ventaproducto.producto')->where('cancelada', 0)->where('pagada', 0)->get();*/
		$dataModule["total"] = number_format($total, 2, ".", ",");
		

		return View::make($this->department.".main", $this->data)->nest('child', $this->department.'.comision' , $dataModule);
	}

	
	public function getPdftotales($id){

     	$total = AbonoComision::where('periodo_comision_id',$id)->where('cancelado', 0)->sum('monto');

		$periodo = AbonoComision::where('periodo_comision_id',$id)->where('cancelado', 0)->first();
		

		$periodo_comision = PeriodoComision::find($periodo->periodo_comision_id);
		
		
		$anticipos_vendedor = AnticipoComision::select('anticipo_comision.*', 'vista_comision.*','vista_asesor_promotor.*',
											DB::raw('sum(anticipo_comision.monto) as total_anticipo'))	
											->where('anticipo_comision.folio',$periodo_comision->folio)
    										->leftJoin('vista_comision', 'anticipo_comision.comision_id', '=', 'vista_comision.id')
    										->leftJoin('vista_asesor_promotor', 'vista_comision.asesor_id','=', 'vista_asesor_promotor.asesor_id')
    										->groupBy('vista_comision.asesor_id')
    										->get(); 
    	

    	$total_anticipo = AnticipoComision::where('anticipo_comision.folio',$periodo_comision->folio)->sum('monto');
		
		$total_pagar = $total - $total_anticipo;


		$abonos = AbonoComision::select('abono_comision.id as abono_comision_id','vista_asesor_promotor.asesor as abono_asesor','abono_comision.periodo_comision_id',
			'abono_comision.monto as monto_abono', 'abono_comision.pagado as abono_pagado',
			'abono_comision.asesor_id as abono_asesor_id', 'abono_comision.periodo_comision_id as perdiodo_id','vista_asesor_promotor.promotor',
			'periodo_comision.*', 'vista_comision.*' , 'vista_comision.total as venta_total' )
		->where('abono_comision.periodo_comision_id','=',$id)
		->leftJoin('periodo_comision', 'abono_comision.periodo_comision_id', '=', 'periodo_comision.id')
		->leftJoin('vista_asesor_promotor', 'abono_comision.asesor_id', '=', 'vista_asesor_promotor.asesor_id')
		->leftJoin('vista_comision', 'abono_comision.comision_id', '=', 'vista_comision.id')->orderBy('vista_asesor_promotor.asesor','asc')		
		->get();	
	
		/*$total_vendedorrr = AbonoComision::select('vista_asesor_promotor.asesor as asesor',
			DB::raw('sum(abono_comision.monto) as total'), 'vista_asesor_promotor.promotor as promotor',
			'abono_comision.asesor_id as abono_asesor_id'
			)
		->where('abono_comision.periodo_comision_id','=',$id)
		->leftJoin('periodo_comision', 'abono_comision.periodo_comision_id', '=', 'periodo_comision.id')
		->leftJoin('vista_asesor_promotor', 'abono_comision.asesor_id', '=', 'vista_asesor_promotor.asesor_id')
		->leftJoin('vista_comision', 'abono_comision.comision_id', '=', 'vista_comision.id')		
		->groupBy('vista_comision.asesor_id')
		->get();*/

		$promotoria_total = AbonoComision::select('vista_asesor_promotor.promotor as promotor',
			DB::raw('sum(abono_comision.monto) as total_promotoria'))
		->where('abono_comision.periodo_comision_id','=',$id)		
		->leftJoin('vista_asesor_promotor', 'abono_comision.asesor_id', '=', 'vista_asesor_promotor.asesor_id')		
		->groupBy('vista_asesor_promotor.promotor')
		->get();


		$promotoria = AbonoComision::select('vista_asesor_promotor.promotor as promotor',		  
		  DB::raw('sum(abono_comision.monto) as subtotal'),
		  DB::raw('ifnull(total_anticipo,0) as total_anticipo'),
		  DB::raw('(sum(abono_comision.monto) - (ifnull(total_anticipo,0))) as total'))
		  ->leftJoin('periodo_comision', 'abono_comision.periodo_comision_id', '=', 'periodo_comision.id')
		  ->leftJoin('vista_asesor_promotor', 'abono_comision.asesor_id', '=', 'vista_asesor_promotor.asesor_id')
		  
		  ->leftJoin(DB::raw('(select vista_comision.venta_id, anticipo_comision.folio, vista_asesor_promotor.*, sum(anticipo_comision.monto) as total_anticipo
				    from anticipo_comision
				    left join vista_comision on anticipo_comision.comision_id = vista_comision.id
				    left join vista_asesor_promotor on vista_comision.asesor_id =  vista_asesor_promotor.asesor_id     
				     where anticipo_comision.folio =' .$periodo_comision->folio.
				     ' group By vista_asesor_promotor.promotor) as  anticipo ' ),'vista_asesor_promotor.promotor', '=','anticipo.promotor')

		  ->where('abono_comision.periodo_comision_id','=', $periodo_comision->id)
		  ->groupBy('vista_asesor_promotor.promotor')->get();


		$total_vendedor = AbonoComision::select('vista_asesor_promotor.asesor as asesor', 'vista_asesor_promotor.promotor as promotor',
		 'abono_comision.asesor_id as abono_asesor_id', 
		  DB::raw('sum(abono_comision.monto) as subtotal'),
		  DB::raw('ifnull(total_anticipo,0) as total_anticipo'),
		  DB::raw('(sum(abono_comision.monto) - (ifnull(total_anticipo,0))) as total'))
		  ->leftJoin('periodo_comision', 'abono_comision.periodo_comision_id', '=', 'periodo_comision.id')
		  ->leftJoin('vista_asesor_promotor', 'abono_comision.asesor_id', '=', 'vista_asesor_promotor.asesor_id')
		  ->leftJoin('vista_comision', 'abono_comision.comision_id', '=', 'vista_comision.id')
		  ->leftJoin(DB::raw('(select vista_comision.venta_id, anticipo_comision.folio, vista_asesor_promotor.*, sum(anticipo_comision.monto) as total_anticipo
				    from anticipo_comision
				    left join vista_comision on anticipo_comision.comision_id = vista_comision.id
				    left join vista_asesor_promotor on vista_comision.asesor_id =  vista_asesor_promotor.asesor_id     
				     where anticipo_comision.folio =' .$periodo_comision->folio.
				     ' group By vista_comision.asesor_id) as  anticipo ' ),'vista_asesor_promotor.asesor_id', '=','anticipo.asesor_id')

		  ->where('abono_comision.periodo_comision_id','=', $periodo_comision->id)
		  ->groupBy('vista_comision.asesor_id')->get();

		 
		
		
		$data['anticipos_vendedor'] = $anticipos_vendedor;
		$data['promotoria_total'] = $promotoria_total;
		$data['total'] = $total;
		$data['total_s_anticipos'] = $total_pagar;
		$data['periodo'] = $periodo_comision;
		$data['totales_vendedores'] = $total_vendedor;
		$data['promotorias'] = $promotoria;
		$data['abonos'] = $abonos;

     $pdf = DOPDF::loadView('formularios.totales_comisiones_pdf',$data)->setPaper('letter', 'landscape');
      	$dom_pdf = $pdf->getDomPDF();
		$pdf->output();
		$canvas = $dom_pdf ->get_canvas();
		$canvas->page_text(700, 600, " {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
      return $pdf->stream();




    }

    public function getPdfanticipo($id){

     	
    	$detalle_anticipo = AnticipoComision::where('anticipo_comision.id',$id)
    										->leftJoin('vista_comision', 'anticipo_comision.comision_id', '=', 'vista_comision.id')
    										->leftJoin('vista_asesor_promotor', 'vista_comision.asesor_id','=', 'vista_asesor_promotor.asesor_id')
    										->firstorFail();

    	$total_count = AbonoComision::where('comision_id', '=', $detalle_anticipo->comision_id)->where('pagado', 1)->count();
    	
    	if ($total_count > 0 ) {
    		$total_pagado = AbonoComision::where('comision_id', '=', $detalle_anticipo->comision_id)->where('pagado', 1)->sum('monto');

    	}else{
    		$total_pagado = 0;
    	}
    	
    	

    	$pagado = $detalle_anticipo->monto + $total_pagado;
    

    	$data['detalle_anticipo'] = $detalle_anticipo;
    	$data['pagado'] = $pagado;

				

    	$pdf = DOPDF::loadView('formularios.anticipo_comision_pdf',$data)->setPaper('letter');
      	$dom_pdf = $pdf->getDomPDF();
		$pdf->output();
		$canvas = $dom_pdf ->get_canvas();
		$canvas->page_text(700, 600, " {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
      return $pdf->stream();


    }

	public function getAbonos($id){
		
		$total = AbonoComision::where('periodo_comision_id',$id)->where('cancelado', 0)->sum('monto');

	
		$periodo = AbonoComision::where('periodo_comision_id',$id)->where('cancelado', 0)->first();

		$dataModule['comisiones_activas'] = VistaComision::where('cancelada',0)->where('pagada', 0)->get();

		$dataModule['asesores'] = VistaAsesorPromotor::where('activo',1)->get();		


		$periodo_comision = PeriodoComision::find($periodo->periodo_comision_id);
		
		$dataModule['pendientes'] = AbonoComision::where('periodo_comision_id',$id)->where('cancelado', 0)->where('pagado',0)->count();				
		
		
		$abonos = AbonoComision::select('abono_comision.id as abono_comision_id','vista_asesor_promotor.asesor as abono_asesor','abono_comision.periodo_comision_id',
			'abono_comision.monto as monto_abono', 'abono_comision.pagado as abono_pagado','vista_asesor_promotor.promotor',
			'abono_comision.asesor_id as abono_asesor_id', 'abono_comision.periodo_comision_id as perdiodo_id',
			'periodo_comision.*', 'vista_comision.*'  )
		->where('abono_comision.periodo_comision_id','=',$id)
		->leftJoin('periodo_comision', 'abono_comision.periodo_comision_id', '=', 'periodo_comision.id')
		->leftJoin('vista_asesor_promotor', 'abono_comision.asesor_id', '=', 'vista_asesor_promotor.asesor_id')
		->leftJoin('vista_comision', 'abono_comision.comision_id', '=', 'vista_comision.id')->orderBy('vista_comision.id','asc')		
		->get();

	
		$total_vendedor = AbonoComision::select('vista_asesor_promotor.asesor as asesor',
			DB::raw('sum(abono_comision.monto) as total'),
			'abono_comision.asesor_id as abono_asesor_id'
			)
		->where('abono_comision.periodo_comision_id','=',$id)
		->leftJoin('periodo_comision', 'abono_comision.periodo_comision_id', '=', 'periodo_comision.id')
		->leftJoin('vista_asesor_promotor', 'abono_comision.asesor_id', '=', 'vista_asesor_promotor.asesor_id')
		->leftJoin('vista_comision', 'abono_comision.comision_id', '=', 'vista_comision.id')		
		->groupBy('vista_comision.asesor_id')
		->get();

		
		$promotorias = AbonoComision::select('vista_asesor_promotor.promotor as promotor',
			DB::raw('sum(abono_comision.monto) as total_promotoria'))
		->where('abono_comision.periodo_comision_id','=',$id)		
		->leftJoin('vista_asesor_promotor', 'abono_comision.asesor_id', '=', 'vista_asesor_promotor.asesor_id')		
		->groupBy('vista_asesor_promotor.promotor')
		->get();

		$dataModule['promotorias'] = $promotorias;

		$dataModule['advertencias'] = ComisionAdvertencia::where('comision_advertencia.activo',1)
		->get();

		$dataModule["totales_vendedores"] = $total_vendedor;
		$dataModule["abonos"] = $abonos;
		/*$dataModule["comisiones"] = Comision::with('asesor.persona', 'venta.cliente.persona','venta.ventaproducto.producto')->where('cancelada', 0)->where('pagada', 0)->get();*/
		$dataModule["total"] = number_format($total, 2, ".", ",");
		$dataModule["periodo_comision"] = $periodo_comision;
		

		return View::make($this->department.".main", $this->data)->nest('child', 'administracion.abono_comision', $dataModule);
	}

	public function postSend(){
		
		
		$periodo_comision_id = Input::get('periodo_comision_id');
		
		$promotoria = Input::get('promotoria');

		$independiente = Input::get('independiente');
		
		$periodo_comision = PeriodoComision::find($periodo_comision_id);

		$vendedores = AbonoComision::where('periodo_comision_id','=',$periodo_comision_id)
		->leftJoin('vista_asesor_promotor', 'abono_comision.asesor_id', '=', 'vista_asesor_promotor.asesor_id')
		->groupBy('abono_comision.asesor_id')
		->get();

		//vendedores dentro de la promotoria
		if ( $independiente == 0 ) {
		

		$abonos = AbonoComision::select('abono_comision.id as abono_comision_id','vista_asesor_promotor.asesor as abono_asesor','abono_comision.periodo_comision_id',
			'abono_comision.monto as monto_abono', 'abono_comision.pagado as abono_pagado','vista_asesor_promotor.promotor',
			'abono_comision.asesor_id as abono_asesor_id', 'abono_comision.periodo_comision_id as perdiodo_id',
			'periodo_comision.*', 'vista_comision.*')
		->where('abono_comision.periodo_comision_id','=',$periodo_comision_id)
		->where('vista_asesor_promotor.promotor','=',$promotoria)
		->leftJoin('periodo_comision', 'abono_comision.periodo_comision_id', '=', 'periodo_comision.id')
		->leftJoin('vista_asesor_promotor', 'abono_comision.asesor_id', '=', 'vista_asesor_promotor.asesor_id')
		->leftJoin('vista_comision', 'abono_comision.comision_id', '=', 'vista_comision.id')->orderBy('vista_comision.id','asc')		
		->get();

	
		$total = AbonoComision::
		where('abono_comision.periodo_comision_id','=',$periodo_comision_id)
		->leftJoin('vista_asesor_promotor', 'abono_comision.asesor_id', '=', 'vista_asesor_promotor.asesor_id')
		->where('vista_asesor_promotor.promotor','=',$promotoria)->where('abono_comision.cancelado', 0)->sum('monto');
		

		//enviar mail de confirmacion
					Mail::send('emails.mail_abonos_comision', array(
											'abonos'=>$abonos,
											 'periodo'=>$periodo_comision,
											 'total' => $total,
											 'promotor'=>Input::get('promotoria'),
											 
																					), function($message) {
			   
		$promotoria = Input::get('promotoria');

		$count_promotor = VistaPromotores::where('Promotor','=',$promotoria)->count();

		if ( $count_promotor == 1 ) {
			$email_promotoria = VistaPromotores::where('Promotor','=',$promotoria)->firstorFail();
		}
			    $message->to($email_promotoria->email)->subject('Comisiones de la semana PFG');
			  /* $message->to('notificaciones@parquefuneralguadalupe.com.mx')->subject('Nuevo seguimiento de queja');*/
			});

					//fin mail confirmación promotoria
			
		}
//vendedores independientes
		elseif($independiente == 1 and $promotoria == "Independiente"){

			//vendedores dentro de una promotoria	

			foreach ($vendedores as $vendedor) {
				//si el vendedor tiene email se le envia correo de comisiones si no no
				if ($vendedor->promotor == "Independiente" and $vendedor->email) {
		

		$abonos = AbonoComision::select('abono_comision.id as abono_comision_id','vista_asesor_promotor.asesor as abono_asesor','abono_comision.periodo_comision_id',
			'abono_comision.monto as monto_abono', 'abono_comision.pagado as abono_pagado','vista_asesor_promotor.promotor',
			'abono_comision.asesor_id as abono_asesor_id', 'abono_comision.periodo_comision_id as perdiodo_id',
			'periodo_comision.*', 'vista_comision.*')
		->where('abono_comision.periodo_comision_id','=',$periodo_comision_id)
		->where('vista_asesor_promotor.asesor_id','=',$vendedor->asesor_id)		
		->leftJoin('periodo_comision', 'abono_comision.periodo_comision_id', '=', 'periodo_comision.id')
		->leftJoin('vista_asesor_promotor', 'abono_comision.asesor_id', '=', 'vista_asesor_promotor.asesor_id')
		->leftJoin('vista_comision', 'abono_comision.comision_id', '=', 'vista_comision.id')->orderBy('vista_comision.id','asc')		
		->get();

		$total = AbonoComision::
		where('abono_comision.periodo_comision_id','=',$periodo_comision_id)
		->leftJoin('vista_asesor_promotor', 'abono_comision.asesor_id', '=', 'vista_asesor_promotor.asesor_id')
		->where('vista_asesor_promotor.asesor_id','=',$vendedor->asesor_id)
		->where('cancelado', 0)->sum('monto');
				
		//enviar mail de confirmacion
					Mail::send('emails.mail_abonos_comision', array(
											'abonos'=>$abonos,
											 'periodo'=>$periodo_comision,
											 'total' => $total,
											 'promotor'=>Input::get('promotoria'),
											 
																					), function($message) use ($vendedor) {
			   
			    	 
			    	 $message->to($vendedor->email)->subject('Comisiones de la semana PFG');# code...
			   
			   
			  /* $message->to('notificaciones@parquefuneralguadalupe.com.mx')->subject('Comisiones de la semana');*/
			});


		}

			}



		}// fin vendedores independientes
		
		
	

		return Redirect::back();
	}


	public function postPorcentaje(){

		$promotor = Input::get('promotor');
		$esquema_comision_id = Input::get('esquema_comision_id');
		$vendedores = VistaAsesorPromotor::where('promotor',$promotor)->get();

		$start = new Carbon('first day of this month');
		$finish = new Carbon('last day of this month');
		$inicio =  $start->format('Y-m-d');
		$fin = $finish->format('Y-m-d');
		
		foreach ($vendedores as $vendedor) {

			$porcentaje_comision = new ComisionEsquemaVendedor();

			$porcentaje_comision->esquema_comision_id = $esquema_comision_id;
			$porcentaje_comision->asesor_id = $vendedor->asesor_id;
			$porcentaje_comision->fecha_inicio = $inicio;
			$porcentaje_comision->fecha_fin = $fin;
			$porcentaje_comision->save();
		}
		return Redirect::back();

	}

	public function getDownload($id){

$ultimo_id = AbonoComision::orderBy('id', 'desc')->first();

$ultimo = $ultimo_id->id;

$abonos= AbonoComision::select('abono_comision.id as abono_comision_id','abono_comision.periodo_comision_id',
			'abono_comision.monto as monto_abono', 'abono_comision.pagado as abono_pagado',
			'abono_comision.asesor_id as abono_asesor', 'abono_comision.periodo_comision_id as perdiodo_id',
			'periodo_comision.*', 'vista_comision.*'  )
		->where('abono_comision.periodo_comision_id','=',$id)
		->leftJoin('periodo_comision', 'abono_comision.periodo_comision_id', '=', 'periodo_comision.id')
		->leftJoin('vista_comision', 'abono_comision.comision_id', '=', 'vista_comision.id')->orderBy('vendedor')
		->orderBy('abono_comision_id','asc')
		->get();
foreach ($abonos as $abono) {

	switch($abono->nombre_corto){
	case $abono->nombre_corto == "R":
				$tipo_venta = "'REC'";
				break;
			case $abono->nombre_corto == "V":
				$tipo_venta = "'CON'";				
				break;
			case $abono->nombre_corto = "O":
				$tipo_venta = "'SER'";
				break;
			default:
 				$tipo_venta = "'CON'";
 				break;
 			}

 		$observaciones = "'".round(($abono->pagado * $abono->numero_pagos)/$abono->total_comisionable).' de '. $abono->numero_pagos."'";


	echo 'Insert into det_comision(pk_det_comision,pk_comision,clave_pk,tipo_pk,importe,pk_vendedor,porc_comision,observaciones) values('.$abono->abono_comision_id.','.$abono->periodo_comision_id.','.$abono->id.','.$tipo_venta.','
		.$abono->monto_abono.','.$abono->abono_asesor.','.$abono->porcentaje.','.$observaciones.');'.'<br>';
}




	}



	public function getAll(){
		$comisiones = VistaComision::all();
		return Response::Json($comisiones);
	}

	
	public function postAddabono(){

     
//validar formulario
			$rules = array(
					'monto' => 'required',
					'asesor_id' => 'required',
					'comision_id'=> 'required'				
					
				);
				$messages = array(
						'required'=>'Campo Obligatorio.'
						
					);
			$validator = Validator::make(Input::all(), $rules, $messages);
				if ($validator->fails())
				 { 
						
						return Redirect::back()->withInput()->withErrors($validator);						
				}
     $date = Carbon::now();

     $abono = new AbonoComision();

     $abono->periodo_comision_id = Input::get('periodo_comision_id');
     $abono->comision_id = Input::get('comision_id');
     $abono->monto = Input::get('monto');
     $abono->asesor_id = Input::get('asesor_id');
     $abono->save();
     return Redirect::back();

	}
	public function postAbono(){
		
		$abono_periodo = AbonoComision::find(Input::get('abono_comision_id'));

		//si hay una modificacion en el monto se guarda
		//if (Input::get('abono_comision' <> $abono_comision->monto)) {
			$abono_periodo->monto = Input::get('abono_comision');
		//}
		$abono_periodo->pagado = 1;
		$abono_periodo->save();

		//actualiza a pagado los que en la vista tengan menos o igual a $3 en el campo por pagar
	
		$abono_comision_id = Input::get('comision_id');
		$actualiza_comision = VistaComision::find($abono_comision_id);
	
	if($actualiza_comision->por_pagar <= 3){
		$comision = Comision::find($abono_comision_id);
					$comision->pagada = 1;
					$comision->save();

	}else{
		$comision = Comision::find($abono_comision_id);
					$comision->pagada = 0;
					$comision->save();

	}

return Redirect::back();

	}

	public function getDeleteabono($id){

		

		$abono = AbonoComision::find($id);
		$abono->delete();


		$comision = VistaComision::find($abono->comision_id);

		if ($comision->por_pagar >= 12) {
			$comision_actualiza = Comision::find($comision->id );
			$comision_actualiza->pagada = 0;
			$comision_actualiza->save();
		}

		

		

		return Redirect::back();
		


	}

	public function postArchivo(){
	
	
	//upload del archivo
	$file = Input::file("archivo");
	if(Input::hasFile('archivo')) {
		
		$file->move("public/excel",$file->getClientOriginalName());	
	}

 Excel::load('public/excel/'.$file->getClientOriginalName(), function($archivo)
  {
   	$resultados = $archivo->get();
   	Cache::flush();
 	$comisiones = VistaComision::where('pagada',0)->where('cancelada',0)->OrderBy('id')->get();
 		
  	  	
  	$fecha_fin = new Carbon('last sunday');

  	$date = new Carbon('last sunday');
  	  	
  	$fecha_inicio = $date->subDays(6);

  	//cuento cuantos periodos hay con las mismas fechas de inicio y fin, para determinar si debo crear uno nuevo
  	$ultimo_periodo_comision = PeriodoComision::orderBy('id', 'desc')->first();
  	$periodo_comision_count = PeriodoComision::where('fecha_inicio','=',$fecha_inicio)->where('fecha_fin','=',$fecha_fin)->count();
    
    if ($periodo_comision_count == 0) {

    	$new_periodo = new PeriodoComision();
    	$new_periodo->fecha_inicio = $fecha_inicio;
    	$new_periodo->fecha_fin = $fecha_fin;
    	$new_periodo->folio = $ultimo_periodo_comision->folio + 1;
    	$new_periodo->save();

    	$periodo_actual = $new_periodo;
    }else{
    	$periodo_actual = $ultimo_periodo_comision;
    }
   

//estas son las que se pagan
 	foreach ($comisiones as $comision_r => $comision) {	
  			
  			foreach($resultados as $resultado => $excel)
  			if ($excel->pkc == $comision->id) {
  				
  				$plan_pago = PlanPagoVenta::select('plan_pago_venta.*','plan_pago.porcentaje_anticipo')
  				->leftJoin('plan_pago', 'plan_pago_venta.plan_pago_id', '=', 'plan_pago.id')
  				->where('venta_id', '=', $comision->id)->where('plan_pago_venta.activo',1)->firstorFail();
  				
  				$venta = VistaComision::find($comision->id);



  				//lo que al vendedor se le ha dado de esa comisión
  				$pagado = $venta->pagado;

  				$tipo_venta = $venta->nombre_corto;

 				$porcentaje_anticipo = $plan_pago->porcentaje_anticipo; 				
  					

 				switch ($porcentaje_anticipo) {
 					case 0:
 						$porcentaje = .30;
 						break;

 					case $porcentaje_anticipo <= 30:
 						$porcentaje = .30;
 						break;	
 					
 					case $porcentaje_anticipo == 0 and $plan_pago->numero_pagos ==2:
 						$porcentaje = .50;
 						break;
 					default:
 						$porcentaje = $porcentaje_anticipo/100;
 						break;
 				}


  				$anticipo = intval($venta->total * $porcentaje);  				

  				//lo que el cliente debe de dar mensualmente
  				$pago_regular = $plan_pago->pago_regular;
  				
  				//calcula pago de comision por pago regular
  				$comision_mensual = $comision->total_comisionable / $comision->numero_pagos;
  				
  				//lo que el cliente pagó en los recibos de la semana
  				$pago_semanal = $excel->importe;

  				

  				if($tipo_venta == "V"){
  				//aplica regla de 3 para pagos superiores al pago regular solo ventas de contrato
  				$comision_semanal = ($pago_semanal * $comision_mensual) / $pago_regular;
  			}else{
  				$comision_semanal = $comision_mensual;
  			}
  				
  				

  				$diferencia_pagos = $pago_regular - $pago_semanal;

  				$resto_comision = $comision->por_pagar;

  	if ($resto_comision > 0 ) { /*---------CONTRATOS----------*/
  					
					  			switch ($pago_semanal) {
					  			 	case (($pago_semanal < $pago_regular and $diferencia_pagos >= 5) or ($pagado == 0 and $pago_semanal < $anticipo and $diferencia_pagos >= 5)):
					  			 		$abono_comision = 0;
					  			 		break;

					  			 	case $pago_semanal >= $anticipo and $tipo_venta == "V":					  			 		
					  			 		$abono_comision = round($resto_comision, 2);
					  			 		break;
					  			 	case $comision_semanal + $pagado > $resto_comision and $resto_comision < $comision_mensual:
					  			 		$abono_comision =  round($resto_comision, 2);
					  			 		break;
					  			 	case $comision_semanal >=$resto_comision and $pago_semanal > $pago_regular :
					  			 		$abono_comision = round($resto_comision, 2);
					  			 		break;
					  			 	case $pago_semanal <= $pago_regular and $diferencia_pagos <= 5 and $pagado == 0  and $pago_semanal >= $anticipo and $resto_comision < $comision_mensual:
					  			 		$abono_comision = round($resto_comision, 2);
					  			 		break;	
					  			 	case $comision_semanal >=$resto_comision and $pago_semanal >= $pago_regular and $pagado == 0 :
					  			 		$abono_comision = round($resto_comision, 2);
					  			 		break;
					  			 	case $pago_semanal == $pago_regular and $pagado == 0:
					  			 		$abono_comision = round($comision_semanal, 2);
					  			 		break;				  			 	
					  			 	
					  			 	
					  			 	default:
					  			 		$abono_comision = round($comision_semanal, 2);
					  			 		
					  			 		break;
					  			 } /*---------FIN CONTRATOS----------*/

			  				}


			  				else{
  								$abono_comision = 'ya pagado';
  								 }

  				
  								 if ($comision->pagado > 0 ) {
  								 	$pagados = ( ($comision->pagado + $abono_comision) * $comision->numero_pagos ) / $comision->total_comisionable;# code...
  								 }else{
  								 	$pagados = 1;
  								 }
  				
  				
  				

  				$meses_pagados = round($pagados,0,PHP_ROUND_HALF_UP);
  				
  				$observaciones =  $meses_pagados.' de '.$comision->numero_pagos; 

  								

/*--------GUARDA REGISTROS-------------*/
//determina si el abono cae entre las fechas de inicio y fin de cuando se creó la lista de comisiones, para evitar duplicar el pago al volver a subir el mismo archivo
if($excel->pago->between($fecha_inicio, $fecha_fin) == 1){
//aqui se van a crear los abonos
	$abono_count = AbonoComision::where('periodo_comision_id','=', $periodo_actual->id)->where('comision_id','=',$excel->pkc)->count();

	if ($abono_count == 0) {
		//guarda el pago

	$new_abono = new AbonoComision();	
	$new_abono->periodo_comision_id = $ultimo_periodo_comision->id + 1;
	$new_abono->comision_id = $excel->pkc;
	$new_abono->monto = $abono_comision;
	$new_abono->fecha = $fecha_fin->toDateString();
	$new_abono->asesor_id = $excel->pk_vendedor;
	$new_abono->save();		
	}


}/*---------------FIN GUARDA REGISTROS------------*/
  				 

  				 /*---------ECHO ---------*/
  				/*echo $excel->pago->between($fecha_inicio, $fecha_fin)','.$comision->asesor_id.','.$comision->porcentaje.','.$observaciones.'<br>';*/
  				/*echo $excel->pkc.'---'. $abono_comision.'<br>';/*.' pago regular '.$plan_pago->pago_regular.' recibo '.
  				$excel->importe.'pago mensual = '.$pago_mensual..' --- '.$observaciones.' ---% '.$comision->porcentaje.' -- '.$abono_comision/*' por pagar '.$comision->por_pagar.'<br>' */
  				/*--------FIN ECHO ---------*/
  			

  			} 			 			
				} 

				/*foreach($resultados as $resultado => $excel){
  			if ($excel->compra >= $fecha_inicio) {

  				$excel->pkc. 'nueva'.'<br>';
  			}
  				}*/
 
  })->all();


	$ultimo_periodo_comision = PeriodoComision::orderBy('id', 'desc')->first();
	return Redirect::action('ComisionControlador@getAbonos',$ultimo_periodo_comision->id);
	

	}

	public function getPago() {

			
			$count_abonos = AbonoComision::get();
			return Response::json($count_abonos);

	}

	public function getPagada($id) {

			$comision = Comision::find($id);
					$comision->pagada = "1";
					$comision->save();
					return Redirect::back();


	}

	public function getCreate(){
			$modal['title'] = 'Nuevo Lote funerario';
			$modal['button_cancel'] = 'Cancelar';
			$modal['button_ok'] = 'Agregar lote';
			$data['modal'] = $modal;
			return View::make('formularios.pago_comision', $data);
		}

		public function postStore(){
			return Response::json(array(
				"success" => false, 
				"messages" => array("El campo de Nombre es requerido", "El campo de apellido es requerido")
			));
		}
}