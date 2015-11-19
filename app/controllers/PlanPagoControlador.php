<?php 
	class PlanPagoControlador extends ModuloControlador{
		public $data = array();
		public $department;

		function __construct(){
			$this->data["module"] = "Planes de pago";			
			$this->data["icon"] = "money";			
			$this->department = Auth::user()->departamento->nombre;
		}		

		public function getIndex(){				
			$dataModule['plan_pago'] = PlanPago::orderby('created_at')->get();
									        	

			
			return View::make($this->department.".main", $this->data)->nest('child','sistemas.plan_pago',$dataModule);
        }
         public function postNuevoPlan(){

        	//validar formulario
			$rules = array(
					'descripcion' => 'required',
					'porcentaje_anticipo'=>'required|digits_between:0,100',
					'periodo'=>'required|numeric|integer',
					'numero_pagos'=>'required|numeric|integer',
					'interes_mensual'=>'required|numeric|integer'					
					
				);

				$messages = array(
						'required'=>'El campo :attribute es obligatorio',
						'digits_between' => 'Solo se aceptan valores del 0 al 100',
						'numeric'=>'Capture solo números',
						'max:13'=>'Maximo :max caracteres',
						'size'=>'Campo debe ser de :size caracteres',
						'integer'=>'solo se aceptan valores enteros'
					);

			$validator = Validator::make(Input::all(), $rules, $messages);
				if ($validator->fails())
				 { 
						
						return Redirect::back()->withInput()->withErrors($validator)->with('status', 'modificando')->with('tab', 'tab2');						
				}
        	$plan = new PlanPago;     	

        	$plan->descripcion = Input::get('descripcion');
  		 	$plan->porcentaje_anticipo = Input::get('porcentaje_anticipo');			
  		 	$plan->periodo = Input::get('periodo');
  		 	$plan->numero_pagos = Input::get('numero_pagos');
  		 	$plan->interes_mensual = Input::get('interes_mensual');

			$plan->save();
			return Redirect::to('configuracion-general/index#profile')->with('status', 'plan_created');


        }
        /**  estatus de plan de pago **/
        public function getAlta($id){

        	$plan = PlanPago::find($id);     	

        	$plan->activo = 1;

			$plan->save();
			return Redirect::back()->with('status', 'plan_alta');
		}

			public function getBaja($id){

        	$plan = PlanPago::find($id);     	

        	$plan->activo = 0;

			$plan->save();
			return Redirect::back()->with('status', 'plan_baja');

        }
        /** fin estatus plan de pago **/ 
	}
 ?>