<?php 
use Carbon\Carbon;
	class ServicioFuneralControlador extends ModuloControlador{
		public $data = array();
		public $department;

		function __construct(){
			$this->data["module"] = "Servicios Funerales";

			$this->data["icon"] = "hospital-o";
			$this->department = Auth::user()->departamento->nombre;
		}
		

		public function getIndex(){	

		
		
		$servicios = VistaServicioFuneralCapilla::select('vista_servicio_funeral_capilla.*','venta_servicio_funeral.prevision','venta_servicio_funeral.servicio_realizado',
			'venta_servicio_funeral.prevision', 'venta_servicio_funeral.venta_producto_id as venta_producto_id','venta_servicio_funeral.cremacion',
		'contrato.folio','contrato.id as contrato_id','contrato.impresiones',DB::raw('IFNULL(vista_venta_abono.abono,0) as abono'))
		->leftJoin('venta_servicio_funeral','vista_servicio_funeral_capilla.venta_producto_id', '=', 'venta_servicio_funeral.venta_producto_id')
		->leftJoin('contrato', 'venta_servicio_funeral.contrato_id', '=', 'contrato.id')
		->leftJoin('vista_venta_abono', 'vista_servicio_funeral_capilla.id', '=', 'vista_venta_abono.venta_id' )->groupby('vista_servicio_funeral_capilla.id')
		->get();

		$total_pagado = Pago::select('recibo.venta_id as venta_id',DB::raw('SUM(pago.monto) as abono'))
			->leftJoin('recibo','pago.recibo_id', '=', 'recibo.id')
			->where('pago.cancelado',0)						
			->groupby('recibo.venta_id')->get();


		$dataModule["total_pagado"] =  $total_pagado;
		$dataModule["servicios"] =  $servicios;
		$dataModule['db'] = ConfiguracionGeneral::where('empresa_id', 1)->where('activo', 1)->firstorFail();		
		return View::make($this->department.".main", $this->data)->nest('child', $this->department.'.serviciocapilla', $dataModule);}
       
        public function getCreate(){
			$modal['title'] = 'Nuevo Servicio';
			$modal['button_cancel'] = 'Cancelar';
			$modal['button_ok'] = 'Agregar Servicio';
			$data['modal'] = $modal;
			return View::make('formularios.servicio', $data);
		}

		public function postStore(){
			return Response::json(array(
				"success" => false, 
				"messages" => array("El campo de Nombre es requerido", "El campo de apellido es requerido")
			));
		}

        public function getAll(){
        	$servicios = VistaServicioFuneral::select('id', 'nombre', 'precio_servicio', 'monto_comisionable', 'porcentaje_comision', DB::raw('CONCAT(nombre, " ","$", (round(precio_servicio * 1.16))) AS nombre_display'))->get();
			return Response::Json($servicios);
        }

        public function getRecibos($id){
			
			$recibos = Recibo::where('venta_id', '=', $id)->get();

			$recibo = Recibo::select('recibo.*', DB::raw('max(id) as maximo'))->where('cancelado',0)->where('pagado',0)->where('venta_id', $id)->firstorFail();
			/////////

			$pagado = Recibo::select('recibo.id as recibo_id',DB::raw('SUM(pago.monto) as abono'))
										->leftJoin('pago','recibo.id', '=', 'pago.recibo_id')
										->where('recibo.venta_id', $id)
										->where('pago.cancelado',0)
										->where('recibo.id',$recibo->id)->first();

			$total_pagado = Pago::select('pago.recibo_id as recibo_id',DB::raw('SUM(pago.monto) as abono'))
			->leftJoin('recibo','pago.recibo_id', '=', 'recibo.id')
			->where('pago.cancelado',0)
			->where('recibo.venta_id', $id )			
			->groupby('recibo.venta_id')->first();

			$venta = Venta::leftJoin('vista_clientes', 'venta.cliente_id', '=', 'vista_clientes.id')
						->leftJoin('plan_pago_venta', 'venta.id', '=', 'plan_pago_venta.venta_id')
						->leftJoin('plan_pago', 'plan_pago_venta.plan_pago_id', '=', 'plan_pago.id')
						->where('venta.id',$id)->firstorFail();
		

		if ($pagado != null) {
			$abonado_recibo = $pagado->abono;
		 }	else{
		 	$abonado_recibo = 0;
		 }
		$por_pagar = $recibo->monto - $abonado_recibo;

		$hoy = carbon::now(); 
		$date_recibo = Carbon::parse($recibo->fecha_limite);
			
         

           $h_y = $hoy->year;
           $h_m = $hoy->month;
           $h_d = $hoy->day;

           $d_y = $date_recibo->year;
           $d_m = $date_recibo->month;
           $d_d = $date_recibo->day;

          $today = Carbon::create($h_y, $h_m, $h_d);
          $d_recibo = Carbon::create($d_y, $d_m, $d_d);
  			
  		 $dias_atraso =  $d_recibo->diffInDays($today,false);
  		 $meses_atraso = $d_recibo->diffInMonths($today,false);

  		 $parcialidad = $por_pagar;
		 $numero_mensualidades = $venta->numero_pagos;
  		 
  		 $max_pendientes = $numero_mensualidades - $recibo->consecutivo;

  		 if ($parcialidad > 0 and $max_pendientes > $meses_atraso) {
				$pagos_completos = $meses_atraso;
				$resto = $parcialidad;
			}else{
				$pagos_completos = $max_pendientes;
				$resto = 0;
			}


			$abono_pendiente = ($recibo->monto * $pagos_completos ) + $parcialidad;
			////////		

			
			$saldo_venta = $venta->total - $total_pagado->abono;
			
			if ($recibos != null) {
				$dataModule["recibos"] = $recibos;
			}
			else{
				$dataModule["recibos"] = 0;
			}
			$dataModule['formas_pago'] = FormaPago::all();
			
			$dataModule['abono_pendiente'] = $abono_pendiente;
			$dataModule['dias_atraso'] = $dias_atraso;
			$dataModule['total_pagado'] = $total_pagado;
			$dataModule["saldo_venta"] = $saldo_venta;
			$dataModule["venta"] = $venta;
			$dataModule["abono_recibo"] = Recibo::select('recibo.id as recibo_id',DB::raw('SUM(pago.monto) as abono'))
										->leftJoin('pago','recibo.id', '=', 'pago.recibo_id')
										->where('recibo.venta_id', $id)
										->where('pago.cancelado',0)
										->groupby('recibo.id')->get();

			$dataModule['db'] = ConfiguracionGeneral::where('empresa_id', 1)->where('activo', 1)->firstorFail();		
			return View::make($this->department.".main", $this->data)->nest('child', $this->department.'.serviciorecibos', $dataModule);
	


	}
	}
 ?>