<?php 
use Carbon\Carbon;
class ComisionControlador extends ModuloControlador{


	function __construct(){
		$this->data["module"] = "Comisiones";
		$this->data["icon"] = "money";
		$this->department = Auth::user()->departamento->nombre;
	}

	public function getIndex(){
		$total = VistaComision::where('cancelada', '0')->where('pagada',0)->sum('por_pagar');
		$dataModule["comisiones"] = VistaComision::orderBy('id','desc')->get();

		$dataModule["abonos"] = AbonoComision::leftJoin('periodo_comision', 'abono_comision.periodo_comision_id', '=', 'periodo_comision.id')->get();
		/*$dataModule["comisiones"] = Comision::with('asesor.persona', 'venta.cliente.persona','venta.ventaproducto.producto')->where('cancelada', 0)->where('pagada', 0)->get();*/
		$dataModule["total"] = number_format($total, 2, ".", ",");
		

		return View::make($this->department.".main", $this->data)->nest('child', $this->department.'.comision' , $dataModule);
	}

	public function getAbonos($id){
		$total = AbonoComision::where('periodo_comision_id',$id)->where('cancelado', 0)->sum('monto');
		
		$periodo = AbonoComision::where('periodo_comision_id',$id)->where('cancelado', 0)->first();

		$dataModule['comisiones_activas'] = VistaComision::where('cancelada',0)->where('pagada', 0)->get();

		$dataModule['asesores'] = VistaAsesorPromotor::where('activo',1)->get();


		$periodo_comision = PeriodoComision::find($periodo->periodo_comision_id);
		
		$dataModule['pendientes'] = AbonoComision::where('periodo_comision_id',$id)->where('cancelado', 0)->where('pagado',0)->count();				
		
		
		
		$dataModule["abonos"] = AbonoComision::select('abono_comision.id as abono_comision_id','vista_asesor_promotor.asesor as abono_asesor','abono_comision.periodo_comision_id',
			'abono_comision.monto as monto_abono', 'abono_comision.pagado as abono_pagado',
			'abono_comision.asesor_id as abono_asesor_id', 'abono_comision.periodo_comision_id as perdiodo_id',
			'periodo_comision.*', 'vista_comision.*'  )
		->where('abono_comision.periodo_comision_id','=',$id)
		->leftJoin('periodo_comision', 'abono_comision.periodo_comision_id', '=', 'periodo_comision.id')
		->leftJoin('vista_asesor_promotor', 'abono_comision.asesor_id', '=', 'vista_asesor_promotor.asesor_id')
		->leftJoin('vista_comision', 'abono_comision.comision_id', '=', 'vista_comision.id')->orderBy('vendedor')
		->get();
		/*$dataModule["comisiones"] = Comision::with('asesor.persona', 'venta.cliente.persona','venta.ventaproducto.producto')->where('cancelada', 0)->where('pagada', 0)->get();*/
		$dataModule["total"] = number_format($total, 2, ".", ",");
		$dataModule["periodo_comision"] = $periodo_comision;
		

		return View::make($this->department.".main", $this->data)->nest('child', 'administracion.abono_comision', $dataModule);
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
		->orderBy('abono_comision.comision_id','asc')
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
					  			 	case $pago_semanal <= $pago_regular and $diferencia_pagos <= 5 and $pagado == 0  and $pago_semanal >= $anticipo:
					  			 		$abono_comision = round($resto_comision, 2);
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


}/* ---------------FIN GUARDA REGISTROS------------*/
  				 

  				 /*---------ECHO ---------
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