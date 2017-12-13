<?php
use Carbon\Carbon;
class SolicitudEmpleoControlador extends \BaseController {

	public function __construct(){
		$this->data["module"] = "Solicitud de empleo";
		$this->data["icon"] = "fa fa-files-o";
		$this->department = Auth::user()->departamento->nombre;
	}
	public function getIndex()
	{
	
	  $dataModule["status"] = Session::pull('status');
	  $dataModule["estados"] =  Estado::all();
	  $dataModule["estado_civil"] = EstadoCivil::all();
	  $dataModule["datos"] = Datos::all();
	  $dataModule["tipo_telefono"] = TipoTelefono::all();
	  $dataModule["cordinador"] = Cordinador::select(DB::raw("CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) as cordinador"),'cordinador.id as cordinador_id')
									->where('cordinador.activo',1)
									->leftJoin('persona', 'cordinador.persona_id', '=', 'persona.id')
									->get();
	  $dataModule["colonias"] = Colonia::select('colonia.nombre as colonia','colonia.codigo_postal','municipio.nombre as municipio','estado.nombre as estado','colonia.id as colonia_id')
	  							->leftjoin('municipio','colonia.municipio_id','=','municipio.id')
	  							->leftjoin('estado','municipio.estado_id','=','estado.id')
	  							->get();
	  return View::make($this->department.".main", $this->data)->nest('child', 'administracion.solicitud', $dataModule);
	}

