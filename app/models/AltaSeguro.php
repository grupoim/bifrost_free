<?php

class AltaSeguro extends Eloquent {
	protected $table = 'alta_seguro';
    public $timestamps = false;

	public function datosolicitante() {
		return $this->hasMany('DatoSolicitante');
	}

}