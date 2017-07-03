<?php

class Proveedor extends Eloquent {
	protected $table = 'proveedor';
	public $timestamps = false;

	public function laminaalta() {
		return $this->hasMany('LaminaAlta');
	}

	public function departamento() {
		return $this->hasMany('Departamento');
	}
}