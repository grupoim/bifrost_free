<?php

class ArchivoDocumentos extends Eloquent {
	protected $table = 'archivo_documentos';
	public $timestamps = false;
	protected $fillable = array('folio','fecha_salida','fecha_regreso','comentario','id_persona');
}
