<?php

class ComisionEsquemaVendedor extends Eloquent {
	protected $table = 'comision_esquema_vendedor';
	public $timestamps = false;

	public function asesor() {
		return $this->belongsTo('Asesor');
	}

}