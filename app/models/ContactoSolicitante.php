<?php

class ContactoSolicitante extends Eloquent {
	protected $table = 'contacto_solicitante';
    public $timestamps = false;


	public function datosolicitante() {
		return $this->belongsTo('DatoSolicitante');
	}

	public function tipotelefono() {
		return $this->belongsTo('TipoTelefono');
	}
}