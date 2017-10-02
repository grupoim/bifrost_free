<?php

class Documentos extends Eloquent {
	protected $table = 'documentos';
public $timestamps = false;


	public function dato_solicitante() {
		return $this->belongsTo('DatoSolicitante');
	}
}