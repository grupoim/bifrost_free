<?php
use Carbon\Carbon;
class ArchivoDocumentosControlador extends \BaseController {

	public function __construct(){
		$this->data["module"] = "Control de archivos";
		$this->data["icon"] = "fa fa-files-o";
		$this->department = Auth::user()->departamento->nombre;
	}
	public function getIndex()
	{
	
	$dataModule["status"] = Session::pull('status');
	$dataModule["archivos"] = ArchivoDocumentos::select('archivo_documentos.id','persona.nombres','persona.apellido_paterno','persona.apellido_materno','archivo_documentos.fecha_salida','archivo_documentos.activo','archivo_documentos.comentario','archivo_documentos.folio','archivo_documentos.fecha_regreso')->leftJoin('persona', 'archivo_documentos.persona_id', '=', 'persona.id')->get();
	$dataModule["personas"]= DB::table('persona')->select('id', DB::raw("CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) as nombre"))->get();	
		return View::make($this->department.".main", $this->data)->nest('child', $this->department.'.ArchivoDocumentos', $dataModule);
	}

	public function getPersonas(){
	
	$personas =DB::table('persona')->select('id', DB::raw("CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) as nombre"))->get();
	return Response::Json($personas);
	}
	public function postRegistro(){
if (Input::get('persona_id') == 0 || Input::get('folio') == false) {
	return  Redirect::back()->with('status', 'validar');
}else{
	if (DB::table('archivo_documentos')->where('folio','=',Input::get('folio'))->where('activo',1)->get()) {
		return  Redirect::back()->with('status', 'prestamo');
	}else{
if (Input::get('fecha_salida') == false) {
		$archivo_documentos = new ArchivoDocumentos;
        $archivo_documentos->folio =  Input::get('folio');
        $archivo_documentos->fecha_salida = strftime( "%Y-%m-%d %H-%M-%S", time());
        $archivo_documentos->fecha_regreso = " ";
        $archivo_documentos->comentario = Input::get('comentario');
        $archivo_documentos->persona_id = Input::get('persona_id');
        $archivo_documentos->save();
		return  Redirect::back()->with('status', 'registro');
}else{
		$archivo_documentos = new ArchivoDocumentos;
        $archivo_documentos->folio =  Input::get('folio');
        $archivo_documentos->fecha_salida = Input::get('fecha_salida').strftime( " %H-%M-%S", time() );
        $archivo_documentos->fecha_regreso = " ";
        $archivo_documentos->comentario = Input::get('comentario');
        $archivo_documentos->persona_id = Input::get('persona_id');
        $archivo_documentos->save();
		return  Redirect::back()->with('status', 'registro');
}		
}
}
}


public function getBaja($id){

			
			$archivo_documentos = ArchivoDocumentos::find($id);
			$archivo_documentos->activo = 0;
			$archivo_documentos->fecha_regreso = strftime( "%Y-%m-%d %H-%M-%S", time() );
			$archivo_documentos->save();
			return Redirect::back()->with('status', 'estatus-B');
}
public function getAlta($id){

			$archivo_documentos = ArchivoDocumentos::find($id);
			$archivo_documentos->activo = 1;
			$archivo_documentos->fecha_salida = strftime( "%Y-%m-%d %H-%M-%S", time() );
			$archivo_documentos->fecha_regreso = false;
			$archivo_documentos->save();
			return Redirect::back()->with('status', 'estatus-A');
}
			public function getRecupera($id){			
		
			
			$dataModule["fecha_regreso"] = ArchivoDocumentos::find($id);			

			return View::make($this->department.".main", $this->data)->nest('child', 'formularios.ArchivoDocumentos', $dataModule);		
			}	
public function postEditar(){
if (DB::table('archivo_documentos')->where('id','=',Input::get('id'))->where('activo',0)->get()) {
	return Redirect::to('archivo-control/index')->with('status', 'editar');
}else{
			$archivo_documentos = ArchivoDocumentos::where('id','=',Input::get('id'))->firstOrFail();
			$archivo_documentos->activo = 0;
			$archivo_documentos->fecha_regreso = Input::get('fecha_regreso').strftime( " %H-%M-%S", time() );
			$archivo_documentos->save();
			return Redirect::to('archivo-control/index')->with('status', 'estatus-B');
}
}
}