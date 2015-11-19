<?php 
 class ColoniaControlador extends \ModuloControlador {
 	public function getAll(){
 		return DB::table('colonia')->leftJoin('municipio', 'colonia.municipio_id', '=', 'municipio.id')
		->select('colonia.id', DB::raw("CONCAT(colonia.nombre, ' C.P. ', colonia.codigo_postal, ', ', municipio.nombre) as ubicacion"))
		->get();
 	}
 }
 ?>