	public function getDomicilio(){	
	$colonia =  Colonia::select('colonia.id as colonia_id',DB::raw("CONCAT(colonia.nombre, ' ', colonia.codigo_postal, ' ', municipio.nombre,' ', estado.nombre) as colonia"))
	  							->leftjoin('municipio','colonia.municipio_id','=','municipio.id')
	  							->leftjoin('estado','municipio.estado_id','=','estado.id')
	  							->get();
	return Response::Json($colonia);
	}
		public function postSolicitud(){

		//solicitud
		$solicitud = new Solicitud;
		$solicitud->puesto = Input::get('puesto');
		$solicitud->sueldo = ' ';
		$solicitud->fecha_solicitud = strftime( "%Y-%m-%d", time());
		$solicitud->zona = Input::get('zona');
		$solicitud->cordinador_id = Input::get('cordinador');
		$solicitud->save();
		// persona de la solicitud
		$persona_solicitante = new Persona;
		$persona_solicitante->nombres = Input::get('nombres');
		$persona_solicitante->apellido_paterno = Input::get('apellido_paterno');
		$persona_solicitante->apellido_materno = Input::get('apellido_materno');
		$persona_solicitante->save();
		//datos de la persona
		$dato_solicitante = new DatoSolicitante;
		$dato_solicitante->edad = Input::get('edad');
		$dato_solicitante->fecha_nacimiento = Input::get('fecha_nacimiento');
		$dato_solicitante->sexo = Input::get('sexo');
		$dato_solicitante->dependientes = Input::get('hijos').' '.Input::get('conyuge').' '.Input::get('padres').' '.Input::get('otros');
		$dato_solicitante->persona_id = $persona_solicitante->id;
		$dato_solicitante->colonia_id = Input::get('colonia');
		$dato_solicitante->estado_civil_id = Input::get('estado_civil');
		$dato_solicitante->datos_id = Input::get('vive_con');
		$dato_solicitante->calle = Input::get('calle');
		$dato_solicitante->numero_interior = Input::get('numero_interior');
		$dato_solicitante->numero_exterior = Input::get('numero_exterior');
		$dato_solicitante->lugar_nacimiento = Input::get('lugar_nacimiento');
		$dato_solicitante->save();
		

		//alta seguro
		$altaseguro = new AltaSeguro;
		$altaseguro->clinica = Input::get('clinica');
		$altaseguro->fecha_alta = " ";
		$altaseguro->fecha_baja = " ";
		$altaseguro->alta = 0;
		$altaseguro->dato_solicitante_id = $dato_solicitante->id;
		$altaseguro->save();
		//prospecto
		$prospecto = new Prospectos;
		$prospecto->dato_solicitante_id = $dato_solicitante->id;
		$prospecto->solicitud_id = $solicitud->id;
		$prospecto->foto = Input::file('foto')->getClientOriginalName();
		$prospecto->save();
 		
 		
		if ($prospecto->save()) {

			$file = Input::file('foto');
			$destinoPath = public_path().'/img/upload/';
			$subir = $file->move($destinoPath,$file->getClientOriginalName());

		}

				//contacto del solicitante
		$contacto_solicitante = new ContactoSolicitante;
		$contacto_solicitante->telefono = Input::get('telefono');
		$contacto_solicitante->codigo_pais = Input::get('codigo_pais');
		$contacto_solicitante->dato_solicitante_id =$dato_solicitante->id;
		$contacto_solicitante->tipo_telefono_id = Input::get('tipo_telefono');
		$contacto_solicitante->save();

		//documentos del solicitante
		$documentos = new Documentos;
		$documentos->curp = Input::get('curp');
		$documentos->rfc = Input::get('rfc');
		$documentos->imss = Input::get('imss');
		$documentos->dato_solicitante_id = $dato_solicitante->id;
		$documentos->save();
		//jalo todos los registros con arreglos 
		$array_nombre = Input::get('nombres_f');
		$array_vive = Input::get('vive');
		$array_colonia = Input::get('colonia_f');
		$array_calle = Input::get('calle_f');
		$array_numero_interior = Input::get('numero_interior_f');
		$array_numero_exterior = Input::get('numero_exterior_f');
		$array_id = Input::get('id_f');
		$arra_ocupacion = Input::get('ocupacion_f');
		//almaceno todos los datos de los familiares del solicitante
		$datos = Datos::where('familiares',1)->where('activo',1)->get();
		foreach ($datos as $dato) {
		$dato_familiar = new DatoFamiliar;
		$dato_familiar->vive = $array_vive[$dato->id];
		$dato_familiar->dato_solicitante_id = $dato_solicitante->id;
		$dato_familiar->colonia_id = $array_colonia[$dato->id];
		$dato_familiar->nombre = $array_nombre[$dato->id];
		$dato_familiar->calle = $array_calle[$dato->id];
		$dato_familiar->numero_interior = $array_numero_interior[$dato->id];
		$dato_familiar->numero_exterior = $array_numero_exterior[$dato->id];
		$dato_familiar->datos_id = $array_id[$dato->id];
		$dato_familiar->ocupacion = $arra_ocupacion[$dato->id];
		$dato_familiar->save();

		}
		
		//primera referencia
		$persona_referencia = new Persona;
		$persona_referencia->nombres = Input::get('nombres_r1');
		$persona_referencia->apellido_paterno = Input::get('apellido_paterno_r1');
		$persona_referencia->apellido_materno = Input::get('apellido_materno_r1'); 
		$persona_referencia->save();

		$referencias = new Referencias;
		$referencias->tiempo_conocerlo = Input::get('tiempo_conocerlo_r1').' '.Input::get('tiempo_r1');
		$referencias->dato_solicitante_id =$dato_solicitante->id;
		$referencias->persona_id = $persona_referencia->id;
		$referencias->colonia_id = Input::get('colonia1');
		$referencias->datos_id = Input::get('ocupacion_r1');
		$referencias->calle = Input::get('calle_r1');
		$referencias->numero_interior = Input::get('numero_interior_r1');
		$referencias->numero_exterior = Input::get('numero_exterior_r1');
		$referencias->save();
			
		$contacto_referencia = new ContactoReferencia;
		$contacto_referencia->telefono = Input::get('telefono1');
		$contacto_referencia->codigo_pais = Input::get('codigo_pais_r1');
		$contacto_referencia->referencias_id = $referencias->id;
		$contacto_referencia->tipo_telefono_id = Input::get('tipo_telefono_r1');
		$contacto_referencia->save();

		//segunda referencia
		$persona_referencia2 = new Persona;
		$persona_referencia2->nombres = Input::get('nombres_r2');
		$persona_referencia2->apellido_paterno = Input::get('apellido_paterno_r2');
		$persona_referencia2->apellido_materno = Input::get('apellido_materno_r2'); 
		$persona_referencia2->save();

		$referencias2 = new Referencias;
		$referencias2->tiempo_conocerlo = Input::get('tiempo_conocerlo_r2').' '.Input::get('tiempo_r2');
		$referencias2->dato_solicitante_id = $dato_solicitante->id;
		$referencias2->persona_id = $persona_referencia2->id;
		$referencias2->colonia_id = Input::get('colonia2');
		$referencias2->datos_id = Input::get('ocupacion_r2');
		$referencias2->calle = Input::get('calle_r2');
		$referencias2->numero_interior = Input::get('numero_interior_r2');
		$referencias2->numero_exterior = Input::get('numero_exterior_r2');
		$referencias2->save();
			
		$contacto_referencia2 = new ContactoReferencia;
		$contacto_referencia2->telefono = Input::get('telefono2');
		$contacto_referencia2->codigo_pais = Input::get('codigo_pais_r2');
		$contacto_referencia2->referencias_id = $referencias2->id;
		$contacto_referencia2->tipo_telefono_id = Input::get('tipo_telefono_r2');
		$contacto_referencia2->save();


    //jalo todos los registros de escolaridad
    $array_nombre_e = Input::get('nombres_e');
    $array_fecha_inicio = Input::get('fecha_inicio');
    $array_fecha_fin = Input::get('fecha_fin');
    $array_año = Input::get('años');
    $array_colonia_e = Input::get('colonia_e');
    $array_calle_e = Input::get('calle_e');
    $array_numero_interior_e = Input::get('numero_interior_e');
    $array_numero_exterior_e = Input::get('numero_exterior_e');
    $array_id_e = Input::get('id_e');
    $array_titulo = Input::get('titulo');
    //almaceno todos los datos de la escolaridad del solicitante
    $estudios = Datos::where('nivel_estudio',1)->where('activo',1)->get();
    foreach ($estudios as $estudio) {
    $escolaridad = new Estudios;
   @$escolaridad->nombre = $array_nombre_e[$estudio->id];
   @$escolaridad->fecha_inicio = $array_fecha_inicio[$estudio->id];
   @$escolaridad->fecha_fin = $array_fecha_fin[$estudio->id];
   @$escolaridad->años = $array_año[$estudio->id];
   @$escolaridad->calle = $array_calle_e[$estudio->id];
   @$escolaridad->numero_interior = $array_numero_interior_e[$estudio->id];
   @$escolaridad->numero_exterior = $array_numero_exterior_e[$estudio->id];
   @$escolaridad->datos_id = $array_id_e[$estudio->id];
   @$escolaridad->dato_solicitante_id = $dato_solicitante->id;
   @$escolaridad->colonia_id = $array_colonia_e[$estudio->id];
   @$escolaridad->titulo = $array_titulo[$estudio->id];
    $escolaridad->save();

    }	

 	return Redirect::back()->with('status', 'registro');

	}



