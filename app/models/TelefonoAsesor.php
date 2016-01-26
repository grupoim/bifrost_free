<?php

class TelefonoAsesor extends Eloquent {
	protected $table = 'telefono_asesor';
	public $timestamps = false;

	public function asesor() {
		return $this->belongsTo('Asesor');
	}

	public function tipotelefono() {
		return $this->belongsTo('TipoTelefono');
	}
}