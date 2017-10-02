<?php
use Carbon\Carbon;
class ProspectosControlador extends \BaseController {

	public function __construct(){
		$this->data["module"] = "Personal";
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
	  $dataModule["solicitante"] = DatoSolicitante::select(DB::raw("CONCAT(persona.nombres, ' ', persona.apellido_paterno, ' ', persona.apellido_materno) as solicitante"),'dato_solicitante.id as solicitante_id')
												  ->leftJoin('persona','dato_solicitante.persona_id','=','persona.id')
												  ->get();	
	
	  $dataModule["prospectos"] = Prospectos::select('solicitud.puesto','solicitud.zona','solicitud.fecha_solicitud', 'prospectos.contratado',
		DB::raw("CONCAT(persona.nombres, ' ', persona.apellido_paterno, ' ', persona.apellido_materno) as cordinador"),'dato_solicitante.id as solicitante_id','prospectos.activo','solicitud.id as solicitud_id')
											->where('prospectos.activo',1)->where('prospectos.contratado',0)
											->leftJoin('solicitud','prospectos.solicitud_id','=','solicitud.id')
											->leftJoin('cordinador','solicitud.cordinador_id','=','cordinador.id')
											->leftJoin('persona','cordinador.persona_id','=','persona.id')
											->leftJoin('dato_solicitante','prospectos.dato_solicitante_id','=','dato_solicitante.id')
											->get();
	  return View::make($this->department.".main", $this->data)->nest('child', 'administracion.prospectos', $dataModule);
	}


	public function postContratacion(){

		$id = Prospectos::where('solicitud_id','=',Input::get('solicitud_id'))->firstorfail();

		$solicitud = Solicitud::find($id->solicitud_id);
		$solicitud->sueldo = Input::get('sueldo');
		$solicitud->fecha_contratacion = Input::get('fecha_contratacion').strftime( " %H-%M-%S", time() );
		$solicitud->save();

		$prospecto = Prospectos::find($id->id);
		$prospecto->contratado = 1;
		$prospecto->save();

		return  Redirect::back()->with('status', 'edit');


	}

	public function getContratados(){

	  $dataModule["personal"] = Prospectos::select('solicitud.id as solicitud_id','solicitud.puesto','solicitud.sueldo','solicitud.fecha_contratacion', 'prospectos.contratado',DB::raw("CONCAT(persona.nombres, ' ', persona.apellido_paterno, ' ', persona.apellido_materno) as solicitante"),
	  	'documentos.curp','documentos.rfc','documentos.imss',DB::raw("CONCAT(colonia.nombre, ' ', colonia.codigo_postal, ' ', municipio.nombre,' ', estado.nombre) as colonia"))
											->where('prospectos.activo',1)->where('prospectos.contratado',1)
											->leftJoin('solicitud','prospectos.solicitud_id','=','solicitud.id')
											->leftJoin('dato_solicitante','prospectos.dato_solicitante_id','=','dato_solicitante.id')											
											->leftJoin('persona','dato_solicitante.persona_id','=','persona.id')
											->leftJoin('documentos','dato_solicitante.id','=','documentos.dato_solicitante_id')
											->leftJoin('colonia','dato_solicitante.colonia_id','=','colonia.id')
											->leftJoin('municipio','colonia.municipio_id','=','municipio.id')
											->leftJoin('estado','municipio.estado_id','=','estado.id')
											->get();
	  return View::make($this->department.".main", $this->data)->nest('child', 'administracion.personal', $dataModule);
	}
	public function getDetalle($id)
	{
		return VistaRelacionPersonal::where('activo',1)->where('contratado',1)->find($id);


		
	}
	}

