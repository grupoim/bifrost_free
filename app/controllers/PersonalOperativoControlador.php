<?php 
use Carbon\Carbon;
	class PersonalOperativoControlador extends ModuloControlador{
		
		
		function __construct(){
		$this->data["module"] = 'Personal Operativo';
		$this->data["icon"] ='users';
		$this->department = camel_case(Auth::user()->departamento->nombre);
		}
		public function getIndex(){
			
			$dataModule["empleados"] = VistaEmpleado::all();					 			
			return View::make($this->department.".main", $this->data)->nest('child', 'operaciones.personaloperativo', $dataModule);		
		}

		public function getLista(){
			$dataModule["empleados"] = VistaEmpleado::where('activo',1)->get();						
			$dataModule["listas"] = Lista::all();
					 			
 			return View::make($this->department.".main", $this->data)->nest('child', 'operaciones.lista', $dataModule);		
		}

		public function getCierraperiodo($lista_id){
			if ((Auth::user()->departamento->id == 4) or (Auth::user()->departamento->id == 1 )) {
			$lista = Lista::find($lista_id);
			$lista->activa = 0;
			$lista->save();

			$detalles = VistaListaAsistencia::where('lista_id',$lista_id)->get();
			$faltas = $detalles->sum('faltas');
			$primas = $detalles->sum('prima');
			//enviar mail de confirmacion
					Mail::send('emails.new_lista', array('fecha_inicio'=> $lista->fecha_inicio,
											 'fecha_fin'=>$lista->fecha_fin,
											 'faltas'=>$faltas,
											 'primas'=>$primas,
											 'lista' => $lista_id,
											 ), function($message) {
			    /*$message->to('elnazavalderrama@gmail.com')->subject('Asistencia del $lista->fecha_inicio al $lista->fecha_fin ');*/
			   $message->to('notificaciones@parquefuneralguadalupe.com.mx')->subject('Nuevo reporte de Asistencia');
			});

					//fin mail confirmación	

			return Redirect::to('personal-operativo/lista');
		}

		}
		
		public function getAbreperiodo($lista_id){
			if ((Auth::user()->departamento->id == 4) or (Auth::user()->departamento->id == 1 )) {
			$lista = Lista::find($lista_id);
			$lista->activa = 1;
			$lista->save();
			return Redirect::to('personal-operativo/asistencia/'.$lista_id);

		}

		}

		public function getAsistencia($lista_id){
			$dataModule["asistencias"] = VistaNomina::where('lista_id','=',$lista_id)->get();			
			$dataModule["lista"] = Lista::find($lista_id);		
					
 			return View::make($this->department.".main", $this->data)->nest('child', 'operaciones.asistencia', $dataModule);		

		}

		public function getNomina($lista_id){
			if((Auth::user()->departamento->id == 6) or (Auth::user()->departamento->id == 1 )){

			$dataModule["asistencias"] = VistaNomina::where('lista_id','=',$lista_id)->get();			
			$dataModule["lista"] = Lista::find($lista_id);			
			$dataModule["revisados_operaciones"] = VistaNomina::where('lista_id','=',$lista_id)->where('revisado',1)->count();
			$dataModule["revisados_contabilidad"] = VistaNomina::where('lista_id','=',$lista_id)->where('revision_contabilidad',1)->count();
			$dataModule["total_empleados"] = VistaNomina::where('lista_id','=',$lista_id)->count();
			$dataModule["suma_ss"]= VistaNomina::where('lista_id','=',$lista_id)->sum('nomina_ss');
			$dataModule["suma_h_extra"]= VistaNomina::where('lista_id','=',$lista_id)->sum('h_extra');
			$dataModule["suma_p_dominical"]= VistaNomina::where('lista_id','=',$lista_id)->sum('p_dominical');
			$dataModule["suma_otras_percepciones"]= VistaNomina::where('lista_id','=',$lista_id)->sum('otras_percepciones');
			$dataModule["suma_bono_mtto"]= VistaNomina::where('lista_id','=',$lista_id)->sum('bono_mtto');
			$dataModule["suma_infonavit"]= VistaNomina::where('lista_id','=',$lista_id)->sum('infonavit');
			$dataModule["suma_abono_prestamo"]= VistaNomina::where('lista_id','=',$lista_id)->sum('abono_prestamo');
			$dataModule["total"]= VistaNomina::where('lista_id','=',$lista_id)->sum('nomina');


 			return View::make($this->department.".main", $this->data)->nest('child', 'operaciones.nomina', $dataModule);		
 		}else 
 		return Redirect::to('personal-operativo/lista');

		}
		public function postNomina(){
			$empleado = VistaNomina::find(Input::get('asistencia_id'));
			
			$nomina = round((($empleado->salario_semanal/7)*Input::get('dias_pago'))
						+Input::get('bono_mtto')
						-$empleado->infonavit
						-Input::get('abono_prestamo')
						+Input::get('otras_percepciones')
						+$empleado->p_dominical
						+$empleado->h_extra,0);

			$nomina_ss =round((($empleado->salario_semanal/7)*Input::get('dias_pago')),0);

			$asistencia = Asistencia::find(Input::get('asistencia_id'));
			$asistencia->dias_pago = Input::get('dias_pago');
			$asistencia->nomina = $nomina;
			$asistencia->nomina_ss = $nomina_ss;
			$asistencia->revision_contabilidad = 1;
			$asistencia->save();
		
			if (Input::get('otras_percepciones')<> $empleado->otras_percepciones) {
				$percepciones = OtrasPercepciones::where('asistencia_id', '=',Input::get('asistencia_id'))->count();

				if($percepciones == 1)
					{
						$percepciones_update = OtrasPercepciones::where('asistencia_id', '=',Input::get('asistencia_id'))->firstOrfail();
						$percepciones_update->monto = Input::get('otras_percepciones');
						$percepciones_update->save();
					}
				
				else{
					$otras_percepciones = new OtrasPercepciones;
					$otras_percepciones->monto = Input::get('otras_percepciones');
					$otras_percepciones->asistencia_id = $empleado->id;
					$otras_percepciones->save();
				}
			}
			if (Input::get('abono_prestamo')<> $empleado->abono_prestamo) {
				

				 $abono = AbonoPrestamo::where('asistencia_id', '=',Input::get('asistencia_id'))->count();
				if ($abono == 1) {
					$abono_update = AbonoPrestamo::where('asistencia_id', '=',Input::get('asistencia_id'))->firstOrfail();
					$abono_update->monto = Input::get('abono_prestamo');
					$abono_update->save();
				}

				else{
						$abono_prestamo = new AbonoPrestamo;
						$abono_prestamo->monto = Input::get('abono_prestamo');
						$abono_prestamo->asistencia_id = $empleado->id;
						$abono_prestamo->save();
					}
			}
		


		if ($empleado->departamento_id == 2) {
				
			
			$bono_mtto = BonoMtto::where('asistencia_id', '=',Input::get('asistencia_id'))->firstOrFail();
			$bono_mtto->monto = Input::get('bono_mtto');
			$bono_mtto->save();
				}
		
			return Redirect::back();
		}
	

		public function postAsis(){
			
			if (Input::has('lunes')){
				$lunes = 1;
			}
			else{
				$lunes = 0;
			}
			if (Input::has('martes')){
				$martes = 1;
			}
			else{
				$martes = 0;
			}
			if (Input::has('miercoles')){
				$miercoles = 1;
			}
			else{
				$miercoles = 0;
			}
			if (Input::has('jueves')){
				$jueves = 1;
			}
			else{
				$jueves = 0;
			}
			if (Input::has('viernes')){
				$viernes = 1;
			}
			else{
				$viernes = 0;
			}
			if (Input::has('sabado')){
				$sabado = 1;
			}
			else{
				$sabado = 0;
			}

			if (Input::has('domingo')){
				$domingo = 1;
			}
			else{
				$domingo = 0;
			}
			if (Input::has('prima_dominical')){
				$prima_dominical = 1;
			}
			else{
				$prima_dominical = 0;
			}

			if (Input::has('hora_extra')){
				$hora_extra = Input::get('hora_extra');
			}
			else{
				$hora_extra = 0;
			}
			
			$dias_trabajados = $sabado + $domingo + $lunes + $martes + $miercoles + $jueves + $viernes;
			
			switch ($dias_trabajados) {
				case '7':
					if ($dias_trabajados == 7 and Input::get('semana_completa') == 1) {
						$dias_pago = 8;
					} 
					else{
						$dias_pago = 7;

					}
					break;

				case '6':
					$dias_pago = 7;
					break;
				case '0':
					$dias_pago = 0;
					break;
				default:
					$dias_pago = $dias_trabajados;
					break;
			}

			$asistencia = Asistencia::find(Input::get('asistencia_id'));
			$asistencia->empleado_id = Input::get('empleado_id');
			$asistencia->sa = $sabado;
			$asistencia->do = $domingo;
			$asistencia->lu = $lunes;
			$asistencia->ma = $martes;
			$asistencia->mi = $miercoles;
			$asistencia->ju = $jueves;
			$asistencia->vi = $viernes;
			$asistencia->nomina = Input::get('nomina');
			$asistencia->nomina_ss = Input::get('nomina_ss');

			if ( $domingo == 1 and $prima_dominical == 1) {
				$asistencia->prima_dominical = 1;
			}else{
				$asistencia->prima_dominical = 0;
			}			
			$asistencia->hora_extra = $hora_extra;
			$asistencia->revisado = 1;			
			if ($sabado+$domingo+$lunes+$martes+$miercoles+$jueves+$viernes == 7 and Input::get('semana_completa')==1) {
				$asistencia->semana_completa = 1;
			}else{$asistencia->semana_completa = 0;}
			
				$asistencia->observaciones = Input::get('observaciones');
			
			
			$asistencia->dias_pago = $dias_pago;

			$asistencia->save();
			
			if (Input::get('departamento_id')==2) {
				
			
			$bono_mtto = BonoMtto::where('asistencia_id', '=',Input::get('asistencia_id'))->firstOrFail();
			$bono_mtto->monto = Input::get('bono_mtto');
			$bono_mtto->save();
				}
 			return Redirect::back();

		}
	

		public function getAgregar(){

			
				$dataModule["empleados"] = VistaEmpleado::all();				
				$dataModule["puestos"]=Puesto::all();	
 				$dataModule["puestos"] = Puesto::all(); 				
 				$dataModule["agregar"]= true;					
				return View::make($this->department.".main", $this->data)->nest('child', 'formularios.personaloperativo', $dataModule);		
		}

		public function getAgregarperiodo(){
				
				$dataModule["empleados"] = VistaEmpleado::all();				
				$dataModule["puestos"]=Puesto::all();								
 				$dataModule["puestos"] = Puesto::all(); 				
 				$dataModule["agregar"]= true;					
				return View::make($this->department.".main", $this->data)->nest('child', 'formularios.periodo', $dataModule);		
		}
	
			public function getRecupera($id){			
		
			
			$dataModule["empleado_r"] = VistaEmpleado::find($id);			
			$dataModule["puestos"]= Puesto::all();
						
			$dataModule["agregar"]= false;
			return View::make($this->department.".main", $this->data)->nest('child', 'formularios.personaloperativo', $dataModule);		
			}	

		
		public function postInsertar(){

			//validar formulario
			$rules = array(
					'nombres' => 'required|max:50',
					'apellido_paterno' => 'required|max:50',
					'apellido_materno'=> 'required|max:50',
					'fecha_ingreso' => 'required'
					
				);

				$messages = array(
						'required'=>'Campo Obligatorio.',
						'max' => 'El campo :attribute no puede tener mas de 50 caracteres'
					);

			$validator = Validator::make(Input::all(), $rules, $messages);
				if ($validator->fails())
				 { 
						
						return Redirect::back()->withInput()->withErrors($validator);						
				}
			
				//al pasar la validacion se procede a guardar campos			

			$persona = new Persona;

			$persona->nombres = Input::get('nombres');
			$persona->apellido_paterno = Input::get('apellido_paterno');
			$persona->apellido_materno = Input::get('apellido_materno');			
			$persona->save();

			$empleado = new Empleado;
			$empleado->persona_id= $persona->id; //insertar el valor del id de la persona anteriormente insertada
			$empleado->puesto_id = Input::get('puesto_id');
			$empleado->fecha_ingreso = Input::get('fecha_ingreso');

			$empleado->save();
			//redirigir al listado de personal operativo
			return Redirect::to('personal-operativo')->with('status', 'ok_create');
			
		}	
			
		
		public function postEditar($id) {
			//validar formulario
			$rules = array(
					'nombres' => 'required|max:50',
					'apellido_paterno' => 'required|max:50',
					'apellido_materno'=> 'required|max:50'				
					
				);	

			$messages = array(
						'required'=>'El campo :attribute es Obligatorio.',
						'max' => 'El campo :attribute no puede tener mas de 50 caracteres'
					);


			$validator = Validator::make(Input::all(), $rules, $messages);
				if ($validator->fails())
				 {		 		

						return Redirect::back()->withInput()->withErrors($validator);
				}
				//al pasar la validacion se procede a guardar campos	
  		 
  		 	$empleado = Empleado::find($id);
  		 	$empleado->puesto_id = Input::get('puesto_id');
			$empleado->fecha_ingreso = Input::get('fecha_ingreso');
			$empleado->save();
   			
  		 	$persona = Persona::find($empleado->persona_id);

			$persona->nombres = Input::get('nombres');
			$persona->apellido_paterno = Input::get('apellido_paterno');
			$persona->apellido_materno = Input::get('apellido_materno');			
			$persona->save();

			$salario = Salario::where('empleado_id',$id)->where('activo',1)->firstOrfail();
			if(isset($salario)){

			if ($salario->salario_semanal <> Input::get('salario_semanal') and $salario->salario_diario <> Input::get('salario_diario'))
			 {
				
				$nuevo_salario = new Salario;
				$nuevo_salario->empleado_id = $empleado->id;
				$nuevo_salario->salario_semanal = Input::get('salario_semanal');
				$nuevo_salario->salario_diario = Input::get('salario_diario');
				$nuevo_salario->save();
				
				if($salario){
				$salario_viejo = Salario::find($salario->id);
				$salario_viejo->activo = 0;
				$salario_viejo->save();
				}

			}else{
				$nuevo_salario = new Salario;
				$nuevo_salario->empleado_id = $empleado->id;
				$nuevo_salario->salario_semanal = Input::get('salario_semanal');
				$nuevo_salario->salario_diario = Input::get('salario_diario');
				$nuevo_salario->save();
			}
		}

   			return Redirect::to('personal-operativo')->with('status', 'ok_update')->with('status', 'ok_update');
			}

			
			public function getBaja($id){

					$empleado = Empleado::find($id);
					$empleado->activo = "0";
					$empleado->save();
					return Redirect::to('personal-operativo')->with('status', 'ok_cancel');

				}

				public function getBajalista($empleado_id){

					$empleado = Empleado::find($empleado_id);
					$empleado->activo = "0";
					$empleado->save();
					return Redirect::back();

				}
						public function getActivar($id){

					$empleado = Empleado::find($id);
					$empleado->activo = "1";
					$empleado->save();
					return Redirect::to('personal-operativo')->with('status', 'ok_activar');

				}	
				
				public function postCrealista(){
					$fecha_fin = Input::get('fecha');
					$fecha_fin_carbon = Carbon::parse($fecha_fin);
					$fecha_inicio_carbon = $fecha_fin_carbon->subDays(Input::get('tipo_lista'))->toDateString();
					
					$lista = new Lista;
					$lista->fecha_inicio = $fecha_inicio_carbon;
					$lista->fecha_fin = $fecha_fin;
					$lista->save();

					$trabajadores_activos = VistaEmpleado::where('activo',1)->count();
					$trabajadores = VistaEmpleado::where('activo',1)->get();
		

					foreach($trabajadores as $trabajador){
					$asistencia = new Asistencia;
					$asistencia->lista_id = $lista->id;
					$asistencia->empleado_id = $trabajador->id;
					$asistencia->save();

					if ($trabajador->departamento_id == 2) {
					$bono_mtto = new BonoMtto;
					$bono_mtto->asistencia_id = $asistencia->id;
					$bono_mtto->save();
					}
					}					

					
					return Redirect::to('personal-operativo/asistencia/'.$lista->id);


				}

				public function getDopdf($lista_id)
				{
				
				$dataModule["asistencias"] = VistaNomina::where('lista_id','=',$lista_id)->get();			
				$dataModule["lista"] = Lista::find($lista_id);	
				 $customPaper = array(0,0,950,950);
				$html = View::make('emails.test', $dataModule);
    			return PDF::load($html, 'letter', 'landscape')->show();
				/*$pdf = DOPDF::loadView('emails.test', $dataModule);
				return DOPDF::loadFile(public_path().'/myfile.html')->save('/my_stored_file.pdf')->stream('download.pdf');
				*/ }

				public function getExcel($lista_id)
				{

				$nomina = VistaNomina::select('empleado as Empleado','salario_diario as SD','salario_semanal as Sueldo','dias_pago as DT','nomina_ss as SS',
					'h_extra as H.E.', 'p_dominical as PD', 'otras_percepciones as OP', 'bono_mtto as BM', DB::raw('if(infonavit > 0, infonavit * -1, 0 ) as INF'), DB::raw('if(abono_prestamo > 0, abono_prestamo * -1, 0 ) as PRE'), 'nomina as Total', DB::raw('if(ss > 0, " ", 0 ) as firma') )->where('lista_id','=',$lista_id)->get();
				
				$lista = Lista::find($lista_id);
				
				$fecha = 'Nomina '.date("d/M/Y", strtotime($lista->fecha_inicio)).' al '.date("d/M/Y", strtotime($lista->fecha_fin));  
				
				$empleados_no = VistaNomina::where('lista_id','=',$lista_id)->count(); 

				
				$incidencias = VistaNomina::select('empleado as Empleado', 'departamento as Depto.', 
					DB::raw('sa+do+lu+ma+mi+ju+vi as Días'), 
					DB::raw('if(sa > 0, "Ok", "" ) as Sab'),
					DB::raw('if(do > 0, "Ok", "" ) as Dom'),
					DB::raw('if(lu > 0, "Ok", "" ) as Lun'),
					DB::raw('if(ma > 0, "Ok", "" ) as Mar'),
					DB::raw('if(mi > 0, "Ok", "" ) as Mie'),
					DB::raw('if(ju > 0, "Ok", "" ) as Jue'),
					DB::raw('if(vi > 0, "Ok", "" ) as Vie'),
					'prima_dominical as PD',
					'hora_extra as HE',
					'observaciones as Observaciones'
					 )->where('lista_id','=',$lista_id)->get();
				


				Excel::create($fecha, function($excel) use ($nomina,$incidencias,$empleados_no,$fecha) {
 
			    // Set the title
			    $excel->setTitle('Relacion de incidencias semanal');

			    // Chain the setters
			    $excel->setCreator('By MDL')
			          ->setCompany('Parque Funeral Guadalule');

			    // Call them separately
			    $excel->setDescription('A demonstration to change the file properties');
           		$excel->sheet('Nomina', function($sheet) use ($nomina,$empleados_no,$fecha) {
 				

 				// Manipulate first row
				//DATOS GENERALES DE LA NOMINA
				$sheet->row(1, array(
				     'INVERSIONES PFG, S.A. DE C.V. ' .$fecha
				));
				
				//ESPACIO PARA ENCABEZADO
				$sheet->mergeCells('A1:M1');
								

 				//FORMATOS DE LAS COL
 				$sheet->setColumnFormat(array(
										    'B' => '"$"#,##0.00_-',
										    'C' => '"$"#,##0.00_-',
										    'E' => '"$"#,##0.00_-',
										    'F' => '"$"#,##0.00_-',
										    'G' => '"$"#,##0.00_-',
										    'H' => '"$"#,##0.00_-',
										    'I' => '"$"#,##0.00_-',
										    'J' => '"$"#,##0.00_-',
										    'K' => '"$"#,##0.00_-',
										    'L' => '"$"#,##0.00_-'


										));
 				//formato de celdas TITULOS en negritas
 				$sheet->cells('A1:O1', function ($cells){
 				//primer renglon en negritas
 				$cells->setFontWeight('bold');
 				// Set font size
				$cells->setFontSize(14);
				// Set alignment to center
				$cells->setAlignment('center');
				// Set vertical alignment to middle
 				$cells->setValignment('middle'); 				

 				});
				
 				//formato de celdas encabezado en negritas, CONGELA LA PRIMER COLUMNA Y LOS RENGLONES HASTA EL 3
 				$sheet->freezePaneByColumnAndRow(1,3)->cells('A2:M2', function ($cells){
 				//primer renglon en negritas
 				$cells->setFontWeight('bold');
 				// Set font size
				$cells->setFontSize(12);
				// Set alignment to center
				$cells->setAlignment('center');
				// Set vertical alignment to middle
 				$cells->setValignment('middle');
 				// Set black background
				$cells->setBackground('#000000');
				// Set with font color
				$cells->setFontColor('#ffffff');

				

 				});

 				//formato y alineacion de el contenido
 				$sheet->cells('C1:L'.($empleados_no + 2), function ($cells){ 				
				// Set alignment to center
				$cells->setAlignment('center');
				// Set vertical alignment to middle
 				$cells->setValignment('middle');

 				});
 				
				
				//primer renglon con borde
				$sheet->setBorder('A2:M'.($empleados_no+2), 'thin');
				
				for ($i=2; $i < ($empleados_no + 3); $i++) { 
					$sheet->setHeight($i, 25);										
				}
				
                
				// Set width for multiple cells
				$sheet->setWidth(array(
				    'A'     =>  35,
				    'C'     =>  10,
				    'D'     =>  5,
				    'E'     =>  10,
				    'L'     =>  10,
				    'M'     =>  25
				));
                $sheet->setOrientation('landscape');
                $sheet->fromArray($nomina, null, 'A2', 	false);
 				 
            		});
           		
	//segunda hoja de movimientos
           		$excel->sheet('Movimientos', function($sheet) use ($incidencias,$fecha, $empleados_no) {
 				

 				// Manipulate first row
				//DATOS GENERALES DE LA NOMINA
				$sheet->row(1, array(
				     'INVERSIONES PFG, S.A. DE C.V. ' ." OBSERVACIONES DE ".$fecha
				));
				
				//ESPACIO PARA ENCABEZADO
				$sheet->mergeCells('A1:M1');	
 				
 
            	//formato de celdas TITULOS en negritas
 				$sheet->cells('A1:O1', function ($cells){
 				//primer renglon en negritas
 				$cells->setFontWeight('bold');
 				// Set font size
				$cells->setFontSize(14);
				// Set alignment to center
				$cells->setAlignment('center');
				// Set vertical alignment to middle
 				$cells->setValignment('middle'); 				

 				});
				
 				//formato de celdas encabezado en negritas, CONGELA LA PRIMER COLUMNA Y LOS RENGLONES HASTA EL 3
 				$sheet->freezePaneByColumnAndRow(1,3)->cells('A2:M2', function ($cells){
 				//primer renglon en negritas
 				$cells->setFontWeight('bold');
 				// Set font size
				$cells->setFontSize(12);
				// Set alignment to center
				$cells->setAlignment('center');
				// Set vertical alignment to middle
 				$cells->setValignment('middle');
 				// Set black background
				$cells->setBackground('#000000');
				// Set with font color
				$cells->setFontColor('#ffffff');				

 				});	
 				$sheet->setOrientation('landscape'); 				 
                $sheet->fromArray($incidencias, null, 'A2', true);
                
                //COLOR DE LOS DOMINGOS
                $sheet->cells('E3:E'.($empleados_no+2), function($cells) {

    			$cells->setBackground('#F7FE2E');
    			$cells->setFontWeight('bold');

						});
            	});
        })->export('xls');
				

				}



				
	}
 
		

 ?>