	public function getInformacion($id){

		$datos = VistaRelacionPersonal::find($id);

		$prospecto = Prospectos::where('solicitud_id',$id)->first();
		$solicitante_id = $prospecto->dato_solicitante_id;

		$cordinador = Solicitud::select(DB::raw("CONCAT(persona.nombres, ' ', persona.apellido_paterno, ' ', persona.apellido_materno) as cordinador"))
									->where('cordinador.activo',1)->where('solicitud.id',$id)
									->leftjoin('cordinador','solicitud.cordinador_id','=','cordinador.id')
									->leftjoin('persona','cordinador.persona_id','=','persona.id')
									->first();

		$familiares = DatoFamiliar::select('dato_familiar.vive','dato_familiar.nombre','datos.nombre as familiar','dato_familiar.calle','dato_familiar.numero_interior'
			,'dato_familiar.numero_exterior','dato_familiar.ocupacion',DB::raw("CONCAT(calle,' #Int ',dato_familiar.numero_interior,' #Ext ',dato_familiar.numero_exterior,' ', colonia.nombre, ' ', colonia.codigo_postal, ' ', municipio.nombre,' ', estado.nombre) as colonia"))
									   ->leftjoin('datos','dato_familiar.datos_id','=','datos.id')
									   ->leftjoin('colonia','dato_familiar.colonia_id','=','colonia.id')
									   ->leftjoin('municipio','colonia.municipio_id','=','municipio.id')
	  							       ->leftjoin('estado','municipio.estado_id','=','estado.id')
	  							       ->where('dato_familiar.dato_solicitante_id',$solicitante_id)
	  							       ->get();

	  	$referencia = Referencias::select('referencias.tiempo_conocerlo',DB::raw("CONCAT(referencias.calle,' #Int ',referencias.numero_interior,' #Ext ',referencias.numero_exterior,' ', colonia.nombre, ' ', colonia.codigo_postal, ' ', municipio.nombre,' ', estado.nombre) as colonia")
	  		,'referencias.numero_exterior','referencias.numero_interior','datos.nombre as ocupacion',DB::raw("CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) as persona"),'contacto_referencia.telefono')
	  								   ->leftjoin('persona','referencias.persona_id','=','persona.id')
	  								   ->leftjoin('contacto_referencia','referencias.id','=','contacto_referencia.referencias_id')
	  								   ->leftjoin('datos','referencias.datos_id','=','datos.id')
									   ->leftjoin('colonia','referencias.colonia_id','=','colonia.id')
									   ->leftjoin('municipio','colonia.municipio_id','=','municipio.id')
	  							       ->leftjoin('estado','municipio.estado_id','=','estado.id')
	  							       ->where('referencias.dato_solicitante_id',$solicitante_id)
	  							       ->get();
	  	$escolaridad = Estudios::select('estudios.nombre as escuela','estudios.fecha_inicio','estudios.fecha_fin','estudios.años',
	  		'datos.nombre as nivel_estudio','estudios.titulo',DB::raw("CONCAT(estudios.calle,' #Int ',estudios.numero_interior,' #Ext ',estudios.numero_exterior,' ',colonia.nombre, ' ', colonia.codigo_postal, ' ', municipio.nombre,' ', estado.nombre) as colonia"))
	  								   ->leftjoin('datos','estudios.datos_id','=','datos.id')
									   ->leftjoin('colonia','estudios.colonia_id','=','colonia.id')
									   ->leftjoin('municipio','colonia.municipio_id','=','municipio.id')
	  							       ->leftjoin('estado','municipio.estado_id','=','estado.id')
	  							       ->where('estudios.dato_solicitante_id',$solicitante_id)
	  							       ->get();

	    $data['dato'] = $datos;
	    $data['familiares'] = $familiares;
	    $data['referencias'] = $referencia;
	    $data['estudios'] = $escolaridad;
	    $data['cordinador'] = $cordinador;


    	$pdf = DOPDF::loadView('formularios.solicitud_empleo_pdf',$data)->setPaper('letter');
      	$dom_pdf = $pdf->getDomPDF();
		$pdf->output();
		$canvas = $dom_pdf ->get_canvas();
		$canvas->page_text(700, 600, " {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
      return $pdf->stream();

	}

	public function getRecupera($id){

		  $dataModule["status"] = Session::pull('status','edit');
		  $dataModule["estados"] =  Estado::all();
		  $dataModule["estado_civil"] = EstadoCivil::all();
		  $dataModule["datos"] = Datos::all();
		  $dataModule["tipo_telefono"] = TipoTelefono::all();
		  $dataModule["cordinador"] = Cordinador::select(DB::raw("CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) as cordinador"),'cordinador.id as cordinador_id')
										->where('cordinador.activo',1)
										->leftJoin('persona', 'cordinador.persona_id', '=', 'persona.id')
										->get();
		  $dataModule["colonias"] = Colonia::select('colonia.nombre as colonia','colonia.codigo_postal','municipio.nombre as municipio','estado.nombre as estado','colonia.id as colonia_id')
	  							->leftjoin('municipio','colonia.municipio_id','=','municipio.id')
	  							->leftjoin('estado','municipio.estado_id','=','estado.id')
	  							->get();
	  	 $dataModule["solicitud_edit"] = Prospectos::select('solicitud.puesto','cordinador.id as cordinador_id','solicitud.zona','persona.nombres','persona.apellido_paterno','persona.apellido_materno',
	  	 	'dato_solicitante.edad','dato_solicitante.calle','dato_solicitante.numero_exterior','dato_solicitante.numero_interior','dato_solicitante.fecha_nacimiento','contacto_solicitante.telefono',
	  	 	'tipo_telefono.id as tipo_id','dato_solicitante.sexo','estado_civil.id as estado_civil_id','datos.id as datos_id','documentos.curp','documentos.rfc','documentos.imss','alta_seguro.clinica'
	  	 	 ,'dato_solicitante.lugar_nacimiento')
	  	 						->where('prospectos.solicitud_id',$id)
	  	 						->leftjoin('solicitud','prospectos.solicitud_id','=','solicitud.id')
	  	 						->leftjoin('cordinador','solicitud.cordinador_id','=','cordinador.id')
	  	 						->leftjoin('dato_solicitante','prospectos.dato_solicitante_id','=','dato_solicitante.id')
	  	 						->leftjoin('persona','dato_solicitante.persona_id','=','persona.id')
	  	 						->leftjoin('contacto_solicitante','dato_solicitante.id','=','contacto_solicitante.dato_solicitante_id')
	  	 						->leftjoin('tipo_telefono','contacto_solicitante.tipo_telefono_id','=','tipo_telefono.id')
	  	 						->leftjoin('estado_civil','dato_solicitante.estado_civil_id','=','estado_civil.id')
	  	 						->leftjoin('datos','dato_solicitante.datos_id','=','datos.id')
	  	 						->leftjoin('documentos','dato_solicitante.id','=','documentos.dato_solicitante_id')
	  	 						->leftjoin('alta_seguro','dato_solicitante.id','=','alta_seguro.dato_solicitante_id')
	  	 						->leftjoin('colonia','dato_solicitante.colonia_id','=','colonia.id')
	  	 						->leftjoin('municipio','colonia.municipio_id','=','municipio.id')
	  							->leftjoin('estado','municipio.estado_id','=','estado.id')
	  	 						->first();
	  	 $dataModule["d_familiares"] = Prospectos::select('dato_familiar.nombre as familiar','datos.familiares','datos.nombre as datos','dato_familiar.calle',
	  	 		'dato_familiar.numero_interior','dato_familiar.numero_exterior','dato_familiar.ocupacion','dato_familiar.vive')
	  	 						->where('prospectos.solicitud_id',$id)
	  	 						->leftjoin('dato_solicitante','prospectos.dato_solicitante_id','=','dato_solicitante.id')
	  	 						->leftjoin('dato_familiar','dato_solicitante.id','=','dato_familiar.dato_solicitante_id')
	  	 						->leftjoin('datos','dato_familiar.datos_id','=','datos.id')
	  	 						->get();
	  	 $dataModule["referencia1"] = Prospectos::select('persona.nombres','persona.apellido_paterno','persona.apellido_materno','referencias.tiempo_conocerlo','contacto_referencia.telefono',
		  	 	'tipo_telefono.id as tipo_id','referencias.numero_interior','referencias.numero_exterior','referencias.calle')
	  	 						->where('prospectos.solicitud_id',$id)
	  	 						->leftjoin('dato_solicitante','prospectos.dato_solicitante_id','=','dato_solicitante.id')
	  	 						->leftjoin('referencias','dato_solicitante.id','=','referencias.dato_solicitante_id')
	  	 						->leftjoin('persona','referencias.persona_id','=','persona.id')
	  	 						->leftjoin('contacto_referencia','referencias.id','=','contacto_referencia.referencias_id')
	  	 						->leftjoin('tipo_telefono','contacto_referencia.tipo_telefono_id','=','tipo_telefono.id')
	  	 						->first();
	   	 $dataModule["referencia2"] = Prospectos::select('persona.nombres','persona.apellido_paterno','persona.apellido_materno','referencias.tiempo_conocerlo','contacto_referencia.telefono',
	   	 		'tipo_telefono.id as tipo_id','referencias.numero_interior','referencias.numero_exterior','referencias.calle')
	  	 						->where('prospectos.solicitud_id',$id)
	  	 						->leftjoin('dato_solicitante','prospectos.dato_solicitante_id','=','dato_solicitante.id')
	  	 						->leftjoin('referencias','dato_solicitante.id','=','referencias.dato_solicitante_id')
	  	 						->leftjoin('persona','referencias.persona_id','=','persona.id')
	  	 						->leftjoin('contacto_referencia','referencias.id','=','contacto_referencia.referencias_id')
	  	 						->leftjoin('tipo_telefono','contacto_referencia.tipo_telefono_id','=','tipo_telefono.id')
	  	 						->get()->last();	
	  	 $dataModule["escolaridad"]	= Prospectos::select('estudios.nombre as escuela','datos.nombre as datos','estudios.fecha_inicio','estudios.fecha_fin',
	  	 		'estudios.años','estudios.calle','estudios.numero_exterior','estudios.numero_interior','estudios.titulo')
	  	 						->where('prospectos.solicitud_id',$id)
	  	 						->leftjoin('dato_solicitante','prospectos.dato_solicitante_id','=','dato_solicitante.id')
	  	 						->leftjoin('estudios','dato_solicitante.id','=','estudios.dato_solicitante_id')
	  	 						->leftjoin('datos','estudios.datos_id','=','datos.id')
	  	 						->get();				

		return View::make($this->department.".main", $this->data)->nest('child', 'administracion.solicitud', $dataModule);
	}

	public function postEditar(){


	}
}


