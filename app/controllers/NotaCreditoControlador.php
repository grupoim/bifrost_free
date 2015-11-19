<?php 
	class NotaCreditoControlador extends ModuloControlador{
		public $data = array();
		public $department;

		function __construct(){
			$this->data["module"] = "Notas de Crédito";			
			$this->data["icon"] = "ticket";			
			$this->department = Auth::user()->departamento->nombre;
		}		

		public function getIndex(){							
			$dataModule['nota_credito'] = Cupon::all();
										        	

			
			return View::make($this->department.".main", $this->data)->nest('child','sistemas.nota_credito',$dataModule);
        }

        public function postNueva(){

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
			return Redirect::back()->with('status', 'plan_created')->with('tab', 'tab2');
        }

        /**  estatus de Nota de crédito **/
        public function getAlta($id){

        	$nota_credito = Cupon::find($id);     	

        	$nota_credito->activo = 1;

			$nota_credito->save();
			return Redirect::back()->with('status', 'cupon_alta');
		}

			public function getBaja($id){

        	$nota_credito = Cupon::find($id);     	

        	$nota_credito->activo = 0;

			$nota_credito->save();
			return Redirect::back()->with('status', 'cupon_baja');

        }
        /** fin estatus plan de pago **/ 
	}
 ?>