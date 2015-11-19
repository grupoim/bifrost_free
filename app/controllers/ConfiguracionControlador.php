<?php 
	class ConfiguracionControlador extends ModuloControlador{
		public $data = array();
		public $department;

		function __construct(){
			$this->data["module"] = "Configuraciones Generales";			
			$this->data["icon"] = "cog";			
			$this->department = Auth::user()->departamento->nombre;
		}		

		public function getIndex(){				
			$dataModule['empresa'] = Empresa::where('activa',1)->get();
			$dataModule['plan_pago'] = PlanPago::orderby('created_at')->get();
			$dataModule['nota_credito'] = Cupon::all();
			$dataModule['productos'] = Producto::where('activo',1)->get();			
			$dataModule['departamentos'] = Departamento::all();


			
			return View::make($this->department.".main", $this->data)->nest('child','sistemas.main_configuracion',$dataModule);
        }
        public function postEditEmpresa(){

        	//validar formulario
			$rules = array(
					'nombre' => 'required',
					'razon_social'=>'required',
					'domicilio'=>'required',
					'rfc'=>'required|max:13|min:12',
					'telefono'=>'required',
					'cp'=>'required|numeric',
					'logo'=>'image|mimes:jpeg,bmp,png'
					
				);

				$messages = array(
						'required'=>'El campo :attribute es obligatorio',						
						'numeric'=>'Capture solo números',
						'max'=>'Capture máximo :max caracteres',
						'min'=>'Capture minimo :min caracteres',
						'image'=>'Solo se aceptan imagenes jpeg, png, bmp o gif',
						'size'=>'el :attribute debe ser de :size numeros'
						
					);

			$validator = Validator::make(Input::all(), $rules, $messages);
				if ($validator->fails())
				 { 
						
						
						return Redirect::back()->withInput()->withErrors($validator)->with('registro', 'modificando')->with('tab', 'tab1');						
				
			}

			
				//al pasar la validacion se procede a guardar campos
        	$id = Input::get('id');

        	$empresa = Empresa::find($id);        	
        	$file = Input::file('logo');
  		 	$empresa->nombre = Input::get('nombre');
  		 	$empresa->razon_social = Input::get('razon_social');			
  		 	$empresa->domicilio = Input::get('domicilio');
  		 	$empresa->rfc = Input::get('rfc');
  		 	$empresa->cp = Input::get('cp');
  		 	$empresa->telefono = Input::get('telefono');
			if(Input::hasFile('logo')) { //checa si trae archivo para poder guardar
					$empresa->logo = Input::file('logo')->getClientOriginalName();//nombre original de la foto								
					$file->move("public/img/upload/empresa",$file->getClientOriginalName());
						}
			$empresa->save();
			return Redirect::back()->with('status', 'update')->with('tab', 'tab1');



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
						
						return Redirect::back()->withInput()->withErrors($validator)->with('registro', 'edit_tab2')->with('tab', 'tab2');						
				}
        	$plan = new PlanPago;     	

        	$plan->descripcion = Input::get('descripcion');
  		 	$plan->porcentaje_anticipo = Input::get('porcentaje_anticipo');			
  		 	$plan->periodo = Input::get('periodo');
  		 	$plan->numero_pagos = Input::get('numero_pagos');
  		 	$plan->interes_mensual = Input::get('interes_mensual');

			$plan->save();
			return Redirect::to('configuracion-general/index')->with('status', 'plan_created')->with('tab', 'tab2')->with('registro', 'edit_tab2');



        }
        /**  estatus de plan de pago **/
        public function getAltapago($id){

        	$plan = PlanPago::find($id);     	

        	$plan->activo = 1;

			$plan->save();
			return Redirect::back()->with('status', 'plan_alta')->with('tab', 'tab2')->with('registro', 'edit_tab2');
		}

			public function getBajapago($id){

        	$plan = PlanPago::find($id);     	

        	$plan->activo = 0;

			$plan->save();
			return Redirect::back()->with('status', 'plan_baja')->with('tab', 'tab2')->with('registro', 'edit_tab2');



        }
        /** fin estatus plan de pago **/


public function postNuevanotacredito(){

        	//validar formulario
			$rules = array(
					'cliente' => 'required',
					'cliente_id' => 'required',
					'descuento'=>'required|digits_between:0,100',
					'descripcion'=>'required',
					'porcentaje'=>'required|numeric'					
					
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
						
						return Redirect::back()->withInput()->withErrors($validator)->with('registro', 'edit_tab3')->with('tab', 'tab3');						
				}
        	$nota = new Cupon;     	

        	$nota->cliente_id = Input::get('cliente_id');
  		 	$nota->descuento = Input::get('descuento');			
  		 	$nota->descripcion = Input::get('descripcion');
  		 	$nota->porcentaje = Input::get('porcentaje');
  		 	
			$nota->save();
			return Redirect::back()->with('status', 'nota_created')->with('tab', 'tab3')->with('registro', 'edit_tab3');



        }
        /**  estatus de nota de credito **/
        public function getAltanota($id){

        	$nota = Cupon::find($id);     	

        	$nota->activo = 1;

			$nota->save();
			return Redirect::back()->with('status', 'nota_alta')->with('tab', 'tab3')->with('registro', 'edit_tab3');
		}

			public function getBajanota($id){

        	$nota = Cupon::find($id);     	

        	$nota->activo = 0;

			$nota->save();
			return Redirect::back()->with('status', 'nota_baja')->with('tab', 'tab3')->with('registro', 'edit_tab3');



        }
        /** fin estatus plan de pago **/ 



	}
